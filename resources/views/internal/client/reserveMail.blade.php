<h5>CONFIRMACIÓN DE RESERVA</h5>

<div>A continuación te mostramos los datos.</div>

<table class="table table-bordered" style="width:1px">
	<thead>
	    <tr>
	        <th>Evento</th>
	        <th>Fecha y Hora</th>
	        <th>Zona</th>
	        <th>Cantidad</th>
	        <!--<th>Ubicación</th>-->
	        <th>Promocion</th>
	        <th>Precio Unitario</th>
	        <th>Precio Total</th>
	    </tr>
	</thead>
	<tbody>
	    <tr>
	    	<td>{{$tickets->first()->event->name}}</td>
	    	<td>{{$tickets->first()->presentation->starts_at}}</td>
	    	<td>{{$tickets->first()->zone->name}}</td>
	    	<td>{{$tickets->first()->quantity}}</td>
	        @if($tickets->first()->promo)
	        <td>{{$tickets->first()->promo->name}}</td>
	        @else
	        <td>No tiene</td>
	        @endif
	        <td>S/. {{$tickets->first()->price}}</td>
	        <td>S/. {{$tickets->first()->total_price}}</td>
	    </tr>
	</tbody>
</table>