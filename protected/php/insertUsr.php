<?php 

$Nombre = $_POST['txtNombre'];
$ApePat = $_POST['txtApePat'];
$ApeMat = $_POST['txtApeMat'];
$Direcc = $_POST['txtDirecc'];
$NumTelCasa = $_POST['txtNumTelCasa'];
$NumTelCel = $_POST['txtNumTelCel'];
$NomUsr = $_POST['txtNomUsr'];
$PwUsr = $_POST['txtPwUsr'];
$pwEncript = md5($PwUsr);
$TipUsr = $_POST['optTipUsr'];

$con = new SQLite3("../data/tienda.db") or die("Problemas para conectar");
$cs = $con -> query("INSERT INTO catUsuarios (catUsrNombre, catUsrAPaterno, catUsrAMaterno, catUsrDirecc, catUsrTelCasa, catUsrTelCelu, catUsrNomUsr, catUsrPwUsr, catUsrPerUsr) VALUES('$Nombre','$ApePat','$ApeMat','$Direcc','$NumTelCasa','$NumTelCel','$NomUsr','$pwEncript','$TipUsr')");
$con -> close();


 ?>