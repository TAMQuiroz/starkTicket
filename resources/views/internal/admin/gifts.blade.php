@extends('layout.admin')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Regalos
@stop

@section('content')
<table class="table table-bordered table-striped">
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Imagen</th>
        <th>Stock</th>
        <th>Puntos</th>
        <th>Estado</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
    
    @foreach($gifts as $gift)
    <tr>
      <td>{{$gift->name}}</td>
      <td>{{$gift->description}}</td>
      <td>{!! Html::image($gift->image, null, array('class'=>'gift_img')) !!}</td>
      <td>{{$gift->stock}}</td>
      <td>{{$gift->points}}</td>
      <td>
        @if($gift->status == config('constants.gift_available'))
          Disponible
        @else
          Agotado
        @endif
      </td>
      <td>
        <a class="btn btn-info" href="{{url('admin/gifts/'.$gift->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td>
        <a class="btn btn-info" href="" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$gift->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>
    </tr>

    <!-- MODAL -->
    <div class="modal fade"  id="deleteModal{{$gift->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">¿Estas seguro que desea eliminar la categoría?</h4>
          </div>
          <div class="modal-body">
            <h5 class="modal-title">Los cambios serán permanentes</h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
              <a class="btn btn-info" href="{{url('admin/gifts/'.$gift->id.'/delete')}}" title="Delete" >Sí</a>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @endforeach
    
</table>

{!!$gifts->render()!!}
@stop

@section('javascript')

@stop