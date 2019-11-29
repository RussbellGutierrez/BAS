<?php
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;

date_default_timezone_set('America/Bogota');
$p = filter_input(INPUT_POST, "parametros");
$iat = get

$json = json_decode($p);

$token = array (
	'nombre'=> $json->data->nombre,
	'tipo_id'=> $json->data->tipo->id,
	'tipo_desc'=> $json->data->tipo->descrip,
	'empresa_id'=> $json->data->empresa->id,
	'empresa_desc'=> $json->data->empresa->descrip,
	'emp_sucursal'=> $json->data->empleado->sucursal,
	'emp_esquema'=> $json->data->empleado->esquema,
	'emp_id'=> $json->data->empleado->codigo,
	'empleado'=> $json->data->empleado->nombre,
	'iat'=>
);

$jwt = JWT::encode($token,"buzon");

setcookie('_pr',$jwt,time() + 86400);//86400 = 1 dia*/

if ($json->data->tipo->id == 1) {
	echo 'a';
}else {
	echo 'u';
}