#include <WiFi.h>
#include <WiFiClient.h>
#include <HTTPClient.h>
#include <DHT.h>
#include <ArduinoJson.h>

#define WIFI_SSID "realme 5i"
#define WIFI_PASSWORD "qwerty123"
#define SERVER_POST "http://192.168.43.94:8000/api/store-data-indoor-monitor"
#define API_KEY "DTkUNSHF1sFhjzNFY2z8gOOOMgL4PA4p"

#define LOG_PERIOD 30000  // count rate (in milliseconds)
#define MAX_PERIOD 60000
#define dhtpin 15
#define DHTType DHT22

DHT dht = DHT(dhtpin, DHTType);

unsigned long counts;          //variable for GM Tube events
unsigned long previousMillis;  //variable  for measuring time
unsigned long lastTime = 0;
unsigned long timerDelay = 1000;
unsigned int multiplier;

double rerataCPM;
double sdCPM;
int currentCPM;
double calcCPM;
double doseRate;
double pencacahanArray[100];

void IRAM_ATTR impulse() {
  counts++;
}

void setup() {  //setup
  counts = 0;
  currentCPM = 0;
  rerataCPM = 0;
  sdCPM = 0;
  calcCPM = 0;

  multiplier = MAX_PERIOD / LOG_PERIOD;

 //begin
  Serial.begin(9600);
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
  double kelembaban = dht.readHumidity();
  double suhu = dht.readTemperature();

  if (isnan(kelembaban) || isnan(suhu)) {
    Serial.println("Failed to read from the DHT sensor, check wiring.");
    return;
  }
  // pembacaan interupt cacahan
  Serial.print("CPM Count: ");
  Serial.println(counts);
  unsigned long currentMillis = millis();
  if (currentMillis - previousMillis > LOG_PERIOD) {
    previousMillis = currentMillis;
    pencacahanArray[currentCPM] = counts * multiplier;
    Serial.print("uSv/hr: ");
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
  }
  if ((millis() - lastTime) > timerDelay) {
    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;

      //POST
      http.begin(SERVER_POST);
      http.addHeader("Content-Type", "application/json");
      http.addHeader("Api-Key", API_KEY);

      StaticJsonDocument<200> docPost;

      docPost["temperature"] = round2(suhu);
      docPost["humidity"] = round2(kelembaban);
      docPost["dose_rate"] = round2(doseRate);

      String requestBody;
      serializeJson(docPost, requestBody);

      int httpResponseCodePost = http.POST(requestBody);
      Serial.println("\n" + requestBody + "\n");

      if (httpResponseCodePost > 0) {
        String response = http.getString();

        Serial.print("code: ");
        Serial.println(httpResponseCodePost);
        Serial.println(response + "\n");
      } else {
        Serial.printf("Error occured while sending HTTP POST: %s\n", http.errorToString(httpResponseCodePost).c_str());
      }

      http.end();
    }
  }
  Serial.print("Humidity: ");
  Serial.print(kelembaban);
  //Print out the Temperature
  Serial.print("% || Temperature: ");
  Serial.print(suhu);
  Serial.print("°C ");
}

double Sieverts(double x) {
  double y = x * 0.00571;
  return y;
}

double round2(double value) {
  return (int)(value * 100 + 0.5) / 100.00;
}
