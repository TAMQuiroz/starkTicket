@extends('layout_admin')

@section('style')

@stop

@section('title')

@stop

@section('content')
	<form action="../home" enctype="multipart/form-data">
	    <div class="top-title">
	        <h3>
	             Editar logotipo y nombre
	        </h3>
	    </div>
	    <div class="bottom-content">
	        <div class="row">
	            <div class="col-sm-4">
	                <div class="text-center">
	                Logo <br>
	                    <img src="#" id="image-input" class="img-circle" width="200" height="200">

	                        {!! Form::file('image',['id' => 'file-input']) !!}
	                </div>
	            </div>
	            <div class="col-sm-8">
	            	Nombre <br>
					<input type="text" name="name" value="teleticke" placeholder="Name" class="entradas full-width-input">
	            </div>
	            <div class="col-sm-12">
		            <button type="submit" class="btn btn-link add_link" >
		                Guardar Cambios
		            </button>
	            </div>
	        </div>
	    </div>
    </form>
@stop

@section('javascript')

<script>
</script>

@stop