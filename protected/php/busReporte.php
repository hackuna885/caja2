<?php 

error_reporting(E_ALL ^ DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

$fechaIni = $_POST['txtFechaIni'];
$fechaFin = $_POST['txtFechaFin'];

if ($fechaFin >= $fechaIni) {

	$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar");
	$cs = $con -> query("SELECT histTFolio, histTFechaTick, histTEstatus, histTTotalEntr, SUBSTR(histTFechaTick, 1, 10) AS FechaTicket FROM histTicket WHERE FechaTicket BETWEEN '$fechaIni' AND '$fechaFin' ORDER BY histTFolio");
	$cs2 = $con ->query("SELECT SUM(histTTotalEntr) AS impTotal FROM histTicket");	

}else{
	echo "<script> alert('La Fecha Final no puede ser Menor!'); </script>";
	echo "<script> window.location='reportes.php'; </script>";
}



 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="UTF-8">
 	<link rel="stylesheet" href="../../css/impTick.css">
	<link rel="stylesheet" href="../../css/impTick2.css" media="print">
 	<title>Corte del Día: </title>
 </head>
 <body onload="window.print();">
 	<div class="main_wrapper">
 		<div class="tickImpre">
			<img class="imglogo" src="../../img/logo.png" alt="">
			<p class="imptxt">
				Mariano Escobedo #20 Col. Zaragoza C.P. 54457. Nicolás Romero. Edo-Méx. Tel: 1660-3794
			</p>
			<br>
			<p>"Corte de caja: <?php echo $fechaIni. ' al ' .$fechaFin; ?>"</p>
			<br>
 	<table class="centTab">
 		<tr>
 			<td>Folio</td>
 			<td>Fecha</td>
 			<td>Estatus</td>
 			<td>Monto</td>
 		</tr>
 		
 			<?php 
 				while ($res = $cs -> fetchArray()) {

 					echo '
 					<tr>
					<td>'.$res['histTFolio'].'</td>
		 			<td>'.$res['histTFechaTick'].'</td>
		 			<td>'.$res['histTEstatus'].'</td>
		 			<td>$'.$res['histTTotalEntr'].'</td>
		 			</tr>
 					';
				}
				$res2 = $cs2 -> fetchArray();
					echo '
					<tr>
			 			<td></td>
			 			<td></td>
			 			<td>Total: </td>
			 			<td>$'.$res2['impTotal'].'</td>
			 		</tr>
					';
 			 ?>
 	</table>
	 	</div>
	 	<div class="botonera">
		<input class="btnAct" id="ticket" type='button' onclick='window.print();' value='Re-Imprimir' />
		<br>
		<button type="button" class="btnAct" id="cancel" onclick="window.location='reportes.php'">Regresar..</button>
	</div>
	</div>
 </body>
 </html>