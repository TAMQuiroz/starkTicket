@extends('layout.admin')

@section('style')

@stop

@section('title')
Asistencia de Pedro Alva
@stop

@section('content')
<div class="row">
    <div class="col-sm-3"><label>Desde:</label>
        <input type="date" class="form-control">
    </div>
    <div class="col-sm-3"><label>Hasta</label>
        <input type="date" class="form-control">
    </div>
    <div class="col-sm-3"><br><input type="submit" value="Listar" class="btn btn-primary"></div>
</div>
<hr>
<table class="table table-bordered table-striped">
  <tr>
    <th></th>
    <th>Lunes</th>
    <th>Martes</th>
    <th>Miercoles</th>
    <th>Jueves</th>
    <th>Viernes</th>
    <th>Sabado</th>
  </tr>
  <tr>
    <td>Fecha registro</td>
    <td>14/09/2015</td>
    <td>15/09/2015</td>
    <td>16/09/2015</td>
    <td>17/09/2015</td>
    <td>18/09/2015</td>
    <td>19/09/2015</td>
  </tr>
  <tr>
    <td>Hora Ingreso</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
    <td>8:00 am</td>
  </tr>
  <tr>
    <td>Hora Salida</td>
    <td>5:30 pm</td>
    <td>4:00 pm</td>
    <td>5:00 pm</td>
    <td>5:30 pm</td>
    <td>5:30 pm</td>
    <td>6:00 pm</td>
  </tr>
  <tr>
    <td>Total horas</td>
    <td>8.5</td>
    <td>8</td>
    <td>9</td>
    <td>9.5</td>
    <td>9.5</td>
    <td>10</td>
  </tr>
</table>
@stop

@section('javascript')

@stop