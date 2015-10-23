@extends('layoutExternal')

@section('style')

@stop

@section('title')
	Subcategoria
@stop

@section('content')
    @if($events)
        <div class="alert alert-danger">Eventos no encontrados</div>
    @else
        <div class="alert alert-success">Listar eventos</div>
    @endif
@stop

@section('javascript')

@stop