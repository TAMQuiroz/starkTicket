<!-- resources/views/auth/login.blade.php -->

@extends('layoutExternal')

@section('style')
    
@stop

@section('content')

{!! Form::open(['url'=>'auth/login','method'=>'POST']) !!}
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
{!!Form::close()!!}

@include('errors.list')

@stop

@section('javascript')

@stop