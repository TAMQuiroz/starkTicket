@extends('layout.admin')

@section('style')

@stop

@section('title')
	Reporte de Ventas
@stop

@section('content')
<div class="row">
    <div class="col-sm-3">
       <label>Ingrese nombre del evento</label>
        <div class="input-group" style="width:290px">
            <!-- 
            <input type="text" class="form-control" placeholder="Nombre del evento...">
            -->
            {!!Form::text('name', null ,['class'=>'form-control','required', 'id'=>'search','placeholder' => 'Nombre del evento'])!!}
            <span class="input-group-btn">
            <button class="btn btn-info" type="button" id = 'botoncito' >Buscar</button>
            </span>
        </div> 
    </div>
    <br><br><br><br>
    <div class="col-sm-2">
        <label>Desde</label>
        
        <input id="fecha-ini" type="date" class="form-control" required="required">
        
    </div>
    <div class="col-sm-2">
        <label>Hasta</label>
        <input id="fecha-fin" type="date" class="form-control">
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
                <a type="button" href="{{url('admin/report/sales/download')}}" class="btn btn-info" >Descargar Archivo Excel</a>
    </div>
</div>
<hr>


<div id="demo2" >
    <table class="table table-bordered table-striped" id = "example">
        <thead>
        <tr>
            <th>Nombre del evento</th>
            <th>Fecha</th>
            <th>Número de entradas vendidas online</th>
            <th>Subtotal</th>
            <th>Número de entradas vendidas en módulo</th>
            <th>Subtotal</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody id="fbody">
        <tr>
            <td>Peppa King</td>
            <td>19/11/2015</td>
            <td>500</td>
            <td>3750.00</td>
            <td>200</td>
            <td>1500</td>
            <td>5200.50</td>
        </tr>
        <tr>
            <td>Arctic Monkeys Concert</td>
            <td>20/11/2015</td>
            <td>500</td>
            <td>3750.00</td>
            <td>200</td>
            <td>1500</td>
            <td>5200.50</td>
        </tr>
        <tr>
            <td>Fuerza Bruta</td>
            <td>26/11/2015</td>
            <td>500</td>
            <td>3750.00</td>
            <td>200</td>
            <td>1500</td>
            <td>5200.50</td>
        </tr>
        <tr>
            <td>Peppa y sus amigos</td>
            <td>14/12/2015</td>
            <td>500</td>
            <td>3750.00</td>
            <td>200</td>
            <td>1500</td>
            <td>5200.50</td>
        </tr>
        </tbody>
    </table>
</div>



<div id="chartContainer"   style="height: 300; width: 100%;"    ></div>


@stop"

@section('javascript')

<script>
/*
$("#botoncito").click(function () {

var rows = $("#fbody").find("tr").hide();
var hehe = document.getElementById("search")//by id


if (hehe.value.length) {
    var data = hehe.value.split(" ");
    
    $.each(data, function (index, value) {
        //rows.filter(":contains('" + value + "')").show();   
        var $rows = $(this); 
        var textFromRowNodes = $rows.children("td:nth-child(n)").text().toLowerCase();
        var searchText = data.toString().toLowerCase();
        alert(textFromRowNodes);
        if (textFromRowNodes.indexOf(searchText) !== -1) {
            alert('LO ENCONTRO');
            $rows.children("td:nth-child(n)").show();
            //return true;
            
        }    
        alert('no LO ENCONTRO');
    });
        
} else rows.show();

});

*/

$("#botoncito").click(function () {

    var rows = $("#fbody").find("tr").hide();
    var name = document.getElementById("search");    
    var data = name.value;
    var search = data.toString().toLowerCase();
    var date1 = document.getElementById("fecha-ini");
    var date2 = document.getElementById("fecha-fin");

    var dateS1 = date1.value.toString();
    var dateS2 = date2.value.toString();
    var d1 = new Date(dateS1);
    var d2 = new Date(dateS2);

    if(search==null || search == ''){ 

        //alert('23/11/1993'.split("/").reverse().join("-"));

        if(dateS1=='' && dateS2==''){
            rows.show(); 
            //alert('vacio D:'); 
        }
        if((dateS1!='' && dateS2=='') || (dateS1=='' && dateS2!='')){
            alert('Ingrese un rango de fechas');
            dateS1=='' ? $("#fecha-ini").prop('required',true) : $("#fecha-fin").prop('required',true);;
        }
        if(dateS1!='' && dateS2!=''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(2)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d1 && dtabl<=d2){
                    $this.show(); 
                }
            });
        }
    }
    else{

        if(dateS1=='' && dateS2==''){
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show(); 
            });
        }
        if((dateS1!='' && dateS2=='') || (dateS1=='' && dateS2!='')){
            alert('Ingrese un rango de fechas');
            dateS1=='' ? $("#fecha-ini").prop('required',true) : $("#fecha-fin").prop('required',true);
        }
        if(dateS1!='' && dateS2!=''){
            //rows.show();
            $rows = rows;
            $rows.each(function(){
                var $this = $(this);
                var dateST= $this.find(':nth-child(2)').text();
                var dtabl = new Date(dateST.split("/").reverse().join("-"));
                if(dtabl>=d1 && dtabl<=d2){
                    $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show(); 
                }
            });
        }
        
    }

    
});

    /*
    var date1 = document.getElementById("fecha-ini");
    var date2 = document.getElementById("fecha-fin");
    //On change
    var addOrRemoveRequiredAttribute = function () {
        if (date1.value.toString()!='') {
            date2.prop('required', true);
        }
        else {
            date2.prop('required', false);
        }
    };

    // And when textarea changes
    date1.on('change', addOrRemoveRequiredAttribute);
    */
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