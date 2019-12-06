<?php
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

date_default_timezone_set('America/Bogota');
$opcion = filter_input(INPUT_POST, "opcion");
$usuario = filter_input(INPUT_POST, "usuario");
$comentario = filter_input(INPUT_POST, "comentario");
$motivo = filter_input(INPUT_POST, "motivo");
$estimado = filter_input(INPUT_POST, "estimado");
$estado = filter_input(INPUT_POST, "estado");

$codigo = '';
$user = 0;
$coment = 0;
$array = array();
$img = array();
$query = new Query;
$m = new Metodos;

$motivo = trim($motivo);

if (isset($_COOKIE['_pr'])) {
	$deco = $m->decodeCookie($_COOKIE['_pr']);
	if ($deco != '0') {

		$cadena = $m->getConectMySQL();//$cadena = $m->getConectWeb();
		$fecha = date('Y-m-d').' '.date('H:i:s');

		if ($opcion == 0) {
			$sql = $query->setAnulado($usuario,intval($comentario),$motivo,$deco->id,$fecha);
		}else if ($opcion == 1) {
			$sql = $query->setTomarComentario($usuario,intval($comentario),$deco->id,$fecha);
		}else {
			($estado == 2) ? $sql = $query->updateEstado($estado,$estimado,$fecha,0,$usuario,intval($comentario),$motivo) : $sql = $query->updateEstado($estado,$estimado,0,$fecha,$usuario,intval($comentario),$motivo);
		}
		$execute = mysql_query($cadena,$sql);//$execute = sqlsrv_query($cadena,$sql);

		($execute === false) ? $respuesta = "error" : $respuesta = "success";
		echo $respuesta;
	}else {
		echo '0';
	}
}else{
	echo '0';
}