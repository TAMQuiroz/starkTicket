@extends('layout')

@section('style')
	<link href="css/designLogin.css" rel="stylesheet">
@stop

@section('content')
	<div class="content">
		<div class="title">Inicio de sesión</div>
		<input type="text" placeholder="E-mail"/>
		<input type="password" placeholder="Contraseña"/>
		<input type="checkbox" id="rememberMe"/>
		<button>Iniciar sesión</button>
		<div class="social"> <span>Iniciar sesión con redes sociales</span></div>
		<div class="buttons">
		   <button class="facebook"><i class="fa fa-facebook"></i>Facebook</button>
		   <button class="twitter"><i class="fa fa-twitter"></i>Twitter</button>
		   <button class="google"><i class="fa fa-google-plus"></i>Google</button>
		</div>
	</div>
@stop

@section('javascript')

@stop