@extends('layoutExternal')

@section('style')
	{!!Html::style('css/datepicker.css')!!}
@stop
@section('content')
<div class="container">
<div class="row">
	<div class="col-sm-6">Fecha de hoy</div>
	<div class="col-sm-5 pull-right">
		{!!Form::open(array('url' => 'salesman/ticket/repay','id'=>'form','class'=>'form-inline'))!!}
		  <div class="form-group">
		  	<input type="text" class="form-control" id="datepicker" placeholder="Fecha" required name="date_at">
		  </div>
		  <input type="submit" value="Buscar eventos" class="btn btn-info">
		</form>
    </div>
</div>
<hr>

</div>

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