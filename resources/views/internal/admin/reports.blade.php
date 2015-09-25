@extends('layout.admin')

@section('style')

@stop

@section('title')
<<<<<<< HEAD
	<div class="row">
    <div class="col-sm-3">
        <label>Seleccione al vendedor</label>
        <select class="form-control">
          <option value="volvo">Todos los vendedores</option>
          <option value="saab">Juan Perez</option>
          <option value="opel">Ana García</option>
          <option value="audi">Miguel Guanira</option>
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
    <div class="col-sm-2">
        <label>Tipo</label>
        <select class="form-control">
          <option value="opel">Tabla</option>
          <option value="volvo">Excel</option>
          <option value="saab">PDF</option>
        </select>
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
            <th>Apellidos y Nombres</th>
            <th>DNI</th>
            <th>Telefonos(s)</th>
            <th>Sexo</th>
        </tr>
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
        </tr>
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
        </tr>
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
        </tr>
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
        </tr>
    </table>
</div>
=======
	Lista de reportes
>>>>>>> 8d83106d0b2b7240742c85592125392c81b12dd8
@stop

@section('content')

@stop

@section('javascript')

@stop