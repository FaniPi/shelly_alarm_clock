<?php
# Copyright (c) 2021 FaniPi

$myfile = fopen("sleep.info", "w") or die("Unable to open file!");
fclose($myfile);

$pfad = $_SERVER["PHP_SELF"];
$teilen = explode("/", $pfad);
header("Location:/".$teilen[1]."/#wecker");

?>