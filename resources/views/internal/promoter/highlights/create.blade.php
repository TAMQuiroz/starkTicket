@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Añadir nuevo evento destacado
@stop

@section('content')
 <!-- @foreach($events as $event)
    {{$event->name}}
    <br>
  @endforeach 

  {{$fecha_min}}-->

{!!Form::open(array('url' => 'promoter/highlights/create','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
  <h4>Seleccionar evento a agregar</h4><br>
  <table id="example" class="display" cellspacing="2" width="90%"   align="center">
      <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Seleccionar</th>
        </tr>
     </thead>
    <tbody>
      @foreach($events as $event)
        <tr>
          <td>{{$event->name}}</td>
          <td> {{$event->description}}</td>
          <td> {!!Form::radio('event_id', $event->id , '', array('id'=>'true', 'class'=>'radio  evento_id','required'))!!} </td>  
        </tr>
      @endforeach
    </tbody>
  </table>

  <hr>
  <h4>Seleccionar duración</h4>
  <div class="select Type col-md-12"> 
      <label>
          <div class="col-md-6">
              <h4 > Fecha inicio </h4>
              {!! Form::date('start_date', $fecha_min_init, ['class' => 'form-control', 'required','min' => $fecha_min]) !!}
          </div>
          <div class="col-md-6">
              <h4 > Duración (días)</h4>
              {!! Form::number('days', null, ['class' => 'form-control', 'min'=>0, 'max'=>30, 'required']) !!}
          </div>
      </label>
  </div>
  <br>
  <div class="form-group">
    <div class="col-sm-10">
      <a class="btn btn-info" type="button" href=""  title="Create"  data-toggle="modal" data-target="#saveModal">Guardar</a>
      <a href="{{url('promoter/highlights')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
    </div>
  </div>
 <!-- MODAL -->
  <div class="modal fade"  id="saveModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">¿Estas seguro que desea agregar este evento destacado?</h4>
        </div>
        <div class="modal-body">
          <h5 class="modal-title">Los cambios serán permanentes</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">No</button>                        
            <button id = "botonModal" type="submit" class="btn btn-info" id="yes">Sí</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  {!!Form::close()!!}
@stop

@section('javascript')
  {!!Html::script('js/jquery.dataTables.min.js')!!}
  <script>  
    $(document).ready(function() {
       $('#example').DataTable( {
           "language": {
               "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
           }
        });  
    });
  </script>
@stop