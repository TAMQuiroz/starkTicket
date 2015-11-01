@extends('layout.admin')

@section('style')

@stop

@section('title')
Asistencia de Pedro Alva
@stop

@section('content')
<div class="row">
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
 
        <th></th>




        <th> {{$dateParStart->format('l')}}  </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
  </tr>
    </thead>
        <tbody>
  <tr>
    <td>Fecha registro</td>
    <td> {{$dateParStart->format('d/m/y')}}    </td>
    <td>{{$dateParStart->addDay(1)->format('d/m/y')}}</td>
    <td>{{$dateParStart->addDay(2)->format('d/m/y')}}</td>
    <td>{{$dateParStart->addDay(3)->format('d/m/y')}}</td>
    <td>{{$dateParStart->addDay(4)->format('d/m/y')}}</td>
    <td>{{$dateParStart->addDay(5)->format('d/m/y')}}</td>
  </tr>
  <tr>
    <td>Hora Ingreso</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>-</td>
    <td>8:00 am</td>
  </tr>
  <tr>
    <td>Hora Salida</td>
    <td>5:30 pm</td>
    <td>4:00 pm</td>
    <td>5:00 pm</td>
    <td>5:30 pm</td>
    <td>-</td>
    <td>6:00 pm</td>
  </tr>
  <tr>
    <td>Total horas</td>
    <td>8.5</td>
    <td>8</td>
    <td>9</td>
    <td>9.5</td>
    <td>0</td>
    <td>10</td>
  </tr>

  <tr>
    <td>Detalle</td>
    
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>

  </tr>



         </tbody>
</table>

<br>
<table class="table table-bordered table-striped">
    <thead>
  <tr>  
 
        <th></th>




        <th> {{$dateParStart->format('l')}}  </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
        <th>{{$dateParStart->addDay(1)->format('l')}} </th>
  </tr>
    </thead>
        <tbody>
  <tr>
    <td>Fecha registro</td>
    <td> {{$dateParStart->format('d/m/y')}}    </td>
    <td>{{$dateParStart->addDay(1)->format('d/m/y')}}</td>
    <td>{{$dateParStart->addDay(2)->format('d/m/y')}}</td>
    <td>{{$dateParStart->addDay(3)->format('d/m/y')}}</td>
    <td>{{$dateParStart->addDay(4)->format('d/m/y')}}</td>
    <td>{{$dateParStart->addDay(5)->format('d/m/y')}}</td>
  </tr>
  <tr>
    <td>Hora Ingreso</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>-</td>
    <td>8:00 am</td>
  </tr>
  <tr>
    <td>Hora Salida</td>
    <td>5:30 pm</td>
    <td>4:00 pm</td>
    <td>5:00 pm</td>
    <td>5:30 pm</td>
    <td>-</td>
    <td>6:00 pm</td>
  </tr>
  <tr>
    <td>Total horas</td>
    <td>8.5</td>
    <td>8</td>
    <td>9</td>
    <td>9.5</td>
    <td>0</td>
    <td>10</td>
  </tr>

  <tr>
    <td>Detalle</td>
    
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>
    <td><a  class="btn btn-info" href="{{url('admin/attendance')}}" title="Asistencia" ><i class="glyphicon glyphicon-time"></i></a></td>

  </tr>



         </tbody>
</table>


@stop

@section('javascript')

@stop

