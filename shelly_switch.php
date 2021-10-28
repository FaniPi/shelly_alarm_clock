
<?php
#include "./set_ip/ip.php";


function shelly_switch($ip_short, $raum, $kanal="0"){
	$ip = ip_change($ip_short);
	$jsondata = file_get_contents('http://'.$ip.'/relay/'.$kanal.'');
	$return = json_decode($jsondata, true);
	
	echo '<div class="w3-quarter w3-margin-top">';
	echo '<div class="w3-card">';
	echo '<div class="w3-container w3-center w3-blue">';
	echo '<h3><b>'.$raum.'</b></h3>';
	echo '</div>';
    if($return["ison"] == true){
		echo '<img src="./img/bulbon.gif" style="width:100%" onclick="getSwitch(\''.$ip.'\','.$kanal.')">';		
	} else {
		echo '<img src="./img/bulboff.gif" style="width:100%" onclick="getSwitch(\''.$ip.'\','.$kanal.')">';
	}
	echo '</div>';
	echo '</div>';	
}

function shelly_switch_klein($ip_short, $raum, $kanal="0"){
	$ip = ip_change($ip_short);
	$jsondata = file_get_contents('http://'.$ip.'/relay/'.$kanal.'');
	$return = json_decode($jsondata, true);
	
	echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border" onclick="getSwitch(\''.$ip.'\','.$kanal.')">';
	if($return["ison"] == true){
		echo '<H1 class="w3-xxlarge" style="color:blue"><b><i class="material-icons" style="font-size:48px;color:yellow">wb_incandescent</i> '.$raum.'<i class="material-icons" style="font-size:48px; color:black">touch_app</i></b></H1>';
	} else {
		echo '<H1 class="w3-xxlarge" style="color:blue"><b><i class="material-icons" style="font-size:48px;color:black">wb_incandescent</i> '.$raum.'<i class="material-icons" style="font-size:48px;color:yellow">touch_app</i></b></H1>';
	}
	echo '</div>';
}



?>



