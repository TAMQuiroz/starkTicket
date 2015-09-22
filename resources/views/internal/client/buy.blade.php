
@extends($user && $user->role_id == 1 ? 'layout.client' : 'layout.worker')

@section('style')
    
@stop

@section('content')
	comprar entradas
@stop

@section('javascript')

@stop