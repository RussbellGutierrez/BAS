<?php
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

date_default_timezone_set('America/Bogota');
$opcion = filter_input(INPUT_POST, "opcion");
$usuario = filter_input(INPUT_POST, "usuario");
$comentario = filter_input(INPUT_POST, "comentario");
$motivo = filter_input(INPUT_POST, "motivo");
$dias = filter_input(INPUT_POST, "dias");
$estado = filter_input(INPUT_POST, "estado");

$codigo = '';
$user = 0;
$coment = 0;
$array = array();
$img = array();
$query = new Query;
$m = new Metodos;

if (isset($_COOKIE['_pr'])) {
	$deco = $m->decodeCookie($_COOKIE['_pr']);
	if ($deco != '0') {

		$cadena = $m->getConectWeb();
		$fecha = date('Y-m-d').' '.date('H:i:s');

		if ($opcion == 0) {
			$sql = $query->setAnulado($usuario,intval($comentario),$motivo,$deco->id,$fecha);
		}else if ($opcion == 1) {
			$sql = $query->setTomarComentario($usuario,intval($comentario),$deco->id,$fecha);
		}else {
			($estado == 2) ? $sql = $query->updateEstado($estado,$dias,$fecha,0,$usuario,intval($comentario)) : $sql = $query->updateEstado($estado,$dias,0,$fecha,$usuario,intval($comentario));
		}
		
		//($opcion == 0) ? $sql = $query->setAnulado($usuario,intval($comentario),$motivo,$deco->id,$fecha) : $sql = $query->setTomarComentario($usuario,intval($comentario),$deco->id,$fecha);
		
		$execute = sqlsrv_query($cadena,$sql);

		($execute === false) ? $respuesta = "error" : $respuesta = "success";
		echo $respuesta;
	}else {
		echo '0';
	}
}else{
	echo '0';
}