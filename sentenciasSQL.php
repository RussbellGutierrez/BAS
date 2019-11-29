<?php
class Query{
	function getVigentes($usuario,$opcion){
		if ($opcion == 0) {
			$sql = "WHERE c.usuario = ".$usuario." AND c.estado IN (0,1,2)";
		}elseif ($opcion == 1) {
			$sql = "WHERE c.estado = 0";
		}else {
			$sql = "WHERE c.admin = ".$usuario." AND c.estado IN (1,2)";
		}

		return "SELECT CONVERT(VARCHAR,c.f_in,23) AS f_in,ISNULL(CONVERT(VARCHAR,c.revisado,23),0) AS revisado,c.usuario,u.descrip AS nomusu,c.codcoment,c.titulo,c.descrip,c.tipo,ce.descrip AS estado,ISNULL(CONVERT(VARCHAR,c.iniciado,23),0) AS iniciado,c.estimado,ISNULL(CONVERT(VARCHAR,c.finalizado,23),0) AS finalizado,c.anulado,ISNULL(CONVERT(VARCHAR,c.fecanul,23),0) AS fecanul
				FROM web.comentario c
				INNER JOIN web.coment_estado ce ON ce.id = c.estado
				INNER JOIN web.usuarios u ON c.usuario = u.id
				".$sql."
				AND c.anulado = 0
				ORDER BY c.admin DESC, c.revisado ASC, c.f_in ASC";
	}

	function getOtros($usuario,$month,$year,$opcion){
		if ($opcion == 0) {
			$sql = "AND c.usuario = ".$usuario." AND c.estado IN (3,4,5) AND c.anulado = 0";
		}elseif ($opcion == 1) {
			$sql = "AND c.usuario = ".$usuario." AND c.anulado = 1";
		}elseif ($opcion == 2) {
			$sql = "AND c.admin = ".$usuario." AND c.estado IN (3,4,5) AND c.anulado = 0";
		}else {
			$sql = "AND c.admin = ".$usuario." AND c.anulado = 1";
		}

		return "SELECT CONVERT(VARCHAR,c.f_in,23) AS f_in,ISNULL(CONVERT(VARCHAR,c.revisado,23),0) AS revisado,c.usuario,u.descrip AS nomusu,c.codcoment,c.titulo,c.descrip,c.tipo,ce.descrip AS estado,ISNULL(CONVERT(VARCHAR,c.iniciado,23),0) AS iniciado,c.estimado,ISNULL(CONVERT(VARCHAR,c.finalizado,23),0) AS finalizado,c.anulado,ISNULL(CONVERT(VARCHAR,c.fecanul,23),0) AS fecanul
				FROM web.comentario c
				INNER JOIN web.coment_estado ce ON ce.id = c.estado
				INNER JOIN web.usuarios u ON c.usuario = u.id
				WHERE MONTH(c.f_in) = ".$month."
				AND YEAR(c.f_in) = ".$year."
				".$sql."
				ORDER BY c.f_in DESC,c.codcoment DESC";
	}

	function updateEstado($estado,$estimado,$iniciado,$finalizado,$usuario,$codcoment){
		if ($estado == 2) {
			$sql = "UPDATE web.comentario SET estado =".$estado.",estimado =".$estimado.",iniciado ='".$iniciado."' WHERE usuario =".$usuario." AND codcoment =".$codcoment."";
		}else {
			$sql = "UPDATE web.comentario SET estado =".$estado.",iniciado = CASE WHEN iniciado IS NULL THEN '".$finalizado."' END,finalizado = '".$finalizado."' WHERE usuario =".$usuario." AND codcoment =".$codcoment."";
		}
		return $sql;
	}

	function getDetalle($opcion,$fecha,$id,$usuario){
		if ($opcion == 0) {
			$sql = "WHERE c.f_in = '".$fecha."' AND c.codcoment = ".$id." AND c.usuario = ".$usuario."";
		}else {
			$sql = "WHERE c.admin != 0 AND c.estado = 2 AND c.anulado = 0";
		}
		return "SELECT CONVERT(VARCHAR,c.f_in,23) AS f_in,CONVERT(VARCHAR,c.h_in,8) AS h_in,c.usuario,u.descrip AS nomusu,c.codcoment,c.titulo,c.descrip AS comentario,ct.descrip AS tipo,ce.descrip AS estado,ISNULL(CONVERT(VARCHAR,c.revisado,23),0) AS revisado,c.admin,u2.descrip AS nomadmin,c.desc_adm,ISNULL(CONVERT(VARCHAR,c.iniciado,23),0) AS iniciado,c.estimado,ISNULL(CONVERT(VARCHAR,c.finalizado,23),0) AS finalizado,c.anulado,ISNULL(CONVERT(VARCHAR,c.fecanul,23),0) AS fecanul
				FROM web.comentario c
				INNER JOIN web.coment_estado ce ON c.estado=ce.id
				INNER JOIN web.coment_tipo ct ON c.tipo=ct.id
				INNER JOIN web.usuarios u ON c.usuario = u.id
				LEFT JOIN web.usuarios u2 ON c.admin = u2.id
				".$sql."
				ORDER BY c.admin ASC,c.h_in ASC";
	}

	function getUltimoComentario($usuario){
		return "SELECT ISNULL(MAX(codcoment),0) AS codcoment
				FROM web.comentario
				WHERE usuario = ".$usuario."";
	}

	function getUsuario(){
		return "SELECT ISNULL(MAX(id),0) AS id
				FROM web.usuarios";
	}

	function addUsuario($id,$nombre,$clave,$dni,$fecha){
		return "INSERT INTO web.usuarios (id,descrip,clave,tipo,dni,fec_creacion,anulado) VALUES (".$id.",'".$nombre."','".$clave."',2,".$dni.",'".$fecha."',0)";
	}

	function loginUsuario($dni,$clave){
		return "SELECT u.id,u.descrip,u.tipo,ut.descrip AS tipo_desc
				FROM web.usuarios u
				INNER JOIN web.usu_tipo ut ON u.tipo=ut.id
				WHERE u.anulado = 0
				AND u.dni = ".$dni."
				AND u.clave = '".$clave."'";
	}

	function comprobarDisponibilidad($dni){
		return "SELECT tipo,COUNT(*) AS total
				FROM web.usuarios
				WHERE dni = ".$dni."
				AND anulado = 0
				GROUP BY tipo";
	}

	function anularUsuario($dni){
		return "UPDATE web.usuarios SET anulado =1 WHERE dni =".$dni." and tipo =2";
	}

	function setComentario($fecha,$hora,$usuario,$codigo,$titulo,$descrip,$tipo,$foto){
		return "INSERT INTO web.comentario (f_in,h_in,usuario,codcoment,titulo,descrip,tipo,foto) VALUES ('".$fecha."','".$hora."',".$usuario.",".$codigo.",'".$titulo."','".$descrip."',".$tipo.",".$foto.")";
	}

	function setAnulado($usuario,$codcoment,$motivo,$admin,$fechatiempo){
		return "UPDATE web.comentario SET admin =".$admin.",desc_adm ='".$motivo."',fecanul ='".$fechatiempo."',anulado =1 WHERE usuario =".$usuario." AND codcoment =".$codcoment."";
	}

	function setTomarComentario($usuario,$codcoment,$admin,$fechatiempo){
		return "UPDATE web.comentario SET admin =".$admin.",revisado ='".$fechatiempo."',estado =1 WHERE usuario =".$usuario." AND codcoment =".$codcoment."";
	}

	function setFinalizarComentario($usuario,$codcoment,$motivo,$admin,$fechatiempo){
		return "";
	}

	function getCookie(){
		return "SELECT TOP 1 * 
				FROM web.cookie
				WHERE anulado = 0
				ORDER BY NEWID()";
	}

	function getSecret($id){
		return "SELECT * 
				FROM web.cookie
				WHERE anulado = 0
				and id = '".$id."'";
	}
}