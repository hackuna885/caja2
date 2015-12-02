<?php

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
$fechaRegCap = date("Y-m-d" . " " . "g:i a");

$variable = $_POST['buscarTicket'];

$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar!");
$cs = $con -> query("SELECT histTFolio,histTNombreC,histTFechaTick,histTFechaEntP FROM histTicket where histTNombreC LIKE '%$variable%'");

echo '

<table>
	<tr>
		<td>Folio</td>
		<td>Nombre</td>
		<td>Fecha de Ticket</td>
		<td>Fecha de Entrega</td>
	</tr>

';


while ( $bus = $cs -> fetchArray()) {
	echo '

		<tr>
		<td>'.$bus[0].'</td>
		<td>'.$bus[1].'</td>
		<td>'.$bus[2].'</td>
		<td>'.$bus[3].'</td>
		</tr>
';

}
$con -> close();

echo '

</table>

';

 ?>