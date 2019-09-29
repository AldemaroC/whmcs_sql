<?php
		$db = $_POST['usuariocliente'];
		$user = $_POST['usuariocliente'];
		
	
	if ( $_POST['acao'] == "criar" ) {
		
		$dbpass = $_POST['senhacliente'];
		
		$con = mysql_connect($_POST['servidor'],$_POST['usuarioservidor'],$_POST['senhaservidor']);

		mysql_query("CREATE DATABASE ".$db."",$con)or die(mysql_error());
		mysql_query("GRANT ALL ON ".$db.".* to  ".$user." identified by '".$dbpass."'",$con) or die(mysql_error());
		mysql_close($con);
		
	} elseif ( $_POST['acao'] == "destruir" ) {
		
		$con = mysql_connect($_POST['servidor'],$_POST['usuarioservidor'],$_POST['senhaservidor']);

		mysql_query("DROP USER ".$db."",$con)or die(mysql_error());
		mysql_query("DROP DATABASE IF EXISTS ".$db."",$con)or die(mysql_error());
		mysql_close($con);
	}
		
?>