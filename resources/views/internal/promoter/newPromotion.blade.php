@extends('layout.promoter')

@section('style')
	<style type="text/css">
		.nameL{
			maxlength:15;
		}
		.discL{
			maxlength:2;
		}
		.descripL{
			maxlength:30;
		}
	</style>
@stop

@section('title')
  Nueva promocion
@stop

@section('content')
	<legend>Ingrese datos de nueva promoción</legend>
	<div style="-webkit-columns: 100px 3;">
		<div>
			<h4>Código</h4>
			{!! Form::text('codePromotion','9898083', array('class' => 'form-control','required','disabled')) !!}	
		</div>
		<div>
			<h4>Nombre</h4>
			{!! Form::text('promotionName','', array('class' => 'form-control nameL','required')) !!}		
		</div>
		<div>
			<h4>Descuento (%)</h4>
			{!! Form::input('number', 'discount', '%', ['class' => 'form-control', 'maxlength'=>'2']) !!} 
		</div>
		
	</div>
	<div style="-webkit-columns: 100px 4;">
		<h4>Fecha Inicio</h4>
		{!! Form::date('dateIni','', array('class' => 'form-control','required')) !!}
		<h4>Fecha Fin</h4>
		{!! Form::date('dateEnd','', array('class' => 'form-control','required')) !!}
		<h4>Hora Inicio</h4>
		{!! Form::time('timeIni','', array('class' => 'form-control','required')) !!}
		<h4>Hora Fin</h4>
		{!! Form::time('timeEnd','', array('class' => 'form-control','required')) !!}
	</div>
	<h4>Descripción</h4>
	{!! Form::textarea('description', null, ['size' => '30x3', 'class' => 'form-control descripL', 'required']) !!}
	
	<h4>Agregar evento:</h4>
	<div class="input-group" style="width:300px">
  		{!! Form::text('eventName','', array('class' => 'form-control nameL','required')) !!}
  		<span class="input-group-btn">
	    	<button class="btn btn-info" type="button">Buscar</button>
	    </span>
	</div><!-- /input-group -->
	<br>
	<table class="table table-bordered table-striped">
	    <tr>
	        <th>Nombre</th>
	        <th>Categoría</th>
	        <th>Seleccionar</th>
	    </tr>
	    <tr>
	    	<td>Viva por el rock 6</td>
	    	<td>Concierto</td>
	    	<td><input type="radio" name="group1"></td>	
	    </tr>
	    <tr>
	    	<td>Viva la Fête</td>
	    	<td>Concierto</td>
	    	<td><input type="radio" name="group1"></td>
	    </tr>
	</table>    
	<div style="-webkit-columns: 100px 2;">
		<h4>Zona</h4>
		{!! Form::select('zone', ['VIP','Platea'],null,['class' => 'form-control','required']) !!}
		<h4>Tipo de Cliente</h4>
		{!! Form::select('zone', ['Niño','Adulto', 'Adulto Mayor'],null,['class' => 'form-control','required']) !!}
	</div>
	<br><br>
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#end" data-whatever="@mdo">Guardar</button>
	<button type="button" class="btn btn-info">Cancelar</button>
	<div class="modal fade" id="end" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title" id="exampleModalLabel">Promociones</h4>
		    	</div>
		    	<div class="modal-body">
		        	<form>
		              	<div class="form-group">
		                	<label for="exampleInputEmail2">Promoción agregada!</label>
		          		</div>
		        	</form>
		   		</div>
		    </div>
		</div> 
	</div>	
@stop

@section('javascript')

@stop
