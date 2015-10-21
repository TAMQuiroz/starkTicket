@extends('layoutExternal')

@section('style')
	{!!Html::style('css/datepicker.css')
	<style type="text/css">
		.full img{
            width: 100%;
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
											<p><a href="event/1"  class="btn btn-info" role="button" >Detalle</a></p>
										</section>
									</div>
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Fecha: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-info" role="button" >Detalle</a></p>
										</section >
									</div>
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Date: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-info" role="button" >Detalle</a></p>
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
											<p><a href="event/1"  class="btn btn-info" role="button" >Detalle</a></p>
										</section>
									</div>
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Date: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-info" role="button" >Detalle</a></p>
										</section style="text-align:center;">
									</div>
									<div class="4u">
										<section style="text-align:center;">
											<a href="#" class="image full"><img src="images/pics13.jpg" alt="" /></a>
											<h2>Titulo del Evento 1</h2>
											<p><b>Precio: </b> S/. 20.00 <br>
												<b>Date: </b> 20/12/2015<br>
												Av. venezuela Nro 255 </p>
											<p><a href="event/1"  class="btn btn-info" role="button" >Detalle</a></p>
										</section>
									</div>
								</div>
								<div class="divider">&nbsp;</div>
							</section>
						</div>
					<!-- /Content -->

					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section class="ui-state-default">
								<header>
									<h3>Calendario de eventos</h3>
								</header>

								<script>

								$(function(){

								    $("#datepicker").datepicker();
								});
								  </script>
								  <div class="ll-skin-latoja">
								<div id="datepicker"></div>
								  </div>		


								<header>
									<h3>Categorias</h3>
								</header>
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
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
@stop