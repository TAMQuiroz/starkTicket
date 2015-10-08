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
        {!!Form::select('select1', [
           'op0' => 'Todos los puntos de venta',
           'op1' => 'La Molina',
           'op2' => 'San Borja',
           'op3' => 'La Perla'],
           null,
           ['class' => 'form-control']
        )!!}
        
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
           'op0' => 'Todos los empleados',
           'op1' => 'Vendedores',
           'op2' => 'Promotores de venta',
           'op3' => 'Administradores'],
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
            <th>Tipo de Empleado</th>
        </tr>
        <tr>
            <td>La Molina</td>
            <td>Pepito Marquez</td>
            <td>Vendedor</td>
        </tr>
        <tr>
            <td>San Borja</td>
            <td>Wendy Perez</td>
            <td>Administrador</td>
        </tr>

    </table>
</div>

@stop

@section('javascript')

@stop