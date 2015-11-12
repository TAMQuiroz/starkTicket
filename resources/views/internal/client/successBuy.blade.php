@extends('layout.client')

@section('style')
    <style type="text/css">
        .btn-info{
            background-color: #83D3C9;
            border-color: #83D3C9;
        }
        .btn-info:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
    </style>
@stop

@section('title')
	Compra exitosa
@stop

@section('content')
	<div class="col-md-12">Su compra se realizó con éxito.</div>
	<div class="col-md-12">Su codigo de comprobante es <b>{{$ticket->id}}</b>, uselo al momento de recoger sus entradas y muestre el documento de identidad de la persona asignada a recogerlas.</div>
	<div class="col-md-12">
		<div class="table-responsive">
		  <table class="table table-bordered" style="widht:1px">
		    <thead>
		        <tr>
		            <th>Evento</th>
		            <th>Fecha y Hora</th>
		            <th>Cantidad</th>
		            <th>Zona</th>
		            <th>Ubicación</th>
		            <th>Promocion</th>
		            <th>Precio Unitario</th>
		            <th>Precio Total</th>
		        </tr>
		    </thead>
		    <tbody>
		        <tr>
		        	<td>{{$ticket->event->name}}</td>
		        	<td>{{date("Y-m-d h:i", $ticket->presentation->starts_at)}}</td>
		        	<td>{{$ticket->quantity}}</td>
		            <td>{{$ticket->zone->name}}</td>  
		            <td>
		            	@if($ticket->event->place->rows != null)
		            		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#place{{$ticket->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button>
						@else
		            		No numerado
		            	@endif	            
		            </td>

			            <!-- MODAL view-->
			            <div class="modal fade" id="place{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			                <div class="modal-dialog" role="document">
			                  <div class="modal-content">
			                    <div class="modal-header">
			                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                      <h4 class="modal-title" id="exampleModalLabel">Asientos comprados: {{$ticket->event->name}}</h4>
			                    </div>
			                    <div class="modal-body">
			                      <form>
			                        <div class="form-group">
			                          <h4>Asientos:</h4>
			                          <ul>
			                            @foreach($seats as $seat)
			                              <li>
			                                  F{{$seat->row}}C{{$seat->column}}

			                              </li>
			                            @endforeach
			                          </ul>
			                        </div>

			                      </form>
			                  
			                    </div>
			                    <div class="modal-footer">
			                      <button type="button" class="btn btn-info" data-dismiss="modal" >Aceptar</button>


			                    </div>
			                  </div>
			                </div>
			              </div>

		            @if($ticket->promo)
		            <td>{{$ticket->promo->name}}</td>
		            @else
		            <td>No tiene</td>
		            @endif
					<td>S/. {{$ticket->price}}</td>
		            @if($ticket->promo && $ticket->promo->carry != null)
		            <td>S/. {{$ticket->price * $ticket->quantity - ($ticket->price*floor($ticket->quantity/$ticket->promo->carry))}}</td>
		            @else
		            <td>S/. {{$ticket->price * $ticket->quantity - ($ticket->price * $ticket->quantity * $ticket->discount/100)}}</td>
		            @endif
		        </tr>
		    </tbody>
		  </table>
		</div>
	</div>
	<div class="col-md-12">
		<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#correo" data-whatever="@mdo">Enviar por Correo</button></td>
		<td><a href="{{url('client/home')}}"><button type="button" class="btn btn-info">Finalizar</button></a></td>
	</div>
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
				    {!! Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail', 'required')) !!}
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