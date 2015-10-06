@extends('layout.admin')

@section('style')
  {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Categorias
@stop

@section('content')
        <!-- Contenido-->
        @if (count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible alert-header" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ strtoupper($error) }}
                </div>
            @endforeach
        @endif
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Eventos</th>
                <th>Subcategorias</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->description}}</td>
                <td>3</td>
                <td class="button-center"><a class="btn btn-info" href={{route('subcategories.index', $category->id)}} title="Editar" >{{$subcategories[$category->name]->count()}}</a></td>
                <td class="button-center"><a class="btn btn-info" href={{route('categories.edit', $category->id)}} title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
                </td> 
                <td class="button-center"><a id="delete {{$category->id}}"class="btn btn-info" data-toggle="modal" data-target="#deleteModal{{$category->id}}" href=""><i class="glyphicon glyphicon-remove"></i></a></td>
            </tr>

            <!-- MODAL -->
              <div class="modal fade"  id="deleteModal{{$category->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">¿Estas seguro que desea Eliminar la categoría?</h4>
                    </div>
                    <div class="modal-body">
                      <h5 class="modal-title">Los cambios serán permanentes</h5>
                      
                    </div>
                    <div class="modal-footer">
                      <form method="post" action={{route('categories.delete', $category->id)}}>
                        {!! csrf_field() !!}
                        <button type="button" class="cancel-button-delete-modal" data-dismiss="modal">No</button>
                        <button type="submit" class="confirm-button-delete-modal">Sí</button>
                      </form>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </div>
            
            @endforeach

        </table>
        <nav>
            <ul class="pagination">
              <li>
                <a href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>


@stop

@section('javascript')

@stop