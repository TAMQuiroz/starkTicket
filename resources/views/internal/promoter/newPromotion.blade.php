@extends('layout.promoter')

@section('style')

    {!!Html::style('css/bootstrap.min.css')!!}

@stop

@section('title')
  Nueva promocion
@stop

@section('content')
 {!!Form::open(array('url' => 'promoter/promotion/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}


	<legend>Ingrese datos de nueva promoción</legend>
	<div style="-webkit-columns: 100px 2;">
	
		<h4>Nombre</h4>
		{!! Form::text('promotionName','', array('class' => 'form-control')) !!}	
		<h4>Descuento (%)</h4>
		{!! Form::text('discount','', array('class' => 'form-control')) !!}
	</div>
	<div style="-webkit-columns: 100px 4;">
		<h4>Fecha Inicio</h4>



		{!! Form::date('dateIni','', array('class' => 'form-control')) !!}
		<h4>Fecha Fin</h4>
		{!! Form::date('dateEnd','', array('class' => 'form-control')) !!}
		<h4>Hora Inicio</h4>
		{!! Form::time('timeIni','', array('class' => 'form-control')) !!}
		<h4>Hora Fin</h4>
		{!! Form::time('timeEnd','', array('class' => 'form-control')) !!}



	</div>
	<h4>Descripción</h4>
	{!! Form::textarea('description', null, ['size' => '30x3', 'class' => 'form-control']) !!}
	
<!-- 

	<h4>Agregar evento:</h4>
	<div class="input-group" style="width:300px">
  		{!! Form::text('eventName','', array('class' => 'form-control')) !!}
  		<span class="input-group-btn">
	    	<button class="btn btn-info" type="button">Buscar</button>
	    </span>
	</div><!-- /input-group -->
	<br>
	<br><br>
	<legend>Seleccione los datos del evento</legend>
       
<br>





   	<table id="example" class="display" cellspacing="2" width="90%"   align="center">

  <thead>
           <tr>
	        <th>Nombre</th>
	        <th>Descripción</th>
	        <th>Seleccionar</th>
	    </tr>


   </thead>



	   <tbody>


	     @foreach($events as $event)

	    <tr>
	    	<td>{{$event->name}}</td>


	   

	    	<td> {{$event->description}}   </td>



	    	<td> {!! Form::radio('select', $event->id ,   (Input::old('select') == $event->id ), array('id'=>'true', 'class'=>'radio' ,'required' ))  !!} </td>	



	    </tr>




	     @endforeach

	     </tbody>

          
	</table>    

<br>
<br>


<br>







	<div style="-webkit-columns: 100px 2;">
		<h4>Zona</h4>
		{!! Form::select('zone', ['VIP','Platea'],null,['class' => 'form-control']) !!}
		<h4>Tipo de Cliente</h4>
		{!! Form::select('zone', ['Niño','Adulto', 'Adulto Mayor'],null,['class' => 'form-control']) !!}
	</div>
	<br><br>
	<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#end" data-whatever="@mdo">Guardar</button>
	<button type="button" class="btn btn-info">Cancelar</button>





	 {!!Form::close()!!}




@stop



@section('javascript')

  {!!Html::script('js/jquery.dataTables.min.js')!!}

<script>  
$(document).ready(function() {
   $('#example').DataTable( {
       "language": {
           "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
       }
   } );
} );
</script>





@stop
