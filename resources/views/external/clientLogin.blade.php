<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login de Cliente</title>
	{!!Html::style('css/bootstrap.min.css')!!}
	{!!Html::style('css/font-awesome.min.css')!!}
	{!!Html::style('css/designLogin.css')!!}
</head>
<body>
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
	
	{!!Html::script('js/jQuery-2.1.4.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
	
</body>
</html>