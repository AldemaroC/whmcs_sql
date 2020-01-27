<?php

include_once(dirname(__FILE__).'/functions.php');

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function whmcs_sql_MetaData()
{
    return array(
        'DisplayName' => 'Módulo de provisionamento MySQL',
        'APIVersion' => '1.1', // Use API Version 1.1
        'RequiresServer' => true, // Set true if module requires a server to work
    );
}


function usuarioAleatorio() {
    $length = 7;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
} 

function postar($post) {
	$enderecoPost = "/modules/servers/whmcs_sql/query.php"; 
        ob_start();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $enderecoPost);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $resposta = curl_exec($ch);
        curl_close($ch);
		return $resposta;
}


function whmcs_sql_CreateAccount($params){
		
		$serviceid = $params['serviceid'];
		$username = "sql".$params['serviceid'];
		$senha = $params['password'];
		
		$post = array(
					'acao' => 'criar',
					'servidor' => $params['serverip'],
					'usuarioservidor' => $params['serverusername'],
					'senhaservidor' => $params['serverpassword'],
					'usuariocliente' => $username,
					'senhacliente' => $senha
					);	
		
		mysql_query("UPDATE tblhosting SET username='$username' WHERE id='$serviceid'");
		
	return postar($post);
}

function whmcs_sql_TerminateAccount($params){
	
		$username = $params['username'];
		
		$post = array(
					'acao' => 'destruir',
					'servidor' => $params['serverip'],
					'usuarioservidor' => $params['serverusername'],
					'senhaservidor' => $params['serverpassword'],
					'usuariocliente' => $username,
					);
        	
	return postar($post);
}
?>
