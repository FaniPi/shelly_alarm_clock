<?php
$datei = './wecker/wecker.info';
if (file_exists($datei)) {	
	echo '<div class="w3-col m4 w3-margin-bottom">';
	echo '<div class="w3-container w3-center w3-blue">';
	echo '<h2><b>Snooze</b></h2>';
	echo '</div>';
	echo '<a href="wecker/wsleep.php"><img src="img/z.gif" style="width:100%"></a>';
	echo "</div>";
	echo '<div class="w3-col m4 w3-margin-bottom">';
	echo '<div class="w3-container w3-center w3-green">';
	echo '<h2><b>Next</b></h2>';
	echo '</div>';
	echo '<a href="wecker/wrepeat.php"><img src="img/rep.gif" style="width:100%"></a>';
	echo "</div>";
	echo '<div class="w3-col m4 w3-margin-bottom">';
	echo '<div class="w3-container w3-center w3-red">';
	echo '<h2><b>Off</b></h2>';
	echo '</div>';
	echo '<a href="wecker/weckerAUS.php"><img src="img/off.gif" style="width:100%"></a>';
	echo "</div>";
} else {
	echo '<div class="w3-col m4 w3-margin-bottom">';
	echo '<div class="w3-container w3-center w3-green">';
	echo '<h2><b>On</b></h2>';
	echo '</div>';
	echo '<a href="wecker/weckerAN.php"><img src="img/on.gif" style="width:100%"></a>';
	echo "</div>";
} 
?>