@extends('layout.promoter')

@section('style')
  {!!Html::style('css/modern-business.css')!!}
  {!!Html::style('css/estilos.css')!!}
@stop

@section('title')
    Nuevo Evento
@stop

@section('content')
        <!-- Contenido-->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="NuevoEvento.html">Inicio</a>
                    </li>
                    <li><a href="NuevoEventoFunciones.html">Funciones</a></li>
                  
                </ol>
            </div>
        </div>
        <!-- /.row --> 

        
        <fieldset>
            <div id="ez"></div>
            <legend>Información general del evento:</legend>
            <div class="container">
                <div>
                    <label for="name">Nombre del evento:</label>
                    <input  type="text" id="name" />
                </div>
                <div>
                    <label for="place">Lugar del evento:</label>
                    <input type="place" id="place" />
                </div>
                <div>
                    <label for="description">Descripción:</label>
                    <textarea id="desc"></textarea>
                </div>
                <div>
                    <label>Categoria Evento:</label>
                    <select>
                        <option value="">Concierto</option>
                        <option value="saab">Teatro</option>
                        <option value="mercedes">Ferias y Circo</option>
                        <option value="audi">Danzas</option>
                        <option value="audi">Otros</option>
                    </select>
                </div>   
                <div>
                    <label>Subcategoria Evento:</label>
                    <select>
                        <option value="">Rock</option>
                        <option value="saab">Cumbia</option>
                        <option value="mercedes">Tropical</option>
                        <option value="audi">Reggaeton más naki</option>
                        <option value="audi">Baladas</option>
                        <option value="audi">Otros</option>
                    </select>
                </div>                  
                <div>
                    <label>Organizador Evento:</label>
                    <select>
                        <option value="">Pepitos Producciones</option>
                        <option value="saab">Rayo en la botella</option>
                        <option value="mercedes">Katy perry</option>
                        <option value="audi">Hermanos yaipen</option>
                        <option value="audi">GG WP </option>
                    </select>
                </div> 
                 <div>
                    <label >Imagen ubicación:</label>
                    <input type="file" />
                </div>     
                 <div>
                    <label >Imagen evento:</label>
                    <input type="file" />
                </div>          
                <label >Estado evento:</label>          
                 <div id="radio" >
                    <input type="radio" name="Estado" value="activo" checked>Activo
                    <input type="radio" name="Estado" value="suspendido">Suspendido
                    <input type="radio" name="Estado" value="inactivo">Inactivo
                </div> 
                <!-- <a href="http://www.google.com">Siguiente</a>  -->
                <a href="{{url('promoter/event/addFunction')}}" >Siguiente</a>     
            </div>  
            <br>
    </div>  
@stop

@section('javascript')

<script src="//cdn.ckeditor.com/4.5.3/standard/ckeditor.js"></script>
  <script type="text/javascript">
    CKEDITOR.replace( 'description',
    {
        toolbar : 'Basic',
    });
  </script>

  {!!Html::script('js/moment.js')!!}
  {!!Html::script('js/rangepicker.js')!!}
@stop