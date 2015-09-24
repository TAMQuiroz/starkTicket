@extends('layout.client')

@section('style')
    
@stop

@section('title')
	Compra exitosa
@stop

@section('content')
	Su compra se realizó con éxito.
	<div class="table-responsive">
	  <table class="table table-bordered" style="widht:1px">
	    <thead>
	        <tr>
	            <th>Evento</th>
	            <th>Fecha</th>
	            <th>Hora</th>
	            <th>Zona</th>
	            <th>Ubicación</th>
	            <th>Precio</th>
	        </tr>
	    </thead>
	    <tbody>
	        <tr>
	        	<td>Piaf</td>
	        	<td>13 Octubre 2015</td>
	        	<td>9:00pm</td>
	            <td>VIP</td>  
	            <td>A14</td>
	            <td>S/150.00</td>
	        </tr>
	        <tr>
	            <td>Piaf</td>
	        	<td>13 Octubre 2015</td>
	        	<td>9:00pm</td>
	            <td>VIP</td>  
	            <td>A15</td>
	            <td>S/150.00</td>
	        </tr>
	    </tbody>
	  </table>
	</div>

	<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#correo" data-whatever="@mdo">Enviar por Correo</button></td>
	<td><button type="button" class="btn btn-info"><a href="{{url('event/1')}}">Finalizar</a></button></td>
	<div class="modal fade" id="correo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="exampleModalLabel">Envío por Correo</h4>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
            	<h4>Ingrese correo:</h4>
				  <div class="form-group">
				    <label for="exampleInputEmail2">Email</label>
				    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
				  </div>
				  <button type="submit" class="btn btn-info">Enviar</button>
				  <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
		          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        
	      </div>
	    </div>
	  </div>
	</div>
@stop

@section('javascript')

@stop