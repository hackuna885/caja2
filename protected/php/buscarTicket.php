<?php

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
$fechaRegCap = date("Y-m-d" . " " . "g:i a");

$variable = $_POST['buscarTicket'];

$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar!");
$cs = $con -> query("SELECT numFolio,fUsado,fStatus,fEntregado, COUNT(id) AS encont FROM catFolio where numFolio = '$variable'");
$bus = $cs -> fetchArray();
$con -> close();


if ($bus['encont'] == 0) {
	$resBus = "No tengo resultados";
}else{

	if ($bus['fUsado'] == 0) {
		$resBus = "Folio Encontrado, No Usado!";
	}else{
		if ($bus['fEntregado'] == 0) {

			if ($bus['fStatus'] == 1) {
			$resBus = 'Pagado

			<br>
			<br>
			<form action="actEntrega.php" method="post">
		 		<input type="submit" class="btnEntrega" value="Entregar"/>
				<input type="text" name="txtFolioEnt" value="'.$bus['numFolio'].'" hidden/>
		 	</form>

			';
			}else{
				$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar!");
				$cs = $con -> query("SELECT * FROM histTicket where histTFolio = '$variable'");
				$busHist = $cs -> fetchArray();
				$cantidadRest = $busHist['histTRestante'];
				$_SESSION['numFolioTick'] = $bus['numFolio'];
				$_SESSION['cantidadRest'] = $cantidadRest;

				$con -> close();

				$resBus = 'Restan: $'.$cantidadRest.'

				<br>
				<br>
				<form action="actEntrega2.php" method="post">
					<input class="inRegC" type="tel" id="cImporte" name="txtImpRec" placeholder="Importe Recibido $$$.." onkeyup="calcula()" maxlength="4" required/>
					<br>
					<br>
					<div id="resCambio">

					</div>
					
			 	</form>

					';
				
			}
		}else{
			$resBus = "Prenda Entregada!";
		}

	}

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