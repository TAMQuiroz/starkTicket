@extends('layoutExternal')

@section('style')
	{!!Html::style('css/datepicker.css')!!}
	{!!Html::style('css/images.css')!!}
@stop
@section('title')
{{date('Y-M-d',$date_at)}}
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-6">Eventos de {{date('Y-m-d',$date_at)}}</div>
		<div class="col-sm-5 pull-right">
			{!!Form::open(array('id'=>'form','class'=>'form-inline'))!!}
			  <div class="form-group">
			  	<input type="text" class="form-control" id="datepicker" placeholder="Fecha" required name="date_at">
			  </div>
			  <input type="submit" value="Buscar eventos" class="btn btn-info">
			</form>
	    </div>
	</div>
</div>
<hr>
@if(count($events)===0)
<div class="alert alert-warning"> Eventos no encontrados en esta fecha</div>
@else
	<div class="row">
	    @foreach($events as $event)
	    <div class="3u">
	        <section>
	            <a href="#" class="image full">{!! Html::image($event->image, null, array('class'=>'image cat_img')) !!}</a>
	            <h3>{{$event->name}}</h3>
	            <p>
	                <b>Fecha de venta: </b> {{date('Y-m-d',$event->selling_date)}}<br>
	                <b>Lugar: </b> {{$event->place->name}} <br>
	                <b>Direccion:</b> {{$event->place->address}} <br>
	            </p>
	            <p><a href="event/{{$event->id}}"  class="btn btn-primary" role="button" >Detalle</a></p>
	        </section>
	    </div>
	    @endforeach
	</div>
@endif

@stop

@section('javascript')
  {!!Html::script('js/jquery-ui.min.js')!!}
<script>
  (function() {
    $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd" ,
            minDate: 0 ,
            maxDate: "+2Y",
            beforeShow: function() {
                setTimeout(function(){
                    $('.ui-datepicker').css('z-index', 9999);
                }, 0);
            }
        }).on("change", function(e) {
            var curDate = $(this).datepicker("getDate");
            var maxDate = new Date();
            maxDate.setDate(maxDate.getDate() + 720);
            maxDate.setHours(0, 0, 0, 0);
            if (curDate > maxDate)
            {
                $(this).val("");
                $(this).addClass("red");
            } else {
                $(this).removeClass("green");
            }
        });
    })();
  </script>
@stop