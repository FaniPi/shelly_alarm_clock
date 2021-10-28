<?php
# Copyright (c) 2021 FaniPi
include "../set_ip/ip.php";

#unlink("sleep.info");
unlink("alarm.info");
$myfile = fopen("repeat.info", "w") or die("Unable to open file!");
$tag = date('z');  # 0-365
$tag++;
fwrite($myfile, $tag);
fclose($myfile);

file_get_contents('http://'.$alert_ip.'/relay/0?turn=off');

$pfad = $_SERVER["PHP_SELF"];
$teilen = explode("/", $pfad);
header("Location:/".$teilen[1]."/");

?>