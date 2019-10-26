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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,900&display=swap" rel="stylesheet">
</head>
<body>
	<div id="backcarousel" class="carousel slide" data-ride="carousel">
	    <ol class="carousel-indicators">
	      <li data-target="#backcarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#backcarousel" data-slide-to="1"></li>
	      <li data-target="#backcarousel" data-slide-to="2"></li>
	    </ol>
	    <div class="carousel-inner" role="listbox">
	    	<div class="carousel-item active" style="background-image: url('https://source.unsplash.com/f5pTwLHCsAg/1920x1080')">
	    		<div class="carousel-caption d-none d-md-block">
	    		</div>
	    	</div>
	    	<div class="carousel-item" style="background-image: url('https://source.unsplash.com/9SoCnyQmkzI/1920x1080')">
	    		<div class="carousel-caption d-none d-md-block">
	    		</div>
	    	</div>
	    	<div class="carousel-item" style="background-image: url('https://source.unsplash.com/pjAH2Ax4uWk/1920x1080')">
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
			<form id="formulario" class="form-alineado" type="POST">
				<input id="user" type="text" class="margen-10 edit-input" name="usuario" placeholder="Usuario" required>
				<input id="pass" type="password" class="margen-10 edit-input" name="contrasena" placeholder="Contraseña" required>
				<select id="emp" class="margen-10 edit-input" name="empresa">
					<option value="1">Oriunda</option>
					<option value="2">Terranorte</option>
				</select>
				<button type="submit" class="btn btn-primary margen-10 tamano-boton">Ingresar</button>
			</form>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('.carousel').carousel({
        		interval: 7000,
                pause: false
        	})
        	$('#formulario').on('submit',function(event){
        		event.preventDefault()
        		Swal.fire({
					title: 'Verificando usuario y contraseña...',
					allowEscapeKey: false,
					allowOutsideClick: false
				})
				Swal.showLoading()
        		$.ajax({
					type: 'POST',
					url: 'http://200.110.40.58/api/usuario/ingresar',
					dataType: 'json',
					contentType: 'application/json; charset=utf-8',
					xhrFields:{withCredentials:false},
					crossDomain: true,
					data: JSON.stringify({'usuario':$('#user').val(),'clave':$('#pass').val(),'empresa':$("#emp option:selected").val()}),
					success: function(data) {
			            Swal.close()
			            $.post('credenciales.php',{parametros:JSON.stringify(data)},function(){})
			        }, 
			    	error: function(jqXHR, textStatus, errorThrown) {
			    		switch(jqXHR.status){
			    			case 400:
			    			Swal.fire('Error','Complete todos los espacios en blanco','error')
			    			break
			    			case 404:
			    			Swal.fire('Advertencia','Usuario no encontrado','warning')
			    			break
			    			case 405:
			    			Swal.fire('Advertencia',"Contraseña incorrecta",'warning')
			    			break
			    			default:
			    			Swal.fire('Error','Ocurrio un error al querer ingresar','error')
			    			break
			    		}
			        }
				})
        	})
		})
	</script>
	<style>
		.carousel-item {
			height: 100vh;
			background: no-repeat center center scroll;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.carousel-indicators li {
			width: 10px;
			height: 10px;
			background-color: rgba(0,0,0,0);
			border: 1px solid #fff;
			border-radius: 20px;
		}
		.carousel-indicators .active {
			background-color: #fff;
		}
		.over-carousel {
			position: fixed;
		    top: 0;
		    right: 0;
		    bottom: 0;
		    left: 0;
		    margin: auto;
		    padding: .5rem;
		    width: min-content;
    		height: fit-content;
		    background: rgba(255, 255, 255);
		}
		.texto-principal {
			font-size: 30px;
			color: black;
	    	font-family: 'Nunito', sans-serif;
	    	margin-top: unset;
	    	margin-bottom: unset;
		}
		.texto-secundario {
			display: none;
		}
		.texto-centrado {
			text-align: center;
		}
		.centrar-verhor {
			align-items: center;
			justify-content: center;
			flex-direction: column;
		}
		.centrar-ver {
			align-items: center;
		}
		.margen-10 {
			margin: 10px 10px 10px 10px;
		}
		.form-alineado {
			width: 300px;
			display: flex;
	    	flex-direction: column;
		}
		.edit-input {
			padding: .375rem .75rem;
		    font-size: 1rem;
		    font-weight: 400;
			border: 1px solid #ced4da;
			border-radius: .25rem;
	    	transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}
		/* Small devices (phones, 768px and down) */
		@media only screen and (max-width: 768px) {
			.over-carousel {
				border-radius: 5px;
			}
			.content-s {
				display: flex;
	    		flex-direction: column;
			}
			.principal-s {
				margin: 20px 20px 0px 20px;
			}
		}

		/* Medium devices (landscape tablets, 768px and up) */
		@media only screen and (min-width: 768px) {
			.over-carousel {
				display: flex;
				padding: 0;
				width: 100%;
			    height: 300px;
			    background: rgba(0, 0, 0, 0.3);
			}
			.texto-principal {
				font-size: 40px;
				color: white;
			}
			.texto-secundario {
				display: contents;
				color: white;
		    	font-size: 20px;
		    	font-family: 'Nunito', sans-serif;
		    	margin-top: unset;
		    	margin-bottom: unset;
			}
			.medio-w {
				width: 50%;
				height: 300px;
				display: flex;
			}
			.tamano-boton {
				width: 100px;
			}
		}

		/* Large devices (large laptops and desktops, 1200px and up) */
		@media only screen and (min-width: 1200px) {
			.over-carousel {
				display: flex;
				padding: 0;
				width: 100%;
				height: 300px;
			    background: rgba(0, 0, 0, 0.3);
			}
			.texto-principal {
				font-size: 50px;
				color: white;
			}
			.texto-secundario {
				display: contents;
				color: white;
		    	font-size: 20px;
		    	font-family: 'Nunito', sans-serif;
		    	margin-top: unset;
		    	margin-bottom: unset;
			}
			.medio-w {
				width: 50%;
				height: 300px;
				display: flex;
			}
			.tamano-boton {
				width: 100px;
			}
		}

	</style>
</body>
</html>