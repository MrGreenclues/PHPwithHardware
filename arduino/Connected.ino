#include <ESP8266WiFi.h>

const char* ssid = "YUHAN";
const char* password = "coronavirus2020";

const int buzzerPin = 4; // Use GPIO4 (D2 on ESP8266)

WiFiServer server(80);

void setup() {
  pinMode(buzzerPin, OUTPUT);
  pinMode(D3, OUTPUT);
  pinMode(D4, OUTPUT);
  pinMode(D5, OUTPUT);

  Serial.begin(115200);
  Serial.println();
  Serial.print("Connecting to WiFi: ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println();
  Serial.print("NodeMCU IP Address: ");
  Serial.println(WiFi.localIP());

  server.begin();
}

void loop() {
  WiFiClient client = server.available();

  if (client) {
    String request = client.readStringUntil('\r');
    client.flush();

    Serial.println(request);

    if (request.indexOf("GET /control?status=Blue%20Button%20Pressed") != -1) {
    digitalWrite(D3, HIGH);   // Turn the blue LED on
    tone(buzzerPin, 1000);    // Start the buzzer
    delay(500);               // Keep the LED and buzzer on for 500ms
    digitalWrite(D3, LOW);    // Turn the blue LED off
    noTone(buzzerPin);        // Stop the buzzer
    } else if (request.indexOf("GET /control?status=Red%20Button%20Pressed") != -1) {
      digitalWrite(D4, HIGH);
      tone(buzzerPin, 1000); // 1000 Hz tone
      delay(500);
      digitalWrite(D4, LOW);
      noTone(buzzerPin);
    } else if (request.indexOf("GET /control?status=Green%20Button%20Pressed") != -1) {
      digitalWrite(D5, HIGH);
      tone(buzzerPin, 1000); // 1000 Hz tone
      delay(500);
      digitalWrite(D5, LOW);
      noTone(buzzerPin);
    }

    // Send a response back to the client
    client.println("HTTP/1.1 200 OK");
    client.println("Content-Type: text/html");
    client.println("Connection: close");
    client.println();
    client.println("Command received");
    delay(1);
  }
}
