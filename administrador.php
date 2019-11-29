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
			if ($deco->tipo != 1) {
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
	<title>BAS - Administrador</title>
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
			      <li class="nav-item ali-items nvc">
			      	<div class="let-small n-disponible active">
			      		<i class="fas fa-inbox fa-2x"></i>
			      		<span>DISPONIBLES</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">DISPONIBLES</a>
			      </li>
			      <li class="nav-item ali-items nvc">
			      	<div class="let-small n-tomado">
			      		<i class="fas fa-chart-pie fa-2x"></i>
			      		<span>TOMADOS</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">TOMADOS</a>
			      </li>
			      <li class="nav-item ali-items nvc">
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
			      <li class="nav-item ali-items">
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
		<div class="disponible dimen dimen-content active">
			<div class="dimen-size bg-white-radi">
				<div class="order-title">
					<span class="title libre active" style="width: 50%;">LIBRES</span>
					<span class="title propio" style="width: 50%;text-align: end;">PROPIOS</span>
					<span class="title otros" style="text-align: end;color: black;"><i class="fas fa-chevron-circle-right"></i></span>
				</div>
				<div id="disponible"></div>
				<button class="gotop" ><i class="fas fa-arrow-up"></i></button>
			</div>
		</div>
		<div class="tomado dimen dimen-content">
			<div class="dimen-size bg-white-radi">
				<div class="order-title">
					<span id="fintom" style="width: 100%;border-bottom: 2px solid lightgray;">FINALIZADOS</span>
				</div>
				<div id="tomado"></div>
				<button class="gotop" ><i class="fas fa-arrow-up"></i></button>
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
						<div class="grid-items">
							<div class="btimg-edit">
								<label class="buton-img"><i class="fas fa-camera-retro fa-3x"></i><input type="file" class="upload-image" accept="image/x-png,image/gif,image/jpeg"><span>Seleccionar una foto</span></label>
							</div>
						</div>
					</div>
				    <div class="d-flex justify-content-center">
				    	<button id="guardar" type="button" class="btn btn-cus btn-depth" style="font-size: 1.6rem;">Enviar comentario</a>
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
	        <h5 class="modal-title">Seleccione la fecha</h5>
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
	        <h5 id="com-titulo" class="modal-title"></h5>
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
	        <h5 id="detalle-title" class="modal-title"></h5>
	        <i class="fas fa-times" data-dismiss="modal"></i>
	      </div>
	      <div id="detalle-body" class="modal-body">
	      </div>
	    </div>
	  </div>
	</div>
	<div id="misc" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content border-cus">
	      <div class="modal-header bord-h-cus" style="justify-content: flex-end;">
	        <i class="fas fa-times" data-dismiss="modal"></i>
	      </div>
	      <div class="modal-body">
	      	<div id="anul-coment" class="input-group">
	      		<textarea id="motivo" class="form-control" style="height: 180px;resize: none;" maxlength="255" placeholder="Motivo para anular..."></textarea>
	      		<div class="input-group-append">
					<button id="aceptar" type="button" class="btn btn-primary btn-sm">Aceptar</button>
				</div>
			</div>
	        <img id="preview" src="" style="width: 430px; height: 400px;">
	      </div>
	    </div>
	  </div>
	</div>
	<div id="opc-tom" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content border-cus m-content">
	      <div id="opc-head" class="modal-header bord-h-cus" style="font-weight: 100;justify-content: space-between;">
	      </div>
	      <div class="modal-body">
	      	<div class="form-group">
	      		<select class="form-control" style="text-align-last: center;" id="sele-opc">
		      		<option value="0">--ELIJA UNA OPCION--</option>
		      		<option value="2">EN PROCESO</option>
		      		<option value="3">FINALIZADO</option>
		      		<option value="4">INCLUIDO</option>
		      		<option value="5">CORREGIDO</option>
		      	</select>
	      	</div>
	      	<div id="opc-dias" style="display: flex;align-items: center;">
	      		<input id="dias" type="number" class="form-control numberParser" style="width: 20%;" placeholder="Dias" value="1" min="1" maxlength="4" />
	      		<span style="width: 80%;margin-left: 5px;font-size: .8rem"> DIAS NECESARIOS PARA CUMPLIR</span>
	      	</div>
	      	<div style="text-align-last: end;margin-top: 10px;">
	      		<button id="opc-btn" type="button" class="btn btn-success btn-sm">CONFIRMAR</button>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
	<input id="otros-opt" type="hidden" value="">
	<script>
		$(function() {
			$('#opc-dias').hide()
			$('.numberParser').on('focusout',function(){noCero($(this).val(),$(this))})
            $('.numberParser').on('keypress',function(evt){return soloNumeros(evt)})
			$('.otros').hide()
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
			comentarios(0,1,0,0)
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
			$('.title').on('click',function(){
				if (!$(this).hasClass('otros')) {
					mensaje()
					$('.title').removeClass('active')
					if ($(this).hasClass('libre')) {
						$('.title').css('width','50%')
						$('.otros').hide()
						$(this).addClass('active')
						comentarios(0,1,0,0)
					}
					if ($(this).hasClass('propio')) {
						$('.propio').css('width','45%')
						$('.otros').css('width','5%')
						$('.otros').show()
						$(this).addClass('active')
						comentarios(0,0,0,0)
					}
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
					if ($(this).hasClass('n-disponible')) {
						clearFields()
						$(document).find('.dimen-content').removeClass('active')
						$(document).find('.disponible.dimen-content').addClass('active')
					}
					if ($(this).hasClass('n-tomado')) {
						clearFields()
						$(document).find('.dimen-content').removeClass('active')
						$(document).find('.tomado.dimen-content').addClass('active')
						mensaje()
						comentariosTomados(0,2,0,0)
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
					if ($('#otros-opt').val() == 0) {
						comentarios(1,$(this).val(),$('#mes').val(),$('#anho').val())
					}else {
						var opcion = 2
						if ($(this).val() == 1) {
							opcion = 3
						}
						comentariosTomados(1,opcion,$('#mes').val(),$('#anho').val())
					}
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
			$('.otros').on('click',function(){
				$('#otros-opt').val(0)
				$('#parametros').modal('show')
			})
			$('#fintom').on('click',function(){
				$('#otros-opt').val(1)
				$('#parametros').modal('show')
			})
			$('#aceptar').on('click',function(){
				var p = $(this).val().split('@')
				if (!$.trim($("#motivo").val())) {
					Swal.fire('Advertencia','Debe ingresar el motivo por el cual anula el comentario','warning')
				}else {
					anular(p[0],p[1],$('#motivo').val())
				}
			})
			$('#sele-opc').change(function(){
		        var estado = $(this).children("option:selected").val()
		        if (estado == 2) {
		        	$('#opc-dias').show()
		        }else {
		        	$('#opc-dias').hide()
		        }
		    })
			$('#opc-btn').on('click',function(){
				var estado = $('#sele-opc').children("option:selected").val()
				if (estado == 0) {
					Swal.fire('Advertencia','Debe seleccionar un estado para proceder','warning')
				}else {
					var dias = 0
					if (estado == 2) {
						dias = $('#dias').val()
					}
					actualizarEstado($(this).val(),dias,estado)
				}
			})
		})
	function soloNumeros(evt){
        var x = evt.which || evt.keyCode
        if(x >= 43 && x <= 46){
            return false
        }else{
            return true
        }
    }
    function noCero(valor,boton){
        if (valor.length == 0) {
            boton.val(1)
        }else if (valor == 0) {
            boton.val(1)
        }
    }
    function actualizarEstado(data,dias,estado){
    	var p = data.split("@")
    	$.post('controlComentarios.php',{opcion:2,usuario:p[2],comentario:p[0],dias:dias,estado:estado},function(e){
    		if (e != 0) {
				if (e == 'error') {
					Swal.fire({
						title: 'Error',
						text: 'Ocurrio un problema al modificar el estado del comentario',
						type: 'error'
					})
				}else {
					Swal.fire({
						title: 'Correcto',
						text: 'Estado del comentario modificado',
						type: 'success'
					})
					$('.modal').modal('hide')
					$('#motivo').val('')
					mensaje()
					comentariosTomados(0,2,0,0)
				}
			}else {
				window.location.href = 'index.php'
			}
    	})
    }
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
						if ($('.libre').hasClass('active')) {
							item += "<div class='alter-header-comment'>"
							item += "<span><i class='fas fa-calendar'></i> "+json[i].fecha+"</span>"
							item += "<span class='nom-tool' data-toggle='tooltip' title='COMENTARIO DE: "+json[i].nomusu+"'><i class='fas fa-user'></i> "+json[i].usuario+" <i class='fas fa-hashtag'></i> "+json[i].codcoment+"</span>"
							item += "</div>"
							item += "<div><span>"+json[i].titulo+"</span></div>"
						}else {
							item += "<div class='header-comment'>"
							item += "<span>"+json[i].fecha+"</span>"
							item += "<span>"+json[i].titulo+"</span>"
							item += "<div class='detalle' value='"+json[i].codcoment+"@"+json[i].fecha+"'><i class='fas fa-ellipsis-v fa-lg'></i></div>"
							item += "</div>"
						}
						if (json[i].descrip.length > 134) {
							const first = json[i].descrip.substring(0,134)
							const last = json[i].descrip.substring(134)
							item += "<p class='parraf'>"+first+"<span class='dots active'>...</span><span class='rest'>"+last+"</span></p>"
						}else {
							item += "<p class='parraf'>"+json[i].descrip+"</p>"
						}
						if ($('.propio').hasClass('active')) {
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
						}else {
							item += "<div class='footer-comment' style='justify-content: flex-end;'>"
							item += "<button type='button' class='btn btn-danger btn-sm act-det' value='"+json[i].codcoment+"@"+json[i].fecha+"@"+json[i].usuario+"'><i class='fas fa-clipboard-list'></i> DETALLE</button>"
							item += "</div>"
						}
						item += "</div>"
					}
					item += "</div>"
				}else {
					item += "<div class='empty-div'>"
					item += "<i class='far fa-comments fa-3x'></i>"
					item += "<span>No tiene comentarios</span>"
					item += "</div>"
				}
				(month != 0 && year != 0) ? $('#coment-body').html(item) : $('#disponible').html(item)
				
				$('.parraf').on('click',function(){
					if ($(this).children('.dots').hasClass('active')) {
						$(this).children('.dots').removeClass('active')
						$(this).children('.rest').addClass('active')
					}else {
						$(this).children('.rest').removeClass('active')
						$(this).children('.dots').addClass('active')
					}
				})
				$('.nom-tool').tooltip()
				$('.detalle').on('click',function(){
					detalle($(this).attr('value'))
				})
				$('.act-det').on('click',function(){
					detalleTomar($(this).val(),0)
				})
				if (month != 0 && year != 0) {
					$('#com-titulo').text('Comentarios anteriores')
					$('#anho')[0].selectedIndex = 0
					$('#mes')[0].selectedIndex = 0
					$('#comentarios').modal('show')
				}
			}else {
				window.location.href = 'index.php'
			}
		})
	}
	function comentariosTomados(comentario,opcion,month,year){
		$.post('obtenerComentarios.php',{comentario:comentario,opcion:opcion,mes:month,anho:year},function(e){
			Swal.close()
			if (e != '0') {
				let item = ""
				if (e != "[[]]") {
					const json = JSON.parse(e)
					item += "<div class='content-div'>"
					for (let i = 0; i < json.length; i++) {
						if (json[i].anulado == 1) {
							item += "<div class='comment border-anulado'>"
						}else {
							if (json[i].tipo == 1) {
								item += "<div class='comment border-suggest' style='display:flex;'>"
							}else if(json[i].tipo == 2) {
								item += "<div class='comment border-bug' style='display:flex;'>"
							}else {
								item += "<div class='comment border-app' style='display:flex;'>"
							}
						}
						item += "<div style='flex-grow:1;display: flex;flex-direction: column;'>"
							item += "<div class='alter-header-comment'>"
							item += "<span><i class='fas fa-calendar'></i> "+json[i].fecha+"</span>"
							item += "<span class='nom-tool' data-toggle='tooltip' title='COMENTARIO DE: "+json[i].nomusu+"'><i class='fas fa-user'></i> "+json[i].usuario+" <i class='fas fa-hashtag'></i> "+json[i].codcoment+"</span>"
							item += "</div>"
							item += "<div><span>"+json[i].titulo+"</span></div>"
							if (json[i].descrip.length > 134) {
								const first = json[i].descrip.substring(0,134)
								item += "<p class='parraf'>"+first+"...</p>"
							}else {
								item += "<p class='parraf' style='flex-grow:1;'>"+json[i].descrip+"</p>"
							}
							if (json[i].estado != 'REVISADO') {
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
							}
							item += "<div><div class='duration'>"+json[i].transcurrido+" días transcurridos desde que se genero</div></div>"
						item += "</div>"
						item += "<div style='display: flex;flex-direction: column;'>"
							item += "<button type='button' class='btn btn-danger btn-apilado' value='"+json[i].usuario+"@"+json[i].codcoment+"'><i class='fas fa-trash-alt'></i></button>"
							item += "<button type='button' class='btn btn-primary btn-apilado' value='"+json[i].codcoment+"@"+json[i].fecha+"@"+json[i].usuario+"'><i class='fas fa-address-card'></i></button>"
							item += "<button type='button' class='btn btn-success btn-apilado' value='"+json[i].codcoment+"@"+json[i].fecha+"@"+json[i].usuario+"'><i class='fas fa-cogs'></i></button>"
						item +="</div>"
						item += "</div>"
					}
					item += "</div>"
				}else {
					item += "<div class='empty-div'>"
					item += "<i class='far fa-comments fa-3x'></i>"
					item += "<span>No tiene comentarios</span>"
					item += "</div>"
				}

				(month != 0 && year != 0) ? $('#coment-body').html(item) : $('#tomado').html(item)

				$('.nom-tool').tooltip()
				$('.opciones').hide()
				$('.btn-apilado').on('click',function(){
					var img = $(this).children()
					if (img.hasClass('fa-trash-alt')) {
						$('#preview').hide()
						$('#anul-coment').show()
						$('#misc').modal('show')
						$('#aceptar').prop('value',$(this).val())
					}else if (img.hasClass('fa-address-card')){
						detalleTomar($(this).val(),1)
					}else {
						let item = "<span>"+$(this).val().split("@")[1]+"</span>"
						item += "<span><i class='fas fa-hashtag'></i> "+$(this).val().split("@")[0]+"</span>"
						item += "<i class='fas fa-times' data-dismiss='modal'></i>"
						$('#opc-head').html(item)
						$('#sele-opc')[0].selectedIndex = 0
						$('#opc-dias').hide()
						$('#opc-btn').prop('value',$(this).val())
						$('#opc-tom').modal('show')
					}
				})
				
				if (month != 0 && year != 0) {
					$('#com-titulo').text('Comentarios concluidos')
					$('#anho')[0].selectedIndex = 0
					$('#mes')[0].selectedIndex = 0
					$('#comentarios').modal('show')
				}
			}else {
				window.location.href = 'index.php'
			}
		})
	}
	function detalleTomar(data,tipo){
		$.post('obtenerDetalle.php',{opcion:1,parametros:data},function(e){
			console.log(e)
			if (e != '0') {
				let item = ""
				const json = JSON.parse(e)
				const img = json['imagenes']
				item += "<div style='margin-bottom: 10px;'>"
				item += "<div class='detail-content'>"
				item += "<span>"+json['usuario']+" - "+json['nomusu']+"</span>"
				item += "</div>"
				item += "<div class='detail-content'>"
				item += "<span>Nº "+json['codcoment']+"</span>"
				item += "<span><i class='fas fa-calendar-day'></i> "+json['fecha']+"</span>"
				item += "<span><i class='far fa-clock'></i> "+json['hora']+"</span>"
				item += "</div>"
				item += "<div class='detail-content cus-content' style='margin-left: 0px;margin-right: 0px;'>"
				item += "<span style='text-align: justify;'>"+json['comentario']+"</span>"
				item += "</div>"
				item += "</div>"
				if (img.length > 0) {
					item += "<div class='grid-items' style='justify-content: center;'>"
					for(var i=0; i<img.length; i++){
						item += "<img class='img-prev' src='"+img[i]+"'></img>"
					}
					item += "</div>"
				}
				if (tipo == 0) {
					item += "<div class='grid-items' style='justify-content:space-around;margin-top:20px;'>"
					item += "<button id='anular' type='button' class='btn btn-danger btn-sm'><i class='fas fa-ban'></i> ANULAR</button>"
					item += "<button id='tomar' type='button' class='btn btn-info btn-sm'><i class='fas fa-plus-circle'></i> TOMAR</button>"
					item += "</div>"
				}
				$('#detalle-title').html(json['titulo'])
				$('#detalle-body').html(item)
				$('#detalles').modal('show')
				$('.img-prev').on('click',function(){
					$('#anul-coment').hide()
					$('#preview').show()
					$('#preview').attr('src', $(this).attr('src'));
   					$('#misc').modal('show');
				})
				$('#anular').on('click',function(){
					$('#preview').hide()
					$('#anul-coment').show()
					$('#misc').modal('show')
					$('#aceptar').prop('value',json['usuario']+'@'+json['codcoment'])
				})
				$('#tomar').on('click',function(){
					tomar(json['usuario'],json['codcoment'])
				})
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
	function anular(usuario,codcoment,motivo){
		$.post('controlComentarios.php',{opcion:0,usuario:usuario,comentario:codcoment,motivo:motivo},function(e){
			if (e != 0) {
				if (e == 'error') {
					Swal.fire({
						title: 'Error',
						text: 'Ocurrio un problema al anular el comentario',
						type: 'error'
					})
				}else {
					Swal.fire({
						title: 'Correcto',
						text: 'Se anulo correctamente el comentario',
						type: 'success'
					})
					$('.modal').modal('hide')
					$('#motivo').val('')
					mensaje()
					comentarios(0,1,0,0)
				}
			}else {
				window.location.href = 'index.php'
			}
		})
	}
	function tomar(usuario,codcoment){
		$.post('controlComentarios.php',{opcion:1,usuario:usuario,comentario:codcoment},function(e){
			if (e != 0) {
				if (e == 'error') {
					Swal.fire({
						title: 'Error',
						text: 'Ocurrio un problema al tomar el comentario',
						type: 'error'
					})
				}else {
					Swal.fire({
						title: 'Correcto',
						text: 'Comentario tomado',
						type: 'success'
					})
					$('.modal').modal('hide')
					$('#motivo').val('')
					mensaje()
					comentarios(0,1,0,0)
				}
			}else {
				window.location.href = 'index.php'
			}
		})
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
		/*.btn-primary
		{
		  display:block;
		  border-radius:0px;
		  box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
		  margin-top:-5px;
		}*/
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
			.modal-body {
				font-weight: 100 !important;
			}
			.modal-title {
				display: contents;
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
			.img-prev {
				width: 100px;
				height: 100px;
				padding: 5px;
				margin: 0px 5px;
				border: 1px solid lightgray;
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
			.grid-items {
				display: flex;
				flex-wrap: wrap;
				justify-content: space-between;
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
			.alter-footer-comment {
				display: flex;
			    justify-content: flex-end;
			    padding: 5px;
			    border-top: 1px solid lightgray;
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
			.title.active {
				color: black;
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
			.disponible.active,.tomado.active,.comentario.active,.realizandose.active {
				display: block;
			}
			.disponible,.tomado,.comentario,.realizandose {
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
			.detail-content {
				display: flex;
				justify-content: space-between;
				margin: 5px;
			}
			.cus-content {
				border: 1px solid lightgray;
			    padding: 5px;
			    border-radius: 5px;
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
			.in-fin {
				display: flex;
			    margin: 2px 5px;
			    justify-content: space-between;
			}
			.btn-apilado {
				flex-grow:1;
				border-radius:unset;
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