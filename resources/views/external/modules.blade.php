@extends('layoutExternal')

@section('style')
	{!!Html::style('css/skeletoGift.css')!!}
	{!!Html::style('css/estiloGift.css')!!}
@stop

@section('title')
	Puntos de venta
@stop

@section('content')
	<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row">
				
					<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header>
									<h2 class = "prueba4">Ubicación de nuestros puntos de venta</h2>
								</header>
								
                                <iframe width="770" height="480" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Avenida%20Ant%C3%BAnez%20De%20Mayolo%2C%20Los%20Olivos%2C%20Lima%2C%20Peru&key=AIzaSyBQwG1d7QYu_dbedftXgRCFLsB24xCbHDk" allowfullscreen></iframe>
							</section>

                            
                               <div class="col-md-6"> <!-- Sirve para darle anchura a tu columna-->
                     >
                                </div>
						</div>
					<!-- /Content -->
                    
                    
						
					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section class="scrol">
              <style>.scrol{
    width: 100%;
    height: 750px;
    overflow: scroll;
}</style>
								<header>
									<h2 class = "title">Puntos de Venta</h2>
                                    <!--<span class="byline">Entradas para tu evento</span> -->								
                                </header>
								<p>Descubre los puntos de venta mas cercanos a tu distrito para que puedas realizar
                                tu compra de una manera mucho mas rápida y efectiva</p>
                                
                            <h3 class = "prueba1">Mercado Covida</h3>
                                   <p>
                                        Av. Antunez de Mayolo<br>1247, Covida - Los Olivos<br>
                                   </p>
                                   <p><i class="fa fa-phone"></i> 
                                       <abbr title="Phone">P</abbr>: (511) 521-1621</p>
                                   <p><i class="fa fa-envelope-o"></i> 
                                       <abbr title="Email">E</abbr>: <a class = "prueba3">eleticket@oficial.pe</a>
                                   </p>
                                   <p><i class="fa fa-clock-o"></i> 
                                       <abbr title="Hours">H</abbr>: Lunes - Viernes: 9:00AM-5:00 PM</p>

                               <h3 class = "prueba1">Cine Imperio</h3>
                                   <p>
                                        Av. Tacna<br>255, Distrito de Lima<br>
                                   </p>
                                   <p><i class="fa fa-phone"></i>   
                                       <abbr title="Phone">P</abbr>: (511) 541-1021</p>
                                   <p><i class="fa fa-envelope-o"></i> 
                                       <abbr title="Email">E</abbr>: <a class = "prueba3">eleticket@oficial.pe</a>
                                   </p>
                                   <p><i class="fa fa-clock-o"></i> 
                                       <abbr title="Hours">H</abbr>: Lunes - Viernes: 9:00AM-5:00 PM</p

                                      
								
							</section>
						</div>
					<!-- Sidebar -->
						
				</div>
			
			</div>
		</div>
@stop

@section('javascript')

@stop