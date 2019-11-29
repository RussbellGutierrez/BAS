<?php
/**
 * Clase encargada de obtener el secret del cookie
 */
date_default_timezone_set('America/Bogota');
require_once 'conexion.php';
require_once 'sentenciasSQL.php';
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;

class Metodos{

	function __construct(){}

	function getConexion($basedatos) {
        $conexion = new Conexion;
        return (strcasecmp($basedatos, 1) == 0) ? $conexion->conectOri() : $conexion->conectTerra();
    }

    function getConectUsers(){
    	$conexion = new Conexion;
        return $conexion->conectUsers();
    }

    function getConectWeb(){
    	$conexion = new Conexion;
        return $conexion->conectWeb();
    }

    function getHasher(){
    	$sql = new Query;
    	$conexion = new Conexion;
    	$cadena = $conexion->conectWeb();
    	$execute = sqlsrv_query($cadena,$sql->getCookie());
    	while($p = sqlsrv_fetch_array($execute)){
    		$data = $p['ID']." ".$p['SECRET'];
    	}
    	return $data;
    }

    function decodeCookie($jwt){
    	$sql = new Query;
    	$conexion = new Conexion;
    	$cadena = $conexion->conectWeb();
    	$header = explode('.', $jwt)[0];
    	$payload = explode('.', $jwt)[1];
    	$signature = explode('.', $jwt)[2];
    	$mix = substr($payload,3,12);
    	$id = substr($mix,2,-2);
    	$payreal = substr($payload,0,3).substr($payload,15);
    	$concat = $header.'.'.$payreal.'.'.$signature;
    	$execute = sqlsrv_query($cadena,$sql->getSecret($id));
    	while($p = sqlsrv_fetch_array($execute)){
    		try {
    			$decoded = JWT::decode($concat,$p['SECRET'],['HS256']);
    		}catch(Exception $e){
    			$decoded = 0;
    		}
    	}
    	return $decoded;
    }

    function hasher() { 
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$randomString = ''; 

		for ($i = 0; $i < 4; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomString .= $characters[$index]; 
		} 

		return $randomString; 
	}

	function diferenciaDias($creado,$revisado,$finalizado,$anulado){
		($revisado == 0) ? $first = date_create($creado) : $first = date_create($revisado);
        if ($finalizado == 0) {
            ($anulado == 0) ? $last = date_create(date("Y-m-d")) : $last = date_create($anulado);
        }else {
            $last = date_create($finalizado);
        }
		$diff = date_diff($first,$last);
		return $diff->format("%a");
	}

	function avanceComentario($iniciado,$estimado,$finalizado){
		$avance = 0;
		if ($iniciado != 0) {
			$fr = date_create($iniciado);
			$fe = date_create(date('Y-m-d', strtotime($iniciado. ' + '.$estimado.' days')));
			$fa = date_create(date('Y-m-d'));
			if ($estimado == 0) {
                $f = date_diff($fr,$fa);
                $avance = $f->format("%a");
            }else if ($finalizado == 0) {
				$fre = date_diff($fr,$fe);
				$fra = date_diff($fr,$fa);
				$avance = ($fra->format("%a")*100)/$fre->format("%a");
			}else {
				$ff = date_create($finalizado);
				$fre = date_diff($fr,$fe);
				$frf = date_diff($fr,$ff);
				$avance = ($frf->format("%a")*100)/$fre->format("%a");
			}
		}
		return number_format($avance,2);
	}
}