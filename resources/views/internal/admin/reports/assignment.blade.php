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
        <select class="form-control">
          <option value="volvo">Todos los puntos de venta</option>
          <option value="saab">La Molina</option>
          <option value="opel">San Borja</option>
          <option value="audi">La Perla</option>
        </select>
        
    </div>
     <div class="col-sm-3">
    <label>Seleccione el tipo de empleado</label>
        <select class="form-control">
          <option value="volvo">Todos los empleados</option>
          <option value="saab">Vendedores</option>
          <option value="opel">Promotores de Venta</option>
          <option value="audi">Administradores</option>
        </select>
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