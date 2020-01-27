<?php
$db = $_POST['usuariocliente'];
$user = $_POST['usuariocliente'];
$dbpass = $_POST['senhacliente'];

//Connect to db
$mysqli = new mysqli($_POST['servidor'],$_POST['usuarioservidor'],$_POST['senhaservidor']);
//Test the connection
	if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}
//Create service
if ( $_POST['acao'] == "criar" ) {
	$mysqli -> query("CREATE DATABASE ".$db."");
	$mysqli -> query("GRANT ALL ON ".$db.".* to  ".$user." identified by '".$dbpass."'");
//Terminate service
} elseif ( $_POST['acao'] == "destruir" ) {
	$mysqli -> query("DROP USER ".$db."");
	$mysqli -> query("DROP DATABASE IF EXISTS ".$db."");
}
$mysqli -> close();
?>
