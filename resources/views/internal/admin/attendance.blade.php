@extends('layout.admin')

@section('style')

@stop

@section('title')
Asistencia de   {{$salesman->name}}  {{$salesman->lastname}}

@stop


@section('content')
<div class="row">
 {!!Form::open(array('url' => 'admin/'.$salesman->id.'/attendanceSubmit' ,'files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
 



 <div class="col-sm-3"><label>Desde:</label>

  {!! Form::date('dateIni', $dateParStart  , array('class' => 'form-control' , 'required')) !!}

</div>

<div class="col-sm-3"><label>Hasta</label>
  {!! Form::date('dateEnd',   $dateParEnd  , array('class' => 'form-control', 'oninput' => 'incrementDate()', 'required')) !!}

</div>
<div class="col-sm-3"><br><input type="submit" value="Filtrar" class="btn btn-info"></div>
</div>


<hr>

<table class="table table-bordered table-striped">
  <thead>
    <tr>  

      <th>Nombre de Día</th>
      <th>Fecha  </th> 
      <th>Hora de ingreso </th>
      <th>Hora de salida  </th>
      <th>Total de horas </th>
      <th>Detalle </th>

    </tr>
  </thead>


  @foreach( $Attendances as $Attendance )

  <tbody>
    <tr>



    @if (date( "l", strtotime(  $Attendance->datetime)) == 'Monday')  <td> Lunes  </td>  @endif
    @if (date( "l", strtotime(  $Attendance->datetime)) == 'Tuesday')   <td> Martes  </td> @endif
    @if (date( "l", strtotime(  $Attendance->datetime)) == 'Wednesday') <td> Miercoles  </td> @endif
    @if (date( "l", strtotime(  $Attendance->datetime)) == 'Thursday') <td> Jueves  </td>  @endif
    @if (date( "l", strtotime(  $Attendance->datetime)) == 'Friday')  <td> Viernes  </td>  @endif
    @if (date( "l", strtotime(  $Attendance->datetime)) == 'Saturday') <td> Sábado  </td> @endif
    @if (date( "l", strtotime(  $Attendance->datetime)) == 'Sunday') <td> Domingo  </td> @endif

    <td>{{  date( "d -m - Y", strtotime(  $Attendance->datetime))    }} </td>
    <td> {{  date( "g:ia", strtotime(  $Attendance->datetimestart))    }}   </td>


    @if ( $Attendance->datetimeend ==NULL )
    <td>No se registro</td>
    @else
    <td> {{  date( "g:ia", strtotime(  $Attendance->datetimeend  ))    }}  </td>
    @endif


    @if ( $Attendance->datetimeend ==NULL )
    <td>  </td>
    @else
    <td> {{ round((strtotime( $Attendance->datetimeend ) - strtotime(  $Attendance->datetimestart ) ) / 3600 , 2) }}  horas </td>
    @endif



     <td><a  class="btn btn-info" href="{{ url('admin/attendance/'.$Attendance->id.'/detail') }}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
   </tr>
 </tbody>



 @endforeach

</table>

<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{route('admin.salesman')}}" class="btn btn-info">Regresar</a>
    </div>
</div>


@stop

@section('javascript')

@stop

