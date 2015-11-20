@extends('layoutExternal')

@section('style')
	 {!!Html::style('css/images.css')!!}
    <style type="text/css">
        #nav .third{
            color: white;
        }
        .input-group{
            width:600px;
        }
        .btn-primary{
            background-color: #83D3C9;
            border-color: #83D3C9;
            margin-left: 50px;
        }
        .btn-primary:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
    </style>
@stop

@section('title')
	Calendario
@stop

@section('content')
	
	<!--
  <div class="row">
    <div class="col-sm-10">
      {!!Form::open(array('url' => 'calendar','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">Buscar Fecha</label>
        <div class="col-sm-3">
          {!!Form::date('firstDate',\Carbon\Carbon::now() ,['class'=>'form-control','id'=>'firstDate'])!!} 
        </div>
        <div class="col-sm-2">
          <a  class="btn btn-info" href="" title="submit" >Buscar Eventos</a>
        </div>

      </div>
      
      {!!Form::close()!!}
    </div> 

  </div>-->
  <header>
		<h3>Eventos del {{ date_format(date_create(\Carbon\Carbon::now()),"d/m/Y")}} </h3>

	</header>
	@if (count($eventInformation)>0)
		<div class="row">
			@foreach($eventInformation as $event)
			<div class="4u">
				<section>
		            <a href="#" class="image full">{!! Html::image($event[0], null, array('class'=>'image cat_img')) !!}</a>
		            <h3>{{$event[1]}}</h3>
		            <p>
		                
		                <b>Lugar: </b> {{$event[2]}} <br>
		                <b>Direccion:</b> {{$event[3]}} <br>
		                <b>Categoria:</b> {{$event[4]}} <br>
		            </p>
		            <p><a href="event/{{$event[5]}}"  class="btn btn-primary" role="button" >Detalle</a></p>
		        </section>
			</div>
			@endforeach
		</div>
		@else
        	<div class="alert alert-danger">No hay eventos para esta fecha</div>
    	@endif
	


@stop

@section('javascript')
@stop