@extends('layoutExternal')

@section('style')
	{!!Html::style('css/images.css')!!}
@stop

@section('title')
	{{$category->name}}
@stop

@section('content')
	<p>{{$category->description}}</p>
    @if (count($subcategories)>0)
	<div class="row">
        @foreach ($subcategories as $subcategory)
        <div class="col-sm-3">
            {!! Html::image($subcategory->image, null, array('class'=>'image cat_img')) !!}
            <h3>{{$subcategory->name}}</h3>
            <p><a href="subcategory/{{$subcategory->id}}" class="btn btn-info" role="button" data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info">No tiene sub categorias</div>
    @endif
@stop

@section('javascript')

@stop