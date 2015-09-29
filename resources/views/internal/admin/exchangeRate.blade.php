@extends('layout.admin')

@section('style')

@stop

@section('title')
	Tipo de cambio
@stop

@section('content')
            <div class="row">
                <form>
              <div class="col-sm-2">
                    Nuevo tipo de Cambio
                    <input type="text" name="username" class="form-control">
                     <b>COMPRA</b>
              </div>
              <div class="col-sm-2">
                    Nuevo tipo de Cambio
                    <input type="text" name="username" class="form-control">
                     <b>VENTA</b>
              </div>
              <div class="col-sm-2"><br>
                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#myModal">Modificar Tipo Cambio</button>
              </div>
                </form>
            </div>
            <hr>
            <h3>Ultimos tipos de cambio</h3>
                        <table class="table table-bordered table-striped">
                          <tr>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                          </tr>
                          <tr>
                            <td>2.80</td>
                            <td>2.93</td>
                            <td>22/09/2015</td>
                            <td>22/10/2015</td>
                          </tr>
                          <tr>
                            <td>2.91</td>
                            <td>2.93</td>
                            <td>23/09/2015</td>
                            <td>25/09/2015</td>
                          </tr>
                          <tr>
                            <td>2.96</td>
                            <td>2.95</td>
                            <td>26/09/2015</td>
                            <td>26/09/2015</td>
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
                  <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-body">
                        <h2>Mensaje del Sistema</h2>
                        <h3>Su Tipo de Cambio ha sido Guardado con Éxito</h3>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>

                  </div>
                </div>
@stop

@section('javascript')

@stop