<?php

$param = filter_input(INPUT_POST, "parametros");

$json = json_decode($param);
$valores = $json->data->tipo->descrip."-".$json->data->empresa->descrip."-".$json->data->empleado->codigo."-".$json->data->empleado->nombre;
setcookie('par',base64_encode($valores),0);
if ($json->data->tipo->id == 1) {
	echo "Administrador";
}else {
	echo "Usuario";
}