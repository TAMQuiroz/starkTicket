@extends('layout.admin')

@section('style')

@stop

@section('title')
	Reporte de Ventas


@stop

@section('content')
{!!Form::open(array('url' => 'admin/report/sales', 'id'=>'form','class'=>'form-horizontal'))!!}

<div class="row">
    <div class="col-sm-3">
       <label>Ingrese nombre del evento</label>
        <div class="input-group" style="width:290px">
            <!-- 
            <input type="text" class="form-control" placeholder="Nombre del evento...">
            -->
            {!!Form::text('nameEvent', null ,['class'=>'form-control', 'id'=>'search','placeholder' => 'Nombre del evento'])!!}
            <span class="input-group-btn">
            <button class="btn btn-info" type="button" id = 'botoncito' >Buscar</button>
            </span>
        </div> 
    </div>
    <br><br><br><br>
    <div class="col-sm-2">
        <label>Desde</label>
        <input type="date" class="form-control">
    </div>
    <div class="col-sm-2">
        <label>Hasta</label>
        <input type="date" class="form-control">
    </div>
   
    <!--
    <div class="col-sm-2">
        <label>Tipo</label>

        {!!Form::select('select1', [
           'op0' => 'Tabla',
           'op1' => 'Excel',
           'op2' => 'PDF'],
           null,
           ['class' => 'form-control']
        )!!}
    </div>
    -->



 
    <div class="col-sm-3">
        <br>
            <!--<a type="button" href="{{url('admin/report/sales/download')}}" class="btn btn-info" >Descargar Archivo Excel</a>-->    
            <button type="submit" class="btn btn-info">Descargar Archivo Excel</button>

            </div>
</div>
<hr>


<div id="demo2" >
    <table class="table table-bordered table-striped" id = "example">
        <thead>
        <tr>
            <th>Nombre del evento</th>
            <th>Fecha del evento</th>
            <th>Número de entradas vendidas online</th>
            <th>Subtotal</th>
            <th>Número de entradas vendidas en módulo</th>
            <th>Subtotal</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody id="fbody">
        @foreach($eventInformation as $event)
        <tr>
            <td>{{$event[0]}}</td>
            <td>{{$event[2]}}</td>
            <td>{{$event[3]}}</td>
            <td>{{$event[4]}}</td>
            <td>{{$event[5]}}</td>
            <td>{{$event[6]}}</td>
            <td>{{$event[7]}}</td>
        </tr>
        @endforeach

        </tbody>
    </table>
</div>


<div id="chartContainer"   style="height: 300; width: 100%;"    ></div>

 {!!Form::close()!!}

@stop

@section('javascript')

<script>




$("#botoncito").click(function () {

var rows = $("#fbody").find("tr").hide();
var hehe = document.getElementById("search")//by id


if (hehe.value.length) {
    var data = hehe.value.split(" ");
    $.each(data, function (index, value) {
        rows.filter(":contains('" + value + "')").show();
    });
} else rows.show();

});

</script>


<script type="text/javascript">
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer",
        {
            title:{
                text: "Gráfico de Ventas"
            },
            legend: {
                maxWidth: 600,
                itemWidth: 120
            },
            data: [
            {
                type: "pie",
                showInLegend: true,
                legendText: "{indexLabel}",
                dataPoints: [
                    { y: 1500, indexLabel: "Peppa King" },
                    { y: 1500, indexLabel: "Artic Monkeys Concert" },
                    { y: 1500, indexLabel: "Fuerza Bruta" },
                    { y: 1500, indexLabel: "Peppa y sus amigos"}
                ]
            }
            ]
        });
        chart.render();
    }
</script>
<!--<script type="text/javascript" src="canvas-1.7.0/canvasjs.min.js"></script> -->
{!!Html::script('js/canvasjs.min.js')!!}

@stop