@extends('layout.client')

@section('style')
@stop

@section('title')
Perfil
@stop

@section('content')

<pre>
    {{$obj}}
</pre>
<p><a href="{{url('client/edit')}}">Edit information</a> | <a href="{{url('client/password')}}">Change password</a></p>
@stop

@section('javascript')

@stop