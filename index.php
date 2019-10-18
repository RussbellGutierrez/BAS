<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="resources/icons/logo.ico" type="image/ico">
	<title>BAS</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
			<p class="texto-grande">BUZON DEL AREA DE SISTEMAS</p>
			<p class="texto-pequeno">Informanos que sucede, nosotros lo revisamos</p>
		</div>
		<div class="medio-w centrar-ver">
			<form class="form-alineado" action="" method="POST">
				<input type="text" class="margen-10 edit-input" name="usuario" placeholder="Usuario">
				<input type="password" class="margen-10 edit-input" name="contrasena" placeholder="Contraseña">
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
        	$('#oriunda').on('click',function(){
				$.post('manejoSesiones.php',{parametro:1},function(){
					window.location.href = "login.php"
				})
			})
			$('#terranorte').on('click',function(){
				$.post('manejoSesiones.php',{parametro:2},function(){
					window.location.href = "login.php"
				})
			})
		})
	</script>
	<style>
	.carousel-item {
		height: 100vh;
		min-height: 350px;
		background: no-repeat center center scroll;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.carousel-indicators li {
		width: 15px;
		height: 15px;
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
	    padding: 0;
	    width: 100%;
	    height: 300px;
	    background: rgba(0, 0, 0, 0.3);
	    display: flex;
	}
	.medio-w {
		width: 50%;
		height: 300px;
		display: flex;
	}
	.texto-grande {
		color: white;
    	font-size: 50px;
    	font-family: Tahoma, Geneva, sans-serif;
    	margin-top: unset;
    	margin-bottom: unset;
	}
	.texto-pequeno {
		color: white;
    	font-size: 20px;
    	font-family: Arial, Helvetica, sans-serif;
    	margin-top: unset;
    	margin-bottom: unset;
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
	.tamano-boton {
		width: 100px;
	}
	</style>
</body>
</html>