@extends('layout.salesman')

@section('style')

@stop

@section('title')
	Entrega de entrada
@stop

@section('content')
	<h5>Ingrese Código de Comprobante</h5>
    <div class="input-group" style="width:290px">
        <input type="text" class="form-control" placeholder="Código de comprobante">
        <span class="input-group-btn">
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#detail">Buscar</button>
        </span>
    </div><!-- /input-group -->

    <div id="detail" class="collapse">
        <br>
        <h5>Detalle de compra:</h5>
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
            </tbody>
          </table>
          <button class="btn btn-info" data-toggle="modal" data-target="#confirm">Confirmar</button>

          	<div class="modal fade" id="confirm">
			  	<div class="modal-dialog">
			    	<div class="modal-content">
			      		<div class="modal-header">
		        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        		<h4 class="modal-title">Confirmacion exitosa!</h4>
			      		</div>
				      	<div class="modal-body">
				        	<p>Puede entregar el ticket.&hellip;</p>
				      	</div>
				      	<div class="modal-footer">
				        	<a href="{{url('salesman/giveaway')}}">
				        		<button type="button" class="btn btn-info">Regresar</button>
				        	</a>
				      	</div>
			    	</div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
        </div>
    </div>
        
@stop

@section('javascript')

@stop