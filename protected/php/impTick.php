<?php 

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
$fechaRegCap = date("Y-m-d" . " " . "g:i a");

$txtCambio = $_POST['txtCambio'];
$txtRestan = $_POST['txtRestan'];

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../css/impTick.css">
	<title>Imprimir Ticket</title>
</head>
<body>
<div class="main_wrapper">
	<div class="tickImpre">
		<img class="imglogo" src="../../img/logo.png" alt="">
		<p class="imptxt">
			Mariano Escobedo #20 Col. Zaragoza C.P. 54457. Nicolás Romero. Edo-Méx. Tel: 1660-3794
		</p>
		<p class="pChico">
			Horarios de Lunes a Viernes: 9:00 am. - 8:00 pm. Sábados y Domingos: 9:00 am. - 2:00 pm.
		</p>
		<br>
		<table class="centTab">
			<tr>
				<td class="tabTicket">Folio</td>
				<td class="tabTicket">Cod. Arti</td>
				<td class="tabTicket">Prenda</td>
				<td class="tabTicket">Monto</td>
				<?php 

					$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar");
					$cs = $con -> query("SELECT * FROM prendasTMP");
					while ($res = $cs -> fetchArray()) {

						$codArt = $res[0];
						$prenda = $res[1];
						$monto = $res[2];
						$folio = $res[3];

						echo '
							

							<tr>
								<td class="tabTicket">'.$folio.'</td>
								<td class="tabTicket">'.$codArt.'</td>
								<td class="tabTicketDer">'.$prenda.'</td>
								<td class="tabTicket">$'.$monto.'</td>
							</tr>

						';
					}
					$con -> close();

				 ?>
				 <tr>
					<td class="tabTicket"></td>
					<td class="tabTicket"></td>
					<td class="tabTicketDer">Total: </td>
					<td class="tabTicket">$<?php echo $_SESSION['x']; ?></td>
				</tr>
				<tr>
					<td class="tabTicketDer">Recibido:</td>
					<td class="tabTicket">$<?php echo $_SESSION['importe']; ?></td>
					<td class="tabTicket"></td>
					<td class="tabTicket"></td>
				</tr>
				<tr>
					<td class="tabTicketDer">A Cuenta:</td>
					<td class="tabTicket">$<?php echo $_SESSION['acuenta']; ?></td>
					<td class="tabTicket"></td>
					<td class="tabTicket"></td>
				</tr>
				<tr>
					<td class="tabTicketDer">Cambio:</td>
					<td class="tabTicket">$<?php echo $txtCambio; ?></td>
					<td class="tabTicket"></td>
					<td class="tabTicket"></td>
				</tr>
				<tr>
					<td class="tabTicketDer">Restante:</td>
					<td class="tabTicket">$<?php echo $txtRestan; ?></td>
					<td class="tabTicket"></td>
					<td class="tabTicket"></td>
				</tr>
			</tr>
		</table>
		<br>
		<p class="txtTicketAIz">
				Nombre: <?php  echo $_SESSION['txtNom']; ?>
				<br>
				Dirección: <?php  echo $_SESSION['txtDir']; ?>
				<br>
				Teléfono: <?php  echo $_SESSION['txtTel']; ?>
				<br>
				Fecha Ticket: <?php  echo $fechaRegCap; ?> 
				<br>
				Fecha Entrega: <?php  echo $_SESSION['txtFec']; ?>
		</p>
		<p class="txtTicketCod">
			<?php echo $_SESSION['noTick']; ?>
		</p>
		<p class="imptxt">
			No. Ticket: <?php echo $_SESSION['noTick']; ?>
		</p>
		<br>
	</div>
</div>
</body>
</html>