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
			<h1>Nombre del trabajador</h1>
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

</html>