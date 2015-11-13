@extends('layout.admin')

@section('style')

@stop

@section('title')
	Reporte de asignación
@stop

@section('content')
<div class="row">
    <div class="col-sm-3">
        <label>Seleccione el punto de venta</label>
        <!--
        <select class="form-control">
          <option value="0">Todos los puntos de venta</option>
          <option value="1">La Molina</option>
          <option value="2">San Borja</option>
          <option value="3">La Perla</option>
        </select>
        -->
        
        {!!Form::select('nameEvent', $modules_list->toArray(), null ,['class'=>'form-control', 'id'=>'search','placeholder' => 'Nombre del Punto'])!!}
        
    </div>
     <div class="col-sm-3">
    <label>Seleccione el tipo de empleado</label>

        <!--
        <select class="form-control">
          <option value="0">Todos los empleados</option>
          <option value="1">Vendedores</option>
          <option value="2">Promotores de Venta</option>
          <option value="3">Administradores</option>
        </select>
        -->
        {!!Form::select('select2', [
           'op0' => 'Todos',
           'op1' => 'Vendedor',
           'op2' => 'Promotor',
           'op3' => 'Administrador'],
           null,
           ['class' => 'form-control']
        )!!}
         </div>
    <div class="col-sm-2">
        <label>Desde</label>
        <input type="date" class="form-control">
    </div>
    <div class="col-sm-2">
        <label>Hasta</label>
        <input type="date" class="form-control">
    </div>
    <div class="col-sm-3">
        <br>
        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo2">Mostrar Reporte</button>
    </div>
</div>
<hr>


<div id="demo2" class="collapse">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Punto de Venta</th>
            <th>Nombres y Apellidos</th>
            <th>Fecha de Asignación</th>
            <th>Fecha de Desasociación</th>
            <th>Tipo de Empleado</th>
        </tr>
        @foreach($assiInformation as $assig)
        <tr>
            <td>{{$assig[0]}}</td>
            <td>{{$assig[1]}} {{$assig[2]}}</td>
            <td>{{$assig[3]}}</td>
            <td>{{$assig[4]}}</td>
            <td>{{$assig[5]}}</td>
        </tr>
        @endforeach

    </table>
</div>

@stop

@section('javascript')

@stop