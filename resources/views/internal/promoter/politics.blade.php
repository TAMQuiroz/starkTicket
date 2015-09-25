@extends('layout.promoter')

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
            </tr>
            <tr>
                <td>Politica 1</td>
                <td>Lorem ipsum dolor sit amet.</td>

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