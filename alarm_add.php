
<?php
# Copyright (c) 2021 FaniPi

# aus Datei alarm_add.info ein array[][] erstellen 
# erstellt global $wecktage_arr
function alarm_add(){
	global $wecktage_arr;
	$datei = './wecker/alarm_add.info';
	if (file_exists($datei)) {
		$myfile = fopen($datei, "r") or die("Unable to open file!");
		// Output one line until end-of-file
		$wecktage_arr = array();
		while(!feof($myfile)) {
		  $mes = fgets($myfile);
		  $arr_mes = explode(",",$mes);
		  array_pop($arr_mes);
		  array_push($wecktage_arr, $arr_mes);
		}
		fclose($myfile);
		array_pop($wecktage_arr);
		return ($wecktage_arr);
	}
	$arr_1 = array("", "");
	$wecktage_arr = array($arr_1);
	return ($wecktage_arr);
}

# überprüfen von alarm_add array 
# ob eine Weckerwiederhlung gelöscht werden muss
# wenn ja wird die Datei alarm_add.info neu erstellt
function alarm_add_del(){
	global $wecktage_arr;
	$wecktage_arr_del = array();
	$check_del = 0;
	for ($x = 0; $x < count($wecktage_arr); $x++) {
		$file = "wecker/del_".$x;
		$file_2 = "wecker/aus_".$x;
		if(!file_exists($file)){
			array_push($wecktage_arr_del, $wecktage_arr[$x]);
			
			if(file_exists($file_2) and $check_del > 0){
				unlink($file_2);
				$z = $x - 1;
				$myfile = fopen("wecker/aus_".$z, "w");
				fclose($myfile);				
			}
			
		} else {
			$check_del++;
			unlink($file);
			if(file_exists($file_2)){
				unlink($file_2);
			}
		}
	}
	if($check_del > 0){
		$myfile = fopen("wecker/alarm_add.info", "w") or die("Unable to open file!");
		foreach ($wecktage_arr_del as $value) {
			$value = implode(",",$value);
			$value = $value.",\n";
			fwrite($myfile, $value);
			
		}
		fclose($myfile);
		$pfad = $_SERVER["PHP_SELF"];
		header("Location:".$pfad);
	}
}

#------------------------------------------------------
# überprüfen von alarm_add array 
# ob eine Weckerwiederhlung ausgeschaltet werden muss
# return $wecktage_arr_kor; in function auswertung_arr()
function alarm_add_kor(){
	global $wecktage_arr;
	$wecktage_arr_kor = array();
	for ($x = 0; $x < count($wecktage_arr); $x++) {
		$file_aus = "wecker/aus_".$x;
		if(!file_exists($file_aus)){
			array_push($wecktage_arr_kor, $wecktage_arr[$x]);
		}
	}
	
	return $wecktage_arr_kor;
}

# überprüfen von alarm_add_kor array
# welches ist der nächste Alarm
# erstellt GLOBALS $zeitspeicher, $tagspeicher
function auswertung_arr(){
	$wecktage_arr = alarm_add_kor();
	$aktuelltag = date("N");  # Mo=1 - SO=7
	$checktag = date("N");  # Mo=1 - SO=7
	$aktuellzeit = date("H:i");  # H=00-23 i=00-59
	$zeitspeicher = '';
	$tagspeicher = '';
	$einzelzeitspeicher = '';
	$einzeltagspeicher = '';
	$stop = 1;
	while($tagspeicher == '' and $stop <= 7){
		for ($x = 0; $x < count($wecktage_arr); $x++) {
			$uhrzeit = array_shift($wecktage_arr[$x]);		
			foreach ($wecktage_arr[$x] as $value) {
				# aktuelltag ist in arr und die Zeit ist noch nicht erreicht
				if($value == $aktuelltag){
					if($aktuelltag == $checktag){
						if($aktuellzeit < $uhrzeit){
							if($zeitspeicher == ''){
								$zeitspeicher = $uhrzeit;
							}
							echo $zeitspeicher.'-'.$uhrzeit."<br>";
							if($zeitspeicher > $uhrzeit){
								$zeitspeicher = $uhrzeit;
							}
							$tagspeicher = $value;
						}
						
						if($aktuellzeit >= $uhrzeit){
							if($einzelzeitspeicher == ''){
								$einzelzeitspeicher = $uhrzeit;
							}
							if($einzelzeitspeicher > $uhrzeit){
								$einzelzeitspeicher = $uhrzeit;
							}
							$einzeltagspeicher = $value;
						}
					} else{
						if($zeitspeicher == ''){
							$zeitspeicher = $uhrzeit;
						}
						if($zeitspeicher > $uhrzeit){
							$zeitspeicher = $uhrzeit;
						}
						$tagspeicher = $value;
					}
					
				}			
			}
			array_unshift($wecktage_arr[$x], $uhrzeit);
		}
		# aktuelltag ist nicht in arr welches ist der nächste tag und zeit
		$aktuelltag++; 
		if($aktuelltag == 8){$aktuelltag = 1;}
		$stop++;
	}
	
	if($tagspeicher == ''){
		eintag();
		$zeitspeicher = $einzelzeitspeicher;
		$tagspeicher = $einzeltagspeicher;
	} else {
		$file = "wecker/repeat.info";
		if(file_exists($file)){unlink($file);}
	}
	
	$GLOBALS['zeitspeicher'] = $zeitspeicher;
	$GLOBALS['tagspeicher'] = $tagspeicher;

}

# erstellt eine Datei für python
# repeat.info checkt ob ein alarm an dem Tag ausgeführt werden muss. 
# Wenn nur ein Tag gestellt ist in function auswertung_arr()
function eintag(){	
	$myfile = fopen("wecker/repeat.info", "w") or die("Unable to open file!");
	$tag = date('z');  # 0-365
	$tag++;
	fwrite($myfile, $tag);
	fclose($myfile);
	
	$file = "wecker/alarm.info";
	if(file_exists($file)){unlink($file);}
}
#------------------------------------------------------

# überprüft und schreibt .info Dateien 
# ändert bei bedarf GLOBALS $zeitspeicher, $tagspeicher
function datei_check(){
	global $tagspeicher, $zeitspeicher;
	$dateida = file_exists("wecker/sleep.info");  # wecker/
	if($dateida == TRUE){
		$tagspeicher = 8;
		$azeit = time();
		$szeit = $azeit+300; 
		$zeitspeicher = date("H:i", $szeit);
	} elseif(file_exists("wecker/alarm.info") == TRUE){  
		$tagspeicher = "aktiv";	
	} else {	
		$myfile = fopen("./wecker/wecktag_2.info", "w") or die("Unable to open file!");  
		fwrite($myfile, $tagspeicher);
		fclose($myfile);
		$myfile = fopen("./wecker/weckzeit_2.info", "w") or die("Unable to open file!"); 
		fwrite($myfile, $zeitspeicher);
		fclose($myfile);
	}
}

# ruft alarm_add() array auf global $wecktage_arr;
# zeigt aus- und ein-geschaltet Weckerwiederhlungen an 
function alarm_anzeigen(){
	global $wecktage_arr, $sprache;
	$wochentage = array('--', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So');
	if($sprache == 'en'){$wochentage = array('--', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');}
	for ($x = 0; $x < count($wecktage_arr); $x++) {
		$uhrzeit = array_shift($wecktage_arr[$x]);
		$uhrzeit = ' '.$uhrzeit;
		$umsch = 0;  
		$datei = 'wecker/aus_'.$x;
		if (file_exists($datei)){$umsch = 1;}
		if($umsch > 0){
			$opacity = 0.4;
		}else {
			$opacity = 1;
		}
		
		echo '<div class="w3-display-container w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border" style="opacity:'.$opacity.'">';	  
		
		$myForm_del = "del".$x;
		echo	'<div class="w3-display-topright">';
		echo		'<form method="post" id='.$myForm_del.' action="./wecker/alarm_add_form.php">';
		echo		'<input type="hidden" id="fname" name="fname" value="del_'.$x.'">';
		echo		'<i class="fa fa-times-rectangle" style="font-size:26px;color:blue" onclick="alert_del(\''.$myForm_del.'\')"></i>';
		echo		'</form>';
		echo	'</div>';
						
		echo	'<H3 class="w3-xlarge" style="color:blue"><b><i class="material-icons" style="font-size:48px;color:blue">update</i>';
		foreach ($wecktage_arr[$x] as $value) {
			$zahl = intval($value);
			if($zahl < 8){
				$zahl = intval($value);
				echo ' '.$wochentage[$zahl];
			}
		}
		echo	'</b></H3>';
		
		echo	'<h1 class="w3-xxxlarge" style="color:blue"><b><i class="material-icons" style="font-size:48px;color:blue">access_time</i>'.$uhrzeit.'</b></h1>';
		
		if($umsch > 0){
			$myForm_ein = "ein".$x;
			echo	'<div class="w3-display-bottomright">';
			echo		'<form method="post" id='.$myForm_ein.' action="./wecker/alarm_add_form.php">';
			echo		'<input type="hidden" name="fname" value="an_'.$x.'"><br><br>';
			echo		'<i class="fa fa-toggle-off" style="font-size:48px;color:blue" onclick="alert_ein(\''.$myForm_ein.'\')"></i>';
			echo		'</form>';
			echo	'</div>';
		} else{
			$myForm_aus = "aus".$x;
			echo	'<div class="w3-display-bottomright">';
			echo		'<form method="post" id='.$myForm_aus.' action="./wecker/alarm_add_form.php">';
			echo		'<input type="hidden" name="fname" value="aus_'.$x.'"><br><br>';
			echo		'<i class="fa fa-toggle-on" style="font-size:48px;color:blue" onclick="alert_aus(\''.$myForm_aus.'\')"></i>';
			echo		'</form>';
			echo	'</div>';
		} 
		
		echo '</div>';
	}
	
}

# zeigt mit GLOBALS $tagspeicher und $zeitspeicher nächsten Alarm an
function next_alert($wecktag, $weckzeit){	
	global $sprache;
	if($wecktag == ""){
		$wecktag = 0;
		$weckzeit = "--";
	}

	$wochentage = array('--', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So', 'snooze');
	if($sprache == 'en'){$wochentage = array('--', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', 'snooze');}
	$wecktag = intval($wecktag);
	$wecktag = $wochentage[$wecktag];
	$datei = './wecker/wecker.info';
	if (file_exists($datei)) {
		echo '<div class="w3-panel w3-pale-green w3-leftbar w3-border-green w3-border">';
	    echo '	<h1 class="w3-xxxlarge" style="color:green"><b><i class="material-icons" style="font-size:48px;color:green">alarm_on</i> '.$wecktag.' '.$weckzeit.'</b></h1>';
		echo '</div>';
	} else{
		echo '<div class="w3-panel w3-pale-red w3-leftbar w3-border-red w3-border">';
	    echo '	<h1 class="w3-xxxlarge" style="color:red"><b><i class="material-icons" style="font-size:48px;color:red">alarm_off</i> Alarm off</b></h1>';
		echo '</div>';
	}
}


?>







