<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>StarkTicket</title>

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
	@yield('style2')
	
</head>
<body>
    @yield('header')

    @yield('sidebar')
    
	<div class="container">
		@yield('content')
	</div>
    
	{!!Html::script('js/jQuery-2.1.4.min.js')!!}
	{!!Html::script('js/bootstrap.min.js')!!}
	@yield('javascript2')

</body>

</html>