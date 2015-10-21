@extends('layout.admin')

@section('style')

@stop

@section('title')
	Lista de promotores de venta
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
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            @foreach($promoters as $promoter)
            <tr>
                <td>{{$promoter->lastname}} {{$promoter->name}}</td>
                <td>
                   
                @if($promoter->di_type == '1')
                    DNI
                @else
                   Carne de Extranjeria
                @endif
          

                </td>
                <td>{{$promoter->di}}</td>
                <td>{{$promoter->phone}}</td>
                <td><a class="btn btn-info" href="#" title="Detalles"  data-toggle="modal" data-target="#edit"><i class="glyphicon glyphicon-plus"></i></a>

                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del promotor</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            <h4>Sexo</h4>  
                            <h4>Documento Identidad</h4>
                            <h4>Número de Documento</h4>
                            <h4>Teléfono</h4>
                            <h4>Direccion</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </td>
                <td>
                  <a class="btn btn-info" href="{{url('admin/promoter/'.$promoter->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
                </td>
                <td>
                  <a class="btn btn-info" href="{{url('admin/promoter/'.$promoter->id.'/delete')}}"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
            @endforeach

        </table>
             {!!$promoters->render()!!}
 
@stop

@section('javascript')

@stop