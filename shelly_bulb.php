
<?php
#include "./set_ip/ip.php";

function shelly_bulb($ip_short, $raum, $a, $b){
	global $farbe, $hell;
	$ip = ip_change($ip_short);
	$jsondata = file_get_contents('http://'.$ip.'/light/0');
	$return = json_decode($jsondata, true);
	$farbe = $return["white"];
	$hell = $return["brightness"];

	echo '<div class="w3-third w3-margin-top">';
	echo '<div class="w3-card">';
	echo '<div class="w3-container w3-center w3-blue">';
	echo '<h2><b>'.$raum.'</b></h2>';
	echo '</div>';
	if($return["ison"] == true){
        echo '<img src="./img/bulbon.gif" style="width:100%" onclick="getBulb_w(\''.$ip.'\','.$farbe.','.$hell.')">';		
	} else {
        echo '<img src="./img/bulboff.gif" style="width:100%" onclick="getBulb_w(\''.$ip.'\','.$farbe.','.$hell.')">';
	}
	echo '</div>';
	shelly_bulb_form();
	echo '</div>';
	
}

function shelly_bulb_klein($ip_short, $raum, $a, $b){
	$ip = ip_change($ip_short);
	$jsondata = file_get_contents('http://'.$ip.'/light/0');
	$return = json_decode($jsondata, true);
	$farbe = $return["white"];
	$hell = $return["brightness"];

	echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border" onclick="getBulb_w(\''.$ip.'\','.$farbe.','.$hell.')">';
	if($return["ison"] == true){
		echo '<H1 class="w3-xxlarge" style="color:blue"><b><i class="material-icons" style="font-size:48px;color:yellow">wb_incandescent</i>'.$raum.'<i class="material-icons" style="font-size:48px; color:black">touch_app</i></b></H1>';
	} else {
		echo '<H1 class="w3-xxlarge" style="color:blue"><b><i class="material-icons" style="font-size:48px;color:black">wb_incandescent</i>'.$raum.'<i class="material-icons" style="font-size:48px;color:yellow">touch_app</i></b></H1>';
	}
	echo '</div>';
	shelly_bulb_form();
}

function shelly_bulb_form(){
	global $farbe, $hell, $a, $b, $ip;

	echo '<div class=" w3-center w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border">';		
	echo '<form method="post" action="wecker/bulb_form.php"';
	echo 'oninput="x.value=parseInt('.$a.'.value);y.value=parseInt('.$b.'.value)">';

	echo  '<br>'; 
	echo ' Weiss<br>';
	echo ' 0';
	echo  '<input type="range" id="'.$a.'" name="farbe" value="'.$farbe.'">100';	   
	echo  '<br>';
	echo  '<output name="x" for="'.$a.'"></output>';
	echo  '<br><br>';
	
	echo  'Helligkeit<br>';
	echo  '0';
	echo  '<input type="range" id="'.$b.'" name="hell" value="'. $hell.'">100';	   
	echo  '<br>';
	echo  '<output name="y" for="'.$b.'"></output>';
	echo  '<br>'; 
	
	echo  '<input type="hidden"  name="ip" value="'.$ip.'"><br>';
	
	echo  '<button class="w3-btn w3-border w3-blue w3-xlarge">Anwenden</button>';
	echo  '<br><br>'; 
	echo '</form>';
	echo '</div>';
}

?>



 

