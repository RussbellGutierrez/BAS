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

$cadena = $m->getConectMySQL();//$cadena = $m->getConectWeb();
$nom = strtoupper($nombre);

if ($opcion == 0){
	$clavehash = password_hash($clave, PASSWORD_DEFAULT);
	$sql = $query->loginUsuario($dni,$clavehash);
	$get = mysqli_query($cadena,$sql);//$get = sqlsrv_query($cadena,$sql);
	if ($get === false) {
			$mensaje = '3';
	}else{
		while($d = mysqli_fetch_array($get)){//while($d = sqlsrv_fetch_array($get)){
			$row = array('id'=>$d['id'],'usuario'=>$d['descrip'],'tipo'=>$d['tipo'],'tipo_desc'=>$d['tipo_desc']);
		}
		if (!empty($row)) {
			$execute = mysqli_query($cadena,$query->consultarLogin($row['id']));//$execute = sqlsrv_query($cadena,$query->consultarLogin($row['id']));
			if ($execute) {
				$filas = mysqli_num_rows($execute);//$filas = sqlsrv_has_rows($execute);
				if ($filas != 0) {//if ($filas === true) {
					$exp = $m->mysqli_field_name($execute,2);/*sqlsrv_fetch($execute);
					$exp = sqlsrv_get_field($execute,2);*/
					$convexp = new DateTime($exp);
					$hoy = new DateTime();
					if ($convexp > $hoy) {
						$mensaje = '2';
					}else {
						$mensaje = '1';
					}
				}
			}
		}
	}
}else if($opcion == 1) {
	$execute = mysqli_query($cadena,$query->comprobarDisponibilidad($dni));//$execute = sqlsrv_query($cadena,$query->comprobarDisponibilidad($dni));
	/*sqlsrv_fetch($execute);
	$tipo = sqlsrv_get_field($execute, 0);
	$total = sqlsrv_get_field($execute, 1);*/
	$tipo = $m->mysqli_field_name($execute, 0);
	$total = $m->mysqli_field_name($execute, 1);
	if ($tipo == 1) {
		$mensaje = '3';
	}else if ($tipo == 2) {
		if ($total > 0) {
			$mensaje = '1';
		}
	}
	if ($mensaje == '') {
		$usuario = mysqli_query($cadena,$query->getUsuario());//$usuario = sqlsrv_query($cadena,$query->getUsuario());
		/*sqlsrv_fetch($usuario);
		$ultimo = sqlsrv_get_field($usuario, 0) + 1;*/
		$ultimo = $m->mysqli_field_name($usuario, 0) + 1;
		$fecha = date('Y-m-d').' '.date('H:i:s');
		$clavehash = password_hash($clave, PASSWORD_DEFAULT);
		$sql = $query->addUsuario($ultimo,$nom,$clavehash,$dni,$fecha);
		$insert = mysqli_query($cadena,$sql);//$insert = sqlsrv_query($cadena,$sql);
		if ($insert === false) {
			$mensaje = '2';
		}
	}
}

$resultado = array('msg'=>$mensaje,'datos'=>$row);

echo json_encode($resultado);