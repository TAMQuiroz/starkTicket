@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Historial de eventos
@stop

@section('content')
  <div class="rangoFechas">
      <label for="from">Inicio</label>
      <input class="form-control" type="date" id="from" name="from">
      <label for="to">Fin</label>
      <input  type="date" id="to" name="to"  class="form-control">
      <td><button type="button" class="btn btn-info">Buscar</button></td>
  </div>
  <!-- Contenido-->
  <hr>
  <h2>Eventos</h2>
      <table class="table table-bordered table-striped">
        <tr>
          <th>Código de Evento</th>
          <th>Nombre de Evento</th>
          <th>Fecha Inicio</th>
          <th>Fecha Fin</th>
          <th>Estado</th>
          <th>Entradas Vendidas</th>
          <th>Monto Acumulado</th>
          <th>Ver</th>
          <th>Editar</th>
          <th>Cancelar</th>
        </tr>

        <tr>
          <td>00001</td>
          <td>Nubeluz Reencuentro</td>
          <td>19/09/2015</td>
          <td>25/10/2015</td>
          <td>Vigente</td>
          <td>1500</td>
          <td>17500.00</td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
          <td><a type="button" class="btn btn-info" href="{{url('promoter/event/editEvent')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancel" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
        </tr>

        <tr>
          <td>00002</td>
          <td>Kiko y la Chili</td>
          <td>20/09/2015</td>
          <td>25/10/2015</td>
          <td>Vigente</td>
          <td>1000</td>
          <td>8300.00</td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
          <td><a type="button" class="btn btn-info" href="{{url('promoter/event/editEvent')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancel" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
        </tr>

        <tr>
          <td>00005</td>
          <td>La banda de Pepito</td>
          <td>20/09/2015</td>
          <td>20/09/2015</td>
          <td>Finalizado</td>
          <td>750</td>
          <td>4300.00</td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
          <td><a type="button" class="btn btn-info" href="{{url('promoter/event/editEvent')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancel" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
        </tr>
        <tr>
          <td>00006</td>
          <td>Visita a Marte</td>
          <td>29/09/2015</td>
          <td>29/09/2015</td>
          <td>Vigente</td>
          <td>100</td>
          <td>50000.00</td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
          <td><a type="button" class="btn btn-info" href="{{url('promoter/event/editEvent')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancel" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
        </tr>
        <tr>
          <td>00007</td>
          <td>Fatmagul el Musical en 2D</td>
          <td>26/10/2015</td>
          <td>02/12/2015</td>
          <td>Cancelado</td>
          <td>30</td>
          <td>1000.00</td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
          <td><a type="button" class="btn btn-info" href="{{url('promoter/event/editEvent')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancel" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
        </tr>

      </table>
      <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel">Detalle de Evento</h4>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <h4>Nubeluz El Encuentro</h4>
                <p>Código 000001. </p>
                <p>Creado Por: Juan Perez</p>
                <p>Promotor: Juanita Perez</p>
                <p>Fecha Creación del 01/09/2015</p>
                <p>Fecha Duración del 19/09/2015 al 25/10/2015</p>
                <h4>Entradas:</h4>
                <ul>
                  <li>Normal : 100.00</li>
                  <li>Vip    : 350.00</li>
                  <li>Haters : 90.00</li>
                </ul>
                <br>
                <h4>Información de Ventas</h4>
                <p>Status           : Vigente</p>
                <p>Entradas Vendidas: 1500</p>
                <p>Total Acumulado  : 17500.00</p>
                <p>Deposito Creador : 3000.00</p>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel">Cancelación de Evento</h4>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <h4>Nubeluz El Encuentro</h4>
                <p>Motivo de cancelación </p>
                <input></input>
                <p>Fecha de reembolso</p>
                <input type="date"></input>  
                
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">Guardar</button>
                </div>
              </div>
            </div>
          </div>



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