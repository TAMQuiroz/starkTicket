@extends('layoutExternal')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Categorias
@stop

@section('content')
    <div class="row">
        @foreach($categories as $category)
        <div class="col-sm-3">
            {!! Html::image($category->image, null, array('class'=>'image cat_img')) !!}
            <h3>{{$category->name}}</h3>
            <p><a href="{{url('category/'.$category->id.'/subcategory')}}" class="btn btn-info" role="button" data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        @endforeach
    </div>
</div>
@stop

@section('javascript')

@stop