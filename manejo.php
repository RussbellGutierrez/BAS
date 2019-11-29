<?php
date_default_timezone_set('America/Bogota');
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;
require_once 'metodos.php';

$p = filter_input(INPUT_POST, "parametros");

$m = new Metodos;
$json = json_decode($p);

$token = array (
	'id'=> $json->id,
	'usuario'=> $json->usuario,
	'tipo'=> $json->tipo,
	'tipo_desc'=> $json->tipo_desc,
	'iat'=> time(),
	'exp'=> (time() + 18000)
);

$hash = $m->getHasher();

$jwt = JWT::encode($token,explode(' ',$hash)[1]);
$rand = $m->hasher();

$header = explode('.', $jwt)[0];
$payload = explode('.', $jwt)[1];
$signature = explode('.', $jwt)[2];

$paynew = substr($payload,0,3).substr($rand,0,2).explode(' ',$hash)[0].substr($rand,2,2).substr($payload,3);

$njwt = $header.'.'.$paynew.'.'.$signature;

setcookie('_pr',$njwt,0);

if ($json->data->tipo->id == 1) {
	echo 'a';
}else {
	echo 'u';
}