@extends('layout.promoter')

@section('style')
@stop

@section('title')
  Editar promocion
@stop

@section('content')

{!!Form::open(array('url' => 'promoter/promotion/'.$promotion->id.'/edit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
	<br>
 
			<div style="width: 500px ;">
		<h3>Nombre del Evento</h3>
			{!! Form::text( '' , $event->name , array('class' => 'form-control', 'maxlength'=>'70','disabled' => 'disabled' ,'required')) !!}		
			</div>


	

	<hr>
	
	<h3>Datos de la promoción</h3>
	<div>
		<div style="width: 500px ;">
			<h4>Nombre</h4>
			{!! Form::text('promotionName', $promotion->name  , array('class' => 'form-control', 'maxlength'=>'70', 'required')) !!}		
		</div>
		<br>
		<div style="-webkit-columns: 100px 4;">
			<h4>Fecha Inicio</h4>
			{!! Form::date('dateIni', $startDay  , array('class' => 'form-control' , 'required')) !!}

			<h4>Hora Inicio</h4>
			{!! Form::time('timeIni',  $startHour , array('class' => 'form-control', 'required')) !!}


			<h4>Fecha Fin</h4>
			{!! Form::date('dateEnd',$endDay   , array('class' => 'form-control', 'oninput' => 'incrementDate()', 'required')) !!}
	
			<h4>Hora Fin</h4>
			{!! Form::time('timeEnd', $finishHour, array('class' => 'form-control', 'required')) !!}
		</div>
		<h4>Descripción</h4>
		{!! Form::textarea('description', $promotion->description  , ['size' => '30x4', 'class' => 'form-control', 'maxlength'=>'400', 'required']) !!}
	</div>
	<br>
	<hr>
 

  @if($promotion->typePromotion == 1)
<h3>Tipo de promoción:  Descuento  </h3>



<div style="-webkit-columns: 100px 2;">
		      	<h4>Seleccione el acceso a la promocion</h4>
				{!! Form::select('access_id',  $accessPromotion  ,  $promotion->access_id    ,['class' => 'form-control']) !!}


				<h4>Descuento (%)</h4>
				{!! Form::number('discount',$promotion->desc , array('class' => 'form-control', 'min'=>'0', 'max'=>'100', 'required')) !!}
			</div>





            @else


<h3>Tipo de promoción: Oferta </h3>



		<div style="-webkit-columns: 100px 2;">
		      	<h4>Lleve : </h4>
			{!! Form::number('carry',$promotion->carry , array('class' => 'form-control' )) !!}	
				<h4>Pague por : </h4>
				{!! Form::number('pay', $promotion->pay , array('class' => 'form-control' )) !!}	
			</div>
		    <div style="width: 500px ;">
				<h4>Zona</h4>
				{!! Form::select('zone',     $zones       ,      $promotion->zone_id   ,['class' => 'form-control']) !!}
			</div>




            @endif

	<br>
	<!--<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#save" data-whatever="@mdo">Guardar</button>-->
	<p class ="text-center"  >  
		<button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target="#save" data-whatever="@mdo">Guardar</button>
		<a href="{{url('promoter/promotion')}}"><button type="button" class="btn btn-info btn-lg">Cancelar</button></a>
	</p>

@stop

         {!!Form::close()!!}

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
	function incrementDate(){
    var publication_date = document.getElementsByName('dateIni')[0].value;
    document.getElementsByName('dateIni')[0].stepUp();
    var publication_date_1 = document.getElementsByName('dateIni')[0].value;
    document.getElementsByName('dateIni')[0].stepDown();
    var today = new Date();
    var publicDate = new Date(document.getElementsByName('dateIni')[0].value);
    var timeToday = today.getTime();
    var timePublic = publicDate.getTime();
    var month = today.getMonth() +1;
    if(timeToday > timePublic)
      document.getElementsByName('dateEnd')[0].min = ''+today.getFullYear()+'-'+month+'-'+today.getDate();
    else
      document.getElementsByName('dateEnd')[0].min = publication_date_1;
  }
	</script>

@stop