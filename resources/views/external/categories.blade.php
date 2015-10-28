@extends('layoutExternal')

@section('style')
    {!!Html::style('css/images.css')!!}
    <style type="text/css">
        #nav .second{
            color: white;
        }
        .btn-primary{
            background-color: #83D3C9;
            border-color: #83D3C9;
            margin-left: 90px;
        }
        .btn-primary:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
        .row h3{
            text-align: center;
        }
        .row .image{
            margin-left: 30px;
        }
    </style>
@stop

@section('title')
	Categorias
@stop

@section('content')
    <div class="row">
        @foreach($categories as $category)
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>{{$category->name}}</h3>
            <p><a href="{{url('category/'.$category->id.'/subcategory')}}" class="btn btn-primary" role="button" data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        @endforeach
    </div>
</div>
@stop

@section('javascript')

@stop