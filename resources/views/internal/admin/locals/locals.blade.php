@extends('layout.admin')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Lista de locales
@stop

@section('content')
        <!-- Contenido-->
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Capacidad</th>
                <th>Imagen</th>
                <th>Detalle</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
          @foreach($locals as $local)
          <tr>
            <td>{{$local->name}}</td>
            <td>{{$local->address}}</td>
            <td>{{$local->capacity}}</td>

            <td>{!! Html::image($local->image, null, array('class'=>'gift_img')) !!}</td>
            <td>
              <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$local->id}}"><i class="glyphicon glyphicon-plus"></i></a>
              <div class="modal fade" id="edit{{$local->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Detalle del Local</h4>
                    </div>
                    <div class="modal-body">
                      <h4>Nombre: </h4>
                      {{$local->name}}
                      <h4>Capacidad: </h4>
                      {{$local->capacity}}
                      <h4>Direccion: </h4>
                      {{$local->address}}, {{$local->district}}, {{$local->province}}, {{$local->state}}
                      <br>
                      <br>
                      {!! Html::image($local->image, null, array('class'=>'modal_img')) !!}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>

            <td>
              <a class="btn btn-info" href="{{url('admin/local/'.$local->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>
            <td>
              <a class="btn btn-info" href=""  title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$local->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
            </td>
          </tr>
          <div class="modal fade"  id="deleteModal{{$local->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">¿Estas seguro que desea eliminar este local?</h4>
                </div>
                <div class="modal-body">
                  <h5 class="modal-title">Los cambios serán permanentes</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                    <a class="btn btn-info" href="{{url('admin/local/'.$local->id.'/delete')}}" title="Delete" >Sí</a>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          @endforeach
        </table>
        {!!$locals->render()!!}
@stop

@section('javascript')

@stop