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
            {!!Form::open(array('route' => ['categories.update',$category->id],'files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="" value="{{$category->name}}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Imagen</label>
                <div class="col-sm-10">
                  <input type="file" name="image" class="form-control" id="inputEmail3" placeholder="">{{$category->image}}
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="description" text="{!!old('description')!!}" rows="5" required>{{$category->description}}</textarea>
                </div>
              </div>
              <div class="form-group @if ($category->type == 1) hidden @endif">
                <label class="col-sm-2" for="isSub">Subcategoria?</label>
                <div class="col-sm-10">
                  <input id="isSub" type="checkbox" data-toggle="collapse" data-target="#subcategoryForm" checked disabled>  
                </div>
              </div>
              <div id="subcategoryForm" class="collapse form-group @if ($category->type == 2) in @endif">
                <label class="col-sm-2" for="subcategory">Elija Categoria</label>
                <div class="col-sm-10">
                  {!! Form::select('father_id', array('' => '') +$categories_list->toArray(), $category->father_id, array('class' => 'form-control','id' => 'subcategory')) !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info">Guardar</button>
                  <a href="{{action('CategoryController@index')}}"><button type="button" class="btn btn-info">Cancelar</button></a>
                </div>
              </div>
            </form>
          </div>
        </div>

@stop

@section('javascript')

@stop