<?php

# Geben sie die IP von ihrem Shelly ein
# Enter the IP of your Shelly
$alert_ip = '192.168.1.48';

# Wenn sie Shelly Bulb einbinden wollen $include_bulb = 'on' 
# If you want to include Shelly Bulb $include_bulb = 'on'
$include_bulb = 'on';

function ip_change($ip){
	global $alert_ip;
	$arr_ip = explode(".",$alert_ip);
	array_pop($arr_ip);
	array_push($arr_ip,$ip);
	$new_ip = implode(".",$arr_ip);
	return $new_ip;
}

function switch_on_off(){
	global $alert_ip;
	$arr_ip = explode(".",$alert_ip);
	return $arr_ip[3];
}

?>