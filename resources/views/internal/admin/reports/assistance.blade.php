@extends('layout.admin')

@section('style')
{!!Html::style('css/datepicker.css')!!}
@stop

@section('title')
	Reporte de Asistencia
@stop

@section('content')
{!!Form::open(array('url' => 'admin/report/assistance', 'id'=>'form','class'=>'form-horizontal'))!!}
<!--<div class="col-sm-3">
    <label>Ingrese nombre del evento</label>
    {!!Form::text('name', null ,['class'=>'form-control', 'id'=>'search','placeholder' => 'Nombre del evento'])!!}
</div>
<div class="col-sm-9">
    <div class="col-sm-4">
        <label>Desde</label>
        {!!Form::input('date','firstDate', null ,['class'=>'form-control','id'=>'fecha-ini', 'required'])!!}
    </div>
    <div class="col-sm-4">
        <label>Hasta</label>
        {!!Form::input('date','lastDate', null ,['class'=>'form-control','id'=>'fecha-fin','required'])!!}
    </div>
    <div class="col-sm-4"><br><button class="btn btn-info" type="button" id = 'botoncito' >Buscar</button></div>
</div> -->
<div class="container">
  <div class="row">
    <div class="col-sm-6"> </div>
    <div class="col-sm-5 pull-right">
      {!!Form::open(array('id'=>'form','class'=>'form-inline'))!!}
      {!! Form::hidden('ty_report', 1,['id'=>'type'])!!}
        <div class="form-group">
          <input type="text" class="form-control" id="datepicker" placeholder="Fecha" required name="date_at">
        </div>
        <input type="submit" value="Buscar eventos" class="btn btn-info">
      </form>
      </div>
  </div>
</div>
{!!Form::close()!!}
{!!Form::open(array('url' => 'admin/report/assistance', 'id'=>'form','class'=>'form-horizontal'))!!}
<div class="col-sm-12">
<hr>
  {!! Form::hidden('ty_report', 2,['id'=>'type'])!!}
   {!! Form::hidden('date_at', $date_at,['id'=>'date_at'])!!}
  <h3>Reporte del {{$date_at}}</h3>
  <hr>
    <table class="table table-bordered table-striped" id="example">
          <tr>
              <th>Nombres y Apellidos</th>
            
              <th>Hora de Ingreso</th>
              <th>Hora de Salida</th>
              <th>Situación Temprano</th>
              <th>Situación Salida</th>
              <th>Punto de Venta</th>
          </tr>
          <tbody id="fbody">
          @foreach($assiInformation as $assi)
          <tr>
              <td>{{$assi[0]}} {{$assi[1]}}</td>
       
              @if (strcmp($assi[2], "-") != 0 )
                <td>{{date_format(date_create($assi[2]),"H:i:s")}}</td>
              @else
                <td>{{$assi[2]}}</td>
              @endif  
              @if (strcmp($assi[3], "-") != 0 )
                <td>{{date_format(date_create($assi[3]),"H:i:s")}}</td>
              @else
                <td>{{$assi[3]}}</td>
              @endif   
              <td>{{$assi[4]}}</td>
              <td>{{$assi[5]}}</td>
              <td>{{$assi[6]}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
  <h5>Seleccione el tipo de formato de su reporte</h5>  
  <div class="col-sm-2">
          {!!Form::select('type', [
             '1' => 'Excel',
             '2' => 'PDF'],
             null,
             ['class' => 'form-control']
          )!!}
  </div>

  <div class="col-sm-2">
      <button type="submit" class="btn btn-info">Descargar Archivo</button>
  </div>
</div>
{!!Form::close()!!}
@stop

@section('javascript')
  {!!Html::script('js/jquery-ui.min.js')!!}
<script>
  (function() {
    $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd" ,
            minDate: "-2y" ,
            maxDate: 0,
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