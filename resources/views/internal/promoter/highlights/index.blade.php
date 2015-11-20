@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Eventos destacados
@stop

@section('content')
  <table class="table table-bordered table-striped">
    <tr>
        <th>Evento</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Activo</th>
        <th>Editar Fecha Inicio</th>
    </tr>
    @foreach($destacados as $destacado)
        <tr>
          <td>{{$destacado->event->name}}</td>
          <td> {{date('d-m-Y',strtotime($destacado->start_date))}}</td>
          <td> {{date('d-m-Y',strtotime($destacado->start_date)+($destacado->days_active*3600*24))}} </td>  
          <td> @if($destacado->active) Activo @endif @if(!$destacado->active)Inactivo @endif</td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#editHighlight{{$destacado->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
            <!-- MODAL Cancel-->
            <div class="modal fade" id="editHighlight{{$destacado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                  {!!Form::open(array('url' => 'promoter/highlights/'.$destacado->id.'/editDate','id'=>'form','class'=>'form-horizontal'))!!}
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel">Modificar hora y fecha</h4>
                    </div>
                    <div class="modal-body">
                        Esta es la hora actual: 
                        <br>
                        <input type="text" name="start_date" id="start_date" value="{{$destacado->start_date}}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" >Salir</button>
                      <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                  </div>
                  {!!Form::close()!!}
                </div>
              </div>
        </tr>
      @endforeach                     
  </table>
  <a href="{{url('promoter/highlights/create')}}"><button class="btn btn-info">Agregar Nuevo</button></a>
@stop

@section('javascript')

@stop