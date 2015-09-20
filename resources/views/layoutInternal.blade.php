<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>StarkTicket</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	{!!Html::style('css/style.css')!!}
	@yield('style')

	<!-- Latest compiled and minified CSS -->
	
	
	
</head>
<body>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Jose Marroquín <font size="2">Administrador</font></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
				  	<li>
	                    <a href="#">Nuevo Evento</a>
	                </li>
				
                    <li>
                        <a href="#">Venta de tickets</a>
                    </li>
            
                    <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes  <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="active">
                                <a href="#">Reporte Ventas</a>
                            </li>
                             <li>
                                <a href="#">Reporte2</a>
                            </li>
                            <li>
                                <a href="#">Reporte3</a>
                            </li>
                            <li>
                                <a href="#">Reporte4</a>
                            </li>
                     
                        </ul>
                    </li>
					
					
					 <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuración  <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="active">
                                <a href="#">Preferencias</a>
                            </li>
                             <li>
                                <a href="#">Seguridad</a>
                            </li>
                            <li>
                                <a href="#">Acerca de</a>
                            </li>
                         
                     
                        </ul>
                    </li>	
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

	<div class="container">
		@yield('content')
	</div>
	
	@yield('javascript')

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>