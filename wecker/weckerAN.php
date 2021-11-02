<?php

$myfile = fopen("wecker.info", "w");
fclose($myfile);

$pfad = $_SERVER["PHP_SELF"];
$teilen = explode("/", $pfad);
header("Location:/".$teilen[1]."/");

?>
