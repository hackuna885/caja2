<?php 

include("contAcceso.php");

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
$fechaRegCap = date("Y-m-d" . " " . "g:i a");

 ?>


 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="UTF-8">

 	<script>
 	function calculaRopa(){
		var ajax;
		if (window.XMLHttpRequest) {
			ajax = new XMLHttpRequest();
		}else{
			ajax = new ActiveXObject("Microsoft.XMLHTTP");
		}

		var url = "calculaRopa.php";
		var kg = document.getElementById("txtKgRopa").value;
		var valores = "txtKgRopa="+kg;

		ajax.open("POST",url,true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.onreadystatechange=function(){
			if (ajax.readyState==4 && ajax.status==200) {
				document.getElementById("midiv").innerHTML = ajax.responseText;
			}
		}

		ajax.send(valores);
	}
	</script>

 	<?php include("../../include/style.inc"); ?>
 	<link rel="stylesheet" href="../../css/pTicket.css">
 	<title>Lavado</title>
 </head>
 <body>
 	<div class="main_wrapper">
	<div class="cUno">
	<?php include("../../include/menu.inc"); ?>
	<div class="pTicket">
	<div class="c1Centro">
		<br>
		<div class="tituloEnt">
			<h1>Lavado</h1>
		</div>
		<br>
		<div class="cIzqUno">
			<br>
			<h2>Kilos de Ropa</h2>
			<br>
			<input class="inRegC" type="tel" id="txtKgRopa" name="txtKgRopa" placeholder="Cuantos Kg?" onkeyup="calculaRopa()" maxlength="3" autofocus/>
			<br>
			<br>
			<input class="btnAct" id="ticket" type="submit" value="Agregar a Caja" onclick="" />
		</div>
		<div class="cDerUno" id="midiv">
			<img src="../../css/img/Lavado.png" alt="">
			<br>
			<br>
			<h3>Monto: $</h3>
		</div>
	</div>
	</div>
	</div>
	</div>
 </body>
 </html>