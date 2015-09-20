<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>StarkTicket</title>
	{!!Html::style('css/style.css')!!}
	@yield('style')

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	
	
</head>
<body>
	<div id="header">
		<div class="container">
				
			<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Teleticke</a></h1>
					<span>Frase de la empresa</span>
				</div>
			
			<!-- Nav -->
				<nav id="nav">
					<ul>
						<li class="active"><a href="index.html">Inicio</a></li>
						<li><a href="threecolumn.html">Categorias</a></li>
						<li><a href="twocolumn1.html">Nosotros</a></li>
						<li><a href="twocolumn2.html">Puntos de venta</a></li>
						<li><a href="onecolumn.html">Calendario</a></li>
					</ul>
				</nav>

		</div>
	</div>

	<div class="container">
		@yield('content')
	</div>

	@yield('footer')
	
	@yield('javascript')

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	{!!Html::script('js/skel.min.js')!!}
	{!!Html::script('js/skel-panels.min.js')!!}
	{!!Html::script('js/init.js')!!}

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