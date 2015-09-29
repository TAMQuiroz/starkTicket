@extends('layoutExternal')

@section('style')
	{!!Html::style('css/skeletoGift.css')!!}
	{!!Html::style('css/estiloGift.css')!!}
	<style type="text/css">
		#nav .sixth{
            color: white;
        }
        .btn-primary{
            background-color: #83D3C9;
            border-color: #83D3C9;
        }
        .btn-primary:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
        .category{
        	color: #83D3C9;
        }
	</style>
@stop

@section('title')
	Calendario
@stop

@section('content')

	<div id="main">
			<div class="container">
				<div class="row">

					<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header>
									<h2>Eventos de 15/09/2015</h2>
									<span class="byline">Donec vivamus fermentum nibh in augue praesent</span>
								</header>
								<div class="row">
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Fecha: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
										</section>
									</div>
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Fecha: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
										</section >
									</div>
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Date: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
										</section>
									</div>
								</div>
								<div class="row">
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Date: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
										</section>
									</div>
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Date: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
										</section style="text-align:center;">
									</div>
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Date: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
										</section>
									</div>
								</div>
								<div class="divider">&nbsp;</div>
							</section>
						</div>
					<!-- /Content -->

					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h3>Calendario de eventos</h3>
								</header>
								<img src="images/calendar.png" width="90%">

								<header>
									<h3>Categorias</h3>
								</header>
								<!--
								<ul class="list-unstyled">
									<li><a href="#">Categoria 1.</a></li>
									<li><a href="#">Categoria 2.</a></li>
									<li><a href="#">Categoria 3.</a></li>
									<li><a href="#">Categoria 4.</a></li>
									<li><a href="#">Categoria 5.</a></li>
									<li><a href="#">Categoria 6.</a></li>
									<li><a href="#">Categoria 7.</a></li>
									<li><a href="#">Categoria 8.</a></li>
									<li><a href="#">Categoria 9.</a></li>
									<li><a href="#">Categoria 10.</a></li>
								</ul> -->
								<p><a href="event" class="category">Categoria 1</a> </p>
								<p><a href="event" class="category">Categoria 2</a> </p>
								<p><a href="event" class="category">Categoria 3</a> </p>
								<p><a href="event" class="category">Categoria 4</a> </p>
								<p><a href="event" class="category">Categoria 5</a> </p>
								<p><a href="event" class="category">Categoria 6</a> </p>
								<p><a href="event" class="category">Categoria 7</a> </p>
								<p><a href="event" class="category">Categoria 8</a> </p>
							<!--	<p><a href="#">Categoria 9.</a> </p>
								<p><a href="#">Categoria 10.</a> </p> -->
							</section>
						</div>
					<!-- Sidebar -->

				</div>

			</div>
		</div>
@stop

@section('javascript')

@stop