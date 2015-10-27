




@extends('layout.promoter')

@section('style')

{!!Html::style('css/bootstrap.min.css')!!}
<style type="text/css">
h1{
	margin-top: 80px;
}
</style>

@stop

@section('title')
  Nueva promocion
@stop

@section('content')
 {!!Form::open(array('url' => 'promoter/promotion/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
	<h3>Seleccione los datos del evento</h3>
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
		    	<td> {{$event->description}}</td>
		    	<td> {!! Form::radio('evento', $event->id ,   (Input::old('evento') == $event->id ), array('id'=>'true', 'class'=>'radio' ,'required' ))  !!} </td>	
		    </tr>

	    	@endforeach
		</tbody>
	</table>  
	<hr>
	<h3>Ingrese información de promoción</h3>
	<div>
		<div style="-webkit-columns: 100px 2;">
				<h4>Nombre</h4>
				{!! Form::text('promotionName','', array('class' => 'form-control', 'maxlength'=>'15', 'required')) !!}	
				<h4>Descuento (%)</h4>
				{!! Form::number('discount','', array('class' => 'form-control', 'min'=>'0', 'max'=>'100', 'required')) !!}
			</div>
			<div style="-webkit-columns: 100px 4;">
				<h4>Fecha Inicio</h4>
				{!! Form::date('dateIni','', array('class' => 'form-control' , 'required')) !!}
				<h4>Fecha Fin</h4>
				{!! Form::date('dateEnd','', array('class' => 'form-control', 'required')) !!}
				<h4>Hora Inicio</h4>
				{!! Form::time('timeIni','', array('class' => 'form-control', 'required')) !!}
				<h4>Hora Fin</h4>
				{!! Form::time('timeEnd','', array('class' => 'form-control', 'required')) !!}
			</div>
			<h4>Descripción</h4>
			{!! Form::textarea('description', null, ['size' => '30x3', 'class' => 'form-control', 'maxlength'=>'200', 'required']) !!}
	</div>
	<br>
	<hr>
	<h3>Seleccione el tipo de promoción</h3>
	<br>
	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
	        Promoción % descuento</a>
	      </h4>
	    </div>
	    <div id="collapse1" class="panel-collapse collapse">
	      	<h4>Seleccionar tarjeta</h4>
			{!! Form::select('card', ['Interbank','BBVA', 'BCP'],null,['class' => 'form-control']) !!}
			<br><br>
			<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#end" data-whatever="@mdo">Guardar</button>
			<a href="{{url('promoter/promotion')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
			<br><br>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
	        Promoción tipo 3 x 2</a>
	      </h4>
	    </div>
	    <div id="collapse2" class="panel-collapse collapse">
		    <div style="-webkit-columns: 100px 2;">
				<h4>Zona</h4>
				{!! Form::select('zone', ['VIP','Platea'],null,['class' => 'form-control']) !!}
				<h4>Tipo de Cliente</h4>
				{!! Form::select('zone', ['Niño','Adulto', 'Adulto Mayor'],null,['class' => 'form-control']) !!}
			</div>
			<br><br>
			<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#end" data-whatever="@mdo">Guardar</button>
			<a href="{{url('promoter/promotion')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
			<br><br>
	    </div>
	  </div>
	</div>


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
