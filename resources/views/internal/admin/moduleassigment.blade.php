@extends('layout.admin')

@section('style')
  {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Asignación de Puntos de Venta
@stop

@section('content')
    {!!Form::open(array('url' => 'admin/modules/assigment','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
    <div class="col-sm-3">
        <label>Seleccione el Punto de Venta</label>
        {!! Form::select('module_id', $modules_list->toArray() ,null,['class' => 'form-control','required','id'=>'module_id'])  !!}
    </div>
    <div class="col-sm-3">
        <label>Ingrese Vendedor</label>
        {!! Form::number('number', null, ['class' => 'form-control', 'required', 'placeholder' => 'Documento de Identidad...','id'=>'salesman_di','min'=>0,'max'=>99999999]) !!}
    </div>
    <div class="col-sm-3">
        <label>Nombre de Vendedor</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'disabled', 'id'=>'salesman_name']) !!}
        {!! Form::hidden('salesman_id', null, ['id'=>'salesman_id'])!!}
    </div>
    <div class="col-sm-3"><br>
       <p> <a class="btn btn-info" type="button" href=""  title="Create"  data-toggle="modal" data-target="#saveModalUser">Asignar Módulo</a></p>
    </div>

    <div class="modal fade"  id="saveModalUser">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">¿Estas seguro que desea agregar esta asignación?</h4>
        </div>
        <div class="modal-body">
          <h5 class="modal-title">Los cambios serán permanentes</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
            <button id = "botonModal" type="submit" class="btn btn-info">Sí</button>
            <!--
            <a class="btn btn-info" href="" title="Create" >Sí</a>
            -->
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {!!Form::close()!!}
    <div class="col-sm-12">
        <hr>
        <h3>Modulos ya relacionados</h3>
          <table class="table table-bordered table-striped">

              <tr>
                  <th>Código del módulo</th>
                  <th>Nombre del módulo</th>
                  <th>Código del vendedor</th>
                  <th>Nombre del vendedor</th>
                  <th>Fecha de Asignación</th>
                  <th>Desasociar</th>
              </tr>

              @foreach($assigmentmodules as $assigmentmodule)
                <tr>
                    <td>{{$assigmentmodule->idModule}}</td>
                    <td>{{$assigmentmodule->nameModule}}</td>

                    <td>{{$assigmentmodule->idSalesman}}</td>
                    <td>{{$assigmentmodule->nameSalesman}} {{$assigmentmodule->lastnameSalesman}}</td>
                    <td>{{$assigmentmodule->dateAssigment}}</td>
                    <td>
                      <a class="btn btn-info" href=""  title="Eliminar" data-toggle="modal" data-target="#deleteModal{{$assigmentmodule->idAssigment}}" ><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>

                <div class="modal fade"  id="deleteModal{{$assigmentmodule->idAssigment}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">¿Estas seguro que desea desasociar el modulo de venta con el vendedor?</h4>
                      </div>
                      <div class="modal-body">
                        <h5 class="modal-title">Los cambios serán permanentes</h5>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                          <a class="btn btn-info" href="{{url('admin/modules/assigment/'.$assigmentmodule->idAssigment.'/delete')}}" title="Delete" >Sí</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
              @endforeach
          </table>
      </div>
@stop

@section('javascript')
  {!!Html::script('js/main.js')!!}
  <script type="text/javascript">
  var config = {
        routes: [
            { salesman: "{{ URL::route('ajax.getClient') }}" },
            { zone: "{{ URL::route('ajax.getClient') }}" },
            { price_ajax: "{{ URL::route('ajax.getPrice') }}" },
            { event_available: "{{URL::route('ajax.getAvailable')}}"},
            { slots: "{{URL::route('ajax.getSlots')}}"},
            { makeArray: "{{URL::route('ajax.getZone')}}"},
            { takenSlots: "{{URL::route('ajax.getTakenSlots')}}"},
            { promo: "{{URL::route('ajax.getPromo')}}"}
        ]
    };
    $('#yes').click(function(){
        $('#submitModal').modal('hide');
    });
    </script>

@stop