
  <?php 
		$sprache_light = 'Licht';
		$sprache_wecker = 'Wecker';
		if($sprache == 'en'){
			$sprache_light = 'light';
			$sprache_wecker = 'alarm clock';
		} 		
  ?>

  <div class="w3-container" id="licht" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b><?php echo $sprache_light; ?></b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
  </div>
  <?php include "shelly_switch.php"; ?>
  <!-- Large and medium screen / Grosser und mittlerer Bildschirm -->
  <!-- Max 4 shelly_switch pro class -->
  <div class="w3-row-padding w3-hide-small"> 
    <?php 
	# Licht von Wecker ein- aus-schalten
	$ip = switch_on_off();
	$raum = $sprache_wecker;
	shelly_switch($ip, $raum,);
	
	# more shelly_switch / weitere shelly_switch
	# $ip = last block of numbers of ip / letzter zahlenblock der ip
	# $raum = displayed text / angezeigter text
	/*
	# shelly_switch	1
	$ip = '49';
	$raum = 'Wohnen';
	shelly_switch($ip, $raum,);
	
	# shelly_switch	2.5 switch 1
	$ip = '71';
	$raum = 'Schrank';
	shelly_switch($ip, $raum,);
	
	# shelly_switch	2.5 switch 2
	$ip = '71';
	$raum = 'Tisch';
	shelly_switch($ip, $raum, "1");	
	*/
	?>        
  </div>
  <!-- New line / Neue zeile  -->
  <div class="w3-row-padding w3-hide-small">
	<?php	
	/*
	$ip = '74';
	$raum = 'Button';
	shelly_switch($ip, $raum,);
	*/
	?>
  </div>
  
  <!-- Small screen / Kleiner Bildschirm -->
  <div class="w3-row-padding w3-hide-large w3-hide-medium"> 
	<?php 
	# Licht von Wecker ein- aus-schalten
	$ip = switch_on_off();
	$raum = $sprache_wecker;
	shelly_switch_klein($ip, $raum);
	
	# weitere shelly_switch
	# $ip = letzter zahlenblock der ip
	# $raum = angezeigter text
	/*
	# shelly_switch	1
	$ip = '74';
	$raum = ' Button';
	shelly_switch_klein($ip, $raum);
	
	# shelly_switch	1
	$ip = '49';
	$raum = ' Wohnen';
	shelly_switch_klein($ip, $raum);
	
	# shelly_switch	2.5 Schalter 
	$ip = '71';
	$raum = ' Schrank';
	shelly_switch_klein($ip, $raum);
	
	# shelly_switch	2.5 Schalter 1
	$ip = '71';
	$raum = ' Tisch';
	shelly_switch_klein($ip, $raum, "1");
	*/
	?> 
  </div>
 