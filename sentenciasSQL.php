<?php
class Query{
	/**MySQL Server**/
	function getVigentes($usuario,$opcion){
		if ($opcion == 0) {
			$sql = "WHERE c.usuario = ".$usuario." AND c.estado IN (0,1,2)";
		}elseif ($opcion == 1) {
			$sql = "WHERE c.estado = 0";
		}else {
			$sql = "WHERE c.admin = ".$usuario." AND c.estado IN (1,2)";
		}

		return "SELECT DATE_FORMAT(c.f_in,'%Y-%m-%d') AS f_in,IFNULL(DATE_FORMAT(c.revisado,'%Y-%m-%d'),0) AS revisado,c.usuario,u.descrip AS nomusu,a.descrip AS app,c.codcoment,c.relativo,c.titulo,c.descrip,c.tipo,ce.descrip AS estado,c.estado AS idestado,IFNULL(DATE_FORMAT(c.iniciado,'%Y-%m-%d'),0) AS iniciado,DATE_FORMAT(c.estimado,'%Y-%m-%d') AS estimado,IFNULL(DATE_FORMAT(c.finalizado,'%Y-%m-%d'),0) AS finalizado,c.anulado,IFNULL(DATE_FORMAT(c.fecanul,'%Y-%m-%d'),0) AS fecanul
				FROM COMENTARIO c
				INNER JOIN COMENT_ESTADO ce ON ce.id = c.estado
				INNER JOIN USUARIOS u ON c.usuario = u.id
				INNER JOIN APP a ON c.tipo_app = a.id
				".$sql."
				AND c.anulado = 0
				ORDER BY c.estado DESC, c.f_in ASC, c.usuario DESC, c.codcoment ASC, c.relativo ASC";
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

		return "SELECT DATE_FORMAT(c.f_in,'%Y-%m-%d') AS f_in,IFNULL(DATE_FORMAT(c.revisado,'%Y-%m-%d'),0) AS revisado,c.usuario,u.descrip AS nomusu,a.descrip AS app,c.codcoment,c.titulo,c.descrip,c.tipo,ce.descrip AS estado,c.estado AS idestado,IFNULL(DATE_FORMAT(c.iniciado,'%Y-%m-%d'),0) AS iniciado,DATE_FORMAT(c.estimado,'%Y-%m-%d') AS estimado,IFNULL(DATE_FORMAT(c.finalizado,'%Y-%m-%d'),0) AS finalizado,c.anulado,IFNULL(DATE_FORMAT(c.fecanul,'%Y-%m-%d'),0) AS fecanul
				FROM COMENTARIO c
				INNER JOIN COMENT_ESTADO ce ON ce.id = c.estado
				INNER JOIN USUARIOS u ON c.usuario = u.id
				INNER JOIN APP a ON c.tipo_app = a.id
				WHERE MONTH(c.f_in) = ".$month."
				AND YEAR(c.f_in) = ".$year."
				".$sql."
				ORDER BY c.f_in DESC, c.usuario DESC, c.codcoment ASC, c.relativo ASC";
	}

	function updateEstado($estado,$estimado,$iniciado,$finalizado,$usuario,$codcoment,$motivo){
		if ($estado == 2) {
			$sql = "UPDATE COMENTARIO SET estado =".$estado.",estimado ='".$estimado."',iniciado ='".$iniciado."',desc_adm = '".$motivo."' WHERE usuario =".$usuario." AND codcoment =".$codcoment."";
		}else {
			$sql = "UPDATE COMENTARIO SET estado =".$estado.",iniciado = CASE WHEN iniciado IS NULL THEN '".$finalizado."' ELSE iniciado END,finalizado = '".$finalizado."',desc_adm = '".$motivo."' WHERE usuario =".$usuario." AND codcoment =".$codcoment."";
		}
		return $sql;
	}

	function getDetalle($opcion,$fecha,$id,$usuario){
		if ($opcion == 0) {
			$sql = "WHERE c.f_in = '".$fecha."' AND c.codcoment = ".$id." AND c.usuario = ".$usuario."";
		}else {
			$sql = "WHERE c.admin != 0 AND c.estado = 2 AND c.anulado = 0";
		}
		return "SELECT DATE_FORMAT(c.f_in,'%Y-%m-%d') AS f_in,DATE_FORMAT(c.h_in,'%T') AS h_in,c.usuario,u.descrip AS nomusu,a.descrip AS app,c.tipo_app AS idapp,c.codcoment,c.titulo,c.descrip AS comentario,ct.descrip AS tipo,c.tipo AS idtipo,ce.descrip AS estado,IFNULL(DATE_FORMAT(c.revisado,'%Y-%m-%d'),0) AS revisado,c.admin,u2.descrip AS nomadmin,c.desc_adm,IFNULL(DATE_FORMAT(c.iniciado,'%Y-%m-%d'),0) AS iniciado,DATE_FORMAT(c.estimado,'%Y-%m-%d') AS estimado,IFNULL(DATE_FORMAT(c.finalizado,'%Y-%m-%d'),0) AS finalizado,c.anulado,IFNULL(DATE_FORMAT(c.fecanul,'%Y-%m-%d'),0) AS fecanul,c.foto
				FROM COMENTARIO c
				INNER JOIN COMENT_ESTADO ce ON c.estado=ce.id
				INNER JOIN COMENT_TIPO ct ON c.tipo=ct.id
				INNER JOIN APP a ON c.tipo_app = a.id
				INNER JOIN USUARIOS u ON c.usuario = u.id
				LEFT JOIN USUARIOS u2 ON c.admin = u2.id
				".$sql."
				ORDER BY c.admin ASC,c.h_in ASC, c.usuario DESC, c.codcoment ASC, c.relativo ASC";
	}

	function getUltimoComentario($usuario){
		return "SELECT IFNULL(MAX(codcoment),0) AS codcoment
				FROM COMENTARIO
				WHERE usuario = ".$usuario."";
	}

	function getUsuario(){
		return "SELECT IFNULL(MAX(id),0) AS id
				FROM USUARIOS";
	}

	function addUsuario($id,$nombre,$clave,$dni,$fecha){
		return "INSERT INTO USUARIOS (id,descrip,clave,tipo,dni,fec_creacion,anulado) VALUES (".$id.",'".$nombre."','".$clave."',2,'".$dni."','".$fecha."',0)";
	}

	function loginUsuario($dni){
		return "SELECT u.id,u.descrip,u.tipo,ut.descrip AS tipo_desc,u.clave
				FROM USUARIOS u
				INNER JOIN USU_TIPO ut ON u.tipo=ut.id
				WHERE u.anulado = 0
				AND u.dni = '".$dni."'";
	}

	function comprobarDisponibilidad($dni){
		return "SELECT tipo,COUNT(*) AS total
				FROM USUARIOS
				WHERE dni = '".$dni."'
				AND anulado = 0
				GROUP BY tipo";
	}

	function usuarioAdmitido($dni){
		return "SELECT COUNT(*) AS total
				FROM VALIDACION
				WHERE dni = '".$dni."'
				AND anulado = 0";
	}

	function setComentario($fecha,$hora,$usuario,$codigo,$relativo,$titulo,$descrip,$app,$tipo,$foto,$editado){
		if ($editado != '') {
			$sql = "INSERT INTO COMENTARIO (f_in,h_in,usuario,codcoment,relativo,titulo,descrip,tipo_app,tipo,foto,editado) VALUES ('".$fecha."','".$hora."',".$usuario.",".$codigo.",".$relativo.",'".$titulo."','".$descrip."',".$app.",".$tipo.",".$foto.",'".$editado."')";
		}else {
			$sql = "INSERT INTO COMENTARIO (f_in,h_in,usuario,codcoment,relativo,titulo,descrip,tipo_app,tipo,foto) VALUES ('".$fecha."','".$hora."',".$usuario.",".$codigo.",".$relativo.",'".$titulo."','".$descrip."',".$app.",".$tipo.",".$foto.")";
		}
		return $sql;
	}

	function anularComentario($usuario,$codcoment){
		return "DELETE FROM COMENTARIO WHERE usuario =".$usuario." AND codcoment=".$codcoment." ";
	}

	function setAnulado($usuario,$codcoment,$motivo,$admin,$fechatiempo){
		return "UPDATE COMENTARIO SET admin =".$admin.",desc_adm ='".$motivo."',fecanul ='".$fechatiempo."',anulado =1 WHERE usuario =".$usuario." AND codcoment =".$codcoment."";
	}

	function setTomarComentario($usuario,$codcoment,$admin,$fechatiempo){
		return "UPDATE COMENTARIO SET admin =".$admin.",revisado ='".$fechatiempo."',estado =1 WHERE usuario =".$usuario." AND codcoment =".$codcoment."";
	}

	function getCookie(){
		return "SELECT * 
				FROM COOKIE
				WHERE anulado = 0
				LIMIT 1";
	}

	function getSecret($id){
		return "SELECT * 
				FROM COOKIE
				WHERE anulado = 0
				and id = '".$id."'";
	}

	function consultarLogin($usuario){
		return "SELECT usuario,token,DATE_FORMAT(expiracion,'%Y-%m-%d %T') AS expiracion
				FROM USRCONT
				WHERE usuario = ".$usuario."";
	}

	function crudLogin($opcion,$usuario,$token,$exp){
		if ($opcion == 0) {
			$sql = "INSERT INTO USRCONT (usuario,token,expiracion) VALUES (".$usuario.",'".$token."','".$exp."')";
		}else {
			$sql = "UPDATE USRCONT SET token = '".$token."',expiracion = '".$exp."' WHERE usuario = ".$usuario."";
		}
		return $sql;
	}

	function usuarioDisponible($id){
		return "SELECT anulado
				FROM USUARIOS
				WHERE id = ".$id."";
	}
}