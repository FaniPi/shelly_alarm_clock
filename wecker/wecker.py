#!/usr/bin/python
import requests
import time
import os
import datetime

ip = "192.168.1.48"

while 0 < 1:
    # Sleep
    if os.path.isfile("sleep.info"):
        requests.get("http://" + ip + "/relay/0?turn=off")
        time.sleep(300)
        if os.path.isfile("sleep.info"):
            os.remove("sleep.info")
        continue

    # repeat
    if os.path.isfile("repeat.info"):
        f = open("repeat.info", "r")
        repeat_tag = f.readline()  # repeat tag
        f.close()
        x = datetime.datetime.now()  # 1-366
        sys_tag = x.strftime("%j")
        if repeat_tag == sys_tag:
            time.sleep(10)
            continue
        else:
            os.remove("repeat.info")

    # alarm
    if os.path.isfile("alarm.info"):
        a = 0
        while a <= 60 and os.path.isfile("alarm.info"):
            if os.path.isfile("sleep.info"):
                break
            if a < 60:
                try:
                    requests.get("http://" + ip + "/relay/0?turn=toggle")
                    time.sleep(2)  # Zeit zwischen an und aus
                    a = a + 1
                except TimeoutError:
                    continue
            else:
                time.sleep(60)
                a = 0

    # zeit
    if not os.path.isfile("weckzeit_2.info"):
        time.sleep(5.0)
        continue
    else:
        f = open("weckzeit_2.info", "r")
        a_zeit = f.readline()  # zeit
        f.close()

    # wecktag
    if os.path.isfile("wecktag_2.info"):
        f = open("wecktag_2.info", "r")
        a_tag = f.readline()  # tag
        f.close()
    else:
        time.sleep(5.0)
        continue

    # zeit und tag
    b = datetime.datetime.now()
    b_zeit = b.strftime("%H:%M")
    b_tag = b.strftime("%u")

    # alarm check
    if os.path.isfile("wecker.info") and b_zeit >= a_zeit and b_tag == a_tag:
        f = open("alarm.info", "w")
        f.close()

    time.sleep(2.0)
