<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="resources/icons/logo.ico" type="image/ico">
	<title>BAS - Usuario</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/c6963f4a8b.js" crossorigin="anonymous"></script>
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
							<span class="m8-l">GUTIERREZ HUANCA, RUSSBELL</span>
							<span class="m8-l">Administrador</span>
						</div>
					</div>
				</a>
			  <button class="navbar-toggler no-border" type="button" data-toggle="collapse" data-target="#navbarMobile">
			  	<i class="fas fa-bars fa-lg icon-default"></i>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarMobile">
			    <ul class="navbar-nav mr-auto dir-marg">
			      <li class="nav-item ali-items m10-lr">
			      	<div class="let-small active">
			      		<i class="fas fa-chart-line fa-2x"></i>
			      		<span>AVANCE</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">AVANCE</a>
			      </li>
			      <li class="nav-item ali-items m10-lr">
			      	<div class="let-small">
			      		<i class="far fa-comment-alt fa-2x"></i>
			      		<span>COMENTARIO</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">COMENTARIO</a>
			      </li>
			      <li class="nav-item ali-items m10-lr">
			      	<div class="let-small">
			      		<i class="fas fa-power-off fa-2x"></i>
			      		<span>DESCONECTAR</span>
			      	</div>
			        <a class="nav-link d-sm" href="#">DESCONECTAR</a>
			      </li>
			    </ul>
			  </div>
			</nav>
		</div>
		<div class="avance active dimen-content">
			<div class="center-content dimen-size bg-white-radi">
				<div class="order-title">
					<span class="title">VIGENTES</span>
				</div>
				<div id="empvigente" class="empty-div">
					<i class="far fa-comments fa-3x"></i>
					<span>No tiene ningún comentario vigente</span>
				</div>
				<div id="convigente" class="content-div active">
					<div class="comment">
						<div class="header-comment">
							<span>31/12/9999</span>
							<span>TITULO_DESCRIP</span>
							<i class="fas fa-ellipsis-v fa-lg"></i>
						</div>
						<p class="parraf">Lorem ipsum dolor sit amet consectetur adipiscing elit donec neque posuere, integer egestas nec per ante erat cras pretium. Phasellus <span class="dots active">...</span><span class="rest">risus non habitasse euismod viverra habitant erat condimentum tortor, ante tincidunt sociis ut mus ullamcorper quis accumsan duis, laoreet taciti nisi convallis est fermentum etiam blandit. Sem imperdiet rutrum purus tellus suscipit id semper lectus est augue, feugiat nulla dapibus posuere dui ridiculus lacinia ultrices ante eleifend mattis, fringilla nascetur hac sagittis ultricies et cum vestibulum proin.</span></p>
						<div class="footer-comment">
							<span>REALIZANDOSE</span>
							<span>N° 0001</span>
							<span class="duration">0 días pasaron</span>
						</div>
					</div>
				</div>
				<div class="order-title">
					<span class="title">FINALIZADO</span>
				</div>
				<div id="empfinaliza" class="empty-div">
					<i class="far fa-comments fa-3x"></i>
					<span>No tiene ningún comentario vigente</span>
				</div>
				<div id="confinaliza" class="content-div active">
					<div class="comment">
						<div class="header-comment">
							<span>31/12/9999</span>
							<span>TITULO_DESCRIP</span>
							<i class="fas fa-ellipsis-v fa-lg"></i>
						</div>
						<p class="parraf">Lorem ipsum dolor sit amet consectetur adipiscing elit donec neque posuere, integer egestas nec per ante erat cras pretium. Phasellus <span class="dots active">...</span><span class="rest">risus non habitasse euismod viverra habitant erat condimentum tortor, ante tincidunt sociis ut mus ullamcorper quis accumsan duis, laoreet taciti nisi convallis est fermentum etiam blandit. Sem imperdiet rutrum purus tellus suscipit id semper lectus est augue, feugiat nulla dapibus posuere dui ridiculus lacinia ultrices ante eleifend mattis, fringilla nascetur hac sagittis ultricies et cum vestibulum proin.</span></p>
						<div class="footer-comment">
							<span>REALIZANDOSE</span>
							<span>N° 0001</span>
							<span class="duration">0 días pasaron</span>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center">
				    <button type="button" class="btn btn-cus btn-depth">Comentarios anteriores</a>
				</div>
			</div>
		</div>
		<div class="comentario dimen dimen-content">
			<div class="dimen-size bg-white-radi">
				<div class="padd">
					<h1>Comentario</h1>
					<div class="m5-tb">
						<label>Titulo</label>
					    <input type="text" class="form-control" placeholder="Titulo del comentario">
					</div>
					<div class="m5-tb">
						<label>Contenido</label>
				    	<textarea class="form-control" placeholder="Explique su comentario brevemente..."></textarea>
					</div>
					<div class="m5-tb">
						<label>Tipo comentario</label>
					    <div class="d-flex justify-content-center">
					    	<div id="sugerencia" class="div-button ">
					    		<i class="far fa-lightbulb fa-2x"></i>
					    		<span>Sugerencia</span>
					    	</div>
					    	<div id="problema" class="div-button">
					    		<i class="fas fa-bug fa-2x"></i>
					    		<span>Problema</span>
					    	</div>
					    </div>
					</div>
					<div class="m5-tb">
						<label>Foto (opcional)</label>
						<div class="photo">
							<label class="btn-outline-success" style="margin-bottom: unset;"><i class="far fa-image fa-2x"></i><input type="file" style="width: 0px;height: 0px;overflow: hidden;"></label>
						</div>
						<!--div class="row">
						  <div class="col-2 imgUp">
						    <div class="imagePreview"></div>
							<label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;"></label>
						  </div>
						  <i class="fa fa-plus imgAdd"></i>
						</div-->
					</div>
				    <div class="d-flex justify-content-center">
				    	<button type="button" class="btn btn-cus btn-depth">Enviar comentario</a>
				    </div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(".imgAdd").click(function(){
		  $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
		});
		$(document).on("click", "i.del" , function() {
			$(this).parent().remove();
		});
		$(function() {
		    $(document).on("change",".uploadFile", function()
		    {
		    		var uploadFile = $(this);
		        var files = !!this.files ? this.files : [];
		        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
		 
		        if (/^image/.test( files[0].type)){ // only image file
		            var reader = new FileReader(); // instance of the FileReader
		            reader.readAsDataURL(files[0]); // read the local file
		 
		            reader.onloadend = function(){ // set image data as background of div
		                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
		uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
		            }
		        }
		      
		    });
		});
		$('#sugerencia').on('click',function(){
			$(document).find('.fa-bug').removeClass('active')
			$(document).find('.fa-lightbulb').addClass('active')
		})
		$('#problema').on('click',function(){
			$(document).find('.fa-lightbulb').removeClass('active')
			$(document).find('.fa-bug').addClass('active')
		})
		$('.let-small').on('click',function(){
			$(document).find('.let-small').removeClass('active')
			$(this).addClass('active')
		})
		$('.parraf').on('click',function(){
			if ($(this).children('.dots').hasClass('active')) {
				$(this).children('.dots').removeClass('active')
				$(this).children('.rest').addClass('active')
			}else {
				console.log("Second")
				$(this).children('.rest').removeClass('active')
				$(this).children('.dots').addClass('active')
			}
		})
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
		/*.bg-darkgreen {
			background-color: #155a44 !important;
		}*/
		/*.bg-gray-radi {
			display: flex;
		    flex-direction: column;
		    text-align: center;
		    justify-content: center;
		    height: 100%;
			background-color: #D3D3D3 !important;
			border-radius: 5px;
		}*/
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
		.div-button {
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
			border: 3px solid #f7b132;
		}
		.border-bug {
			border: 3px solid #0c9c0a;
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

		/* Small devices (phones, 768px and down) */
		@media only screen and (max-width: 768px) {
			body {
				background: rgb(87,186,241);
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
			.fa-bars, .fa-times {
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
				height: calc(100vh - 68px);
				transition: all .6s ease;
			}
			ul {
				align-items: center;
			}
			li {
				justify-content: center;
				width: 100px;
			}
			.dir-marg {
				flex-direction: row;
				margin-top: 10px;
			}
			.fa-lightbulb.active{
				color: #ffbf00;
			}
			.fa-bug.active{
				color: #28a745;
			}
			.photo {
				display: flex;
			    flex-direction: column;
			    justify-content: center;
			    align-items: center;
				height: 220px;
    			margin: 10px 50px 10px 50px;
			    border: 3px dashed darkcyan;
			    color: darkcyan;
			    border-radius: 5px;
			}
			.header-comment {
				display: flex;
			    justify-content: space-between;
			    margin: 5px 10px;
			    align-items: center;
			}
			.footer-comment {
				display: flex;
			    justify-content: space-between;
			    margin: 5px 10px;
			    align-items: center;
			}
			.order-title {
				padding: 10px 30px 0px 10px;
			}
			.title {
				color: lightgray;
	    		display: block;
	    		border-bottom: 2px inset lightgray;
			}
			.empty-div.active {
				display: flex;
				height: 200px;
				margin: 10px 20px 0px 20px;
			    flex-direction: column;
			    text-align: center;
			    justify-content: center;
			}
			.content-div.active {
				display: flex;
				margin: 0px 30px;
			    flex-direction: column;
			    text-align: center;
			    justify-content: center;
			}
			.center-content {
				height: 100%;
			}
			.avance.active,.comentario.active {
				display: block;
			}
			.avance,.comentario,.content-div,.empty-div {
				display: none;
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