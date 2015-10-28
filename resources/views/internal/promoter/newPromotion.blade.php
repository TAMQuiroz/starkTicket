




@extends('layout.promoter')

@section('style')


@stop

@section('title')
  Nueva promocion
@stop







@section('content')
 {!!Form::open(array('url' => 'promoter/promotion/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
	<h3>Seleccione evento a relacionar</h3>
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
		    	<td> {!! Form::radio('evento', $event->id ,   (Input::old('evento') == $event->id ), array('id'=>'true', 'class'=>'radio  evento_id'         ,'required'   ))  !!} </td>	
		    </tr>

	    	@endforeach
		</tbody>
	</table>  




	<hr>
	<br>
	<h3>Ingrese información de promoción</h3>
	<div>
		<div style="width: 500px ;">
			<h4>Nombre</h4>
			{!! Form::text('promotionName','', array('class' => 'form-control', 'maxlength'=>'70', 'required')) !!}		
		</div>
		<br>
		<div style="-webkit-columns: 100px 4;">
			<h4>Fecha Inicio</h4>
			{!! Form::date('dateIni','', array('class' => 'form-control' , 'required')) !!}

	<h4>Hora Inicio</h4>
			{!! Form::time('timeIni','', array('class' => 'form-control', 'required')) !!}
			
			<h4>Fecha Fin</h4>
			{!! Form::date('dateEnd','', array('class' => 'form-control', 'required')) !!}
		
			<h4>Hora Fin</h4>
			{!! Form::time('timeEnd','', array('class' => 'form-control', 'required')) !!}
		</div>
		<h4>Descripción</h4>
		{!! Form::textarea('description', '' ,  ['size' => '30x3', 'class' => 'form-control', 'maxlength'=>'400', 'required']) !!}
	</div>
	<br><br><br>
	<hr>
	<h3>Seleccione el tipo de promoción</h3>
	<br>
	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
	        DESCUENTOS</a>
	      </h4>
	    </div>
	    <div id="collapse1" class="panel-collapse collapse">
	    	<div style="-webkit-columns: 100px 2;">
		      	<h4>Seleccione el acceso a la promocion</h4>
			{!! Form::select('access_id',   $accessPromotion->toArray()     ,null,['class' => 'form-control']) !!}






				<h4>Descuento (%)</h4>
				{!! Form::number('discount','', array('class' => 'form-control', 'min'=>'0', 'max'=>'100', 'required')) !!}
			
			</div>
			<br><br>
			
	    </div>
	  </div>



	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
	        OFERTAS</a>
	      </h4>
	    </div>
	    <div id="collapse2" class="panel-collapse collapse">

	<div style="-webkit-columns: 100px 2;">
		      	<h4>Lleve : </h4>
			{!! Form::number('carry','', array('class' => 'form-control' )) !!}	
				<h4>Pague por : </h4>
				{!! Form::number('pay','', array('class' => 'form-control' )) !!}	
			</div>


		    <div style="width: 500px ;">
				<h4>Zona</h4>
				{!! Form::select('zone', ['Seleccione Evento'],null,['class' => 'form-control'  , 'id'=>'id_zoneCombo'  ]) !!}
		
			</div>
			<br><br>
		
	    </div>
	  </div>

	<br><br>

<p class ="text-center"  >  

	<legend>Seleccione los datos del evento</legend>

<br>



<button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#end" data-whatever="@mdo">Guardar</button>
	<a href="{{url('promoter/promotion')}}"><button type="button" class="btn btn-info btn-lg">Cancelar</button></a>


</p>
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
	  	});



	 	$(".evento_id").click(function(){ // punto para michis , michis para id, id es unico 
          variable  =  $( this).val() ;

      url_base = "{{ url('/') }}";

 // Peticion ajax
     $.getJSON( url_base + "/promoter/promotion/new/"+variable  , function(data)
     {
       $("#id_zoneCombo").empty();
       $.each( data, function( id, name ) {
           $('#id_zoneCombo').append("<option value=\""+id+"\">"+name+"</option>");
     });


     })





  		});

   



   




	});
	</script>














<script>
 $(document).ready(function(){
   // Poblar sub category
   $("#category_id").change(function(){

     category_id = $("#category_id").val();
     url_base = "{{ url('/') }}";
     // Peticion ajax
     $.getJSON(url_base+"/promoter/"+category_id+"/subcategories", function(data)
     {
       $("#subcategory_id").empty();
       $.each( data, function( id, name ) {
           $('#subcategory_id').append("<option value=\""+id+"\">"+name+"</option>");
     });

     })
   });
 });
 </script>








@stop
