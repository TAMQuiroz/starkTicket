@extends('layout.admin')

@section('style')

@stop

@section('title')
	Lista de Administradores
@stop

@section('content')
  <!-- Contenido-->
  <table class="table table-bordered table-striped">
      <tr>
          <th>Apellidos y Nombres</th>
          <th>Documento Identidad</th>
          <th>Número de Documento</th>
          <th>Telefono</th>
          <th>Detalle</th>
          <th>Editar</th>
          <th>Eliminar</th>
      </tr>
      <tr>
          <td>Contenido 1</td>
          <td>Contenido 2</td>
          <td>Contenido 3</td>
          <td>Contenido 4</td>
          <td>        
            <a class="btn btn-info" href="" data-toggle="modal" data-target="#edit" title="Detalles"><i class="glyphicon glyphicon-plus"></i></a>
           </td> 
           <td>
            <a class="btn btn-info" href="{{url('admin/admin/1/edit')}}" title="Editatr"><i class="glyphicon glyphicon-pencil"></i></a>
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle del promotor</h4>
                  </div>
                  <div class="modal-body">
                    <h4>Nombre</h4>
                    <h4>Sexo</h4>  
                    <h4>Documento Identidad</h4>
                    <h4>Número de Documento</h4>
                    <h4>Teléfono</h4>
                    <h4>Direccion</h4>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div> 
            <td>
            <a class="btn btn-info"  href="" title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a> 
             </td>
          </td>
      </tr>
      <tr>
          <td>Contenido 1</td>
          <td>Contenido 2</td>
          <td>Contenido 3</td>
          <td>Contenido 4</td>
          <td>        
            <a class="btn btn-info" href="" data-toggle="modal" data-target="#edit" title="Detalles"><i class="glyphicon glyphicon-plus"></i></a>
           </td> 
           <td>
            <a class="btn btn-info" href="{{url('admin/admin/1/edit')}}" title="Editatr"><i class="glyphicon glyphicon-pencil"></i></a>
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
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div> 
            <td>
            <a class="btn btn-info"  href="" title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a> 
             </td>
          </td>
      </tr>
      <tr>
             <td>Contenido 1</td>
          <td>Contenido 2</td>
          <td>Contenido 3</td>
          <td>Contenido 4</td>
          <td>        
            <a class="btn btn-info" href="" data-toggle="modal" data-target="#edit" title="Detalles"><i class="glyphicon glyphicon-plus"></i></a>
           </td> 
           <td>
            <a class="btn btn-info" href="{{url('admin/admin/1/edit')}}" title="Editatr"><i class="glyphicon glyphicon-pencil"></i></a>
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
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div> 
            <td>
            <a class="btn btn-info"  href="" title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a> 
             </td>
          </td>
      </tr>
      <tr>
             <td>Contenido 1</td>
          <td>Contenido 2</td>
          <td>Contenido 3</td>
          <td>Contenido 4</td>
          <td>        
            <a class="btn btn-info" href="" data-toggle="modal" data-target="#edit" title="Detalles"><i class="glyphicon glyphicon-plus"></i></a>
           </td> 
           <td>
            <a class="btn btn-info" href="{{url('admin/admin/1/edit')}}" title="Editatr"><i class="glyphicon glyphicon-pencil"></i></a>
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
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div> 
            <td>
            <a class="btn btn-info"  href="" title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a> 
             </td>
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