
@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Organizadores
@stop

@section('content')
{!! Form::text('eventPlace','', array('class' => 'form-control')) !!}
<button type="button" class="btn btn-info">Buscar</button>
<br><br>
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
            <td>4</td>
            <td>
                <a class="btn btn-info" href="{{url('promoter/organizer/'.$organizer->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>    
            <td>
                <a class="btn btn-info" href="{{url('promoter/organizer/'.$organizer->id.'/delete')}}"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a></td>
        </tr>
    @endforeach

    
    </tbody>
  </table>
</div>

{!!$organizador->render()!!}
@stop

@section('javascript')

@stop