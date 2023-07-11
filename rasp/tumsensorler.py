import RPi.GPIO as GPIO
import time
import datetime
import MySQLdb
import Adafruit_DHT
#GPIO.cleanup()
GPIO.setwarnings(False);

#Bir MySQL veritabanına bağlantı kuruluyor. Bu bağlantı conn değişkenine atanıyor.
conn = MySQLdb.connect(user="root",
                  passwd="1234",
                  db="olcumler")
x = conn.cursor()

# Su sensörü pini
water_pin = 5

# Yangın sensörü pini
fire_pin = 20

# Ses sensörü pini
sound_pin = 6

# Hareket sensörü pini
motion_pin = 12

# DHT11 sensörü pini
dht_pin = 14

# Buzzer pini
buzzer_pin = 23


# GPIO ayarları
GPIO.setmode(GPIO.BCM)
GPIO.setup(buzzer_pin, GPIO.OUT)
GPIO.setup(dht_pin, GPIO.OUT)
GPIO.setup(water_pin, GPIO.IN)
GPIO.setup(fire_pin, GPIO.IN)
GPIO.setup(sound_pin, GPIO.IN)
GPIO.setup(motion_pin, GPIO.IN)

# DHT11 sensörü ayarları
sensor = Adafruit_DHT.DHT11

#RGB led pinlerine atanan pin numaraları
bluePin = 19 
greenPin = 13
redPin = 26 
#RGB Led pinleri çıkış olarak ayarlanır.
GPIO.setup(redPin,GPIO.OUT)
GPIO.setup(greenPin,GPIO.OUT)
GPIO.setup(bluePin,GPIO.OUT)

#buzzer için fonksiyon oluşturuldu
def buzz(duration):
    GPIO.output(buzzer_pin, GPIO.HIGH)
    time.sleep(duration)
    GPIO.output(buzzer_pin, GPIO.LOW)
    time.sleep(duration)
    
#Renk segmentleri için fonksiyonlar oluşturuldu.
def turnOff():
    GPIO.output(redPin,GPIO.HIGH)
    GPIO.output(greenPin,GPIO.HIGH)
    GPIO.output(bluePin,GPIO.HIGH)
def white():
    GPIO.output(redPin,GPIO.LOW)
    GPIO.output(greenPin,GPIO.LOW)
    GPIO.output(bluePin,GPIO.LOW)
    
def red():
    GPIO.output(redPin,GPIO.LOW)
    GPIO.output(greenPin,GPIO.HIGH)
    GPIO.output(bluePin,GPIO.HIGH)

def green():
    GPIO.output(redPin,GPIO.HIGH)
    GPIO.output(greenPin,GPIO.LOW)
    GPIO.output(bluePin,GPIO.HIGH)
    
def blue():
    GPIO.output(redPin,GPIO.HIGH)
    GPIO.output(greenPin,GPIO.HIGH)
    GPIO.output(bluePin,GPIO.LOW)

try:
    while True:
        # Su sensörü okunuyor
        if GPIO.input(water_pin)==1:
            print("Su algilandi!")
            su = "1"
            red()
            buzz(1)  # Buzzer'ı 1 saniye boyunca açık tut
            #time.sleep(2)
        else:
            su = "0"
            white()

        # Yangın sensörü okunuyor
        if GPIO.input(fire_pin):
            print("Yangin algilandi!")
            yangın = "1"
            red()
            buzz(1)  # Buzzer'ı 1 saniye boyunca açık tut
            #time.sleep(2)
        else:
            yangın = "0"
            white()

        # Ses sensörü okunuyor
        if GPIO.input(sound_pin):
            print("Ses algilandi!")
            ses = "1"
            red()
            buzz(1)  # Buzzer'ı 1 saniye boyunca açık tut
            #time.sleep(2)
        else:
            ses = "0"
            white()

        # Hareket sensörü okunuyor
        if GPIO.input(motion_pin):
            print("Hareket algilandi!")
            hareket = "1"
            red()
            buzz(1)  # Buzzer'ı 1 saniye boyunca açık tut
            #time.sleep(2)
        else:
            hareket = "0"
            white()

        # DHT11 sensörü okunuyor
        humidity, temperature = Adafruit_DHT.read_retry(sensor, dht_pin)
        if humidity is not None and temperature is not None:
            print('Sicaklik: {0:0.1f} C - Nem: {1:0.1f} %'.format(temperature, humidity))
        else:
            print('DHT11 sensorunden okuma basarisiz.')

        # 2 saniye aralıklarla sensörler okunuyor
        time.sleep(2)

        # Veriler MySQL veritabanına kaydediliyor
        x.execute("INSERT INTO genel_olcumler(ZAMAN, SICAKLIK, NEM, YANGIN, HAREKET, SU, SES) VALUES (NOW(), %s, %s, %s, %s, %s, %s)",
                  (temperature, humidity, yangın, hareket, su, ses))
        conn.commit()
        time.sleep(1)

except KeyboardInterrupt:
    # GPIO.cleanup()
    pass
