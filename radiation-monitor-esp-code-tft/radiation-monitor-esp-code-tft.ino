#include <Wire.h>
#include <DHT.h>

#define LOG_PERIOD 30000 // count rate (in milliseconds)
#define dhtpin 27
#define DHTType DHT22

DHT dht = DHT(dhtpin, DHTType);
unsigned long  counts; //variable for GM Tube events
unsigned long previousMillis; //variable  for measuring time
float averageCPM;
float sdCPM;
int currentCPM;
float  calcCPM;
float CPMArray[100];

void IRAM_ATTR impulse() {
  counts++;
}

void setup() { //setup
  counts = 0;
  currentCPM = 0;
  averageCPM = 0;
  sdCPM = 0;
  calcCPM  = 0;
  Serial.begin(115200);
  dht.begin();
  pinMode(13,INPUT);
  attachInterrupt(digitalPinToInterrupt(13),impulse, FALLING); //define  external interrupts
}

void loop() { //main cycle
  delay(1000);
  float kelembaban = dht.readHumidity();
  float suhu = dht.readTemperature();
  if (isnan(kelembaban) || isnan(suhu)) {
    Serial.println("Failed to read from the DHT sensor, check wiring.");
    return;
  }
    
  Serial.println("CPM Count: ");
  Serial.println(counts);
  unsigned long currentMillis  = millis();
  if (currentMillis - previousMillis > LOG_PERIOD) {
    previousMillis  = currentMillis;
    CPMArray[currentCPM] = counts * 2;
    Serial.println("uSv/hr: ");
    Serial.println(outputSieverts(CPMArray[currentCPM]));
    counts = 0;
    averageCPM = 0;
    sdCPM = 0;
    
    //calc avg and sd
    for (int x=0; x<currentCPM+1; x++)  {
      averageCPM = averageCPM + CPMArray[x];
    }

    averageCPM = averageCPM / (currentCPM + 1);

    for (int x=0; x<currentCPM+1; x++)  {
      sdCPM = sdCPM + sq(CPMArray[x] - averageCPM);
    }

    sdCPM  = sqrt(sdCPM / currentCPM) / sqrt(currentCPM+1);

    Serial.println("Avg:  " + String(averageCPM) + " +/- " + String(sdCPM) + "  ArrayVal: " + String(CPMArray[currentCPM]));
    currentCPM = currentCPM + 1;


    //Serial Print
    Serial.print("Humidity: ");
    Serial.print(kelembaban);
    //Print out the Temperature
    Serial.print("% || Temperature: ");
    Serial.print(suhu);
    Serial.print("°C ");

    //Print new line
    Serial.println();
  } 
}

float outputSieverts(float x)  {
  float y = x * 0.00812;
  return y;
}