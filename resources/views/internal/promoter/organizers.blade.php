@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Organizadores
@stop

@section('content')
{!! Form::text('eventPlace','', array('class' => 'form-control')) !!}
<button type="button" class="btn btn-info">Buscar</button>
<br><br>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>E-mail</th>
            <th>Ruc</th>
            <th>Eventos</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Organizador 1</td>
            <td>22334455</td>
            <td>email@gmail.com</td>
            <td>2551231236</td>
            <td>23</td>
            <td>
                <a class="btn btn-info" href="#" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>    
            <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a></td>
        </tr>
        <tr>
            <td>Organizador 1</td>
            <td>22334455</td>
            <td>email@gmail.com</td>
            <td>2551231236</td>
            <td>23</td>
            <td>
                <a class="btn btn-info" href="#" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>    
            <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a></td>

        </tr>
        <tr>
            <td>Organizador 1</td>
            <td>22334455</td>
            <td>email@gmail.com</td>
            <td>2551231236</td>
            <td>23</td>
            <td>
                <a class="btn btn-info" href="#" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>    
            <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a></td>

        </tr>
        <tr>
            <td>Organizador 1</td>
            <td>22334455</td>
            <td>email@gmail.com</td>
            <td>2551231236</td>
            <td>23</td>
            <td>
                <a class="btn btn-info" href="#" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>    
            <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a></td>

        </tr>
        <tr>
            <td>Organizador 1</td>
            <td>22334455</td>
            <td>email@gmail.com</td>
            <td>2551231236</td>
            <td>23</td>
            <td>
                <a class="btn btn-info" href="#" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>    
            <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a></td>

        </tr>
        <tr>
            <td>Organizador 1</td>
            <td>22334455</td>
            <td>email@gmail.com</td>
            <td>2551231236</td>
            <td>23</td>
           <td>
                <a class="btn btn-info" href="#" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>    
            <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a></td>

        <tr>
            <td>Organizador 1</td>
            <td>22334455</td>
            <td>email@gmail.com</td>
            <td>2551231236</td>
            <td>23</td>
            <td>
                <a class="btn btn-info" href="#" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td>    
            <td>
                <a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a></td>

        </tr>
    </tbody>
  </table>
</div>
@stop

@section('javascript')

@stop