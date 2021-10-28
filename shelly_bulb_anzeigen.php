
  <div class="w3-container" id="bulb" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>bulb</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>
  
  <?php include "shelly_bulb.php"; ?>
  <!-- Large and medium screen / Grosser und mittlerer Bildschirm --> 
  <!-- Max 3 shelly_bulb pro class -->
  <div class="w3-row-padding w3-hide-small">
	<?php
	
	$raum = 'Bulb';
	$ip = "73";
	$a = 'a_1';
	$b = 'b_1';
	shelly_bulb($ip, $raum, $a, $b);
	
	$raum = 'Bulb2';
	$ip = "73";
	$a = 'a_2';
	$b = 'b_2';
	shelly_bulb($ip, $raum, $a, $b);

	$raum = 'Bulb3';
	$ip = "73";
	$a = 'a_3';
	$b = 'b_3';
	shelly_bulb($ip, $raum, $a, $b);
	?>
  </div>
  <div class="w3-row-padding w3-hide-small">
    <?php
	$raum = 'Bulb4';
	$ip = "73";
	$a = 'a_4';
	$b = 'b_4';
	shelly_bulb($ip, $raum, $a, $b);
	?>
  </div>
  
  <!-- Small screen / Kleiner Bildschirm -->
  <div class="w3-row-padding w3-hide-large w3-hide-medium"> 
	<?php

	$raum = 'Bulb';
	$ip = "73";
	$a = 'a_1';
	$b = 'b_1';
	shelly_bulb_klein($ip, $raum, $a, $b);

	?>
  </div>
  