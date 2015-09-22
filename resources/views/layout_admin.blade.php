<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title') | StarkTicket</title>
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/admin.css')!!}
    @yield('style2')
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
            <a class="navbar-brand" href="">Telecticke </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Eventos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/event">List</a></li>
                        <li><a href="/event/create">New</a></li>
                        <li><a href="/event/promoter_record">Promoter Record</a></li>
                        <li><a href="/event/client_record">Client Record</a></li>
                        <li><a href="/event/add_function">Add function</a></li>
                        <li class="divider"></li>
                        <li><a href="eventos-historial.html">Historial</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/category">Listar</a></li>
                        <li><a href="/category/create">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Listar</a></li>
                        <li><a href="#">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Trabajadores <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="trabajador-agregar.html">Nuevo</a></li>
                        <li class="divider"></li>
                        <li><a href="promotores.html">Promotores de ventas</a></li>
                        <li><a href="vendedores.html">Vendedores</a></li>
                        <li><a href="administradores.html">Administradores</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Puntos de Venta <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="puntos-ventas">Listar</a></li>
                        <li><a href="punto-venta-agregar.html">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Business <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="cash_count">Cash</a></li>
                        <li><a href="ticket_return">Return Ticket </a></li>
                        <li><a href="exchange_rate">Exchange Rate</a></li>
                        <li><a href="transfer_payments">Transfer Payments</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="active">
                            <a href="full-width.html">Reporte Ventas</a>
                        </li>
                         <li>
                            <a href="sidebar.html">Reporte2</a>
                        </li>
                        <li>
                            <a href="faq.html">Reporte3</a>
                        </li>
                        <li>
                            <a href="404.html">Reporte4</a>
                        </li>

                    </ul>
                </li>


                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuración  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="tipo-cambio.html">Tipode cambio</a></li>
                        <li><a href="acerca-de.html">Acerca de</a></li>
                        <li><a href="sistema.html">Sistema</a></li>
                    </ul>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="">Juan</a></li>
                <li><a href="../navbar-static-top/">(Salir)</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="container">
    <h1>@yield('title') Field title @show</h1>
    @yield('content')
</div>
<div class="container">
    <hr>
    <p><b>Todos los derechos reservados.</b></p>
</div>
@yield('style2')
@yield('javascript2')
{!!Html::script('js/jQuery-2.1.4.min.js')!!}
{!!Html::script('js/bootstrap.min.js')!!}
</body>
</html>