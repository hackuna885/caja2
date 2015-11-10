<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar");
$cs = $con -> query("SELECT COUNT(catUsrIdUsr), MAX(catUsrIdUsr) FROM catUsuarios");
$bus = $cs -> fetchArray();
$count = $bus[0];
$max = $bus[1];
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
 	<title>Crear Usuarios</title>
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
		var valores = "txtIdUsr="+IdUsr+"&txtNombre="+Nombre+"&txtApePat="+ApePat+"&txtApeMat="+ApeMat+"&txtDirecc="+Direcc+"&txtNumTelCasa="+NumTelCasa+"&txtNumTelCel="+NumTelCel+"&txtNomUsr="+NomUsr+"&txtPwUsr="+PwUsr;

		conexion.open("POST",url,true);
		conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 		conexion.onreadystatechange=function(){
 			if (conexion.readyState==4 && conexion.status==200) {
 				document.getElementById("midiv").innerHTML = conexion.responseText;
 			}
 		}
 		conexion.send(valores);
 		var IdUsr = document.getElementById("txtIdUsr").value="<?php echo $idUsr; ?>";
 		var Nombre = document.getElementById("txtNombre").value="";
 		var ApePat = document.getElementById("txtApePat").value="";
 		var ApeMat = document.getElementById("txtApeMat").value="";
 		var Direcc = document.getElementById("txtDirecc").value="";
 		var NumTelCasa = document.getElementById("txtNumTelCasa").value="";
 		var NumTelCel = document.getElementById("txtNumTelCel").value="";
 		var NomUsr = document.getElementById("txtNomUsr").value="";
 		var PwUsr = document.getElementById("txtPwUsr").value="";
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
 		<input type="text" name="txtIdUsr" id="txtIdUsr" placeholder="id Usuario.." value="<?php echo $idUsr; ?>"/>
 		<br>
 		<input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre.." required/>
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
 		<input type="text" name="txtNomUsr" id="txtNomUsr" placeholder="Nombre de Usuario.." required/>
 		<br>
 		<input type="password" name="txtPwUsr" id="txtPwUsr" placeholder="Password.." min="3" required/>
 		<br>
 		<br>
 		<button type="button" onclick="insertarDatos()">Guardar</button>
 		<br>
 		<button type="button" onclick="">Actualizar</button>
 	</form>
 	<div id="midiv"></div>
 </body>
 </html>