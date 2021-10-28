<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$ip = $_POST["ip"];
		$farbe = $_POST["farbe"];
		$hell = $_POST["hell"];
		file_get_contents('http://192.168.1.'.$ip.'/light/0?white='.$farbe.'&brightness='.$hell.'');
}

function goBack(){
	$pfad = $_SERVER["PHP_SELF"];
	$teilen = explode("/", $pfad);
	header("Location:/".$teilen[1]."/#bulb");	
}

goBack();	
?>