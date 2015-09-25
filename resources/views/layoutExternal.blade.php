<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>@yield('title') | StarkTicket</title>

	{!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
	{!!Html::style('css/style.css')!!}
	{!!Html::style('css/style-desktop.css')!!}
	{!!Html::style('css/skel-noscript.css')!!}

	@yield('style')

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">Telecticke </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{url('auth/login')}}">Login</a></li>
                    <li><a href="{{url('auth/register')}}">Sign Up</a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

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
				<h1 id="portada"><a href="{{url('home')}}">Teleticke</a></h1>
			</div>


			<!-- Nav -->
			<nav id="nav">
				<ul>
					<li><a href="{{url('/')}}">Inicio</a></li>
					<li><a href="{{url('category')}}">Categorias</a></li>
					<li><a href="{{url('event')}}">Eventos</a></li>
					<li><a href="{{url('about')}}">Nosotros</a></li>
					<li><a href="{{url('modules')}}">Puntos de venta</a></li>
					<li><a href="{{url('calendar')}}">Calendario</a></li>
					<li><a href="{{url('gifts')}}">Canjealo</a></li>
				</ul>
			</nav>

		</div>
	</div>

	<div class="container">
		@yield('content')
	</div>


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

	{!!Html::script('js/jQuery-2.1.4.min.js')!!}
	{!!Html::script('js/jquery-1.11.3.min.js')!!}
	{!!Html::script('js/bootstrap.min.js')!!}
	@yield('javascript')

</html>