<?php
# Copyright (c) 2021 FaniPi

function weckdatei(){
	$zeit = 0;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$zeit = test_input($_POST["zeit"]);
		$zeit = $zeit.',';
		$myfile = fopen("alarm_add.info", "a") or die("Unable to open file!");
		fwrite($myfile, $zeit);
		
		$wochentage = array('Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So');
		$wecktage = array();
		$keintag = 0;
		foreach ($wochentage as $value) {
			$tag = test_input($_POST[$value]);
			$tag = intval($tag);
			if($tag != 0){				
				$tag = $tag.",";
				fwrite($myfile, $tag);
				$keintag++;
			} else {
				array_push($wecktage, $tag);
			}		
		}

		if($keintag == 0){
			for($x = 1; $x <= count($wochentage); $x++) {
				$tag = $x.",";
				fwrite($myfile, $tag);
			}
		}
		
		$new_line = "\n";
		fwrite($myfile, $new_line);
		fclose($myfile);
	}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function goBack(){
	$pfad = $_SERVER["PHP_SELF"];
	$teilen = explode("/", $pfad);
	header("Location:/".$teilen[1]."/");	
}

weckdatei();
goBack();
?>









