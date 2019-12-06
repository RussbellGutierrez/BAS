<?php
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

date_default_timezone_set('America/Bogota');
$comentario = filter_input(INPUT_POST, "comentario");
$opcion = filter_input(INPUT_POST, "opcion");
$mes = filter_input(INPUT_POST, "mes");
$anho = filter_input(INPUT_POST, "anho");

$user = 0;
$coment = 0;
$codigo = '';
$row = array();
$array = array();
$query = new Query;
$m = new Metodos;

if (isset($_COOKIE['_pr'])) {

	$deco = $m->decodeCookie($_COOKIE['_pr']);
	if ($deco != '0') {
		$cadena = $m->getConectMySQL();//$cadena = $m->getConectWeb();
		($comentario == 0) ? $sql = $query->getVigentes($deco->id,$opcion) : $sql = $query->getOtros($deco->id,$mes,$anho,$opcion);

		$execute = mysqli_query($cadena,$sql);//$execute = sqlsrv_query($cadena,$sql);

		while($datos = mysqli_fetch_array($execute)){//while($datos = sqlsrv_fetch_array($execute)){
			if ($user == 0 && $coment == 0) {
				$user = $datos['usuario'];
				$coment = $datos['codcoment'];
				$diff = $m->diferenciaDias($datos['f_in'],$datos['revisado'],$datos['finalizado'],$datos['fecanul']);
				$avance = $m->avanceComentario($datos['iniciado'],$datos['estimado'],$datos['finalizado']);
				$codigo = str_pad($datos['codcoment'], 4, "0", STR_PAD_LEFT);
				$row = array('fecha'=>$datos['f_in'],'transcurrido'=>$diff,'usuario'=>$datos['usuario'],'nomusu'=>$datos['nomusu'],'app'=>$datos['app'],'codcoment'=>$codigo,'titulo'=>$datos['titulo'],'descrip'=>$datos['descrip'],'tipo'=>$datos['tipo'],'estado'=>$datos['estado'],'avance'=>$avance,'finalizado'=>$datos['finalizado'],'anulado'=>$datos['anulado'],'iniciado'=>$datos['iniciado'],'estimado'=>$datos['estimado']);
			}else if($user == $datos['usuario'] && $coment == $datos['codcoment']) {
				array_walk($row,'agregarComentario',$datos['descrip']);
			}else {
				array_push($array, $row);
				$user = $datos['usuario'];
				$coment = $datos['codcoment'];
				$diff = $m->diferenciaDias($datos['f_in'],$datos['revisado'],$datos['finalizado'],$datos['fecanul']);
				$avance = $m->avanceComentario($datos['iniciado'],$datos['estimado'],$datos['finalizado']);
				$codigo = str_pad($datos['codcoment'], 4, "0", STR_PAD_LEFT);
				$row = array('fecha'=>$datos['f_in'],'transcurrido'=>$diff,'usuario'=>$datos['usuario'],'nomusu'=>$datos['nomusu'],'app'=>$datos['app'],'codcoment'=>$codigo,'titulo'=>$datos['titulo'],'descrip'=>$datos['descrip'],'tipo'=>$datos['tipo'],'estado'=>$datos['estado'],'avance'=>$avance,'finalizado'=>$datos['finalizado'],'anulado'=>$datos['anulado'],'iniciado'=>$datos['iniciado'],'estimado'=>$datos['estimado']);
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
	if ($etiqueta == 'descrip') {
		$comentario = $comentario."".$continuacion;
	}
}