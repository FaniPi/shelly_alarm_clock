
    <a onclick="reload()" class="w3-bar-item w3-button w3-hover-white" ><H2><b>reload <i class="material-icons" style="font-size:28px">refresh</i></b></H2></a> 
	<a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">info</a> 
    <a href="#wecker" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">alarm clock</a>
	<a href="#wecker_stellen" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">set alarm clock</a>
    <a href="#licht" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">light</a>
	<?php include './set_ip/ip.php';
	if($include_bulb == 'on'){
		echo '<a href="#bulb" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">bulb</a> ';
	}
	?>