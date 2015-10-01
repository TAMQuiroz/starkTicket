<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login de Cliente</title>
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/designLogin.css')!!}
    <style type="text/css">
        .content button, .btn{
            background-color: #83D3C9;
            border-color: #83D3C9;
            margin: 10px 0;
            color: white;
            font-size: 1.1rem;
        }
        .btn:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
        .content input{
          color: black;
          border: black;
        }
        .content h4, .content h3{
          color: black;
        }
    </style>
</head>
<body>
    {!! Form::open(['url'=>'auth/login','method'=>'POST']) !!}
        {!! csrf_field() !!}

        <div class="content">
            <div class="title">Inicio de sesión</div>
            <input type="email" name="email" value="{{old('email')}}" placeholder="E-mail"/>
            <input type="password" name="password" placeholder="Contraseña"/>
            <a href="" data-toggle="modal" data-target="#myModal">Olvidaste tu contraseña?</a>
            <!-- Button trigger modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4>Ingresa e-mail</h4>
                            <input type="correo" style="border:gray 1px solid" name="correo" placeholder="E-mail"/>
                        </div>
                        <button type="button" class="btn btn-info" style="margin-left:10px; width:580px" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Enviar</button>
                        <button type="button" class="btn btn-info" style="margin-left:10px; width:580px" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Cancelar</button>
                    </div>
                </div>
            </div>
            <button class="btn">Iniciar sesión</button>
            <p><a href="{{url('/')}}" class="btn" role="button" data-target="#info" data-whatever="@mdo" style="width:100%">Regresar</a></p>
        </div>

        @include('errors.list')

    {!!Form::close()!!}


    {!!Html::script('js/jQuery-2.1.4.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}

</body>
</html>
