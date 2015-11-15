<h5>CONFIRMACIÓN DE RESERVA</h5>

<div>A continuación te mostramos los datos.</div>

<table class="table table-bordered" style="width:1px">
	<thead>
	    <tr>
	        <th>Evento</th>
	        <th>Fecha y Hora</th>
	        <th>Zona</th>
	        <th>Cantidad</th>
	        <!--<th>Ubicación</th>
	        <th>Promocion</th>
	        <th>Precio Unitario</th>
	        <th>Precio Total</th>-->
	    </tr>
	</thead>
	<tbody>
	    <tr>
	    	<td>{{$tickets->first()->event->name}}</td>
	    	<td>{{$tickets->first()->eventDate}}</td>
	    	<td>{{$tickets->first()->zone->name}}</td>
	    	<td>{{$tickets->first()->cant}}</td>
	    </tr>
	</tbody>
</table>