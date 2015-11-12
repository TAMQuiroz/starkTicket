@extends('layout.promoter')

@section('style')
  {!!Html::style('css/images.css')!!}
@stop

@section('title')
    Historial de eventos
@stop

@section('content')
    <!--Se esta pasando la variable $event_data que es una matriz de forma 
        event_data[0]=[
                        "event"             =>  $event,
                        "ticket_sum"        =>  $ticket_sum,
                        "ticket_quantity"   =>  $ticket_quantity,
                      ];
        Cada llave es un evento, para acceder, debes entrar a $event_data[indice]['event'] o $event_data[indice]['ticket_sum']
    -->
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
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($event_data as $event)
        <tr>
  
          <td>{{$event['event']->name}}</td>
          <td>{{date("d/m/Y",$event['event']->publication_date)}}</td>
          <td>{{date("d/m/Y",$event['event']->selling_date)}}</td>
          <td>Vigente</td> <!--falta la logica de vigente -->
          <td>{{$event['ticket_quantity']}}</td> <!--no hay -->
          <td>{{$event['ticket_sum']}}</td> <!--no hay -->
          <td><a href="{{ url ('promoter/transfer_payments/'.$event['event']->id.'/create') }}" class="btn btn-info">$</a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info{{$event['event']->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button>

            <div class="modal fade" id="info{{$event['event']->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Detalle de Evento</h4>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">

                  <h4>Nombre: {{$event['event']->name}}</h4>
                  <p>Código:  {{$event['event']->id}} </p>
                  <p>Creado Por: {{$event['event']->organization->organizerName}} {{$event['event']->organization->organizerLastName}}  </p>
                  <p>Promotor: {{$event['event']->organization->organizerName}} {{$event['event']->organization->organizerLastName}}</p>
                  <p>Descripción:  {{$event['event']->description}} </p>
                  <p>Local: {{$event['event']->place->name}} </p>
                  <p>Categoria: {{$event['event']->category->name}} </p>
                  
                  <p>Fecha Creación: {{date_format(date_create($event['event']->created_at),"d/m/Y")}}</p>
                  <p>Fecha Publicación: {{date("d/m/Y",$event['event']->publication_date)}}</p>
                  <p>Fecha Inicio ventas: {{date("d/m/Y",$event['event']->selling_date)}}</p>
                  <p>Duracion función: {{$event['event']->time_length}} hora(s) </p>
                 
                  <h4>Entradas:</h4>
                  <ul>
                    @foreach ($event['event']->zones as $zone)
                      <li>
                          {{$zone->name}} : S/. {{$zone->price}}
                      </li>
                    @endforeach
                  </ul>
                  <h4>Funciones:</h4>
                  <ul>
                    @foreach ($event['event']->presentations as $present)
                      <li>
                          Función: {{date("d/m/Y",$present->starts_at)}} {{date('h:i:s',$present->starts_at)}}

                      </li>
                    @endforeach
                  </ul>
                  <br>
                  <br>
                  {!! Html::image($event['event']->image, null, array('class'=>'carousel_img')) !!}
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
          <td><a type="button" class="btn btn-info" href="{{url('promoter/event/'.$event['event']->id.'/edit')}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
          <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancelEvent{{$event['event']->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
            <!-- MODAL Cancel-->
            <div class="modal fade" id="cancelEvent{{$event['event']->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel">Cancelación de Evento: {{$event['event']->name}}</h4>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <h4>Funciones:</h4>
                          <ul>
                            @foreach ($event['event']->presentations as $present)
                              <li>
                                  Funcion: {{date("d/m/Y",$present->starts_at)}} {{date('h:i:s',$present->starts_at)}}   {!! Form::checkbox("$present->id", 'yes') !!}

                              </li>
                            @endforeach
                          </ul>
                        </div>

                      </form>
                  
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#cancelModal{{$event['event']->id}}" >Guardar</button>




                    </div>
                  </div>
                </div>
              </div>

          <td>
            <a class="btn btn-info" href=""  title="Eliminar"    data-toggle="modal" data-target="#deleteModal{{$event['event']->id}}"><i class="glyphicon glyphicon-remove"></i></a>
          </td> 
            <!-- MODAL Delete-->
            <div class="modal fade"  id="deleteModal{{$event['event']->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">¿Estas seguro que desea eliminar este evento?</h4>
                  </div>
                  <div class="modal-body">
                    <h5 class="modal-title">Los cambios serán permanentes</h5>
                  </div>
                  <div class="modal-footer">
                      {!!Form::open(array('route' =>array ('events.delete',$event['event']->id)))!!}
                          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                          <button type="submit" class="btn btn-info">Si</button>
                      </form>  
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </tr>
        @endforeach
        </tbody>
      </table>     







        




@stop
