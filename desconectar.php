<?php
date_default_timezone_set('America/Bogota');
require_once 'metodos.php';
require_once 'sentenciasSQL.php';

$q = new Query;
$m = new Metodos;

if (isset($_COOKIE['_pr'])) {
	$deco = $m->decodeCookie($_COOKIE['_pr']);
	if ($deco != '0') {

		$cadena = $m->getConectMySQL();//$cadena = $m->getConectWeb();
		$sql = $q->crudLogin(1,$deco->id,$deco->token,date('Y-m-d H:i:s'));
		$exe = mysqli_query($cadena,$sql);//$exe = sqlsrv_query($cadena,$sql);
		if ($exe === false) {
			echo '0';
		}else {
			setcookie('_pr','',time() - 3600);
			unset($_COOKIE['_pr']);
			echo '1';
		}
	}
}