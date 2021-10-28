<!DOCTYPE html>
<html lang="de">
<link rel="icon" href="img/access_alarm_black_48dp.svg" type="image/svg" sizes="16x16">
<title>Wecker</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
.w3-quarter img{cursor:pointer}
a:link {
  text-decoration: none;
}
img{cursor:pointer} 
#reload:hover {
  color: blue;
}
</style>
<?php 
$sprache = 'de';
include "alarm_add.php";
alarm_add();
alarm_add_del();
auswertung_arr();
datei_check();
?>

<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <h3 class="w3-padding-64"><b>FaniPi<br>Shelly</b></h3>
  </div>
  <div class="w3-bar-block">
	<?php include "menuDE.php"; ?>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰Menu</a>
  <span>FaniPi Shelly</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Header -->
    <div class="w3-container" style="margin-top:75px">
	    <div class="w3-half">
			<?php 
			next_alert($tagspeicher, $zeitspeicher);  # alarm_add.php
			alarm_anzeigen();  # alarm_add.php
			?> 		  	
		</div>
	    <div class="w3-half w3-center" style="margin-top:15px">
			<div class="w3-display-container" style="height:300px;">
				<div class="w3-display-middle"><canvas id="canvas" width="300px" height="300px" style="background-color:white"></canvas></div>
			</div>
			
	    </div>
    </div>

  
  <!-- Wecker -->
  <div class="w3-container" id="wecker" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Wecker</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">	
  </div>
  <!-- Grosser und mittlerer Bildschirm -->
  <div class="w3-row-padding w3-hide-small">
	<?php include "wecker_1.php"?>
  </div>
  <!-- Kleiner Bildschirm -->
  <div class="w3-row-padding w3-hide-large w3-hide-medium">
	<?php include "wecker_2.php"?>
  </div>


  <!-- Wecker stellen -->
  <div class="w3-container" id="wecker_stellen" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Wecker stellen</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">	
  </div>
  
  <div class="w3-container w3-center" style="color:blue">
    <H2><b><form id="myForm_add" method="post" action="./wecker/stellen_form.php">
	  <input type="time" id="zeit" name="zeit" required><br><br>
	  <input class="w3-check" id="Mo" type="checkbox" name="Mo" value="1">Mo
	  <input class="w3-check" id="Di" type="checkbox" name="Di" value="2">Di
	  <input class="w3-check" id="Mi" type="checkbox" name="Mi" value="3">Mi
	  <input class="w3-check" id="Do" type="checkbox" name="Do" value="4">Do
	  <input class="w3-check" id="Fr" type="checkbox" name="Fr" value="5">Fr
	  <br>
	  <input class="w3-check" id="Sa" type="checkbox" name="Sa" value="6">Sa
	  <input class="w3-check" id="So" type="checkbox" name="So" value="7">So
	  <br><br>
	  <img src="./img/button.png"  onclick="wecker_form()">	
	</form></b></H2>
  </div>


  <!-- Licht -->
  <?php include "shelly_switch_anzeigen.php"; ?>
   
  
  <!-- Bulb -->
  <?php if($include_bulb == 'on'){ include "shelly_bulb_anzeigen.php";} ?>
  
    
<!-- End page content -->
</div>

<!-- W3.CSS Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></p></div>

<script>
function reload() {
  location.reload();
}

// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

// Checkbox kontrolle
function wecker_form() {
	// Zeit überprüfen	
	var zeit = document.getElementById("zeit").valueAsDate;
	var y = 1;
	if(zeit == null){
		alert("Keine Zeit ausgewählt!");
		y = 0;
	}
	// Tage überprüfen
	const days = ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"];
	var x = 0;
	for (let i = 0; i < days.length; i++) {
		if(document.getElementById(days[i]).checked == true){
			var x = 1;
		}
	}	
	if(x == 0){
		alert("Keine Tage ausgewählt!");
	}
	// Wenn Zeit und Tage ok
	var check = y + x;
	if(check == 2){
		if (confirm("Jetzt stellen!")) {
		document.getElementById("myForm_add").submit();
	  }
	}
}

// alarm wiederholungen ein aus und Loeschen
function alert_del(myForm_del) {
  if (confirm("Alarm wird endgültig gelöscht!")) {
    document.getElementById(myForm_del).submit();
  } 
}
function alert_aus(myForm_aus) {
  if (confirm("Ausschalten!")) {
	document.getElementById(myForm_aus).submit();
  }
}
function alert_ein(myForm_ein) {
  if (confirm("Alarm wird eingeschaltet!")) {
    document.getElementById(myForm_ein).submit();
  }
}

// shelly switch
function getSwitch(ip, kanal) {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    }
  }
  
  xmlhttp.open("GET","http://"+ip+"/relay/"+kanal+"?turn=toggle");
  xmlhttp.send();
  location.reload();
}

// shelly bulb
function getBulb_w(ip, farbe, hell) {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    }
  }
  
  xmlhttp.open("GET","http://"+ip+"/light/0?turn=toggle&white="+farbe+"&brightness="+hell+"");
  xmlhttp.send();
  location.reload();
}

// UHR
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = '#b3ccff';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#0000cc');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#0000cc');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>

</body>
</html>
