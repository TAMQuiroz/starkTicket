@extends('layout.admin')

@section('style')

@stop

@section('title')
	Lista de Administradores
@stop

@section('content')
  <!-- Contenido-->
  <table class="table table-bordered table-striped">
      <tr>
          <th>Apellidos y Nombres</th>
          <th>DNI</th>
          <th>Telefonos(s)</th>
          <th>Estado C</th>
          <th>Sexo</th>
          <th></th>
      </tr>
      <tr>
          <td>Contenido 1</td>
          <td>Contenido 2</td>
          <td>Contenido 3</td>
          <td>Contenido 4</td>
          <td>Contenido 5</td>
          <td><a href="#">Editar</a> <a href="detalles">Detalles</a> <a href="">Eliminar</a> </td>
      </tr>
      <tr>
          <td>Contenido 1</td>
          <td>Contenido 2</td>
          <td>Contenido 3</td>
          <td>Contenido 4</td>
          <td>Contenido 5</td>
          <td><a href="#">Editar</a> <a href="detalles">Detalles</a> <a href="">Eliminar</a> </td>
      </tr>
      <tr>
          <td>Contenido 1</td>
          <td>Contenido 2</td>
          <td>Contenido 3</td>
          <td>Contenido 4</td>
          <td>Contenido 5</td>
          <td><a href="#">Editar</a> <a href="detalles">Detalles</a> <a href="">Eliminar</a> </td>
      </tr>
      <tr>
          <td>Contenido 1</td>
          <td>Contenido 2</td>
          <td>Contenido 3</td>
          <td>Contenido 4</td>
          <td>Contenido 5</td>
          <td><a href="#">Editar</a> <a href="detalles">Detalles</a> <a href="">Eliminar</a> </td>
      </tr>
  </table>
  <nav>
      <ul class="pagination">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
@stop

@section('javascript')

@stop