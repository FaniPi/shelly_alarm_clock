<?php
# Copyright (c) 2021 FaniPi
include "../set_ip/ip.php";
unlink("wecker.info");
unlink("sleep.info");
unlink("alarm.info");
unlink("repeat.info");

file_get_contents('http://'.$alert_ip.'/relay/0?turn=off');
$pfad = $_SERVER["PHP_SELF"];
$teilen = explode("/", $pfad);
header("Location:/".$teilen[1]."/");

?>