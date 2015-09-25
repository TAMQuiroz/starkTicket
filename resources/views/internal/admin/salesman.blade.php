@extends('layout.admin')

@section('style')

@stop

@section('title')
	Lista de vendedores
@stop

@section('content')
        <!-- Contenido-->
        <br>
        <h5>Selecciona un departamento</h5></font> 
        <div class="dropdown">
            <button style="background-color:#83D3C9; border-color:#83D3C9; color:white;" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"> Lima
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Arequipa</a></li>
                <li><a href="#">Ica</a></li>
                <li><a href="#">Moquegua</a></li>
                <li><a href="#">Tacna</a></li>
            </ul>
        </div>
        
        <h5>Selecciona un distrito</h5></font> 
        
        <div  class="dropdown">
            <button  style="background-color:#83D3C9; border-color:#83D3C9; color:white;" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"> 
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Pueblo Libre</a></li>
                <li><a href="#">Santa Rosa</a></li>
                <li><a href="#">Ventanilla</a></li>
                <li><a href="#">Breña</a></li>
                <li><a href="#">San Miguel</a></li>
                <li><a href="#">Jesús María</a></li>
                <li><a href="#">Magdalena del Mar</a></li>
                <li><a href="#">Lince</a></li>
                <li><a href="#">San Isidro</a></li>
            </ul>
        </div>
        <br>
        <br>

         <fieldset>
            <legend>Vendedores: </legend>
                Código:  <input type="text" name="firstname" value="">  Nombre/Apellidos: <input type="text" name="lastname" value="">
                <a href="#" class="btn btn-primary" style="background-color:#83D3C9; border-color:#83D3C9; color:white;">Buscar</a>
                <br>                
                <br>
                <br>
        </fieldset>


        <table class="table table-bordered table-striped">
            <tr>
                <th>Apellidos y Nombres</th>
                <th>DNI</th>
                <th>Telefonos(s)</th>
                <th>Sexo</th>
                <th></th>
            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
                <td>
                    <a href="{{url('admin/salesman/1/edit')}}" >Editar</a>

                    <a href="" data-toggle="modal" data-target="#edit">Detalles</a>

                    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Detalle del promotor</h4>
                          </div>
                          <div class="modal-body">
                            <h4>Nombre</h4>
                            <h4>Direccion</h4>
                            <h4>DNI</h4>
                            <h4>Telefono</h4>
                            <h4>Email</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <a href="">Eliminar</a>
                    <a href="{{url('admin/attendance')}}">Asistencia</a>
                </td>
            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
                <td><a href="#">Editar</a> <a href="detalles">Detalles</a> <a href="">Eliminar</a>  <a href="/admin/attendance">Asistencia</a></td>
                    </td>
            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
                <td><a href="#">Editar</a> <a href="detalles">Detalles</a> <a href="">Eliminar</a> <a href="/admin/attendance">Asistencia</a></td>

            </tr>
            <tr>
                <td>Contenido 1</td>
                <td>Contenido 2</td>
                <td>Contenido 3</td>
                <td>Contenido 4</td>
                <td><a href="#">Editar</a> <a href="detalles">Detalles</a> <a href="">Eliminar</a>  <a href="/admin/attendance">Asistencia</a></td>
                    </td>
            </tr>
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