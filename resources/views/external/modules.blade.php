@extends('layoutExternal')

@section('style')
  {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Puntos de venta
@stop

@section('content')
    <h3>Ubica nuestros Módulos de Venta </h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Ubicación</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Detalle</th>
        </tr>
            @foreach($modules as $module)
        <tr>
          <td>{{$module->name}}</td>
          <td>{{$module->address}}</td>
          <td>{{$module->district}}, {{$module->province}}, {{$module->state}}</td>
          <td>{{$module->email}}</td>
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
                    {{$module->address}}, {{$module->district}}, {{$module->province}}, {{$module->state}}
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
                    <h4>Ubicanos: </h4>
                    {!! Html::image($module->image, null, array('class'=>'modal_img')) !!}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          @endforeach
    </table>
@stop

@section('javascript')

@stop