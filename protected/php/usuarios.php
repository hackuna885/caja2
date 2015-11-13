<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar");
$cs = $con -> query("SELECT COUNT(catUsrIDUsr), MAX(catUsrIDUsr) FROM catUsuarios");
$res = $cs -> fetchArray();
$count = $res[0];
$max = $res[1];
$con -> close();

if ($count == 0) {
	$idUsr = "A0001";
}else{
	$idUsr = "A".substr((substr($max, 1) + 10001), 1);
}

 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="UTF-8">
 	<title>Usuario</title>
 	<script type="text/javascript">
 	function insertarDatos(){

 		var conexion;
 		if (window.XMLHttpRequest) {
 			conexion = new XMLHttpRequest();
 		}else{
 			conexion = new ActiveXObject("Microsoft.XMLHTTP");
 		}

 		var url = "insertUsr.php";
 		var IdUsr = document.getElementById("txtIdUsr").value;
		var Nombre = document.getElementById("txtNombre").value;
		var ApePat = document.getElementById("txtApePat").value;
		var ApeMat = document.getElementById("txtApeMat").value;
		var Direcc = document.getElementById("txtDirecc").value;
		var NumTelCasa = document.getElementById("txtNumTelCasa").value;
		var NumTelCel = document.getElementById("txtNumTelCel").value;
		var NomUsr = document.getElementById("txtNomUsr").value;
		var PwUsr = document.getElementById("txtPwUsr").value;
		var TipUsr = document.getElementById("optTipUsr").value;
		var valores = "txtIdUsr="+IdUsr+"&txtNombre="+Nombre+"&txtApePat="+ApePat+"&txtApeMat="+ApeMat+"&txtDirecc="+Direcc+"&txtNumTelCasa="+NumTelCasa+"&txtNumTelCel="+NumTelCel+"&txtNomUsr="+NomUsr+"&txtPwUsr="+PwUsr+"&optTipUsr="+TipUsr;

		conexion.open("POST",url,true);
		conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 		conexion.onreadystatechange=function(){
 			if (conexion.readyState==4 && conexion.status==200) {
 				document.getElementById("midiv").innerHTML = conexion.responseText;
 			}
 		}
 		conexion.send(valores);
 		var Nombre = document.getElementById("txtNombre").value="";
 		var ApePat = document.getElementById("txtApePat").value="";
 		var ApeMat = document.getElementById("txtApeMat").value="";
 		var Direcc = document.getElementById("txtDirecc").value="";
 		var NumTelCasa = document.getElementById("txtNumTelCasa").value="";
 		var NumTelCel = document.getElementById("txtNumTelCel").value="";
 		var NomUsr = document.getElementById("txtNomUsr").value="";
 		var PwUsr = document.getElementById("txtPwUsr").value="";
 		var TipUsr = document.getElementById("optTipUsr").value="2";
 		alert('Datos Guardados!');
 		ajaxget();
 	}
 	</script>
 	<script type="text/javascript">

	function ajaxget(){

		var ejeAjax;
		if (window.XMLHttpRequest) {
			ejeAjax = new XMLHttpRequest();
		}else{
			ejeAjax = new ActiveXObject("Microsoft.XMLHTTP");
		}
		ejeAjax.onreadystatechange= function(){
			if (ejeAjax.readyState=4 && ejeAjax.status==200) {
				document.getElementById("refresh").innerHTML=ejeAjax.responseText;
			}
		}
		ejeAjax.open("GET","refreUsr.php", true);
		ejeAjax.send();

	}


	</script>

	<script type="text/javascript">
		function eliminarAjax(str){

			var eliAjax;
			if (window.XMLHttpRequest) {
				eliAjax = new XMLHttpRequest();
			}else{
				eliAjax = new ActiveXObject("Microsoft.XMLHTTP");
			}
			eliAjax.onreadystatechange=function(){
				if (eliAjax.readyState==4 && eliAjax.status==200) {
					document.getElementById("midiv").innerHTML = eliAjax.responseText;
				}
			}
			eliAjax.open("GET", "eliUsr.php?idUsr="+ str, true);
			eliAjax.send();
			alert('Usuario Eliminado!');
			ajaxget();
		}
	</script>

 </head>
 <body>
 	<form action="">
 		<p>Buscar Usuario:</p>
 		<input type="text" name="txtBusc" placeholder="Buscar id.."/>
 		<br>
 		<button type="button" onclick="">Buscar</button>
 		<br>
 		<p>Datos Personales:</p>
 		<div id="refresh">
 		<input type="text" name="txtIdUsr" id="txtIdUsr" placeholder="Id de Usuario.." value="<?php echo $idUsr; ?>" disabled/>
 		</div>
 		<input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre.." autofocus/>
 		<br>
 		<input type="text" name="txtApePat" id="txtApePat" placeholder="Apellido Paterno.."/>
 		<br>
 		<input type="text" name="txtApeMat" id="txtApeMat" placeholder="Apellido Materno.."/>
 		<br>
 		<input type="text" name="txtDirecc" id="txtDirecc" placeholder="Dirección.."/>
 		<br>
 		<input type="tel" name="txtNumTelCasa" id="txtNumTelCasa" placeholder="Teléfono Casa.." maxlength="8"/>
 		<br>
 		<input type="tel" name="txtNumTelCel" id="txtNumTelCel" placeholder="Teléfono Móvil.." maxlength="13"/>
 		<br>
 		<p>Datos de la Cuenta:</p>
 		<input type="text" name="txtNomUsr" id="txtNomUsr" placeholder="Nombre de Usuario.." />
 		<br>
 		<input type="password" name="txtPwUsr" id="txtPwUsr" placeholder="Password.." min="3" />
 		<br>
 		<p>Permisos de:</p>
 		<select name="optTipUsr" id="optTipUsr">
 			<option value="1">Administrador</option>
 			<option value="2" selected>Usuario</option>
 		</select>
 		<br>
 		<br>
 		<input type="submit" value="Guardar" onclick="insertarDatos()"/>
<!--  		<button type="button" onclick="insertarDatos()">Guardar</button> -->
 		<br>
 		<button type="button" onclick="">Actualizar</button>
 	</form>
 	<div id="midiv">
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
			<td><button type="button" onclick="eliminarAjax('.$resId2.')">Eliminar</button></td>
			</tr>
				';

			}
			$con -> close();

		 ?>
	</table>
 	</div>
 </body>
 </html>