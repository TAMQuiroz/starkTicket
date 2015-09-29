@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Historial de pagos
@stop

@section('content')


<!-- Contenido-->
  <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha inicio</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha fin</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control">
                    </div>
                </div>             
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Organizador</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="sel1">
                      <option>Yola polastri producciones</option>
                      <option>Rayo en la botella</option>
                      <option>Canal 2</option>
                      <option>Canal 4</option>
                      <option>Onur y sherezade</option>
                    </select>
                  </div>            
              </div>  
                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        <a class="btn btn-info">Buscar</a>
                    </div>
                </div>                           
            </form>
          </div>
  </div>          


  
  <hr>
  <h2>Pagos registrados</h2>
      <table class="table table-bordered table-striped">
        <tr>
          <th>Nombre de Evento</th>
          <th>Nombre de Organizador</th>
          <th>Nombre promotor</th>
          <th>Fecha</th>
          <th>Monto pagado</th>
          <th>Saldo</th>
        </tr>

        <tr>
          <td>Nubeluz Reencuentro</td>
          <td>Yola polastri producciones</td>
          <td>Luis Fernando</td>
          <td>25/10/2015</td>
          <td>17500.00</td>
          <td>1000.00</td>
        </tr>

        <tr>
          <td>Kiko y la Chili</td>
          <td>Rayo en la botella</td>
          <td>Luis Fernando</td>
          <td>25/10/2015</td>
          <td>8300.00</td>
          <td>0.00</td>
        </tr>

        <tr>
          <td>La banda de Pepito</td>
          <td>Canal 2</td>
          <td>Luis Fernando</td>
          <td>20/09/2015</td>
          <td>4300.00</td>
          <td>0.00</td>
        </tr>
        <tr>
          <td>Visita a Marte</td>
          <td>Canal 4</td>
          <td>Luis Fernando</td>
          <td>29/09/2015</td>
          <td>50000.00</td>
          <td>0.00</td>
        </tr>
        <tr>
          <td>Fatmagul el Musical en 2D</td>
          <td>Onur y sherezade</td>
          <td>Luis Fernando</td>
          <td>02/12/2015</td>
          <td>1000.00</td>
          <td>2000.00</td>
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