<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

$idUsr = $_GET['idUsr'];

$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar");
$cs = $con -> query("DELETE FROM catUsuarios WHERE catUsrIDUsr = '$idUsr'");
$con -> close();

 ?>

 <!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Datos Eliminados</title>
</head>
<body>
	<table>
		<tr>
			<td>Id</td>
			<td>Usuario</td>
			<td>Permisos</td>
			<td></td>
		</tr>

		<?php 

			$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar");
			$cs = $con -> query("SELECT * FROM catUsuarios");
			while ($res = $cs -> fetchArray()) {
				$resId = $res['catUsrIDUsr'];
				$resUsr = $res['catUsrNomUsr'];
				$resPer = $res['catUsrPerUsr'];
				$resId2 = "'".$resId."'";

				if ($resPer == 1) {
					$resPer = "Administrador";
				}else{
					$resPer = "Usuario";
				}

				echo '
			<tr>
			<td>'.$resId.'</td>
			<td>'.$resUsr.'</td>
			<td>'.$resPer.'</td>
			<td><button type="button" class="eliminar" onclick="eliminarAjax('.$resId2.')">Eliminar</button></td>
			</tr>
				';

			}
			$con -> close();

		 ?>
	</table>

</body>
</html>