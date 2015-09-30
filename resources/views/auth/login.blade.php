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
        
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Recuperar contraseña</h4>
                  </div>
                  <div class="modal-body">
                    <h3>Ingresa tu correo</h3>
                    <input type="password" name="password" style="border-color: black;" placeholder="Correo"/>
                    <button type="button" class="btn btn-primary">Enviar correo de recuperacion</button>
                  </div> 
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  </div>
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
