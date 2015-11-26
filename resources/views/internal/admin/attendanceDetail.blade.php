@extends('layout.admin')

@section('style')

@stop

@section('title')
Detalle de asistencia de {{$salesman->name}}  {{$salesman->lastname}}
<br>

@stop

@section('content')
<div class="row">
  <div class="col-sm-8">
   {!!Form::open(array('url' => 'admin/'.$detailsAttendances[$detailsAttendances->count()-1]->id.'/Update/attendanceSubmit','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}

   <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Hora Ingreso</th>
        <th>Hora Salida</th>
        <th>Editar</th>
      </tr>
    </thead>
    <tbody>
     
      <?php
      $i=0;
      while ($i< $detailsAttendances->count()){ 
        ?>

        <tr>
          <th>   {{ date ("g:i:s a",strtotime($detailsAttendances[$i]->datetime))}}</th>
          
          <?php
          $i++;
          ?>


          @if ( $detailsAttendances[$i]->datetime == NULL )
          <th>No se cerró sesión</th>
          @else
          <th> {{  date( "g:i:s a", strtotime(  $detailsAttendances[$i]->datetime  ))    }}  </th>
          @endif
          <th><a class="btn btn-info" title="Editar" data-toggle="modal" data-target="#editModal{{$i}}"><i class="glyphicon glyphicon-pencil"></i></a></th>      
        </tr>     

        <!-- MODAL -->
        <div class="modal fade"  id="editModal{{$i}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modificar hora</h4>
              </div>
              <div class="modal-body">
                <h5>Hora Inicio</h5>
                {!!Form::input('time', 'horaInicio' , date("H:i",strtotime($detailsAttendances[$i-1]->datetime))   ,['class'=>'form-control','required' ,'readonly'])!!}
                
                <h5>Hora Fin</h5>


                @if ( $detailsAttendances[$i]->datetime == NULL )
                {!!Form::input('time','horaFin', ''  ,['class'=>'form-control','required'])!!}
                @else
                {!!Form::input('time','horaFin', date("H:i",strtotime($detailsAttendances[$i]->datetime))  ,['class'=>'form-control','required','readonly'])!!}
                @endif
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>                        
                <button type="submit" class="btn btn-info" >Guardar</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <?php   
        $i++;
      }
      ?>
      
    </tbody>
  </table>

</div>
</div>

<div class="row">
    <div class="col-md-12">
        <a href="{{route('admin.salesman')}}" class="btn btn-info">Regresar</a>
    </div>
</div>
@stop

@section('javascript')

@stop
