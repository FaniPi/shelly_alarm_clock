# shelly_alarm_clock
## Light alarm clock with Shelly WiFi Switch

**What it takes**
1. Shelly WiFi Switch 1 
2. Web server
3. PHP
4. Python 3 

**What needs to be adjusted.**
1. File ***shelly/set_ip/ip.php***
Enter the IP of the Shelly WiFi Switch in the ***$alert_ip*** variable.
2. File ***shelly/wecker/wecker.py***
Enter the IP of the Shelly WiFi Switch in the ***ip*** variable.

**Options to switch the light on and off.**
1. Shelly WiFi Switch 1 or 2.5
File shelly/shelly_switch_anzeigen.php 
2. Bulb
File shelly/shelly_bulb_anzeigen.php 
File shelly/set_ip/ip.php $include_bulb = 'on'

----------------------------------------------

## Licht Wecker mit Shelly WiFi Switch

**Was es braucht**
1. Shelly WiFi Switch 1 
2. Web server
3. PHP
4. Python 3 

**Was muss angepasst werden.**
1. Datei ***shelly/set_ip/ip.php***
Geben Sie die IP des Shelly WiFi Switch in der Variabel ***$alert_ip*** ein.
2. Datei ***shelly/wecker/wecker.py***
Geben Sie die IP des Shelly WiFi Switch in der Variabel ***ip*** ein.
3. Auf Deutsch umstellen
Datei shelly/index.php umbenennen zu indexEN.php
Datei shelly/indexDE.php umbenennen zu index.php

**Optionen zum Licht an-aus-schalten.**
1. Shelly WiFi Switch 1 oder 2.5
Datei shelly/shelly_switch_anzeigen.php 
2. Lampe
Datei shelly/shelly_bulb_anzeigen.php 
Datei shelly/set_ip/ip.php $include_bulb = 'on'
