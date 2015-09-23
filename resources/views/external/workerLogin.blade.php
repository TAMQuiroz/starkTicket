<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    {!!Html::style('css/estiloLogin2.css')!!};
	<style>
		body {
				background: #e1c192 url( {{ URL::asset('images/wood_pattern.jpg') }})

		}
	</style>
</head>
<body>
	

		{!!Form::open(['class' => 'form-2'])!!}
		<h1><span class="log-in">Sign in</span> o <span class="sign-up">Ingresa</span></h1>
		<p class="float">
			<label for="login"><i class="icon-user"></i>Usuario</label>
			<input type="text" name="login" placeholder="Usuario o correo">
		</p>
		<p class="float">
			<label for="password"><i class="icon-lock"></i>Contraseña</label>
			<input type="password" name="password" placeholder="Contraseña" class="showpassword"> 
		</p>
		<p class="clearfix"> 
			<a href="#" class="log-twitter">Log in con Facebook</a>    
			<input type="submit" name="submit" value="Ingresa">
		</p>       
	{!!Form::close()!!}    

	@if (Session::has('message'))
		<div class="alert alert-warning">
		   <strong>Advertencia!</strong> Contraseña o usuario incorrecto, vuelva a intentarlo nuevamente

		</div>
	@endif

	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Password' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Mostrar Contraseña")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
		</script>




</body>
</html>