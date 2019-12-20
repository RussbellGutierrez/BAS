<?php
	date_default_timezone_set('America/Bogota');
	require_once 'metodos.php';

	$m = new Metodos;
	if (isset($_COOKIE['_pr'])) {
		$deco = $m->decodeCookie($_COOKIE['_pr']);
		if ($deco != '0') {
			if (time() < $deco->exp) {
				if ($deco->tipo == 1) {
					header('Location:administrador.php');
				}else {
					header('Location:usuario.php');
				}
				exit;
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="resources/icons/logo.ico" type="image/ico">
	<title>BAS</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.6.1/js/all.js" integrity="sha384-R5JkiUweZpJjELPWqttAYmYM1P3SNEJRM6ecTQF05pFFtxmCO+Y1CiUhvuDzgSVZ" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="resources/styles/index.css">
</head>
<body>
	<div id="backcarousel" class="carousel slide" data-ride="carousel">
	    <ol class="carousel-indicators">
	      <li data-target="#backcarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#backcarousel" data-slide-to="1"></li>
	      <li data-target="#backcarousel" data-slide-to="2"></li>
	    </ol>
	    <div class="carousel-inner" role="listbox">
	    	<div class="carousel-item active" style="background-image: url('https://source.unsplash.com/B3l0g6HLxr8/1920x1080')">
	    		<div class="carousel-caption d-none d-md-block">
	    		</div>
	    	</div>
	    	<div class="carousel-item" style="background-image: url('https://source.unsplash.com/9SoCnyQmkzI/1920x1080')">
	    		<div class="carousel-caption d-none d-md-block">
	    		</div>
	    	</div>
	    	<div class="carousel-item" style="background-image: url('https://source.unsplash.com/FBNxmwEVpAc/1920x1080')">
	    		<div class="carousel-caption d-none d-md-block">
	    		</div>
	    	</div>
	    </div>
	</div>
	<div class="over-carousel">
		<div class="medio-w centrar-verhor texto-centrado">
			<p class="principal-s texto-principal">BUZON DEL AREA DE SISTEMAS</p>
			<p class="texto-secundario">Informanos que sucede, nosotros lo revisamos</p>
		</div>
		<div class="content-s medio-w centrar-ver">
			<form id="form-log" class="form-alineado" style="background-color: white;border-radius: 5px;" type="POST">
				<input id="user" type="text" class="margen-10 edit-input" name="usuario" placeholder="Usuario" required>
				<input id="pass" type="password" class="margen-10 edit-input" name="contrasena" placeholder="Contraseña" required>
				<button type="submit" class="btn btn-primary margen-10 tamano-boton">Ingresar</button>
				<a data-toggle="modal" class="margen-10" href="#registrar" style="text-align: end;">¿Nuevo usuario?</a>
			</form>
		</div>
	</div>
	<div id="registrar" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content border-cus m-content">
	    	<div class="modal-header bord-h-cus">
	    		<h5 class="modal-title" id="m-titulo-1"><i class="fas fa-user"></i> Nuevo Usuario</h5>
	    		<i class="fas fa-times" data-dismiss="modal"></i>
	    	</div>
	    	<div class="modal-body m-body">
	    		<form id="form-reg" type='POST'>
	    			<div class="form-group">
		    			<label for="usuario"><i class="fas fa-child"></i> Nombre completo</label>
					    <input type="text" class="form-control" id="usuario" placeholder="Nombres y Apellidos" required>
					</div>
					<div class="form-group">
		    			<label for="dni"><i class="fas fa-address-card"></i> DNI</label>
					    <input type="text" class="form-control" id="dni" placeholder="DNI" maxlength="8" required>
					</div>
					<div class="form-group">
					    <label for="clave1"><i class="fas fa-comment-dots"></i> Contraseña</label>
					    <input type="password" class="form-control" id="clave1" placeholder="Contraseña" required>
					</div>
					<div class="form-group">
					    <label for="clave2"><i class="fas fa-comment-dots"></i> Repita contraseña</label>
					    <input type="password" class="form-control" id="clave2" placeholder="Contraseña" required>
					</div>
					<div style="text-align: end;">
						<button type="submit" class="btn btn-primary btn-sm">REGISTRAR</button>
					</div>
	    		</form>
	    	</div>
	    </div>
	  </div>
	</div>
	<script>
	$(function() {
		var h = $(window).height()
		$('.carousel-item').css('height',h)
		$('.carousel').carousel({
        	interval: 7000,
            pause: false
        })
        $('#form-log').on('submit',function(event){
        	event.preventDefault()
        	Swal.fire({
				title: 'Verificando usuario y contraseña...',
				allowEscapeKey: false,
				allowOutsideClick: false
			})
			Swal.showLoading()
			$.post('controlUsuarios.php',{opcion:0,dni:$('#user').val(),clave:$('#pass').val()},function(e){
				const json = JSON.parse(e)
				if (jQuery.isEmptyObject(json['datos'])) {
					Swal.fire('Advertencia','El usuario no existe, verifique los datos ingresados','warning')
				}else {
					if (json['msg'] == 4) {
						Swal.fire('Advertencia','Contraseña incorrecta','warning')
					}else if (json['msg'] == 3) {
						Swal.fire('Error','Ocurrio un error al ingresar el usuario','error')
					}else if (json['msg'] == 2) {
						Swal.fire('Usuario conectado','Si no es usted, comuniquese con el área de sistemas','warning')
					}else {
						var opc = 0
						if (json['msg'] == 1)
							opc = 1
						Swal.close()
						var param = JSON.stringify({'id':json['datos']['id'],'usuario':json['datos']['usuario'],'tipo':json['datos']['tipo'],'tipo_desc':json['datos']['tipo_desc']})
						$.post('manejo.php',{opcion:opc,parametros:param},function(e){
							if (e == 'a') {
				            	window.location.href = "administrador.php"
				            }else if (e == 'u') {
				            	window.location.href = "usuario.php"
				            }else {
				            	Swal.fire('Error','Ocurrio un error durante su ingreso','error')
				            }
						})
					}
				}
			})
        })
        $('#form-reg').on('submit',function(event){
        	event.preventDefault()
        	if ($('clave1').val() == $('clave2').val()) {
        		Swal.fire({
					title: 'Registrando nuevo usuario...',
					allowEscapeKey: false,
					allowOutsideClick: false
				})
				Swal.showLoading()
				$.post('controlUsuarios.php',{opcion:1,nombre:$('#usuario').val(),dni:$('#dni').val(),clave:$('#clave1').val()},function(e){
					const json = JSON.parse(e)
					if (json['msg'] == '') {
						Swal.fire('Correcto','Usuario registrado correctamente','success')
						$('#usuario').val('')
						$('#dni').val('')
						$('#clave1').val('')
						$('#clave2').val('')
					}else {
						if (json['msg'] == 1) {
							Swal.fire('Advertencia','Existe un usuario registrado anteriormente, comuniquese con soporte','warning')
						}else if (json['msg'] == 2) {
							Swal.fire('Error','Ocurrio un error al registrar el usuario','error')
						}else if (json['msg'] == 3) {
							Swal.fire('Advertencia','No puede usar este DNI','warning')
						}else if (json['msg'] == 4) {
							Swal.fire('Error','No tiene permiso para crear un usuario','error')
						}
					}
				})
        	}else {
        		Swal.fire('Advertencia','Verifique que la contraseña se repita en ambos campos','warning')
        	}
        })
	})
	</script>
</body>
</html>