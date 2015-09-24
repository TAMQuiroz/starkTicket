@extends('layout.admin')

@section('style')

@stop

@section('title')
	Puntos de venta
@stop

@section('content')
    <!-- Contenido-->
    <table class="table table-bordered table-striped">
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th></th>
        </tr>
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
            <td>Contenido 5</td>
            <td>
                <a href="{{url('admin/modules/1/edit')}}">Editar</a> 
                <a href="detalles" data-toggle="modal" data-target="#myModal">Detalles</a> 
                <a href="">Eliminar</a> 
            </td>
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


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Detalle punto de venta</h4>
          </div>
          <div class="modal-body">
            <h4>Nombre de punto de venta</h4>
            <h4>Direccion de punto de venta</h4>
            <h4>Ciudad de punto de venta</h4>
            <h4>Estado de punto de venta</h4>
            {!! Html::image('images/puntodeventa.jpg', null, array('class'=>'image center-block img-thumbnail')) !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
@stop

@section('javascript')

@stop