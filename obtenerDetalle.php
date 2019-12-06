<?php
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

date_default_timezone_set('America/Bogota');
$opcion = filter_input(INPUT_POST, "opcion");
$parametros = filter_input(INPUT_POST, "parametros");

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

		$cadena = $m->getConectMySQL();//$cadena = $m->getConectWeb();
		$p = explode('@',$parametros);

		if($opcion == 0) {
			$sql = $query->getDetalle(0,$p[1],$p[0],$deco->id);
		}else {
			$sql = $query->getDetalle(0,$p[1],$p[0],$p[2]);
			$directorio = "comentario-img/";
			$imagenes = glob($directorio.$p[2]."_".intval($p[0])."_*");

			foreach ($imagenes as $i) {
				$tipo = pathinfo($i, PATHINFO_EXTENSION);
				$data = file_get_contents($i);
				$base64 = 'data:image/' . $tipo . ';base64,' . base64_encode($data);
				array_push($img,$base64);
			}
		}
		
		$execute = mysqli_query($cadena,$sql);//$execute = sqlsrv_query($cadena,$sql);
		while($datos = mysqli_fetch_array($execute)){//while($datos = sqlsrv_fetch_array($execute)){
			if ($user == 0 && $coment == 0) {
				$user = $datos['usuario'];
				$coment = $datos['codcoment'];
				$codigo = str_pad($datos['codcoment'], 4, "0", STR_PAD_LEFT);
				$fecesti = date_create(date('Y-m-d', strtotime($datos['iniciado']. ' + '.$datos['estimado'].' days')));
				$array = array('fecha'=>$datos['f_in'],'hora'=>$datos['h_in'],'usuario'=>$datos['usuario'],'nomusu'=>$datos['nomusu'],'app'=>$datos['app'],'codcoment'=>$codigo,'titulo'=>$datos['titulo'],'comentario'=>$datos['comentario'],'tipo'=>$datos['tipo'],'estado'=>$datos['estado'],'revisado'=>$datos['revisado'],'admin'=>$datos['admin'],'nomadmin'=>$datos['nomadmin'],'desc_adm'=>$datos['desc_adm'],'iniciado'=>$datos['iniciado'],'estimado'=>$datos['estimado'],'finalizado'=>$datos['finalizado'],'anulado'=>$datos['anulado'],'fecanul'=>$datos['fecanul'],'fecesti'=>$fecesti->format("Y-m-d"),'imagenes'=>$img);
			}else if($user == $datos['usuario'] && $coment == $datos['codcoment']) {
				array_walk($array,'agregarComentario',$datos['comentario']);
			}
		}
		echo json_encode($array);
	}else {
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