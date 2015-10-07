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
            <th>Distrito</th>
            <th>Provincia</th>
            <th>Ciudad</th>
            <th>Imagen</th>
            <th>Detalle</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <!--
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
            <td>Contenido 5</td>
            <td>
               <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a> 
            </td>
            <td>
                <a class="btn btn-info" href="{{url('admin/modules/1/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
             </td>    
             <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
            <td>Contenido 5</td>
            <td>
               <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a> 
            </td>
            <td>
                <a class="btn btn-info" href="{{url('admin/modules/1/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
             </td>    
             <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
            <td>Contenido 5</td>
            <td>
               <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a> 
            </td>
            <td>
                <a class="btn btn-info" href="{{url('admin/modules/1/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
             </td>    
             <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
        <tr>
            <td>Contenido 1</td>
            <td>Contenido 2</td>
            <td>Contenido 3</td>
            <td>Contenido 4</td>
            <td>Contenido 5</td>
            <td>
               <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a> 
            </td>
            <td>
                <a class="btn btn-info" href="{{url('admin/modules/1/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
             </td>    
             <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr> -->

        @foreach($modules as $module)
        <tr>
          <td>{{$module->name}}</td>
          <td>{{$module->address}}</td>
          <td>{{$module->district}}</td>
          <td>{{$module->province}}</td>
          <td>{{$module->state}}</td>
          <td>{!! Html::image('images/map.png', null, array('class'=>'module_img')) !!}</td>
          <td>
              <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a> 
            </td>
          <td>
            <a class="btn btn-info" href="{{url('admin/modules/'.$module->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
          </td> 
          <td>
            <a class="btn btn-info" href="{{url('admin/modules/'.$module->id.'/delete')}}"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
          </td>
        </tr>
        @endforeach



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
            <h5>Nombre de punto de venta</h5>
            <h5>Direccion de punto de venta</h5>
            <h5>Ciudad de punto de venta</h5>
            <h5>Estado de punto de venta</h5>
            {!! Html::image('images/puntodeventa.jpg', null, array('class'=>'image center-block img-thumbnail')) !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
@stop

@section('javascript')

@stop