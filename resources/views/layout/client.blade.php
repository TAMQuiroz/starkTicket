<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset($favicon) }}">
    <title>@yield('title') | {{$business_name}} - StarkTicket</title>

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/admin.css')!!}
    {!!Html::style('css/skel-noscript.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/style-desktop.css')!!}
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
                <a class="navbar-brand" href="{{url('client/home')}}">{{$business_name}} </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Eventos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('client')}}">Perfil</a></li>
                            <li><a href="{{url('client/event_record')}}">Historial</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a>Puntos Acumulados: {{Auth::user()->points}}</a></li>
                    <li><a href="{{url('client')}}">{{\Auth::user()->name}}</a></li>
                    <li><a href="{{url('auth/logout')}}">Salir</a></li>
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
                <h1 id="portada"><a href="{{url('client/home')}}">{{$business_name}}</a></h1>
            </div>


            <!-- Nav -->
            <nav id="nav">
                <ul>
                    <li><a href="{{url('client/home')}}">Inicio</a></li>
                    <li><a href="{{url('about')}}">Nosotros</a></li>
                    <li><a href="{{url('category')}}">Categorias</a></li>
                    <li><a href="{{url('event')}}">Eventos</a></li>
                    <li><a href="{{url('modules')}}">Puntos de venta</a></li>
                    <li><a href="{{url('calendar')}}">Calendario</a></li>
                    <li><a href="{{url('gifts')}}">Canjealo</a></li>
                </ul>
            </nav>

        </div>
    </div>

    <div class="container">
        <h1>@yield('title')</h1>
        <hr>
        @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @yield('content')
    </div>
    <div class="container">
        <hr>
        <p><b>Desarrollado por Stark</b></p>
    </div>

    {!!Html::script('js/jQuery-2.1.4.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
    {!!Html::script('js/jquery.validate.min.js')!!}
    {!!Html::script('js/messages_es_PE.js')!!}
    <script type="text/javascript">
    $(document).ready(function(){
        $('#form').validate({
        errorElement: "span",
        rules: {
        },
        highlight: function(element) {
            $(element).closest('.form-group')
            .removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element)
            .addClass('help-inline')
            .closest('.form-group')
            .removeClass('has-error').addClass('has-success');
            }
        });
        $('#yes').click(function(){
            $('.modal').modal('hide');  
        });
    });
    </script>
    @yield('javascript')
</body>
</html>