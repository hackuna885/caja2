<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

$busUsr = $_POST['txtBusc'];


$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar");
$cs = $con -> query("SELECT * FROM catUsuarios WHERE catUsrIDUsr = '$busUsr'");
$res = $cs -> fetchArray();

$UsrIDUsr = $res['catUsrIDUsr'];
$Nombre = $res['catUsrNombre'];
$APaterno = $res['catUsrAPaterno'];
$AMaterno = $res['catUsrAMaterno'];
$Direcc = $res['catUsrDirecc'];
$TelCasa = $res['catUsrTelCasa'];
$TelCelu = $res['catUsrTelCelu'];
$NomUsr = $res['catUsrNomUsr'];
$PerUsr = $res['catUsrPerUsr'];

 ?>
 <html>
 	

 		<div class="c1Centro2">
 			<div class="cIzqUno">
 				
		 		<h3>Datos Personales:</h3>
		 		<br>
		 		<div id="refresh" class="inRefresh">
		 		<input type="text" class="inRegC" name="txtIdUsr" id="txtIdUsr" placeholder="Id de Usuario.." value="<?php echo $UsrIDUsr; ?>" disabled/>
		 		</div>
		 		<input type="text" class="inRegC" name="txtNombre" id="txtNombre" placeholder="Nombre.." value="<?php echo $Nombre; ?>" />
		 		<br>
		 		<input type="text" class="inRegC" name="txtApePat" id="txtApePat" placeholder="Apellido Paterno.." value="<?php echo $APaterno; ?>" />
		 		<br>
		 		<input type="text" class="inRegC" name="txtApeMat" id="txtApeMat" placeholder="Apellido Materno.." value="<?php echo $AMaterno; ?>" />
		 		<br>
		 		<input type="text" class="inRegC" name="txtDirecc" id="txtDirecc" placeholder="Dirección.." value="<?php echo $Direcc; ?>" />
		 		<br>
		 		<input type="tel" class="inRegC" name="txtNumTelCasa" id="txtNumTelCasa" placeholder="Teléfono Casa.." maxlength="8" value="<?php echo $TelCasa; ?>" />
		 		<br>
		 		<input type="tel" class="inRegC" name="txtNumTelCel" id="txtNumTelCel" placeholder="Teléfono Móvil.." maxlength="13" value="<?php echo $TelCelu; ?>" />
		 		<br>
		 		<br>
 			</div>
 			<div class="cDerUno">
 				
 				<h3>Datos de la Cuenta:</h3>
		 		<br>
		 		<input type="text" class="inRegC" name="txtNomUsr" id="txtNomUsr" placeholder="Nombre de Usuario.." value="<?php echo $NomUsr; ?>" autofocus/>
		 		<br>
		 		<input type="password" class="inRegC" name="txtPwUsr" id="txtPwUsr" placeholder="Password.." min="3" />
		 		<br>
		 		<br>
		 		<h3>Permisos de:</h3>
		 		<br>
		 		<select name="optTipUsr" id="optTipUsr" class="inRegC" value="<?php echo $PerUsr; ?>">
		 			<option value="1">Administrador</option>
		 			<option value="2">Usuario</option>
		 		</select>
		 		<br>
		 		<br>
		 		<input type="submit" class="btnAct" id="ticket" value="Actualizar" onclick="actualizarDatos()"/>
		 		<br>
		 		<input type="submit" class="btnAct" id="cancel" value="Cancelar"/>
		 		<br>
		 		<br>

 			</div>
 		</div>

 </html>