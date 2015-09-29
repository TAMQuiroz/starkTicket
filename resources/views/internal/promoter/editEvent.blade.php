@extends('layout.promoter')

@section('style')
  <!--{!!Html::style('css/modern-business.css')!!} -->
  <!-- {!!Html::style('css/estilos.css')!!} -->
@stop

@section('title')
    Editar Evento
@stop

@section('content')
        <!-- Contenido-->
        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Lugar</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" rows="5" id="comment">
                  </textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Categoría</label>
                <div class="col-sm-10">
                    <select class="form-control" id="sel1">
                        <option>Concierto</option>
                        <option>Teatro</option>
                        <option>Ferias y Circo</option>
                        <option>Otros</option>
                    </select>
                </div>            
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Sub categoría</label>
                <div class="col-sm-10">
                    <select class="form-control" id="sel1">
                        <option>Rock</option>
                        <option>Cumbia</option>
                        <option>Tropical</option>
                        <option>Otros</option>
                    </select>
                </div>            
              </div>  
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Organizador</label>
                <div class="col-sm-10">
                    <select class="form-control" id="sel1">
                        <option>Pepitos Produccione</option>
                        <option>Rayo en la botella</option>
                        <option>Hermanos yaipen</option>
                    </select>
                </div>            
              </div>                                       
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Imagen ubicación</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Imagen evento</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="inputEmail3" placeholder="">
                </div>
              </div>     
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Estado</label>
                <div class="col-sm-10">
                  <label class="radio-inline"><input type="radio" name="optradio">Vigente</label>
                  <label class="radio-inline"><input type="radio" name="optradio">Finalizado</label>
                  <label class="radio-inline"><input type="radio" name="optradio">Cancelado</label>  
                </div>
              </div>                                    
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a  class="btn btn-info" href="{{url('promoter/event/addFunction')}}"  >Siguiente</a>
                  <a class="btn btn-info"  href="{{url('promoter/event/record')}}" >Cancelar</a>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-9 col-sm-10">
                  <a class="btn btn-info"  href="{{url('promoter/event/record')}}" >Guardar cambios</a>
                </div>
              </div>              
            </form>
          </div>

          
        </div>

@stop

@section('javascript')

  {!!Html::script('js/moment.js')!!}
  {!!Html::script('js/rangepicker.js')!!}
@stop