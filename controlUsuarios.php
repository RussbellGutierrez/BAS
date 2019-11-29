<?php
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

date_default_timezone_set('America/Bogota');
$opcion = filter_input(INPUT_POST, "opcion");
$nombre = filter_input(INPUT_POST, "nombre");
$dni = filter_input(INPUT_POST, "dni");
$clave = filter_input(INPUT_POST, "clave");

$row = array();
$query = new Query;
$m = new Metodos;
$mensaje = '';

$cadena = $m->getConectWeb();
$nom = strtoupper($nombre);

if ($opcion == 0){
	$sql = $query->loginUsuario($dni,$clave);
	$get = sqlsrv_query($cadena,$sql);
	if ($get === false) {
			$mensaje = '2';
	}else{
		while($d = sqlsrv_fetch_array($get)){
			$row = array('id'=>$d['id'],'usuario'=>$d['descrip'],'tipo'=>$d['tipo'],'tipo_desc'=>$d['tipo_desc']);
		}
	}
}else if($opcion == 1) {
	$execute = sqlsrv_query($cadena,$query->comprobarDisponibilidad($dni));
	sqlsrv_fetch($execute);
	$tipo = sqlsrv_get_field($execute, 0);
	$total = sqlsrv_get_field($execute, 1);
	if ($tipo == 1) {
		$mensaje = '3';
	}else if ($tipo == 2) {
		if ($total > 0) {
			$mensaje = '1';
		}
	}
	if ($mensaje == '') {
		$usuario = sqlsrv_query($cadena,$query->getUsuario());
		sqlsrv_fetch($usuario);
		$ultimo = sqlsrv_get_field($usuario, 0) + 1;
		$fecha = date('Y-m-d').' '.date('H:i:s');
		$sql = $query->addUsuario($ultimo,$nom,$clave,$dni,$fecha);
		$insert = sqlsrv_query($cadena,$sql);
		if ($insert === false) {
			$mensaje = '2';
		}
	}
}/*else if ($opcion == 2) {
	$anular = sqlsrv_query($cadena,$query->anularUsuario($dni));
	if ($anular === false) {
		$mensaje = '3';
	}
}*/
$resultado = array('msg'=>$mensaje,'datos'=>$row);

echo json_encode($resultado);