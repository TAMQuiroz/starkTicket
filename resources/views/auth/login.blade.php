<!-- resources/views/auth/login.blade.php -->

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
    {!! Form::open(['url'=>'auth/login','method'=>'POST']) !!}
        {!! csrf_field() !!}

        <div class="content">
            <div class="title">Inicio de sesión</div>
            <input type="email" name="email" value="{{old('email')}}" placeholder="E-mail"/>
            <input type="password" name="password" placeholder="Contraseña"/>
            <input type="checkbox" name="remember" id="rememberMe"/>
            <button>Iniciar sesión</button>
            <div class="social"> <span>Iniciar sesión con redes sociales</span></div>
            <div class="buttons">
               <button class="facebook"><i class="fa fa-facebook"></i>Facebook</button>
               <button class="twitter"><i class="fa fa-twitter"></i>Twitter</button>
               <button class="google"><i class="fa fa-google-plus"></i>Google</button>
            </div>
        </div>

        @include('errors.list')

    {!!Form::close()!!}
    

    {!!Html::script('js/jQuery-2.1.4.min.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}

</body>
</html>   
