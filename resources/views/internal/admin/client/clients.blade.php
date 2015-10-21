@extends('layout.admin')

@section('style')

@stop

@section('title')
  Lista de Clientes
@stop

@section('content')
        <!-- Contenido-->
        <table class="table table-bordered table-striped">
            <tr>
                <th>Apellidos y Nombres</th>
                <th>Documento Identidad</th>
                <th>Número de Documento</th>
                <th>Teléfono</th>
                <th>Detalle</th>
                <th>Desactivar</th>
            </tr>

            @foreach($clients as $client)
            <tr>
                <td>{{$client->lastname}}, {{$client->name}}</td>
                <td>@if($client->di_type == 1)
                    DNI
                    @else
                    Carnet de Extranjeria
                    @endif</td>
                <td>{{$client->di}}</td>
                <td>{{$client->phone}}</td>
                <td><a class="btn btn-info" href="#" title="Detalles"  data-toggle="modal" data-target="#edit"><i class="glyphicon glyphicon-plus"></i></a>

                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del cliente</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            {{$client->lastname}}, {{$client->name}}
                            <h4>Documento Identidad</h4>
                            @if($client->di_type == 1)
                            DNI
                            @else
                            Carnet de Extranjeria
                            @endif
                            <h4>Número de Documento</h4>
                            {{$client->di}}
                            <h4>Teléfono</h4>
                            {{$client->phone}}
                            


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </td>
                <td>
                 <a class="btn btn-info" href="" title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$client->id}}"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
                <div class="modal fade"  id="deleteModal{{$client->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">¿Estas seguro que desea dar de baja al cliente?</h4>
                  </div>
                  <div class="modal-body">
                    <h5 class="modal-title">Los cambios serán permanentes</h5>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                      <a class="btn btn-info" href="{{url('admin/admin/'.$client->id.'/delete')}}" title="Delete" >Sí</a>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            </tr>
            @endforeach
        </table>
         {!!$clients->render()!!}
@stop

@section('javascript')

@stop