@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Historial de eventos
@stop

@section('content')
    <table class="table table-bordered table-striped" id="events">
      <thead>
        <tr>
          <!-- <th>Código de Evento</th> -->
          <th>Nombre de Evento</th>
          <th>Fecha Publicación eventos</th>
          <th>Fecha Inicio ventas</th>
          <th>Estado</th>
          <th>Entradas Vendidas</th>
          <th>Monto Acumulado</th>
          <th>Pagar</th>
          <th>Ver</th>
          <th>Editar</th>
          <th>Cancelar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($events as $event)
        <tr>
          <!-- <td>{{$event->id}}</td> -->
          <td>{{$event->name}}</td>
          <td>{{date("d/m/Y",$event->publication_date)}}</td>
          <td>{{date("d/m/Y",$event->selling_date)}}</td>
          <td>Vigente</td> <!--falta la logica de vigente -->
          <td>1500</td> <!--no hay -->
          <td>17500.00</td> <!--no hay -->
          <td><a href="{{ url ('promoter/transfer_payments/'.$event->id.'/create') }}" class="btn btn-info">$</a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info{{$event->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button>
      <div class="modal fade" id="info{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Detalle de Evento</h4>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
            <h4>Nombre: {{$event->name}}</h4>
            <p>Código:  {{$event->id}} </p>
            <p>Creado Por: {{$event->organization->organizerName}} {{$event->organization->organizerLastName}}  </p>
            <p>Promotor: {{$event->organization->organizerName}} {{$event->organization->organizerLastName}}</p>
            <p>Descripción:  {{$event->description}} </p>
            <p>Local: {{$event->place->name}} </p>
            <p>Categoria: {{$event->category->name}} </p>
            <!-- <p>Sub Categoria: {{$event->category->name}} </p> -->
            <p>Fecha Creación: {{date_format(date_create($event->created_at),"d/m/Y")}}</p>
            <p>Fecha Publicación: {{date("d/m/Y",$event->publication_date)}}</p>
            <p>Fecha Inicio ventas: {{date("d/m/Y",$event->selling_date)}}</p>
            <p>Duracion función: {{$event->time_length}} hora(s) </p>
            <!-- <p>Fecha Duración del {{date("d/m/Y",$event->selling_date)}} al {{date("d/m/Y",strtotime("+".$event->time_length."days",$event->selling_date))}}</p> -->
            <h4>Entradas:</h4>
            <ul>
              @foreach ($event->zones as $zone)
                <li>
                    {{$zone->name}} : S/. {{$zone->price}}
                </li>
              @endforeach
            </ul>
            <h4>Funciones:</h4>
            <ul>
              @foreach ($event->presentations as $present)
                <li>
                    Funcion: {{date("d/m/Y",$present->starts_at)}}
                </li>
              @endforeach
            </ul>
            <br>
            <h4>Información de Ventas</h4>
            <p>Proximamente</p>

            <br>
            {!! Html::image($event->image, null, array('class'=>'module_img')) !!}
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
          </td>
          <td><a type="button" class="btn btn-info" href="{{url('promoter/event/'.$event->id.'/edit')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#deleteEvent{{$event->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
        </tr>

        <div class="modal fade" id="deleteEvent{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel">Cancelación de Evento</h4>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <h4>{{$event->name}}</h4>
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

        @endforeach
        </tbody>
      </table>



@stop
