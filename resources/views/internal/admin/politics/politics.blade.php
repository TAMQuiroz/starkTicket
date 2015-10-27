@extends('layout.admin')

@section('style')

@stop

@section('title')
	Politicas
@stop

@section('content')
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Editar</th>
            </tr>
                  @foreach($politics as $politic)



            <tr>
                <td>{{$politic->name}}</td>
                <td>{{$politic->description}}</td>
                <td>{{$politic->state}}</td>
            <td><a class="btn btn-info" href="{{url('admin/politics/'.$politic->id.'/edit')}}" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a></td>
                    
               @endforeach
        </table>
          <!--
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
          </nav> -->
@stop

@section('javascript')

@stop