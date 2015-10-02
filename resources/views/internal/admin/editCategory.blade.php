@extends('layout.admin')

@section('style')

@stop

@section('title')
	Editar Categoria
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="" value="Categoria">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Subcategoria</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                  <br>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editarSubs">Editar</button>


                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#crearSub">Agregar</button>


                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="5">Descripcion de la categoria</textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a class="btn btn-info"  data-toggle="modal" data-target="#agregado">Guardar</a>
                  <a href="{{url('admin/category')}}"><button type="reset" class="btn btn-info">Cancelar</button></a>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="modal fade" id="editarSubs" tabindex="-1" role="dialog" aria-labelledby="editarSubs">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editarSubs">Editar subcategorias</h4>
              </div>

              <div class="modal-body">
                  <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Eventos</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        
                    </tr>
                    <tr>
                        <td>SubCategoria 1</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. </td>
                        <td>3</td>
                        <td>
                          <a class="btn btn-info" data-toggle="modal" data-target="#myModal"title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a> 
                        </td>
                        <td>
                          <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a> 
                        </td>
                    </tr>
                    <tr>
                        <td>SubCategoria 2</td>
                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua.</td>
                        <td>30</td>
                        <td>
                          <a class="btn btn-info" data-toggle="modal" data-target="#myModal"title="Editar" ><i class="glyphicon glyphicon-pencil"></i></a> 
                        </td>
                        <td>
                          <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a> 
                        </td>
                    </tr>

                  </table>
                </div>
            </div>
          </div>

          <div class="modal fade"  id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Editar subcategoria</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form class="form-horizontal" method="post">
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="" value="Nombre de subcategoria">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" id="inputEmail3" placeholder="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="5">Descripcion de subcategoria</textarea>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-info">Guardar</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>

        <div class="modal fade" id="crearSub" tabindex="-1" role="dialog" aria-labelledby="crearSub">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="crearSub">Crear subcategoria</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <form class="form-horizontal" method="post">
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEmail3" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="inputEmail3" placeholder="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" rows="5"></textarea>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                 <button type="button" class="btn btn-info">Guardar</button>
              </div>
            </div>
          </div>
        </div>




@stop

@section('javascript')

@stop