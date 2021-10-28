
    <a onclick="reload()" class="w3-bar-item w3-button w3-hover-white" ><H2><b>Reload <i class="material-icons" style="font-size:28px">refresh</i></b></H2></a> 
	<a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Info</a> 
    <a href="#wecker" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Wecker</a>
	<a href="#wecker_stellen" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Wecker stellen</a>
    <a href="#licht" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Licht</a>
	<?php include './set_ip/ip.php';
	if($include_bulb == 'on'){
		echo '<a href="#bulb" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Lampe</a> ';
	}
	?>