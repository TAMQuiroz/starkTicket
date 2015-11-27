@extends('layout.admin')

@section('style')

@stop

@section('title')
	Nueva Categoria
@stop

@section('content')
  <!-- Contenido-->
  <div class="row">
    <div class="col-sm-8">
      {!!Form::open(array('route' => 'categories.store','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-10">
            {!!Form::text('name', null, ['class'=>'form-control','id'=>'inputEmail3','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label for="inputImage" class="col-sm-2 control-label">Imagen</label>
          <div class="col-sm-10">
            {!! Form::file('image', ['class' => 'form-control', 'id' => 'inputImage','required']) !!}
          </div>
        </div>  
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Descripción</label>
          <div class="col-sm-10">
            {!!Form::textarea('description',null,['class'=>'form-control','rows'=>5,'id'=>'description','required'])!!}
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2" for="isSub">Subcategoria?</label>
          <div class="col-sm-10">
            <input id="isSub" name="isSub" value="1" type="checkbox" @if (old('father_id') != '') checked @endif data-toggle="collapse" data-target="#subcategoryForm" @if (count($categories_list)===0) disabled @endif>  
          </div>
        </div>
        <div id="subcategoryForm" class="collapse form-group @if (old('father_id') != '') in @endif">
          <label class="col-sm-2" for="subcategory">Elija Categoria</label>
          <div class="col-sm-10">
            {!! Form::select('father_id', $categories_list->toArray(), null, array('class' => 'form-control','id' => 'subcategory')) !!}
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
<script type="text/javascript">
  $("#isSub").isChecked()
</script>
@stop