@extends('layout.admin')

@section('style')
   {!!Html::style('css/images.css')!!}
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
            <th>Departamento</th>
            <th>Teléfono</th>
            <th>Detalle</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        @foreach($modules as $module)
        <tr>
          <td>{{$module->name}}</td>
          <td>{{$module->address}}</td>
          <td>{{$module->district}}</td>
          <td>{{$module->province}}</td>
          <td>{{$module->state}}</td>
          <td>{{$module->phone}}</td>
          <td>
            <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$module->id}}"><i class="glyphicon glyphicon-plus"></i></a> 
            <div class="modal fade" id="edit{{$module->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle punto de venta</h4>
                  </div>
                  <div class="modal-body">
                    <h4>Nombre: </h4>
                    {{$module->name}}
                    <h4>Direccion: </h4>
                    {{$module->address}}
                    <h4>Ciudad: </h4>
                    {{$module->district}}
                    <h4>Provincia: </h4>
                    {{$module->province}}
                    <h4>Departamento: </h4>
                    {{$module->state}}
                    <h4>Teléfono: </h4>
                    {{$module->phone}}
                    <h4>Correo: </h4>
                    {{$module->email}}
                    <h4>Apertura: </h4>
                    {{date_format(date_create($module->starTime),"H:i:s")}}
                    <h4>Cierre: </h4>
                    {{date_format(date_create($module->endTime),"H:i:s")}}
                    <br>
                    <br>
                    {!! Html::image($module->image, null, array('class'=>'carousel_img')) !!}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>

          <td>
            <a class="btn btn-info" href="{{url('admin/modules/'.$module->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
          </td> 
          <td>
            <a class="btn btn-info" href=""  title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$module->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
          </td>
        </tr>
        <div class="modal fade"  id="deleteModal{{$module->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¿Estas seguro que desea eliminar este punto de Venta?</h4>
              </div>
              <div class="modal-body">
                <h5 class="modal-title">Los cambios serán permanentes</h5>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                  <a class="btn btn-info" href="{{url('admin/modules/'.$module->id.'/delete')}}" title="Delete" >Sí</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        @endforeach



    </table>
   {!!$modules->render()!!} 
    <!--
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
    -->


    <!-- Modal -->


@stop

@section('javascript')

@stop