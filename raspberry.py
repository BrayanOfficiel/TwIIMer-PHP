from machine import Pin, PWM
import network  # import des fonction lier au wifi
import urequests  # import des fonction lier au requetes http
import utime  # import des fonction lier au temps
import ujson  # import des fonction lier aà la convertion en Json

(Pin(8, mode=Pin.OUT)).off
(Pin(9, mode=Pin.OUT)).off
(Pin(10, mode=Pin.OUT)).off
    
wlan = network.WLAN(network.STA_IF) # met la raspi en mode client wifi
wlan.active(True) # active le mode client wifi

# Wi-Fi credentials
ssid = "ssid"
mdp = "mdp"
local_ip = "192.168.1.128"
url = "http://" + local_ip + "/iot.php"
print("URL =", url)

wlan.connect(ssid, mdp) # connecte la raspi au réseau

#dictionnaire avec type / couleur

colors = {
    "Brayan": (255,0,255),
    "IAiiRoZz": (255, 0, 0),
    "test": (255, 255, 255),
    "test3": (192, 168, 1),
}

#afficher la led de la couleur correspondant au type
ledR = PWM(Pin(10, mode=Pin.OUT)) 
ledG = PWM(Pin(9, mode=Pin.OUT))
ledB = PWM(Pin(8, mode=Pin.OUT))

leds=[ledR,ledG,ledB]

for led in leds:
    led.freq(1000)
    led.duty_u16(0)

def color (r,g,b):
    leds[0].duty_u16(r*255)
    leds[1].duty_u16(g*255)
    leds[2].duty_u16(b*255)

while not wlan.isconnected():
    print("Connexion en cours...")
    utime.sleep(1)
    pass


while(True):
    try:
        print("Connecté")
        print("Requête 'GET' en cours")
        req = urequests.get(url)
        path = (req.json()[0]["author"])
        print("Dernier utilisateur à avoir tweet : ", path)
        print("Couleur (R,G,B) :", colors[path])
        color(colors[path][0],colors[path][1],colors[path][2])
        req.close()
    except Exception as e:
        print(e)
    break
