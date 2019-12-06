<?php
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

date_default_timezone_set('America/Bogota');

$user = 0;
$coment = 0;
$row = array();
$array = array();
$query = new Query;
$m = new Metodos;

if (isset($_COOKIE['_pr'])) {

	$deco = $m->decodeCookie($_COOKIE['_pr']);
	if ($deco != '0') {
		$cadena = $m->getConectMySQL();//$cadena = $m->getConectWeb();
		$sql = $query->getDetalle(1,0,0,0);

		$execute = mysqli_query($cadena,$sql);//$execute = sqlsrv_query($cadena,$sql);

		while($datos = mysqli_fetch_array($execute)){//while($datos = sqlsrv_fetch_array($execute)){
			if ($user == 0 && $coment == 0) {
				$user = $datos['usuario'];
				$coment = $datos['codcoment'];
				$diff = $m->diferenciaDias($datos['f_in'],$datos['revisado'],$datos['finalizado'],$datos['fecanul']);
				$avance = $m->avanceComentario($datos['iniciado'],$datos['estimado'],$datos['finalizado']);
				$codigo = str_pad($datos['codcoment'], 4, "0", STR_PAD_LEFT);
				$row = array('fecha'=>$datos['f_in'],'transcurrido'=>$diff,'usuario'=>$datos['usuario'],'nomusu'=>$datos['nomusu'],'admin'=>$datos['admin'],'nomadmin'=>$datos['nomadmin'],'desc_adm'=>$datos['desc_adm'],'app'=>$datos['app'],'codcoment'=>$codigo,'titulo'=>$datos['titulo'],'comentario'=>$datos['comentario'],'tipo'=>$datos['tipo'],'estado'=>$datos['estado'],'avance'=>$avance,'finalizado'=>$datos['finalizado'],'anulado'=>$datos['anulado'],'iniciado'=>$datos['iniciado'],'estimado'=>$datos['estimado']);
			}else if($user == $datos['usuario'] && $coment == $datos['codcoment']) {
				array_walk($row,'agregarComentario',$datos['comentario']);
			}else {
				array_push($array, $row);
				$user = $datos['usuario'];
				$coment = $datos['codcoment'];
				$diff = $m->diferenciaDias($datos['f_in'],$datos['revisado'],$datos['finalizado'],$datos['fecanul']);
				$avance = $m->avanceComentario($datos['iniciado'],$datos['estimado'],$datos['finalizado']);
				$codigo = str_pad($datos['codcoment'], 4, "0", STR_PAD_LEFT);
				$row = array('fecha'=>$datos['f_in'],'transcurrido'=>$diff,'usuario'=>$datos['usuario'],'nomusu'=>$datos['nomusu'],'admin'=>$datos['admin'],'nomadmin'=>$datos['nomadmin'],'desc_adm'=>$datos['desc_adm'],'app'=>$datos['app'],'codcoment'=>$codigo,'titulo'=>$datos['titulo'],'comentario'=>$datos['comentario'],'tipo'=>$datos['tipo'],'estado'=>$datos['estado'],'avance'=>$avance,'finalizado'=>$datos['finalizado'],'anulado'=>$datos['anulado'],'iniciado'=>$datos['iniciado'],'estimado'=>$datos['estimado']);
			}
		}
		array_push($array, $row);
		echo json_encode($array);
	}else{
		echo '0';
	}
}else{
	echo '0';
}

function agregarComentario(&$comentario,$etiqueta,$continuacion){
	if ($etiqueta == 'comentario') {
		$comentario = $comentario."".$continuacion;
	}
}