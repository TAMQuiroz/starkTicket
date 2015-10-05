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
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
    
    @foreach($gifts as $gift)
    <tr>
      <td>{{$gift->name}}</td>
      <td>{{$gift->description}}</td>
      <td>{!! Html::image('images/gift1.png', null, array('class'=>'gift_img')) !!}</td>
      <td>{{$gift->stock}}</td>
      <td>{{$gift->points}}</td>
      <td>
        <a class="btn btn-info" href="{{url('admin/gifts/'.$gift->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
      </td> 
      <td>
        <a class="btn btn-info" href="{{url('admin/gifts/'.$gift->id.'/delete')}}"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
      </td>
    </tr>
    @endforeach
    
</table>

{!!$gifts->render()!!}
@stop

@section('javascript')

@stop