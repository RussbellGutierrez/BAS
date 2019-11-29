<?php
	date_default_timezone_set('America/Bogota');
	require_once 'metodos.php';
	$m = new Metodos;
	if (isset($_COOKIE['_pr'])) {
		$deco = $m->decodeCookie($_COOKIE['_pr']);
		if ($deco != '0') {
			if (time() > $deco->exp) {
				header('Location:index.php');
				exit;
			}
			if ($deco->tipo == 1) {
				header('Location:index.php');
				exit;
			}
		}else{
			header('Location:index.php');
			exit;
		}
	}else {
		header('Location:index.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="resources/icons/logo.ico" type="image/ico">
	<title>BAS - Usuario</title>
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--script src="https://kit.fontawesome.com/c6963f4a8b.js" crossorigin="anonymous"></script-->
	<script defer src="https://use.fontawesome.com/releases/v5.6.1/js/all.js" integrity="sha384-R5JkiUweZpJjELPWqttAYmYM1P3SNEJRM6ecTQF05pFFtxmCO+Y1CiUhvuDzgSVZ" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container-fluid no-padding">
		<div class="dimen dimen-nav">
			<nav class="navbar navbar-expand-lg navbar-light dimen-size">
				<a class="navbar-brand" href="#">
					<div class="ali-items">
						<i class="fas fa-rocket fa-2x"></i>
						<div class="dis-txt">
							<span class="m8-l"><?php echo $deco->usuario; ?></span>
							<span class="m8-l user_type"><?php echo $deco->tipo_desc; ?></span>
						</div>
					</div>
				</a>
			  <button class="navbar-toggler no-border" type="button" data-toggle="collapse" data-target="#navbarMobile">
			  	<i class="fas fa-bars fa-lg icon-default"></i>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarMobile">
			    <ul class="navbar-nav mr-auto dir-marg">
			      <li class="nav-item ali-items m10-lr nvc">
			      	<div class="let-small n-avance active">
			      		<i class="fas fa-chart-line fa-2x"></i>
			      		<span>AVANCE</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">AVANCE</a>
			      </li>
			      <li class="nav-item ali-items m10-lr nvc">
			      	<div class="let-small n-comentario">
			      		<i class="far fa-comment-alt fa-2x"></i>
			      		<span>COMENTARIO</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">COMENTARIO</a>
			      </li>
			      <li class="nav-item ali-items nvc">
			      	<div class="let-small n-realizandose">
			      		<i class="fas fa-glasses fa-2x"></i>
			      		<span>REALIZANDOSE</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">REALIZANDOSE</a>
			      </li>
			      <li class="nav-item ali-items m10-lr">
			      	<div class="let-small n-desconectar">
			      		<i class="fas fa-power-off fa-2x"></i>
			      		<span>DESCONECTAR</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">DESCONECTAR</a>
			      </li>
			    </ul>
			  </div>
			</nav>
		</div>
		<div class="avance dimen dimen-content active">
			<div class="dimen-size bg-white-radi">
				<div id="vigente"></div>
				<button class="gotop"><i class="fas fa-arrow-up"></i></button>
			</div>
		</div>
		<div class="comentario dimen dimen-content">
			<div class="dimen-size bg-white-radi">
				<div class="padd">
					<h1>Comentario</h1>
					<div class="m5-tb">
						<label>Titulo</label>
					    <input type="text" class="form-control title-comment" placeholder="Titulo del comentario">
					</div>
					<div class="m5-tb">
						<label>Descripcion</label>
				    	<textarea class="form-control descrip-comment" placeholder="Describa su comentario brevemente..."></textarea>
					</div>
					<div class="m5-tb">
						<label>Tipo comentario</label>
					    <div class="d-flex justify-content-center">
					    	<div class="type-button comment-dots" value='1'>
					    		<i class="far fa-comment-dots fa-2x"></i>
					    		<span>Sugerencia</span>
					    	</div>
					    	<div class="type-button bug" value='2'>
					    		<i class="fas fa-bug fa-2x"></i>
					    		<span>Problema</span>
					    	</div>
					    	<div class="type-button laptop" value='3'>
					    		<i class="fas fa-laptop-code fa-2x"></i>
					    		<span>Aplicacion</span>
					    	</div>
					    </div>
					</div>
					<div class="m5-tb">
						<label>Foto (opcional)</label>
						<div class="grid-images">
							<div class="btimg-edit">
								<label class="buton-img"><i class="fas fa-camera-retro fa-3x"></i><input type="file" class="upload-image" accept="image/x-png,image/gif,image/jpeg"><span>Seleccionar una foto</span></label>
							</div>
						</div>
					</div>
				    <div class="d-flex justify-content-center">
				    	<button id="guardar" type="button" class="btn btn-cus btn-depth">Enviar comentario</a>
				    </div>
				</div>
			</div>
		</div>
		<div class="realizandose dimen dimen-content">
			<div class="dimen-size bg-white-radi">
				<div id="adm-exe">
				</div>
				<button class="gotop"><i class="fas fa-arrow-up"></i></button>
			</div>
		</div>
	</div>
	<div id="parametros" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content border-cus m-content">
	      <div class="modal-header bord-h-cus">
	        <h5 class="modal-title" id="m-titulo-1">Seleccione la fecha</h5>
	        <i class="fas fa-times" data-dismiss="modal"></i>
	      </div>
	      <div class="modal-body m-body">
	      	<div class="form-group">
	      		<select class="form-control" style="text-align-last: center;" id="anho">
	      		</select>
	      	</div>
	      	<div class="form-group">
	      		<select class="form-control" style="text-align-last: center;" id="mes">
		      		<option value="0">--MES--</option>
		      		<option value="1">Enero</option>
		      		<option value="2">Febrero</option>
		      		<option value="3">Marzo</option>
		      		<option value="4">Abril</option>
		      		<option value="5">Mayo</option>
		      		<option value="6">Junio</option>
		      		<option value="7">Julio</option>
		      		<option value="8">Agosto</option>
		      		<option value="9">Setiembre</option>
		      		<option value="10">Octubre</option>
		      		<option value="11">Noviembre</option>
		      		<option value="12">Diciembre</option>
		      	</select>
	      	</div>
	      	<div style="display: flex;">
	      		<div class="d-flex justify-content-center" style="flex: auto;">
	      			<button type="button" class="btn btn-cus modal-btn-cus btn-depth option" value="0"><i class="fas fa-flag-checkered fa-2x"></i> FINALIZADOS</a>
				</div>
				<div class="d-flex justify-content-center" style="flex: auto;">
	      			<button type="button" class="btn btn-cus modal-btn-cus btn-depth option" value="1"><i class="fas fa-comment-slash fa-2x"></i> ANULADOS</a>
				</div>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
	<div id="comentarios" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content border-cus">
	      <div class="modal-header bord-h-cus">
	        <h5 class="modal-title" id="m-titulo-1">Comentarios anteriores</h5>
	        <i class="fas fa-times" data-dismiss="modal"></i>
	      </div>
	      <div id="coment-body" class="modal-body">
	      </div>
	    </div>
	  </div>
	</div>
	<div id="detalles" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content border-cus m-content">
	      <div class="modal-header bord-h-cus">
	        <h5 id="detalle-title" class="modal-title" id="m-titulo-1"></h5>
	        <i class="fas fa-times" data-dismiss="modal"></i>
	      </div>
	      <div id="detalle-body" class="modal-body">
	      </div>
	    </div>
	  </div>
	</div>
	<script>
		$(function() {
			/*$('.chev-down').on('click',function(){
				var padre = $(this).parent()
				padre.find('.chv-dw').fadeOut()
				padre.find('.childDiv').show('slide',{direction:'up'},400,function(){
					padre.find('.chev-up').fadeIn()
				})
			})
			$('.chev-up').on('click',function(){
				var padre = $(this).parent()
				padre.find('.chev-up').fadeOut()
				padre.find('.childDiv').hide('slide',{direction:'up'},400,function(){
					padre.find('.chv-dw').fadeIn()
				})
			})*/
			$(".upload-image").change(imagenPreview)
			var d = new Date().getFullYear()
			let option = "<option value=0>--AÑO--</option>"
			option += "<option value="+d+">"+d+"</option>"
			option += "<option value="+(d-1)+">"+(d-1)+"</option>"
			option += "<option value="+(d-2)+">"+(d-2)+"</option>"
			option += "<option value="+(d-3)+">"+(d-3)+"</option>"
			option += "<option value="+(d-4)+">"+(d-4)+"</option>"
			option += "<option value="+(d-5)+">"+(d-5)+"</option>"
			$('#anho').html(option)
			$('.gotop').fadeOut(10)
			mensaje()
			comentarios(0,0,0,0)
			$('.nvc').on('click', function(){
			    $('.navbar-collapse').collapse('hide');
			})
			$('.type-button').on('click',function(){
				if ($(this).hasClass('bug')) {
					$('.type-button').removeClass('animated pulse')
					$('.type-button').removeClass('active')
					$(this).addClass('animated pulse')
					$(this).addClass('active')
				}
				if ($(this).hasClass('laptop')) {
					$('.type-button').removeClass('animated pulse')
					$('.type-button').removeClass('active')
					$(this).addClass('animated pulse')
					$(this).addClass('active')
				}
				if ($(this).hasClass('comment-dots')) {
					$('.type-button').removeClass('animated pulse')
					$('.type-button').removeClass('active')
					$(this).addClass('animated pulse')
					$(this).addClass('active')
				}
			})
			$('.let-small').on('click',function(){
				if ($(this).hasClass('n-desconectar')) {
					clearFields()
					Swal.fire({
					  title: 'Desconectar',
					  text: "Seguro que quiere desconectarse?",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  cancelButtonText: 'No',
					  confirmButtonText: 'Si'
					}).then((result) => {
					  if (result.value) {
					  $.post('desconectar.php',function(){window.location.href = "index.php"})	
					  }
					})
				}else {
					$(document).find('.let-small').removeClass('active')
					$(this).addClass('active')
					if ($(this).hasClass('n-avance')) {
						clearFields()
						$(document).find('.dimen-content').removeClass('active')
						$(document).find('.avance.dimen-content').addClass('active')
						mensaje()
						comentarios(0,0,0,0)
					}
					if($(this).hasClass('n-comentario')){
						$(document).find('.dimen-content').removeClass('active')
						$(document).find('.comentario.dimen-content').addClass('active')
					}
					if ($(this).hasClass('n-realizandose')) {
						clearFields()
						$(document).find('.dimen-content').removeClass('active')
						$(document).find('.realizandose.dimen-content').addClass('active')
						mensaje()
						comentarioRealizandose()
					}
				}
			})
			$(window).on('scroll',function(){
				if ($(this).scrollTop() > 40) {
					$('.gotop').fadeIn()
				}else {
					$('.gotop').fadeOut()
				}
			})
			$('.gotop').on('click',function(){
				$('html ,body').animate({scrollTop : 0},500)
			})
			$('.option').on('click',function(){
				if ($('#anho').val() != 0 && $('#mes').val() != 0) {
					mensaje()
					comentarios(1,$(this).val(),$('#mes').val(),$('#anho').val())
				}else {
					Swal.fire({
						title: 'Aviso',
						text: 'Debe seleccionar un mes y año',
						type: 'warning'
					})
				}
			})
			$('#guardar').on('click',function(){
				var titulo = $('.title-comment').val()
				var descrip = $('.descrip-comment').val()
				if (titulo == '' || descrip == '') {
					Swal.fire({
						title: 'Aviso',
						text: 'Complete los campos de titulo y descripcion',
						type: 'warning'
					})
				}else if (!$('.type-button').hasClass('active')){
					Swal.fire({
						title: 'Aviso',
						text: 'Debe indicar el tipo de comentario',
						type: 'warning'
					})
				}else {
					var tipo = $('.type-button.active').attr('value')
					var img = []
					$('.img-upload').each(function(i){
						img.push($(this).attr('src'))
					})
					$.post('guardarComentario.php',{titulo:titulo,comentario:descrip,tipo:tipo,imagenes:JSON.stringify(img)},function(e){
						if (e != '0') {
							switch(e){
								case '1':
								Swal.fire({
									title: 'Correcto',
									text: 'Comentario enviado correctamente',
									type: 'success'
								})
								clearFields()
								break
								case '2':
								Swal.fire({
									title: 'Aviso',
									text: 'No se pudo enviar el comentario',
									type: 'error'
								})
								break
							}
						}else {
							window.location.href = 'index.php'
						}
					})
				}
			})
		})
	function comentarioRealizandose(){
		$.post('obtenerComentAdmin.php',function(e){
			Swal.close()
			if (e != '0') {
				let item = ""
				var admin = 0
				if (e != "[[]]") {
					const json = JSON.parse(e)
					item += "<div class='order-title'>"
					item += "<span class='title' style='width: 100%;'>REALIZANDOSE</span>"
					item += "</div>"
					item += "<div class='content-div' style='margin-top: 10px;'>"
					for (let i = 0; i < json.length; i++) {
						if (admin == 0) {
							admin = json[i].admin
							item += "<div class='com-padre'>"
								item += "<div class='h-com rounded-top' style='display: flex;justify-content: space-between;background: darkmagenta;padding: 0px 5px;'>"
									item += "<span>"+json[i].nomadmin+"</span>"
									item += "<span class='chv-dw' style='display:none;'><i class='fas fa-chevron-circle-down'></i></span>"
								item += "</div>"
								item += "<div class='com-hijo' style='color:black;background: white;'>"
								/*comentario*/
								if (json[i].tipo == 1) {
									item += "<div class='comment border-suggest'>"
								}else if(json[i].tipo == 2) {
									item += "<div class='comment border-bug'>"
								}else {
									item += "<div class='comment border-app'>"
								}
									item += "<div class='alter-header-comment'>"
									item += "<span><i class='fas fa-calendar'></i> "+json[i].fecha+"</span>"
									item += "<span class='nom-tool' data-toggle='tooltip' title='COMENTARIO DE: "+json[i].nomusu+"'><i class='fas fa-user'></i> "+json[i].usuario+" <i class='fas fa-hashtag'></i> "+json[i].codcoment+"</span>"
									item += "</div>"
									item += "<div><span>"+json[i].titulo+"</span></div>"
									if (json[i].comentario.length > 134) {
										const first = json[i].comentario.substring(0,134)
										const last = json[i].comentario.substring(134)
										item += "<p class='parraf'>"+first+"<span class='dots active'>...</span><span class='rest'>"+last+"</span></p>"
									}else {
										item += "<p class='parraf'>"+json[i].comentario+"</p>"
									}
									item += "<div class='progress prog-cus'>"
										if (json[i].avance == 100 || json[i].avance < 100) {
											item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
										}else if (json[i].avance > 100 && json[i].avance < 125) {
											item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-warning' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
										}else if (json[i].avance >= 125) {
											item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
										}
									item += "</div>"
									item += "<div class='in-fin'>"
										item += "<span><i class='far fa-flag'></i> "+json[i].iniciado+"</span>"
										item += "<span><i class='fas fa-flag-checkered'></i> "+json[i].fecesti+"</span>"
									item += "</div>"
								item += "</div>"
								/*comentario*/
								if (i == (json.length-1)) {
									item += "</div>"
									item += "<div class='rounded-bottom div-bot'><span class='chv-up'><i class='fas fa-chevron-circle-up'></i></span></div>"
									item += "</div>"
								}
						}else if (admin == json[i].admin) {
							/*comentario*/
							if (json[i].tipo == 1) {
								item += "<div class='comment border-suggest'>"
							}else if(json[i].tipo == 2) {
								item += "<div class='comment border-bug'>"
							}else {
								item += "<div class='comment border-app'>"
							}
								item += "<div class='alter-header-comment'>"
								item += "<span><i class='fas fa-calendar'></i> "+json[i].fecha+"</span>"
								item += "<span class='nom-tool' data-toggle='tooltip' title='COMENTARIO DE: "+json[i].nomusu+"'><i class='fas fa-user'></i> "+json[i].usuario+" <i class='fas fa-hashtag'></i> "+json[i].codcoment+"</span>"
								item += "</div>"
								item += "<div><span>"+json[i].titulo+"</span></div>"
								if (json[i].comentario.length > 134) {
									const first = json[i].comentario.substring(0,134)
									const last = json[i].comentario.substring(134)
									item += "<p class='parraf'>"+first+"<span class='dots active'>...</span><span class='rest'>"+last+"</span></p>"
								}else {
									item += "<p class='parraf'>"+json[i].comentario+"</p>"
								}
								item += "<div class='progress prog-cus'>"
									if (json[i].avance == 100 || json[i].avance < 100) {
										item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
									}else if (json[i].avance > 100 && json[i].avance < 125) {
										item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-warning' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
									}else if (json[i].avance >= 125) {
										item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
									}
								item += "</div>"
								item += "<div class='in-fin'>"
									item += "<span><i class='far fa-flag'></i> "+json[i].iniciado+"</span>"
									item += "<span><i class='fas fa-flag-checkered'></i> "+json[i].fecesti+"</span>"
								item += "</div>"
							item += "</div>"
							/*comentario*/
							if (i == (json.length-1)) {
								item += "</div>"
								item += "<div class='rounded-bottom div-bot'><span class='chv-up'><i class='fas fa-chevron-circle-up'></i></span></div>"
								item += "</div>"
							}
						}else {
							item += "</div>"
							item += "<div class='div-bot'><span class='chv-up'><i class='fas fa-chevron-circle-up'></i></span></div>"
							item += "</div>"
							admin = json[i].admin
							item += "<div class='com-padre'>"
								item += "<div class='h-com rounded-top' style='display: flex;justify-content: space-between;background: darkmagenta;padding: 0px 5px;'>"
									item += "<span>"+json[i].nomadmin+"</span>"
									item += "<span class='chv-dw' style='display:none;'><i class='fas fa-chevron-circle-down'></i></span>"
								item += "</div>"
								item += "<div class='com-hijo' style='display:none;color:black;background: white;'>"
								/*comentario*/
								if (json[i].tipo == 1) {
									item += "<div class='comment border-suggest'>"
								}else if(json[i].tipo == 2) {
									item += "<div class='comment border-bug'>"
								}else {
									item += "<div class='comment border-app'>"
								}
									item += "<div class='alter-header-comment'>"
									item += "<span><i class='fas fa-calendar'></i> "+json[i].fecha+"</span>"
									item += "<span class='nom-tool' data-toggle='tooltip' title='COMENTARIO DE: "+json[i].nomusu+"'><i class='fas fa-user'></i> "+json[i].usuario+" <i class='fas fa-hashtag'></i> "+json[i].codcoment+"</span>"
									item += "</div>"
									item += "<div><span>"+json[i].titulo+"</span></div>"
									if (json[i].comentario.length > 134) {
										const first = json[i].comentario.substring(0,134)
										const last = json[i].comentario.substring(134)
										item += "<p class='parraf'>"+first+"<span class='dots active'>...</span><span class='rest'>"+last+"</span></p>"
									}else {
										item += "<p class='parraf'>"+json[i].comentario+"</p>"
									}
									item += "<div class='progress prog-cus'>"
										if (json[i].avance == 100 || json[i].avance < 100) {
											item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
										}else if (json[i].avance > 100 && json[i].avance < 125) {
											item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-warning' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
										}else if (json[i].avance >= 125) {
											item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
										}
									item += "</div>"
									item += "<div class='in-fin'>"
										item += "<span><i class='far fa-flag'></i> "+json[i].iniciado+"</span>"
										item += "<span><i class='fas fa-flag-checkered'></i> "+json[i].fecesti+"</span>"
									item += "</div>"
								item += "</div>"
								/*comentario*/
							if (i == (json.length-1)) {
								item += "</div>"
								item += "<div class='rounded-bottom div-bot'><span class='chv-up'><i class='fas fa-chevron-circle-up'></i></span></div>"
								item += "</div>"
							}
						}
					}
					item += "</div>"

					$('#adm-exe').html(item)
					$('.parraf').on('click',function(){
						if ($(this).children('.dots').hasClass('active')) {
							$(this).children('.dots').removeClass('active')
							$(this).children('.rest').addClass('active')
						}else {
							$(this).children('.rest').removeClass('active')
							$(this).children('.dots').addClass('active')
						}
					})
					$('.chv-dw').on('click',function(){
						var div = $(this).parent()
						var padre = div.parent()
						$(this).fadeOut()
						div.removeClass('rounded-sm')
						div.addClass('rounded-top')
						padre.find('.com-hijo').show('slide',{direction:'up'},400,function(){
							padre.find('.div-bot').fadeIn()
						})
					})
					$('.chv-up').on('click',function(){
						var div = $(this).parent()
						var padre = div.parent()
						padre.find('.div-bot').fadeOut()
						padre.find('.com-hijo').hide('slide',{direction:'up'},400,function(){
							padre.find('.chv-dw').fadeIn()
							padre.find('.h-com').removeClass('rounded-top')
							padre.find('.h-com').addClass('rounded-sm')
						})
					})
					$('.nom-tool').tooltip()
				}else {
					item += "<div class='empty-div'>"
					item += "<i class='far fa-comments fa-3x'></i>"
					item += "<span>Los administradores se encuentran libres</span>"
					item += "</div>"
				}
			}else {
				window.location.href = 'index.php'
			}
		})
	}
	function comentarios(comentario,opcion,month,year){
		$.post('obtenerComentarios.php',{comentario:comentario,opcion:opcion,mes:month,anho:year},function(e){
			Swal.close()
			if (e != '0') {
				let item = ""
				if (month == 0 && year == 0) {
					item += "<div class='order-title'>"
					item += "<span class='title title-l'>VIGENTES</span>"
					item += "<span id='finalizado' class='title title-r'>OTROS</span>"
					item += "</div>"
				}
				if (e != "[[]]") {
					const json = JSON.parse(e)
					item += "<div class='content-div'>"
					for (let i = 0; i < json.length; i++) {
						if (json[i].anulado == 1) {
							item += "<div class='comment border-anulado'>"
						}else {
							if (json[i].tipo == 1) {
								item += "<div class='comment border-suggest'>"
							}else if(json[i].tipo == 2) {
								item += "<div class='comment border-bug'>"
							}else {
								item += "<div class='comment border-app'>"
							}
						}
						item += "<div class='header-comment'>"
						item += "<span>"+json[i].fecha+"</span>"
						item += "<span>"+json[i].titulo+"</span>"
						item += "<div class='detalle' value='"+json[i].codcoment+"@"+json[i].fecha+"'><i class='fas fa-ellipsis-v fa-lg'></i></div>"
						item += "</div>"
						if (json[i].descrip.length > 134) {
							const first = json[i].descrip.substring(0,134)
							const last = json[i].descrip.substring(134)
							item += "<p class='parraf'>"+first+"<span class='dots active'>...</span><span class='rest'>"+last+"</span></p>"
						}else {
							item += "<p class='parraf'>"+json[i].descrip+"</p>"
						}
						if (json[i].estado != 'PENDIENTE') {
							item += "<div class='progress prog-cus'>"
							if (json[i].finalizado != 0) {
								if (json[i].avance == 100 || json[i].avance < 100) {
									item += "<div class='progress-bar bg-success' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
								}else if (json[i].avance > 100 && json[i].avance < 125) {
									item += "<div class='progress-bar bg-warning' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
								}else if (json[i].avance >= 125) {
									item += "<div class='progress-bar bg-danger' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
								}
							}else if (json[i].finalizado == 0) {
								if (json[i].avance == 100 || json[i].avance < 100) {
									item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
								}else if (json[i].avance > 100 && json[i].avance < 125) {
									item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-warning' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
								}else if (json[i].avance >= 125) {
									item += "<div class='progress-bar progress-bar-striped progress-bar-animated bg-danger' style='width: "+json[i].avance+"%'>"+json[i].avance+"%</div>"
								}
							}
							item += "</div>"
						}
						item += "<div class='footer-comment'>"
						item += "<span>"+json[i].estado+"</span>"
						item += "<span>N° "+json[i].codcoment+"</span>"
						item += "<span class='duration'>"+json[i].transcurrido+" días pasaron</span>"
						item += "</div>"
						item += "</div>"
					}
					item += "</div>"
				}else {
					item += "<div class='empty-div'>"
					item += "<i class='far fa-comments fa-3x'></i>"
					item += "<span>No tiene comentarios</span>"
					item += "</div>"
				}
				(month != 0 && year != 0) ? $('#coment-body').html(item) : $('#vigente').html(item)
				$('.parraf').on('click',function(){
					if ($(this).children('.dots').hasClass('active')) {
						$(this).children('.dots').removeClass('active')
						$(this).children('.rest').addClass('active')
					}else {
						$(this).children('.rest').removeClass('active')
						$(this).children('.dots').addClass('active')
					}
				})
				$('#finalizado').on('click',function(){
					$('#parametros').modal('show')
				})
				$('.detalle').on('click',function(){
					detalle($(this).attr('value'))
				})
				if (month != 0 && year != 0) {
					$('#anho')[0].selectedIndex = 0
					$('#mes')[0].selectedIndex = 0
					$('#comentarios').modal('show')
				}	
			}else {
				window.location.href = 'index.php'
			}
		})
	}
	function detalle(data){
		$.post('obtenerDetalle.php',{opcion:0,parametros:data},function(e){
			if (e != '0') {
				let item = ""
				const json = JSON.parse(e)
				item += "<div style='display: flex;flex-direction: column;margin: 0px 15px;font-weight: 100'>"
					item += "<div style='display: flex;justify-content: space-between;margin-bottom:5px;'>"
						item += "<span><i class='fas fa-hashtag'></i> "+json['codcoment']+"</span>"
						item += "<span><i class='fas fa-calendar-day'></i> "+json['fecha']+"</span>"
						item += "<span><i class='fas fa-clock'></i> "+json['hora']+"</span>"
					item += "</div>"
					item += "<div style='display: flex;justify-content: space-between;margin-bottom:5px;'>"
						item += "<span><i class='fas fa-comment-dots'></i> "+json['tipo']+"</span>"
						item += "<span style='background: crimson;color: white;padding: 0px 10px;'>"+json['estado']+"</span>"
					item += "</div>"
					if (json['admin'] != 0) {
						item += "<span style='text-align: center;padding: 3px;background: green;margin-top: 3px;color: white;'><i class='fas fa-user-circle'></i> ADMINISTRADOR</span>"
						item += "<span style='text-align: center;margin-bottom:5px;border-left: 1px solid green;border-right: 1px solid green;border-bottom: 1px solid green;'>"+json['nomadmin']+"</span>"
						if (json['fecanul'] == 0) {
							item += "<div style='display: flex;justify-content: space-between;margin-bottom:5px;'>"
								item += "<span>COMENTARIO REVISADO:</span>"
								item += "<span>"+json['revisado']+"</span>"
							item += "</div>"
						}else {
							item += "<div style='display: flex;justify-content: space-between;margin-bottom:5px;'>"
								item += "<span>COMENTARIO ANULADO:</span>"
								item += "<span>"+json['fecanul']+"</span>"
							item += "</div>"
						}
						if (json['desc_adm'] != null && json['desc_adm'] != '') {
							item += "<span>MENSAJE ADMIN:</span>"
							item += "<span style='border: 1px solid lightblue;padding: 5px;border-radius: 5px;'>"+json['desc_adm']+"</span>"
						}
						if (json['estimado'] != 0) {
							item += "<span style='margin-bottom:5px;'>TOMARA "+json['estimado']+" DIAS, APROXIMADO:</span>"
							item += "<div style='display: flex;justify-content: space-between;align-items: center;'>"
								item += "<span><i class='far fa-flag'></i> "+json['iniciado']+"</span>"
								item += "<i class='fas fa-angle-double-right'></i>"
								item += "<span><i class='fas fa-flag-checkered'></i> "+json['fecesti']+"</span>"
							item += "</div>"
						}
						if (json['finalizado'] != 0) {
							item += "<span style='width:100%;text-align: center;color: crimson;'>CONCLUIDO EL "+json['finalizado']+"</span>"
						}
					}
				item += "</div>"
				$('#detalle-title').html(json['titulo'])
				$('#detalle-body').html(item)
				$('#detalles').modal('show')
			}else {
				window.location.href = 'index.php'
			}
		})
	}
	function imagenPreview(e) {
	    var $input = $(this)
	    var inputFiles = this.files
	    if(inputFiles == undefined || inputFiles.length == 0) return
	    var inputFile = inputFiles[0]

	    var reader = new FileReader()
	    reader.onload = function(event) {
	    	let item = ""
	    	item += "<div class='content-upload'>"
	    	item += "<img class='img-upload' src='"+event.target.result+"'></img>"
	    	item += "<div class='btn-remove'><i class='fas fa-times'></i></div>"
	    	item += "</div>"
	    	$('.btimg-edit').before(item)
	    	$('.btn-remove').on('click',function(){
	    		$(this).closest('.content-upload').remove()
	    	})
	    }
	    reader.onerror = function(event) {
	        alert("Error: " + event.target.error.code)
	    }
	    reader.readAsDataURL(inputFile)
	}
	function clearFields(){
		$('.title-comment').val('')
		$('.descrip-comment').val('')
		$('.type-button').removeClass('active')
		$(document).find('.content-upload').remove()
	}
	function mensaje(){
		Swal.fire({
			title: 'Obteniendo comentarios...',
			allowEscapeKey: false,
			allowOutsideClick: false
		})
		Swal.showLoading()
	}
	</script>
	<style>
		.no-padding {
			padding-right: 0px !important;
			padding-left: 0px !important; 
		}
		body, button {
			font-family: 'Nunito', sans-serif !important;
			font-weight: 600 !important;
		}
		.dots.active,.rest.active {
			display: inline;
		}
		.dots,.rest {
			display: none;
		}
		.bg-white-radi {
			background-color: #ffffff !important;
			border-radius: 5px;
		}
		.ali-items {
			display: flex;
			align-items: center;
		}
		.padd {
			padding: 1rem 1rem 1rem 1rem;
		}
		.m8-l {
			margin-left: .8rem;
		}
		.m10-lr {
			margin-left: 1rem;
			margin-right: 1rem;
		}
		.dis-txt {
			display: grid;
		}
		.type-button {
			width: 100px;
			margin-left: 10px;
			margin-right: 10px;
		    background: #ffffff;
		    border-radius: 10px;
		    border: 1px solid gray;
		    text-align: center;
    		padding: 10px 5px 10px 5px;
		}
		.border-suggest {
			border: 3px solid #007bff;
		}
		.border-bug {
			border: 3px solid #dc3545;
		}
		.border-app {
			border: 3px solid #ff9f00;
		}
		.border-anulado {
			border: 3px solid #5803e0;
		}
		/*PRINCIPAL: #29a17b
		SECUNDARIO: #57c2a0*/
		.imagePreview {
		    width: 100%;
		    height: 180px;
		    background-position: center center;
		  background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
		  background-color:#fff;
		    background-size: cover;
		  background-repeat:no-repeat;
		    display: inline-block;
		  box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
		}
		.btn-primary
		{
		  display:block;
		  border-radius:0px;
		  box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
		  margin-top:-5px;
		}
		.imgUp
		{
		  margin-bottom:15px;
		}
		.del
		{
		  position:absolute;
		  top:0px;
		  right:15px;
		  width:30px;
		  height:30px;
		  text-align:center;
		  line-height:30px;
		  background-color:rgba(255,255,255,0.6);
		  cursor:pointer;
		}
		.imgAdd
		{
		  width:30px;
		  height:30px;
		  border-radius:50%;
		  background-color:#4bd7ef;
		  color:#fff;
		  box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
		  text-align:center;
		  line-height:30px;
		  margin-top:0px;
		  cursor:pointer;
		  font-size:15px;
		}
		.chip {
		  display: inline-block;
		  padding: 0 25px;
		  height: 50px;
		  font-size: 16px;
		  line-height: 50px;
		  border-radius: 25px;
		  background-color: #f1f1f1;
		}
		.chip i {
		  float: left;
		  margin: 0 10px 0 -25px;
		  height: 50px;
		  width: 50px;
		  border-radius: 50%;
		}

		.border-cus {
			border: unset;
			border-radius: unset;
			border-top-left-radius: 1rem;
    		border-top-right-radius: 1rem;
		}

		.bord-h-cus {
			background: #5803e0;
    		color: white;
    		padding: .5rem 1rem;
    		align-items: center;
			border: unset;
			border-top-left-radius: .5rem;
    		border-top-right-radius: .5rem;
		}

		/* Small devices (phones, 768px and down) */
		@media only screen and (max-width: 768px) {
			body {
				background: rgb(87,186,241);
			}
			ul {
				justify-content: space-between !important;
				align-items: center;
			}
			.div-bot {
				text-align: right;
				background: darkmagenta;
				margin-top: 10px;
				padding: 0px 5px;
			}
			.com-padre {
				color: white;
			    margin-bottom: 10px;
			}
			.navbar-brand {
			    font-size: .9rem;
			}
			.no-border {
				border-color: rgba(0,0,0,0) !important;
			}
			.d-sm {
				display: none;
			}
			.fa-rocket,.let-small.active {
				color: red;
			}
			.fa-bars {
				color: black;
			}
			.let-small {
				font-size: .7rem;
				display: grid; 
    			justify-items: center;
			}
			.btn:hover {
				color: white;
				outline:0px !important;
			    -webkit-appearance:none;
			    box-shadow: none !important;
			}
			.btn-cus {
				width: 100%;
			    margin: 20px 30px;
			    font-size: 1.6rem;
				background-color: #ff7458;
				color: white;
				border-width: 1px;
				border-radius: .5rem;
				border-color: rgba(0,0,0,0.2);
			}
			.btn-depth {
			    box-shadow: inset 0 1px 0 rgba(255,255,255,0.0125), 0 1px 1px rgba(0,0,0,0.05);
			    border-top-width: .0625rem;
			    border-bottom-width: calc(.2rem + .0625rem);
			    transition: all .5s ease;
			}
			.btn-depth:active {
				box-shadow: 0 1px 1px rgba(0,0,0,0.05), inset 0 1px 0 rgba(255,255,255,0.0125);
			    border-bottom-width: .0625rem;
			    border-top-width: calc(.2rem + .0625rem);
			}
			.dimen-nav {
				padding: 0rem 1rem;
				background: white;
			}
			.comment {
			    background: white;
			    font-size: .8rem;
			    border-radius: 5px;
			    box-shadow: 2px 2px 5px #b5b5b5;
			    margin-top: 20px;
			}
			.parraf {
				text-align: justify;
    			font-weight: 100;
    			margin: 5px 10px;
			}
			.duration {
				font-size: .7rem;
			    font-weight: 100;
			    color: gray;
			}
			.m5-tb {
				margin-top: .5rem;
				margin-bottom: .5rem;
			}
			.m20-tb {
				margin-top: 2rem;
    			margin-bottom: 2rem;
			}
			.dimen-content {
				padding: 1rem 1rem;
				transition: all .6s ease;
			}
			.dir-marg {
				flex-direction: row;
				margin-top: 10px;
				justify-content: center;
			}
			.laptop.active {
				color: #ffffff;
			    background: #ff9f00;
			    border: unset;
			}
			.bug.active {
				color: #ffffff;
			    background: #dc3545;
			    border: unset;
			}
			.comment-dots.active {
				color: #ffffff;
			    background: #007bff;
			    border: unset;
			}
			.content-upload {
				display: flex;
			    flex-direction: column;
			    justify-content: center;
			    align-items: center;
			    width: 120px;
				height: 200px;
    			margin: 10px 9px;
			    border: 1px solid black;
			}
			.img-upload {
				width: 120px;
				height: 170px;
				padding: 5px;
			}
			.btn-remove {
				width: 120px;
			    text-align: center;
			    background-color: #dc3545;
			    color: #ffffff;
			    font-size: 1.25rem;
			    border-top: 1px solid black;
			}
			.btimg-edit {
				display: flex;
			    align-items: center;
			    width: 120px;
			}
			.buton-img {
				margin-bottom: unset;
			    display: flex;
			    width: 100px;
			    margin: 10px 9px;
			    flex-direction: column;
			    text-align: center;
			    align-items: center;
			    border: 1px solid black;
    			border-radius: 5px;
			}
			.upload-image {
				width: 0px;
				height: 0px;
				overflow: hidden;
			}
			.grid-images {
				display: flex;
				flex-wrap: wrap;
			}
			.header-comment {
				display: flex;
			    justify-content: space-between;
			    margin: 5px 10px;
			    align-items: center;
			}
			.alter-header-comment {
				display: flex;
			    justify-content: space-between;
			    align-items: center;
			    color: white;
			    background: #2e8b8b;
			    padding: 5px 10px;
			    font-weight: 100 !important;
			}
			.footer-comment {
				display: flex;
			    justify-content: space-between;
			    margin: 5px 10px;
			    align-items: center;
			}
			.order-title {
				display: flex;
				padding: 10px 30px 0px 30px;
			}
			.user_type {
				font-size: .75rem;
			}
			.title {
				color: lightgray;
	    		border-bottom: 2px inset lightgray;
			}
			.title-l {
				width: 70%;
			}
			.title-r {
				width: 30%;
				color: red;
				text-align: end;
			}
			.empty-div {
				display: flex;
				height: 200px;
				margin: 10px 20px 0px 20px;
			    flex-direction: column;
			    text-align: center;
			    justify-content: center;
			    align-items: center;
			}
			.content-div {
				display: flex;
				margin: 0px 30px;
				padding-bottom: 20px;
			    flex-direction: column;
			    text-align: center;
			    justify-content: center;
			}
			.avance.active,.comentario.active,.realizandose.active {
				display: block;
			}
			.avance,.comentario,.realizandose {
				display: none;
			}
			.prog-cus {
				font-weight: 100;
    			margin: 0px 5px;
			}
			.gotop {
				position: fixed;
				bottom: 30px;
				right: 20px;
				width: 30px;
				height: 30px;
				background: #e74c3c;
				color: white;
				border: none;
				cursor: pointer;
				border-radius: 30px;
			}
			.m-content {
				margin: 0px 50px;
			}
			.m-body {
				display: flex;
			    padding: .5rem;
			    flex-direction: column; 
			}
			.modal-btn-cus {
				margin: 5px 10px;
    			font-size: .8rem;
			}
			.edit-estado {
				background: #c62be2;
			    color: white;
			    text-align: center;
			}
			.edit-content {
				display: flex;
    			flex-direction: column;
			}
			.edit-text {
				text-align: center;
    			border-bottom: 1px solid lightgray;
			}
			.edit-top {
				border: 3px solid #00b2ff;
			    border-radius: 5px;
			    margin-bottom: 10px;
			    padding: 5px;
			}
			.edit-bot {
				border: 3px solid #ff6500;
			    border-radius: 5px;
			    margin-top: 10px;
			    padding: 5px;
			}
			.prog-cus {
				font-weight: 100;
    			margin: 0px 5px;
			}
			.in-fin {
				display: flex;
			    margin: 2px 5px;
			    justify-content: space-between;
			}
		}

		/* Medium devices (landscape tablets, 768px and up) */
		@media only screen and (min-width: 768px) {
			.dimen {
				padding: 1.1rem 5rem 1.1rem 5rem;
			}
			.dimen-size {
			    margin-left: auto;
			    margin-right: auto;
			    max-width: 95.36743rem;
			}
		}

		/* Large devices (large laptops and desktops, 1200px and up) */
		@media only screen and (min-width: 1200px) {
			.dimen {
				padding: 1.1rem 5rem 1.1rem 5rem;
			}
			.dimen-size {
			    margin-left: auto;
			    margin-right: auto;
			    max-width: 95.36743rem;
			}
		}
	</style>
</body>
</html>