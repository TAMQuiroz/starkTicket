@extends('layout.admin')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Lista de locales
@stop

@section('content')
        <!-- Contenido-->
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Capacidad</th>
                <th>Imagen</th>
                <th>Detalle</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            <!--
            <tr>
                <td>Categoria 1</td>
                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
                <td>323</td>
                <td>{!! Html::image('images/map.png', null, array('class'=>'gift_img')) !!}</td>
                <td><a class="btn btn-info" href="{{url('admin/local/1/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
                </td> 
                <td><a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a> </td>
            </tr>
            <tr>
                <td>Categoria 2</td>
                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
                <td>300</td>
                <td>{!! Html::image('images/map.png', null, array('class'=>'gift_img')) !!}</td>
               <td><a class="btn btn-info" href="{{url('admin/local/1/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
                </td> 
                <td><a class="btn btn-info" href="#"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a> </td>
            </tr>

          -->
          @foreach($locals as $local)
          <tr>
            <td>{{$local->name}}</td>
            <td>{{$local->address}}</td>
            <td>{{$local->capacity}}</td>
            
            <td>{!! Html::image($local->image, null, array('class'=>'gift_img')) !!}</td>
            <td>
              <a class="btn btn-info" href="detalles" title="Detalles" data-toggle="modal" data-target="#edit{{$local->id}}"><i class="glyphicon glyphicon-plus"></i></a> 
              <div class="modal fade" id="edit{{$local->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Detalle del Local</h4>
                    </div>
                    <div class="modal-body">
                      <h4>Nombre: </h4>
                      {{$local->name}}
                      <h4>Capacidad: </h4>
                      {{$local->capacity}}
                      <h4>Direccion: </h4>
                      {{$local->address}}
                      <h4>Distrito: </h4>
                      {{$local->district}}
                      <h4>Provincia: </h4>
                      {{$local->province}}
                      <h4>Departamento: </h4>
                      {{$local->state}}
                      <br>
                      <br>
                      {!! Html::image($local->image, null, array('class'=>'local_img')) !!}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>

            <td>
              <a class="btn btn-info" href="{{url('admin/local/'.$local->id.'/edit')}}" title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a>
            </td> 
            <td>
              <a class="btn btn-info" href=""  title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$local->id}}" ><i class="glyphicon glyphicon-remove"></i></a>
            </td>
          </tr>
          <div class="modal fade"  id="deleteModal{{$local->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">¿Estas seguro que desea eliminar este local?</h4>
                </div>
                <div class="modal-body">
                  <h5 class="modal-title">Los cambios serán permanentes</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                    <a class="btn btn-info" href="{{url('admin/local/'.$local->id.'/delete')}}" title="Delete" >Sí</a>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          @endforeach


        </table>
        {!!$locals->render()!!} 
        <!--
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
          </nav> -->
@stop

@section('javascript')

@stop