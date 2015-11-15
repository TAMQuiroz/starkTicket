<h5>CONFIRMACIÓN DE COMPRA</h5>

<div>A continuación te mostramos los datos.</div>

<table class="table table-bordered" style="width:1px">
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
	        		@foreach($seats as $seat)
                      <li>
                          F{{$seat->row}}C{{$seat->column}}

                      </li>
                    @endforeach
				@else
	        		No numerado
	        	@endif	            
	        </td>
	        @if($ticket->promo)
	        <td>{{$ticket->promo->name}}</td>
	        @else
	        <td>No tiene</td>
	        @endif
			<td>S/. {{$ticket->price}}</td>
	        <td>S/. {{$ticket->total_price}}</td>
	    </tr>
	</tbody>
</table>

