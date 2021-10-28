<?php
$datei = './wecker/wecker.info';
if (file_exists($datei)) {	
	echo '<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue w3-border">';
	echo '<a href="wecker/wsleep.php"><h1 class="w3-xxxlarge" style="color:blue"><b><i class="material-icons" style="font-size:48px;color:blue">snooze </i> Snooze<i class="material-icons" style="font-size:48px;color:blue">touch_app</i></b></h1></a>';
	echo "</div>";
	echo '<div class="w3-panel w3-pale-green w3-leftbar w3-border-green w3-border">';
	echo '<a href="wecker/wrepeat.php"><h1 class="w3-xxxlarge" style="color:green"><b><i class="material-icons" style="font-size:48px;color:green">update </i> Next<i class="material-icons" style="font-size:48px;color:green">touch_app</i></b></h1></a>';
	echo "</div>";
	echo '<div class="w3-panel w3-pale-red w3-leftbar w3-border-red w3-border">';
	echo '<a href="wecker/weckerAUS.php"><h1 class="w3-xxxlarge" style="color:red"><b><i class="material-icons" style="font-size:48px;color:red">alarm_off </i> Off<i class="material-icons" style="font-size:48px;color:red">touch_app</i></b></h1></a>';
	echo "</div>";
} else {
	echo '<div class="w3-panel w3-pale-green w3-leftbar w3-border-green w3-border">';
	echo '<a href="wecker/weckerAN.php"><h1 class="w3-xxxlarge" style="color:green"><b><i class="material-icons" style="font-size:48px;color:green">alarm_on </i> On<i class="material-icons" style="font-size:48px;color:green">touch_app</i></b></h1></a>';
	echo "</div>";
} 
?>