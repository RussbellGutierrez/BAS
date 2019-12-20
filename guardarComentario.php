<?php
require_once 'metodos.php';
require_once 'sentenciasSQL.php';
date_default_timezone_set('America/Bogota');

$opcion = filter_input(INPUT_POST, "opcion");
$titulo = filter_input(INPUT_POST, "titulo");
$comentario = filter_input(INPUT_POST, "comentario");
$app = filter_input(INPUT_POST, "app");
$tipo = filter_input(INPUT_POST, "tipo");
$imagenes = filter_input(INPUT_POST, "imagenes");
$codcoment = filter_input(INPUT_POST, "codcoment");
$adicional = filter_input(INPUT_POST, "adicional");

$descrip = array();
$list = array();
$m = new Metodos;
$query = new Query;
$contador = 1;

if (isset($_COOKIE['_pr'])) {
	
	$deco = $m->decodeCookie($_COOKIE['_pr']);
	if ($deco != '0') {

		$cadena = $m->getConectMySQL();
		if($opcion == 0) {
			$execute = mysqli_query($cadena,$query->getUltimoComentario($deco->id));
			$id = mysqli_fetch_assoc($execute);
			$ultimo = $id['codcoment'] + 1;
			$hora = date('H:i:s');
			$fecha = date('Y-m-d');
			$editado = '';
			$arr_img = json_decode($imagenes);
			$titulo = strtoupper($titulo);
			(empty($arr_img)) ? $foto = 0 : $foto = 1;
		}else{
			$delete = mysqli_query($cadena,$query->anularComentario($deco->id,$codcoment));
			$ultimo = $codcoment;
			$hora = explode("@", $adicional)[1];
			$fecha = explode("@", $adicional)[0];
			$editado = date('Y-m-d H:i:s');
			$foto = $imagenes;
		}

		$comentario = str_replace("'", "''",$comentario);
		$comentario = strtoupper($comentario);
		
		if (strlen($comentario) > 255) {
			do{
				$part = substr($comentario,0,255);
				array_push($descrip,$part);
				$comentario = substr($comentario,255);
			}while (strlen($comentario) > 255);
			array_push($descrip,$comentario);

			foreach ($descrip as $coment) {
				$row = array('fecha'=>$fecha,'hora'=>$hora,'usuario'=>$deco->id,'codigo'=>$ultimo,'relativo'=>$contador,'titulo'=>$titulo,'descrip'=>$coment,'app'=>$app,'tipo'=>$tipo,'foto'=>$foto,'editado'=>$editado);
				array_push($list,$row);
				$contador++;
			}
		}else {
			$row = array('fecha'=>$fecha,'hora'=>$hora,'usuario'=>$deco->id,'codigo'=>$ultimo,'relativo'=>$contador,'titulo'=>$titulo,'descrip'=>$comentario,'app'=>$app,'tipo'=>$tipo,'foto'=>$foto,'editado'=>$editado);
			array_push($list,$row);
		}

		foreach ($list as $i) {
			$sql = $query->setComentario($i['fecha'],$i['hora'],$i['usuario'],$i['codigo'],$i['relativo'],$i['titulo'],$i['descrip'],$i['app'],$i['tipo'],$i['foto'],$i['editado']);
			$insert = mysqli_query($cadena,$sql);
		}

		if ($insert === false) {
			echo '2';
		}else {
			if (!empty($arr_img)) {	
				for($i=0; $i<count($arr_img); $i++){
					$bin = base64_decode(explode(',',$arr_img[$i])[1]);
					$img = imagecreatefromstring($bin);
					if (!$img) {
						 die('Base64 value is not a valid image');
					}
					$name = $deco->id.'_'.$ultimo.'_'.$i;
					$img_file = 'comentario-img/'.$name.'.png';
					imagepng($img, $img_file, 0);
				}
			}
			echo '1';
		}
	}else {
		echo '0';
	}
}else{
	echo '0';
}