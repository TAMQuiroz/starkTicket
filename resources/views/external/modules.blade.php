@extends('layoutExternal')

@section('style')
	{!!Html::style('css/skeletoGift.css')!!}
	{!!Html::style('css/estiloGift.css')!!}
  {!!Html::style('css/images.css')!!}
  <style type="text/css">
        #nav .fifth{
            color: white;
        }
  </style>
@stop

@section('title')
	Puntos de venta
@stop

@section('content')
	<!-- Main -->
   <!--
		<div id="main">
			<div class="container">
				<div class="row">
				
					
						<div id="content" class="8u skel-cell-important">
							<section>
								<header>
									<h2 class = "prueba4">Ubicación de nuestros puntos de venta</h2>
								</header>
								
                                <iframe width="770" height="480" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Avenida%20Ant%C3%BAnez%20De%20Mayolo%2C%20Los%20Olivos%2C%20Lima%2C%20Peru&key=AIzaSyBQwG1d7QYu_dbedftXgRCFLsB24xCbHDk" allowfullscreen></iframe>
							</section>

                            
                               <div class="col-md-6"> 
                     
                                </div>
						</div>
			
                    
                    
						
		
						<div id="sidebar" class="4u">
							<section class="scrol">
              <style>.scrol{
                  width: 100%;
                  height: 650px;
                  overflow: scroll;
              }</style>
								<header>
									<h2 class = "title">Puntos de Venta</h2>
                                   							
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
                                       <abbr title="Hours">H</abbr>: Lunes - Viernes: 9:00AM-5:00 PM</p>

                                  <h3 class = "prueba1">Cine Tacna Prime 5 stars</h3>
                                   <p>
                                        Av. Tacna<br>667, Distrito de Lima<br>
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
					
						
				</div>
			
			</div>
		</div> -->
    <header>
    <h1>Ubica nuestros Módulos de Venta </h1>

  </header>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Distrito</th>
            <th>Provincia</th>
            <th>Departamento</th>
            <th>Teléfono</th>
            <th>Detalle</th>
        </tr>
            @foreach($modules as $module)
        <tr>
          <td>{{$module->name}}</td>
          <td>{{$module->address}}</td>
          <td>{{$module->district}}</td>
          <td>{{$module->province}}</td>
          <td>{{$module->state}}</td>
          <td>{{$module->phone}}</td>
          <!--<td>{{$module->email}}</td> -->
          <!--<td>{!! Html::image($module->image, null, array('class'=>'gift_img')) !!}</td> -->
          <td>
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$module->id}}"><i class="glyphicon glyphicon-plus"></i></a> 
            <div class="modal fade" id="edit{{$module->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle punto de venta</h4>
                  </div>
                  <div class="modal-body">
                    <h4>Nombre: </h4>
                    {{$module->name}}
                    <h4>Direccion: </h4>
                    {{$module->address}}
                    <h4>Ciudad: </h4>
                    {{$module->district}}
                    <h4>Provincia: </h4>
                    {{$module->province}}
                    <h4>Departamento: </h4>
                    {{$module->state}}
                    <h4>Teléfono: </h4>
                    {{$module->phone}}
                    <h4>Correo: </h4>
                    {{$module->email}}
                    <h4>Apertura: </h4>
                    {{$module->starTime}}
                    <h4>Cierre: </h4>
                    {{$module->endTime}}
                    <br>
                    <br>
                    <h4>Ubicanos: </h4>
                    {!! Html::image($module->image, null, array('class'=>'module_img')) !!}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          @endforeach



    </table>
  
@stop

@section('javascript')

@stop