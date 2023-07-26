#include <WiFi.h>
#include <WiFiClient.h>
#include <HTTPClient.h>
#include <Wire.h>
#include <DHT.h>
#include <ArduinoJson.h>

#define WIFI_SSID "Storyart"
#define WIFI_PASSWORD "minimalmintakek"
#define SERVER_NAME ""

#define LOG_PERIOD 60000  // count rate (in milliseconds)
#define dhtpin 15
#define DHTType DHT22

DHT dht = DHT(dhtpin, DHTType);


unsigned long counts;          //variable for GM Tube events
unsigned long previousMillis;  //variable  for measuring time
unsigned long lastTime = 0;
unsigned long timerDelay = 1000;

float rerataCPM;
float sdCPM;
int currentCPM;
float calcCPM;
float doseRate;
float pencacahanArray[100];

void IRAM_ATTR impulse() {
  counts++;
}

void setup() {  //setup
  counts = 0;
  currentCPM = 0;
  rerataCPM = 0;
  sdCPM = 0;
  calcCPM = 0;

 //begin
  Serial.begin(115200);
  Wire.begin();
  dht.begin();
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

  // PINMODE
  pinMode(dhtpin, INPUT);
  pinMode(12, INPUT);
  attachInterrupt(digitalPinToInterrupt(12), impulse, FALLING);  //define  external interrupts
}

void loop() {  //main cycle
  delay(1000);
  //pembacaan sensor DHT22
  float kelembaban = dht.readHumidity();
  float suhu = dht.readTemperature();

  if (isnan(kelembaban) || isnan(suhu)) {
    Serial.println("Failed to read from the DHT sensor, check wiring.");
    return;
  }
  //pembacaan interupt cacahan
  Serial.println("CPM Count: ");
  Serial.println(counts);
  unsigned long currentMillis = millis();
  if (currentMillis - previousMillis > LOG_PERIOD) {
    previousMillis = currentMillis;
    pencacahanArray[currentCPM] = counts * 2;
    Serial.println("uSv/hr: ");
    Serial.println(Sieverts(pencacahanArray[currentCPM]));
    counts = 0;
    rerataCPM = 0;
    sdCPM = 0;
    //calc avg and sd
    for (int x = 0; x < currentCPM + 1; x++) {
      rerataCPM = rerataCPM + pencacahanArray[x];
    }
    rerataCPM = rerataCPM / (currentCPM + 1);
    for (int x = 0; x < currentCPM + 1; x++) {
      sdCPM = sdCPM + sq(pencacahanArray[x] - rerataCPM);
    }
    sdCPM = sqrt(sdCPM / currentCPM) / sqrt(currentCPM + 1);

    doseRate = Sieverts(pencacahanArray[currentCPM]);

    //Serial.println("Avg:  " + String(rerataCPM) + " +/- " + String(sdCPM) + "  ArrayVal: " + String(pencacahanArray[currentCPM]));
    currentCPM = currentCPM + 1;
    if ((millis() - lastTime) > timerDelay) {
      if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;

        http.begin(SERVER_NAME);
        http.addHeader("Content-Type", "application/json");

        StaticJsonDocument<200> doc;

        doc["suhu"] = round2(suhu);
        doc["kelembaban"] = round2(kelembaban);
        doc["dose_rate"] = round2(doseRate);

        String requestBody;
        serializeJson(doc, requestBody);

        int httpResponseCode = http.POST(requestBody);
        Serial.println("\n" + requestBody + "\n");

        if (httpResponseCode > 0) {
          String response = http.getString();

          Serial.print("code: ");
          Serial.println(httpResponseCode);
          Serial.println(response + "\n");
        } else {
          Serial.printf("Error occured while sending HTTP POST: %s\n", http.errorToString(httpResponseCode).c_str());
        }
      }
    }
    //Serial Print
    Serial.print("Humidity: ");
    Serial.print(kelembaban);
    //Print out the Temperature
    Serial.print("% || Temperature: ");
    Serial.print(suhu);
    Serial.print("°C ");
    
    //LCD PRINT
    lcdCMD("suhu.val=",suhu);
    lcdCMD("kelembaban.val=",kelembaban);
    lcdCMD("doseRate.val=",doseRate);

    
  }
}

float Sieverts(float x) {
  float y = x * 0.00571;
  return y;
}

float round2(float value) {
  return (int)(value * 100 + 0.5) / 100.00;
}

void lcdCMD(String cmd, float val){
  Serial.print(cmd);
  Serial.print(val);
  Serial.write(255);
  Serial.write(255);
  Serial.write(255);
}