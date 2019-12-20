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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.6.1/js/all.js" integrity="sha384-R5JkiUweZpJjELPWqttAYmYM1P3SNEJRM6ecTQF05pFFtxmCO+Y1CiUhvuDzgSVZ" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="resources/styles/contenido.css">
</head>
<body>
	<div class="container container-fluid no-padding body-lg">
		<div class="dimen dimen-nav">
			<nav class="navbar navbar-expand-lg navbar-light dimen-size">
				<a class="navbar-brand" href="#">
					<div class="ali-items">
						<i class="fas fa-rocket fa-2x"></i>
						<div class="dis-txt">
							<span class="m8-l"><?php echo $deco->usuario; ?></span>
							<span class="m8-l user-type"><?php echo $deco->tipo_desc; ?></span>
						</div>
					</div>
				</a>
			  <button class="navbar-toggler no-border" type="button" data-toggle="collapse" data-target="#navbarMobile">
			  	<i class="fas fa-bars fa-lg icon-default"></i>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarMobile">
			    <ul class="navbar-nav mr-auto dir-marg">
			      <li class="nav-item ali-items nvc">
			      	<div class="nd-md-lg let-small dis-smallest n-disponible active">
			      		<i class="fas fa-inbox fa-2x"></i>
			      		<span class="ml-10">DISPONIBLE</span>
			      	</div>
			      	<a class="nd-sm opt-link n-disponible active" href="#">
			      		<div class="let-large fs8">
			      			<i class="fas fa-inbox fa-2x"></i>
			      			<span>DISPONIBLE</span>
			      		</div>
			      	</a>
			      </li>
			      <li class="nav-item ali-items nvc">
			      	<div class="nd-md-lg let-small dis-smallest n-tomado">
			      		<i class="fas fa-chart-pie fa-2x"></i>
			      		<span class="ml-10">TOMADO</span>
			      	</div>
			      	<a class="nd-sm opt-link n-tomado" href="#">
			      		<div class="let-large fs8">
			      			<i class="fas fa-chart-pie fa-2x"></i>
			      			<span>TOMADO</span>
			      		</div>
			      	</a>
			      </li>
			      <li class="nav-item ali-items nvc">
			      	<div class="nd-md-lg let-small dis-smallest n-comentario">
			      		<i class="far fa-comment-alt fa-2x"></i>
			      		<span class="ml-10">COMENTARIO</span>
			      	</div>
			      	<a class="nd-sm opt-link n-comentario" href="#">
			      		<div class="let-large fs8">
			      			<i class="far fa-comment-alt fa-2x"></i>
			      			<span>COMENTARIO</span>
			      		</div>
			      	</a>
			      </li>
			      <li class="nav-item ali-items nvc">
			      	<div class="nd-md-lg let-small dis-smallest n-realizandose">
			      		<i class="fas fa-glasses fa-2x"></i>
			      		<span class="ml-10">EN PROCESO</span>
			      	</div>
			      	<a class="nd-sm opt-link n-realizandose" href="#">
			      		<div class="let-large fs8">
			      			<i class="fas fa-glasses fa-2x"></i>
			      			<span>EN PROCESO</span>
			      		</div>
			      	</a>
			      </li>
			      <li class="nav-item ali-items">
			      	<div class="nd-md-lg let-small dis-smallest n-desconectar">
			      		<i class="fas fa-power-off fa-2x"></i>
			      		<span class="ml-10">SALIR</span>
			      	</div>
			        <a class="nd-sm opt-link n-desconectar" href="#">
			      		<div class="let-large fs8">
			      			<i class="fas fa-power-off fa-2x"></i>
			      			<span>SALIR</span>
			      		</div>
			      	</a>
			      </li>
			    </ul>
			  </div>
			</nav>
		</div>
		<div class="disponible dimen dimen-content active">
			<div class="dimen-size bg-white-radi d-flex-lg">
				<div class="order-title">
					<span class="title libre active">LIBRES</span>
					<span class="title propio">PROPIOS</span>
					<span class="title otros">OTROS</span>
				</div>
				<div id="disponible" class="lg-empty"></div>
				<button class="gotop" ><i class="fas fa-arrow-up"></i></button>
			</div>
		</div>
		<div class="tomado dimen dimen-content">
			<div class="dimen-size bg-white-radi d-flex-lg">
				<div class="order-title">
					<span class="title tomados active">TOMADOS</span>
					<span class="title finalizados">OTROS</span>
				</div>
				<div id="tomado" class="lg-empty"></div>
				<button class="gotop" ><i class="fas fa-arrow-up"></i></button>
			</div>
		</div>
		<div class="comentario dimen dimen-content">
			<div class="dimen-size bg-white-radi">
				<div class="padd">
					<h1 class="title-smallest">Comentario</h1>
					<div class="m5-tb">
						<label class="n-mrb">Titulo</label>
					    <input id="title-com" type="text" class="form-control form-field" placeholder="Titulo del comentario">
					</div>
					<div class="m5-tb">
						<label class="n-mrb">Descripcion</label>
				    	<textarea id="descrip-com" class="form-control form-field" placeholder="Describa su comentario brevemente..."></textarea>
					</div>
					<div class="form-group m5-tb">
						<label class="n-mrb">Seleccione aplicacion</label>
			      		<select id="app-com" class="form-control" style="text-align-last: center;">
			      			<option value="0">--APLICACION ASOCIADA--</option>
			      			<option value="1">CUBOS</option>
			      			<option value="2">PEDIMAP VENTAS</option>
			      			<option value="3">PEDIMAP TRANSPORTE</option>
			      			<option value="4">CONCAR</option>
			      			<option value="5">INTELSOFT</option>
			      			<option value="6">CHESS</option>
			      			<option value="7">KVENTAS</option>
			      			<option value="8">KTRANSPORTE</option>
			      			<option value="9">MANTENIMIENTO</option>
			      			<option value="10">CATALOGO</option>
			      			<option value="11">IWOT</option>
			      			<option value="12">BAS</option>
			      			<option value="13">OTROS</option>
			      		</select>
			      	</div>
					<div class="m5-tb">
						<label class="n-mrb">Tipo comentario</label>
					    <div class="d-flex justify-content-center">
					    	<div class="type-button comment-dots" style="display: flex;align-items: center;" value='1'>
					    		<div>
					    			<i class="far fa-comment-dots fa-2x"></i>
					    			<span>Sugerencia</span>
					    		</div>
					    	</div>
					    	<div class="type-button bug" style="display: flex;align-items: center;" value='2'>
					    		<div>
					    			<i class="fas fa-bug fa-2x"></i>
					    			<span style="font-size: .8rem;">Problemas u Observaciones</span>
					    		</div>
					    	</div>
					    	<div class="type-button laptop" style="display: flex;align-items: center;" value='3'>
					    		<div>
					    			<i class="fas fa-laptop-code fa-2x"></i>
					    			<span>Peticion</span>
					    		</div>
					    	</div>
					    </div>
					</div>
					<div class="m5-tb">
						<label class="n-mrb">Foto (opcional)</label>
						<div class="grid-images">
							<div class="btimg-edit">
								<label class="buton-img"><i class="fas fa-camera-retro fa-3x"></i><input type="file" class="upload-image" accept="image/x-png,image/gif,image/jpeg"><span>Seleccionar una foto</span></label>
							</div>
						</div>
					</div>
				    <div class="d-flex justify-content-center sc-lg">
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
	        <h5 class="modal-title m-title-smallest">Seleccione la fecha</h5>
	        <i class="fas fa-times fa-lg" data-dismiss="modal"></i>
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
	<div id="detalles" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content border-cus m-content txt-smallest">
	      <div class="modal-header bord-h-cus">
	        <h5 id="detalle-title" class="modal-title m-title-smallest"></h5>
	        <i class="fas fa-times fa-lg" data-dismiss="modal"></i>
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
	        <i class="fas fa-times fa-lg" data-dismiss="modal"></i>
	      </div>
	      <div class="modal-body">
	      	<div id="anul-coment" class="input-group">
	      		<textarea id="motivo" class="form-control" style="height: 180px;resize: none;" maxlength="255" placeholder="Motivo para anular..."></textarea>
	      		<div class="input-group-append">
					<button id="aceptar" type="button" class="btn btn-primary btn-sm">Aceptar</button>
				</div>
			</div>
	        <img id="preview" src="" class="preview-photo">
	      </div>
	    </div>
	  </div>
	</div>
	<div id="opc-tom" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content border-cus m-content">
	      <div id="opc-head" class="modal-header bord-h-cus" style="font-weight: 100;justify-content: space-between;">
	      	<i class="fas fa-times fa-lg" data-dismiss="modal"></i>
	      </div>
	      <div class="modal-body">
	      	<div class="form-group">
	      		<select class="form-control" style="text-align-last: center;" id="sele-opc">
		      		<!--option value="0">--ELIJA UNA OPCION--</option>
		      		<option value="2">EN PROCESO</option>
		      		<option value="3">FINALIZADO</option>
		      		<option value="4">INCLUIDO</option>
		      		<option value="5">CORREGIDO</option-->
		      	</select>
	      	</div>
	      	<textarea id="opc-coment" class="form-control" style="height: 100px;resize: none;" maxlength="255" placeholder="Comentario opcional..."></textarea>
	      	<div id="opc-estimado" class="form-group">
                <label>Fecha final estimada</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                    </div>
                    <input type='text' class="form-control" id="estimado" readonly="readonly"/>
                </div>
            </div>
	      	<div style="text-align-last: end;margin-top: 10px;">
	      		<button id="opc-btn" type="button" class="btn btn-success btn-sm">CONFIRMAR</button>
	      	</div>
	      </div>
	    </div>
	  </div>
	</div>
	<input id="otros-opt" type="hidden" value="">
	<input id="tomar-opt" type="hidden" value="">
	<script>
		$(function() {
			$('.modal').on('shown.bs.modal',function(e){
				var id = $(this).attr('id')
				if ( id != 'misc') {
					var height = $(this).find('.modal-content').height()
					if ( height < 650 ) {
						$(this).addClass('h-aut')
					}else {
						$(this).removeClass('h-aut')
					}
				}
				if (id == 'opc-tom') {
					let option = "<option value=0>--ELIJA UNA OPCION--</option>"
					var opc = $('#tomar-opt').val()
					if (opc < 2) {
						option += "<option value=2>EN PROCESO</option>"
						option += "<option value=3>FINALIZADO</option>"
						option += "<option value=4>INCLUIDO</option>"
						option += "<option value=5>CORREGIDO</option>"	
					}else if (opc == 2) {
						option += "<option value=3>FINALIZADO</option>"
						option += "<option value=4>INCLUIDO</option>"
						option += "<option value=5>CORREGIDO</option>"
					}
					$('#sele-opc').html(option)
				}
			})
			$.datepicker.regional['es'] = {
                 closeText: 'Cerrar',
                 prevText: '< Ant',
                 nextText: 'Sig >',
                 currentText: 'Hoy',
                 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                 dayNamesMin: ['D','L','M','X','J','V','S'],
                 weekHeader: 'Sm',
                 dateFormat: 'yy-mm-dd',
                 numberOfMonths: 1,
                 changeMonth: true
                 }
            $.datepicker.setDefaults($.datepicker.regional['es'])
            $('#estimado').datepicker().datepicker('setDate', 'today')
			$('#opc-estimado').hide()
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
				if (!$(this).hasClass('otros') && !$(this).hasClass('finalizados')) {
					mensaje()
					$('.title').removeClass('active')
					if ($(this).hasClass('libre')) {
						$('.otros').hide()
						$(this).addClass('active')
						comentarios(0,1,0,0)
					}
					if ($(this).hasClass('propio')) {
						$('.otros').show()
						$(this).addClass('active')
						comentarios(0,0,0,0)
					}
					if ($(this).hasClass('tomados')) {
						$(this).addClass('active')
						comentariosTomados(0,2,0,0)
					}
				}
			})
			$('.let-small').on('click',function(){
				if ($(this).hasClass('n-desconectar')) {
					clearFields()
					Swal.fire({
					  title: 'Salir',
					  text: "Seguro que quiere salir de la aplicación?",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  cancelButtonText: 'No',
					  confirmButtonText: 'Si'
					}).then((result) => {
						if (result.value) {
							$.post('desconectar.php',function(e){
						  		if (e == 0) {
						  			Swal.fire('Error','Ocurrio un error durante el proceso','error')
						  		}else {
						  			window.location.href = "index.php"
						  		}
						  	})
						}
					})
				}else {
					$('.let-small').removeClass('active')
					$(this).addClass('active')
					if ($(this).hasClass('n-disponible')) {
						clearFields()
						$('.title').removeClass('active')
						$('.dimen-content').removeClass('active')
						$('.disponible.dimen-content').addClass('active')
						$('.otros').hide()
						$('.title.libre').addClass('active')
						mensaje()
						comentarios(0,1,0,0)
					}
					if ($(this).hasClass('n-tomado')) {
						clearFields()
						$('.title').removeClass('active')
						$('.dimen-content').removeClass('active')
						$('.tomado.dimen-content').addClass('active')
						$('.title.tomados').addClass('active')
						mensaje()
						comentariosTomados(0,2,0,0)
					}
					if($(this).hasClass('n-comentario')){
						$('.dimen-content').removeClass('active')
						$('.comentario.dimen-content').addClass('active')
					}
					if ($(this).hasClass('n-realizandose')) {
						clearFields()
						$('.dimen-content').removeClass('active')
						$('.realizandose.dimen-content').addClass('active')
						mensaje()
						comentarioRealizandose()
					}
				}
			})
			$('.opt-link').on('click',function(){
				if ($(this).hasClass('n-desconectar')) {
					clearFields()
					Swal.fire({
					  title: 'Salir',
					  text: "Seguro que quiere salir de la aplicación?",
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
					$('.opt-link').removeClass('active')
					$(this).addClass('active')
					if ($(this).hasClass('n-disponible')) {
						clearFields()
						$('.title').removeClass('active')
						$('.dimen-content').removeClass('active')
						$('.disponible.dimen-content').addClass('active')
						$('.title.libre').addClass('active')
						mensaje()
						comentarios(0,1,0,0)
					}
					if ($(this).hasClass('n-tomado')) {
						clearFields()
						$('.title').removeClass('active')
						$('.dimen-content').removeClass('active')
						$('.tomado.dimen-content').addClass('active')
						$('.title.tomados').addClass('active')
						mensaje()
						comentariosTomados(0,2,0,0)
					}
					if($(this).hasClass('n-comentario')){
						$('.dimen-content').removeClass('active')
						$('.comentario.dimen-content').addClass('active')
					}
					if ($(this).hasClass('n-realizandose')) {
						clearFields()
						$('.dimen-content').removeClass('active')
						$('.realizandose.dimen-content').addClass('active')
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
				var titulo = $('#title-com').val()
				var descrip = $('#descrip-com').val()
				var app = $('#app-com').val()
				if (titulo == '' || descrip == '') {
					Swal.fire({
						title: 'Aviso',
						text: 'Complete los campos de titulo y descripcion',
						type: 'warning'
					})
				}else if (!$('.type-button').hasClass('active')){
					Swal.fire({
						title: 'Aviso',
						text: 'Indique el tipo de comentario',
						type: 'warning'
					})
				}else if (app == 0){
					Swal.fire({
						title: 'Aviso',
						text: 'Indique la aplicacion asociada',
						type: 'warning'
					})
				}else {
					var tipo = $('.type-button.active').attr('value')
					var img = []
					$('.img-upload').each(function(i){
						img.push($(this).attr('src'))
					})
					guardarComentario(0,titulo,descrip,app,tipo,JSON.stringify(img),0,'')
				}
			})
			$('.otros').on('click',function(){
				$('#otros-opt').val(0)
				$('#parametros').modal('show')
			})
			$('.finalizados').on('click',function(){
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
		        if (estado == 0) {
		        	$('#opc-estimado').hide()
		        	$('#opc-coment').hide()
		        }else if (estado == 2) {
		        	$('#opc-estimado').show()
		        	$('#opc-coment').hide()
		        }else {
		        	$('#opc-estimado').hide()
		        	$('#opc-coment').show()
		        }
		    })
			$('#opc-btn').on('click',function(){
				var estado = $('#sele-opc').children("option:selected").val()
				if (estado == 0) {
					Swal.fire('Advertencia','Debe seleccionar un estado para proceder','warning')
				}else {
					if (estado == 2 && $('#estimado').val() == '') {
						Swal.fire('Advertencia','Seleccione una fecha estimada de finalizacion','warning')
					}else {
						var estimado = null
						var motivo = $('#opc-coment').val()
						if (estado == 2) {
							estimado = $('#estimado').val()
						}
						actualizarEstado($(this).val(),motivo,estimado,estado)
					}
				}
			})
		})
	    function actualizarEstado(data,motivo,estimado,estado){
	    	var p = data.split("@")
	    	$.post('controlComentarios.php',{opcion:2,usuario:p[2],comentario:p[0],motivo:motivo,estimado:estimado,estado:estado},function(e){
	    		console.log(e)
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
					item += "<div class='order-title' style='background: unset;'>"
					item += "<span class='title-uni'>REALIZANDOSE</span>"
					item += "</div>"
					if (e != "[[]]") {
						const json = JSON.parse(e)
						item += "<div class='content-div pad-cus' style='margin-top: 10px;display: block;flex-wrap: unset;'>"
						for (let i = 0; i < json.length; i++) {
							if (admin == 0) {
								admin = json[i].admin
								item += "<div class='com-padre'>"
									item += "<div class='h-com rounded-top'>"
										item += "<span>"+json[i].nomadmin+"</span>"
										item += "<span class='chv-dw' style='display:none;'><i class='fas fa-chevron-circle-down'></i></span>"
									item += "</div>"
									item += "<div class='com-hijo lg-empty'>"
									if (json[i].tipo == 1) {
										item += "<div class='comment border-suggest d-block-sm'>"
									}else if(json[i].tipo == 2) {
										item += "<div class='comment border-bug d-block-sm'>"
									}else {
										item += "<div class='comment border-app d-block-sm'>"
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
											item += "<span><i class='fas fa-flag-checkered'></i> "+json[i].estimado+"</span>"
										item += "</div>"
										item += "<div><i class='fas fa-cubes'></i> "+json[i].app+"</div>"
									item += "</div>"
									if (i == (json.length-1)) {
										item += "</div>"
										item += "<div class='rounded-bottom div-bot'><span class='chv-up'><i class='fas fa-chevron-circle-up'></i></span></div>"
										item += "</div>"
									}
							}else if (admin == json[i].admin) {
								if (json[i].tipo == 1) {
									item += "<div class='comment border-suggest d-block-sm'>"
								}else if(json[i].tipo == 2) {
									item += "<div class='comment border-bug d-block-sm'>"
								}else {
									item += "<div class='comment border-app d-block-sm'>"
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
										item += "<span><i class='fas fa-flag-checkered'></i> "+json[i].estimado+"</span>"
									item += "</div>"
									item += "<div><i class='fas fa-cubes'></i> "+json[i].app+"</div>"
								item += "</div>"
								if (i == (json.length-1)) {
									item += "</div>"
									item += "<div class='rounded-bottom div-bot'><span class='chv-up'><i class='fas fa-chevron-circle-up'></i></span></div>"
									item += "</div>"
								}
							}else {
								item += "</div>"
								item += "<div class='rounded-bottom div-bot'><span class='chv-up'><i class='fas fa-chevron-circle-up'></i></span></div>"
								item += "</div>"
								admin = json[i].admin
								item += "<div class='com-padre'>"
									item += "<div class='h-com rounded-top'>"
										item += "<span>"+json[i].nomadmin+"</span>"
										item += "<span class='chv-dw' style='display:none;'><i class='fas fa-chevron-circle-down'></i></span>"
									item += "</div>"
									item += "<div class='com-hijo lg-empty'>"
									if (json[i].tipo == 1) {
										item += "<div class='comment border-suggest d-block-sm'>"
									}else if(json[i].tipo == 2) {
										item += "<div class='comment border-bug d-block-sm'>"
									}else {
										item += "<div class='comment border-app d-block-sm'>"
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
											item += "<span><i class='fas fa-flag-checkered'></i> "+json[i].estimado+"</span>"
										item += "</div>"
										item += "<div><i class='fas fa-cubes'></i> "+json[i].app+"</div>"
									item += "</div>"
								if (i == (json.length-1)) {
									item += "</div>"
									item += "<div class='rounded-bottom div-bot'><span class='chv-up'><i class='fas fa-chevron-circle-up'></i></span></div>"
									item += "</div>"
								}
							}
						}
						item += "</div>"
					}else {
						item += "<div class='empty-div'>"
						item += "<i class='far fa-comments fa-3x'></i>"
						item += "<span>Los administradores se encuentran libres</span>"
						item += "</div>"
					}
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
								item += "<div class='comment border-anulado d-block-sm'>"
							}else {
								if (json[i].tipo == 1) {
									item += "<div class='comment border-suggest d-block-sm'>"
								}else if(json[i].tipo == 2) {
									item += "<div class='comment border-bug d-block-sm'>"
								}else {
									item += "<div class='comment border-app d-block-sm'>"
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
								item += "<div class='dropdown'>"
									item += "<div class='dropdown-toggle' style='cursor: pointer;' data-toggle='dropdown'><i class='fas fa-cog fa-lg'></i></div>"
									item += "<div class='dropdown-menu move-drop' value='"+json[i].codcoment+"@"+json[i].fecha+"'>"
										item += "<button class='dropdown-item detalle' type='button'><i class='fas fa-poll-h'></i> DETALLE</button>"
										if (json[i].estado == 'PENDIENTE') {
											item += "<button class='dropdown-item editar' type='button'><i class='fas fa-pen-square'></i> EDITAR</button>"
										}
									item += "</div>"
								item += "</div>"
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
								if (json[i].estado != 'PENDIENTE' && json[i].estado != 'REVISADO') {
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
								item += "<div class='footer-comment' style='align-items: flex-end;'>"
								item += "<span><i class='fas fa-cubes'></i> "+json[i].app+"</span>"
								item += "<button type='button' class='btn btn-danger btn-sm act-det' value='"+json[i].codcoment+"@"+json[i].fecha+"@"+json[i].usuario+"'><i class='fas fa-clipboard-list'></i> DETALLE</button>"
								item += "</div>"
							}
							item += "</div>"
						}
						item += "</div>"
					}else {
						item += "<div class='empty-div'>"
						item += "<i class='far fa-comments fa-3x'></i>"
						item += "<span>No se encontraron comentarios</span>"
						item += "</div>"
					}
					$('#disponible').html(item)
					$('.dropdown-toggle').dropdown()
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
						$('.title').removeClass('active')
						$('.title.otros').addClass('active')
						$('#anho')[0].selectedIndex = 0
						$('#mes')[0].selectedIndex = 0
						$('.modal').modal('hide')
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
								item += "<div class='comment border-anulado' style='flex-direction:row;'>"
							}else {
								if (json[i].tipo == 1) {
									item += "<div class='comment border-suggest' style='flex-direction:row;'>"
								}else if(json[i].tipo == 2) {
									item += "<div class='comment border-bug' style='flex-direction:row;'>"
								}else {
									item += "<div class='comment border-app' style='flex-direction:row;'>"
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
									item += "<p class='parraf'>"+json[i].descrip+"</p>"
								}
								if (json[i].estado != 'REVISADO') {
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
									item += "<div class='in-fin'>"
										item += "<span><i class='far fa-flag'></i> "+json[i].iniciado+"</span>"
										item += "<span><i class='fas fa-flag-checkered'></i> "+json[i].estimado+"</span>"
									item += "</div>"
								}
								item += "<div class='duration'>"+json[i].transcurrido+" días transcurridos desde que se genero</div>"
							item += "</div>"
							item += "<div style='display: flex;flex-direction: column;'>"
								item += "<button type='button' class='btn btn-danger btn-apilado anular' value='"+json[i].usuario+"@"+json[i].codcoment+"'><i class='fas fa-trash-alt'></i></button>"
								item += "<button type='button' class='btn btn-primary btn-apilado detalle' value='"+json[i].codcoment+"@"+json[i].fecha+"@"+json[i].usuario+"'><i class='fas fa-address-card'></i></button>"
								item += "<button type='button' class='btn btn-success btn-apilado accion' value='"+json[i].codcoment+"@"+json[i].fecha+"@"+json[i].usuario+"@"+json[i].idestado+"'><i class='fas fa-cogs'></i></button>"
							item +="</div>"
							item += "</div>"
						}
						item += "</div>"
					}else {
						item += "<div class='empty-div'>"
						item += "<i class='far fa-comments fa-3x'></i>"
						item += "<span>No se encontraron comentarios</span>"
						item += "</div>"
					}

					$('#tomado').html(item)
					$('.nom-tool').tooltip()
					$('.opciones').hide()
					$('.btn-apilado').on('click',function(){
						if ($(this).hasClass('anular')) {
							$('#preview').hide()
							$('#anul-coment').show()
							$('#misc').modal('show')
							$('#aceptar').prop('value',$(this).val())
						}else if ($(this).hasClass('detalle')){
							detalleTomar($(this).val(),1)
						}else {
							let item = "<span>"+$(this).val().split("@")[1]+"</span>"
							item += "<span><i class='fas fa-hashtag'></i> "+$(this).val().split("@")[0]+"</span>"
							item += "<i class='fas fa-times' data-dismiss='modal'></i>"
							$('#opc-head').html(item)
							$('#sele-opc')[0].selectedIndex = 0
							$('#opc-estimado').hide()
							$('#opc-coment').hide()
							$('#opc-btn').prop('value',$(this).val())
							$('#tomar-opt').val($(this).val().split('@')[3])
							$('#opc-tom').modal('show')
						}
					})
					
					if (month != 0 && year != 0) {
						$('.title').removeClass('active')
						$('.title.finalizados').addClass('active')
						$('#anho')[0].selectedIndex = 0
						$('#mes')[0].selectedIndex = 0
						$('.modal').modal('hide')
					}
				}else {
					window.location.href = 'index.php'
				}
			})
		}
		function detalleTomar(data,tipo){
			$.post('obtenerDetalle.php',{opcion:1,parametros:data},function(e){
				if (e != '0') {
					let item = ""
					const json = JSON.parse(e)
					const img = json['imagenes']
					item += "<div style='margin-bottom: 10px;'>"
					item += "<span><i class='fas fa-cubes'></i> "+json['app']+"</span>"
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
						item += "<div class='grid-images' style='justify-content: center;'>"
						for(var i=0; i<img.length; i++){
							item += "<img class='img-prev' src='"+img[i]+"'></img>"
						}
						item += "</div>"
					}
					if (tipo == 0) {
						item += "<div class='grid-images' style='justify-content:space-around;margin-top:20px;'>"
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
		function detalle(data,accion){
			$.post('obtenerDetalle.php',{opcion:0,parametros:data},function(e){
				if (e != '0') {
					let item = ""
					const json = JSON.parse(e)
					const foto = json['foto']
					item += "<div style='display: flex;flex-direction: column;margin: 0px 15px;font-weight: 100'>"
						item += "<span style='margin-bottom:5px;'><i class='fas fa-cubes'></i> "+json['app']+"</span>"
						item += "<div style='display: flex;justify-content: space-between;margin-bottom:5px;'>"
							item += "<span><i class='fas fa-hashtag'></i> "+json['codcoment']+"</span>"
							item += "<span><i class='fas fa-calendar-day'></i> "+json['fecha']+"</span>"
							item += "<span><i class='fas fa-clock'></i> "+json['hora']+"</span>"
						item += "</div>"
						item += "<div style='display: flex;justify-content: space-between;margin-bottom:5px;'>"
							item += "<span><i class='fas fa-comment-dots'></i> "+json['tipo']+"</span>"
							item += "<span style='background: crimson;color: white;padding: 0px 10px;'>"+json['estado']+"</span>"
						item += "</div>"
						if (accion == 0) {
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
								if (json['estimado'] != 0 && json['estimado'] != null) {
									item += "<span style='margin-bottom:5px;'>TOMARA "+json['estimado']+" DIAS, APROXIMADO:</span>"
									item += "<div style='display: flex;justify-content: space-between;align-items: center;'>"
										item += "<span><i class='far fa-flag'></i> "+json['iniciado']+"</span>"
										item += "<i class='fas fa-angle-double-right'></i>"
										item += "<span><i class='fas fa-flag-checkered'></i> "+json['estimado']+"</span>"
									item += "</div>"
								}
								if (json['finalizado'] != 0 && json['finalizado'] != null) {
									item += "<span style='width:100%;text-align: center;color: crimson;'>CONCLUIDO EL "+json['finalizado']+"</span>"
								}
							}
						}else {
							item += "<span class='n-mrb'><i class='far fa-comment-alt'></i> COMENTARIO</span>"
							item += "<textarea id='edit-descrip' class='form-control form-field' style='height: 150px;' placeholder='Describa su comentario brevemente...'>"+json['comentario']+"</textarea>"
							item += "<div class='grid-images' style='justify-content:space-around;margin-top:20px;'>"
								item += "<button type='button' data-dismiss='modal' class='btn btn-danger btn-sm'><i class='fas fa-ban'></i> CANCELAR</button>"
								item += "<button id='actualizar' type='button' class='btn btn-info btn-sm' value='"+json['titulo']+"@"+json['idapp']+"@"+json['idtipo']+"@"+json['foto']+"@"+json['codcoment']+"@"+json['fecha']+"@"+json['hora']+"'><i class='fas fa-save'></i> ACTUALIZAR</button>"
							item += "</div>"
						}
					item += "</div>"
					$('#detalle-title').html(json['titulo'])
					$('#detalle-body').html(item)
					$('#detalles').modal('show')
					$('#actualizar').on('click', function(){
						var p = $(this).val().split('@')
						var descrip = $('#edit-descrip').val()
						guardarComentario(1,p[0],descrip,p[1],p[2],p[3],p[4],p[5]+'@'+p[6])
					})
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
			$('.form-field').val('')
			$('#app-com')[0].selectedIndex = 0
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
		function guardarComentario(opcion,titulo,descrip,app,tipo,img,id,adicional){
			$.post('guardarComentario.php',{opcion:opcion,titulo:titulo,comentario:descrip,app:app,tipo:tipo,imagenes:img,codcoment:id,adicional:adicional},function(e){
				console.log(e)
				if (e != '0') {
					if (opcion == 0) {
						if (e == '1') {
							clearFields()
							Swal.fire({
								title: 'Correcto',
								text: 'Comentario enviado correctamente',
								type: 'success'
							})
						}else {
							Swal.fire({
								title: 'Aviso',
								text: 'No se pudo enviar el comentario',
								type: 'error'
							})
						}
					}else {
						if (e == '1') {
							$('.modal').modal('hide')
							mensaje()
							comentarios(0,0,0,0)
						}else {
							Swal.fire({
								title: 'Aviso',
								text: 'No se pudo actualizar el comentario',
								type: 'error'
							})
						}
					}
				}else {
					window.location.href = 'index.php'
				}
			})
		}
	</script>
</body>
</html>