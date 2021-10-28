<?php
# Copyright (c) 2021 FaniPi

function alarm_add(){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$fname = $_POST["fname"];
		$f = explode("_", $fname);
		if($f[0] == "aus"){myfile_w($fname);}
		if($f[0] == "an"){myfile_d("aus_".$f[1]);}
		if($f[0] == "del"){myfile_w($fname);}
	}		
}

function myfile_w($fname){
	$myfile = fopen($fname, "w");
	fclose($myfile);
}

function myfile_d($fname){
	unlink($fname);
}

function goBack(){
	$pfad = $_SERVER["PHP_SELF"];
	$teilen = explode("/", $pfad);
	header("Location:/".$teilen[1]."/");	
}


alarm_add();
goBack();


?>


