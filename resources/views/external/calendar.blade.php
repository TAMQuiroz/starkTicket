@extends('layoutExternal')

@section('style')
	{!!Html::style('css/datepicker.css')!!}
	{!!Html::style('css/images.css')!!}
@stop
@section('title')
Calendario
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-6">Busqueda del día {{date('Y-m-d',$date_at)}}</div>
		<div class="col-sm-5 pull-right">
			{!!Form::open(array('id'=>'form','class'=>'form-inline'))!!}
			  <div class="form-group">
			  	<input type="text" class="form-control" id="datepicker" placeholder="Fecha" required name="date_at">
			  </div>
			  <input type="submit" value="Buscar eventos" class="btn btn-info">
			</form>
	    </div>
	</div>
</div>
<hr>
<!--
@if(count($presentations)===0)
<div class="alert alert-warning"> Presentaciones no encontrados en esta fecha</div>
@else
	<div class="row">
		<div class="col-sm-12">
		<h3>Presentaciones encontrados en {{date('Y-m-d',$date_at)}}</h3>
		<table class="table table-bordered">
			<tr>
				<th>Fecha de presentación</th>
				<th>Evento</th>
				<th>Detalles</th>
			</tr>
	    @foreach($presentations as $presentation)
	    	<tr>
	    		<td>{{date('H:i:s',$presentation->starts_at)}}</td>
	    		<td>{{$presentation->event["name"]}}</td>
	    		<td><p><a href="event/{{$presentation->event['id']}}"  class="btn btn-info" role="button" >Detalle</a></p></td>
	    	</tr>
	    @endforeach
		</table>
		</div>
	</div>
@endif -->
<h3>Presentaciones encontrados en {{date('Y-m-d',$date_at)}}</h3>
@if(count($eventInformation)===0)
<div class="alert alert-warning"> Presentaciones no encontrados en esta fecha</div>
@else
	
	<br>
	<div class="row">
	    <div class="col-sm-12">
	    <table class="table table-bordered table-striped">
			<tr>
				<th>Nombre Evento</th>
				<th>Imagen del Evento</th>
				<th>Informacion</th>
				<th>Presentaciones</th>
				<th>Detalles</th>
			</tr>
			@foreach($eventInformation as $event)
	    	<tr>    		
	    		<td>	
	    			<h4>{{$event[2]}}</h4>    					  			
	    		</td>
	    		<td>	  			
					{!! Html::image($event[0], null, array('class'=>'image gift_img')) !!}			  			
	    		</td>
	    		<td> 
	    			<p>
					    <b>Lugar: </b> {{$event[3]}} <br>
					    <b>Direccion:</b> {{$event[4]}} <br>
					    <b>Categoria:</b> {{$event[5]}} <br>
					</p>  
	    		</td>
	    		<td>
	    			@foreach ($event[6] as $pre)
	    				<p>{{date('H:i:s',$pre[0])}}</p>
	    			@endforeach
	    		</td>
	    		<td><p><a href="event/{{$event[1]}}"  class="btn btn-info" role="button" >Detalle</a></p></td>
	    	</tr>
	    	@endforeach
		</table>
		</div>
		
	</div>

@endif
<h3>Eventos publicados el {{date('Y-m-d',$date_at)}}</h3>
@if(count($events)===0)
<div class="alert alert-warning"> Eventos publicados no encontrados en esta fecha</div>
@else
	
	<br>
	<div class="row">
	    @foreach($events as $event)
	    <div class="3u">
	        <section>
	            <a  class="image full">{!! Html::image($event->image, null, array('class'=>'image cat_img')) !!}</a>
	            <h3>{{$event->name}}</h3>
	            <p>
	                <b>Fecha de venta: </b> {{date('Y-m-d',$event->selling_date)}}<br>
	                <b>Lugar: </b> {{$event->place->name}} <br>
	                <b>Direccion:</b> {{$event->place->address}} <br>
	                <b>Categoria:</b> {{$event->category->name}} <br>
	            </p>
	            <p><a href="event/{{$event->id}}"  class="btn btn-info" role="button" >Detalle</a></p>
	        </section>
	    </div>
	    @endforeach
	</div>
@endif

@stop

@section('javascript')
  {!!Html::script('js/jquery-ui.min.js')!!}
<script>
  (function() {
    $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd" ,
            minDate: 0 ,
            maxDate: "+2Y",
            beforeShow: function() {
                setTimeout(function(){
                    $('.ui-datepicker').css('z-index', 9999);
                }, 0);
            }
        }).on("change", function(e) {
            var curDate = $(this).datepicker("getDate");
            var maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 720);
            maxDate.setHours(0, 0, 0, 0);
            if (curDate > maxDate)
            {
                $(this).val("");
                $(this).addClass("red");
            } else {
                $(this).removeClass("green");
            }
        });
    })();
  </script>
@stop