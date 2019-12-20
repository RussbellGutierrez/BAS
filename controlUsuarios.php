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

$cadena = $m->getConectMySQL();
$nom = strtoupper($nombre);

if ($opcion == 0){
	$sql = $query->loginUsuario($dni);

	$get = mysqli_query($cadena,$sql);
	if ($get === false) {
		$mensaje = '3';
	}else{
		while($d = mysqli_fetch_array($get)){
			$row = array('id'=>$d['id'],'usuario'=>$d['descrip'],'tipo'=>$d['tipo'],'tipo_desc'=>$d['tipo_desc'],'clave'=>$d['clave']);
		}
		if(!empty($row)) {
			$execute = mysqli_query($cadena,$query->consultarLogin($row['id']));
			if ($execute) {
				$filas = mysqli_num_rows($execute);
				if ($filas != 0) {
					$exp = mysqli_fetch_assoc($execute);
					$convexp = new DateTime($exp['expiracion']);
					$hoy = new DateTime();
					if ($convexp > $hoy) {
						$mensaje = '2';
					}else {
						if (password_verify($clave,$row['clave'])) {
							$mensaje = '1';
						}else {
							$mensaje = '4';
						}
					}
				}
			}
		}
	}
}else if($opcion == 1) {
	$filtro = mysqli_query($cadena,$query->usuarioAdmitido($dni));
	$resultado = mysqli_fetch_assoc($filtro);
	if ($resultado['total'] == 0) {
		$mensaje = '4';
	}else {
		$execute = mysqli_query($cadena,$query->comprobarDisponibilidad($dni));
		$param = mysqli_fetch_assoc($execute);
		$tipo = $param['tipo'];
		$total = $param['total'];
		if ($tipo == 1) {
			$mensaje = '3';
		}else if ($tipo == 2) {
			if ($total > 0) {
				$mensaje = '1';
			}
		}
		if ($mensaje == '') {
			$usuario = mysqli_query($cadena,$query->getUsuario());
			$id = mysqli_fetch_assoc($usuario);
			$ultimo = $id['id'] + 1;
			$fecha = date('Y-m-d').' '.date('H:i:s');
			$clavehash = password_hash($clave, PASSWORD_DEFAULT);
			$sql = $query->addUsuario($ultimo,$nom,$clavehash,$dni,$fecha);
			$insert = mysqli_query($cadena,$sql);
			if ($insert === false) {
				$mensaje = '2';
			}
		}
	}
}

$resultado = array('msg'=>$mensaje,'datos'=>$row);

echo json_encode($resultado);