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

			if ($bus['fStatus'] == 2) {
			$resBus = '

			Folio CANCELADO!

			';
			}else{
			$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar!");
			$cs = $con -> query("SELECT histTFolio,histTNombreC,histTTotalEntr,histTFechaEntP FROM histTicket where histTFolio = '$variable'");

			echo '

			<table>
				<tr>
					<td class="p5">Folio</td>
					<td class="p5">Nombre</td>
					<td class="p5">Importe</td>
					<td class="p5">Cancelar</td>
				</tr>

			';


			while ( $bus2 = $cs -> fetchArray()) {
				echo '

					<tr>
					<td class="p1">'.$bus2[0].'</td>
					<td class="p4">'.$bus2[1].'</td>
					<td class="p4">$'.$bus2[2].'</td>
					<td class="p4">
									<form action="cancelTicket.php" method="post">
									 		<input type="text" name="txtCancelTicket" value="'.$bus2[0].'" hidden/>
									 		<input type="submit" class="eliminar" value="Cancelar"/>
									</form>
					</td>
					</tr>
			';

			}
			$con -> close();

			echo '

			</table>

			';
				
			}
		}else{

			echo "No puedo CANCELAR, Prenda Entrega!";
		}

	}

}

 ?>
