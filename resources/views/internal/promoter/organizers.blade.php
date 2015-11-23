
@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Organizadores
@stop

@section('content')
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>E-mail</th>
            <th>Ruc</th>
            <th>Eventos</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
     <tbody>

     @foreach($organizador as $organizer)
        <tr>
            <td>{{$organizer->organizerName}}</td>
            <td>{{$organizer->telephone}}</td>
            <td>{{$organizer->email}}</td>
            <td>{{$organizer->ruc}}</td>
            <td>{{$organizer->events}}</td>
            <td>
                <a class="btn btn-info" href="{{url('promoter/organizer/'.$organizer->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>
            <td>
                <a class="btn btn-info" href=""  title="Eliminar"    data-toggle="modal" data-target="#deleteModal{{$organizer->id}}"><i class="glyphicon glyphicon-remove"></i></a></td>
        </tr>


        <!-- MODAL -->
        <div class="modal fade"  id="deleteModal{{$organizer->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¿Estas seguro que desea eliminar a un organizador?</h4>
              </div>
              <div class="modal-body">
                <h5 class="modal-title">Los cambios serán permanentes</h5>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                  <a class="btn btn-info" href="{{url('promoter/organizer/'.$organizer->id.'/delete')}}" title="Delete" >Sí</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endforeach


    </tbody>
  </table>
</div>

{!!$organizador->render()!!}
@stop

@section('javascript')

@stop