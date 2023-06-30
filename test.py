# python script to get json from iot.php and output a color to raspberry depending on the user

from machine import Pin, PWM
import network  # import des fonction lier au wifi
import urequests  # import des fonction lier au requetes http
import utime  # import des fonction lier au temps
import ujson  # import des fonction lier aà la convertion en Json

# configuration des parametre de connexion au wifi
ssid = "Brayan's iPhone"
password = "aorusz390"

# configuration des parametre de connexion au serveur
url = "http://localhost/iot.php"
headers = {'content-type': 'application/json'}

# configuration des parametre de connexion au led rgb
ledR = PWM(Pin(8), freq=1000)
ledG = PWM(Pin(9), freq=1000)
ledB = PWM(Pin(10), freq=1000)

