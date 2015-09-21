<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>StarkTicket</title>
	
	{!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
	{!!Html::style('css/style.css')!!}
	{!!Html::style('css/style-desktop.css')!!}
	@yield('style')
	
</head>
<body>
	<div id="header">
		<div class="container">
			@if(Session::has('flash_message'))
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{Session::get('flash_message')}}
				</div>
			@endif
			<!-- Logo -->

			<div id="logo">
				<h1 id="portada"><a href="#">Teleticke</a></h1>
			</div>

			
			<!-- Nav -->
			<nav id="nav">
				<ul>
					<li><a href="#">Inicio</a></li>
					<li><a href="#">Categorias</a></li>
					<li><a href="#">Nosotros</a></li>
					<li><a href="#">Puntos de venta</a></li>
					<li><a href="#">Calendario</a></li>
					<li><a href="#">Canjealo</a></li>
				</ul>
			</nav>

		</div>
	</div>

	<div class="container">
		@yield('content')
	</div>

	@yield('footer')
	
	@yield('javascript')

	{!!Html::script('js/jQuery-2.1.4.min.js')!!}
	{!!Html::script('js/bootstrap.min.js')!!}
</body>

<footer id="footer">

	<ul class="icons">
		<li><a href="#" class="icon circle fa-twitter"><span class="label">Twitter</span>S</a></li>
		<li><a href="#" class="icon circle fa-facebook"><span class="label">Facebook</span>t</a></li>
		<li><a href="#" class="icon circle fa-google-plus"><span class="label">Google+</span>a</a></li>
		<li><a href="#" class="icon circle fa-github"><span class="label">Github</span>r</a></li>
		<li><a href="#" class="icon circle fa-dribbble"><span class="label">Dribbble</span>k</a></li>
	</ul>

</footer>

</html>