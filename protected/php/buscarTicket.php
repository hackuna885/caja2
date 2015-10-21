<?php

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
$fechaRegCap = date("Y-m-d" . " " . "g:i a");

$variable = $_POST['buscarTicket'];

$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar!");
$cs = $con -> query("SELECT fStatus FROM catFolio where numFolio = '$variable'");
$bus = $cs -> fetchArray();
$con -> close();


if ($bus[0] == 1) {
	$resBus = "Pagado";
}else{
	$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar!");
	$cs = $con -> query("SELECT * FROM histTicket where histTFolio = '$variable'");
	$busHist = $cs -> fetchArray();
	$resBus = "Restan: $".$busHist['histTRestante'];
	$con -> close();
}

 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="UTF-8">
 	<title>Busqueda de Ticket</title>
 </head>
 <body>
 	<h3>Estatus de Ticket:</h3>
 	<br>
 	<p><?php echo $resBus; ?></p>
 </body>
 </html>