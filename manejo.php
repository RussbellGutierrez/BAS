<?php
date_default_timezone_set('America/Bogota');
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$opc = filter_input(INPUT_POST, "opcion");
$p = filter_input(INPUT_POST, "parametros");

$query = new Query;
$m = new Metodos;
$cadena = $m->getConectMySQL();//$cadena = $m->getConectWeb();
$json = json_decode($p);

$hash_us = $m->hasher(30);

$iat = time();
$exp = ($iat + 18000);
$token = array (
	'id'=> $json->id,
	'usuario'=> $json->usuario,
	'tipo'=> $json->tipo,
	'tipo_desc'=> $json->tipo_desc,
	'token'=> $hash_us,
	'iat'=> $iat,
	'exp'=> $exp
);

$hash = $m->getHasher();

$jwt = JWT::encode($token,explode(' ',$hash)[1]);
$rand = $m->hasher(4);

$header = explode('.', $jwt)[0];
$payload = explode('.', $jwt)[1];
$signature = explode('.', $jwt)[2];

$paynew = substr($payload,0,3).substr($rand,0,2).explode(' ',$hash)[0].substr($rand,2,2).substr($payload,3);

$njwt = $header.'.'.$paynew.'.'.$signature;

$fecha = date('Y-m-d H:i:s',$exp);
$sql = $query->crudLogin($opc,$json->id,$hash_us,$fecha);
$exe = mysqli_query($cadena,$sql);//$exe = sqlsrv_query($cadena,$sql);

if ($exe === false) {
	echo 'e';
}else {
	setcookie('_pr',$njwt,time() + 21600);
	if ($json->tipo == 1) {
		echo 'a';
	}else {
		echo 'u';
	}
}