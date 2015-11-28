$('document').ready(function () {

  $('#multiple-mode-on').on('click', function(){
    //alert("boolean val: "+$('#multiple-mode-on').is(":checked"));
    $('.selected').removeClass('selected').addClass('reserved');
  });
  $('#single-mode-on').on('click', function(){
    //alert("boolean val: "+$('#multiple-mode-on').is(":checked"));
    $('.selected').removeClass('selected').addClass('reserved');
  });

});

$(document).ready(function() {

       holi();

       function holi(){
       var tam= $('[id=invisible_id]').size();
       for(var i=1;i<=tam;i++){
        var numeroId = $('[name=local_id]')[0].options[i-1].value;
          $('#dist').append('<div id="seat-map-'+numeroId+'" class="seatCharts-container"  tabindex ="0"> </div>');
      }
        var e = $('[name=local_id]')[0];

        var index= e.options[e.selectedIndex].value;
        console.log(index);
        var algo = $('#row_' + index).val();
        //console.log("algo "+algo);
        var table = document.getElementById("table-zone");

        for(var i = table.rows.length - 1; i > 0; i--)
        {
            table.deleteRow(i);
        }

        if(algo !== undefined && algo >=1){
          //si el local tiene asientos y filas numeradas Do this 
          //console.log("index "+index);
          var rows = $('#row_'+index).val();
          var columns = $('#column_'+index).val();

          // setear maximo filas maxima col
          document.getElementById("input-column").max=columns;
          document.getElementById("input-row").max=rows;
          document.getElementById("input-colIni").max=columns;
          document.getElementById("input-rowIni").max=rows;

          console.log("columnas "+columns);

          console.log("filas "+rows);

          var arreglo = new Array();

          
          arreglo = getSeatsArray(index);//haremos el arreglo del local
          //console.log(arreglo);
          var seatid="seat-map-"+index;
          console.log(seatid);

          var tam= $('[id=invisible_id]').size();
          for(var i=1;i<=tam;i++){
            var numeroId = $('[name=local_id]')[0].options[i-1].value;
            $('#seat-map-'+numeroId).hide();
          }          
          //$('#seat-map-'+index).show();
          showSeatMap(index);
          $('#input-column').show();
          $('#input-row').show();
          $('#input-colIni').show();
          $('#input-rowIni').show();
          $('#label_col').show();
          $('#label_fil').show();
          $('#label_fini').show();
          $('#label_cini').show();
          $('#dist').show();
          $('#label_capacity').hide();
          $('#input-capacity').hide();

          document.getElementById('input-capacity').disabled=true;
        }else{
          //si el local no tiene asientos numerados Do this 
          //$('#seat-map').empty();

          document.getElementById('input-capacity').disabled=false;
          var tam= $('[id=invisible_id]').size();
          for(i=1;i<=tam;i++){
            $('#seat-map-'+i).hide();
          }
          //$('#seat-map').hide();
          
          $('#input-column').hide();
          $('#input-row').hide();
          $('#input-colIni').hide();
          $('#input-rowIni').hide();
          $('#label_col').hide();
          $('#label_fil').hide();
          $('#label_fini').hide();
          $('#label_cini').hide();
          $('#dist').hide();
          $('#label_capacity').show();
          $('#input-capacity').show();
        }
      }
    });


$('[name=local_id]').on('click', function(){
        var e = $('[name=local_id]')[0];

        var index= e.options[e.selectedIndex].value;
        console.log(index);
        var algo = $('#row_' + index).val();
        //console.log("algo "+algo);
        var table = document.getElementById("table-zone");

        for(var i = table.rows.length - 1; i > 0; i--)
        {
            table.deleteRow(i);
        }

        if(algo !== undefined && algo >=1){
          //si el local tiene asientos y filas numeradas Do this 
          //console.log("index "+index);
          var rows = $('#row_'+index).val();
          var columns = $('#column_'+index).val();

          // setear maximo filas maxima col
          document.getElementById("input-column").max=columns;
          document.getElementById("input-row").max=rows;
          document.getElementById("input-colIni").max=columns;
          document.getElementById("input-rowIni").max=rows;

          //console.log("columnas "+columns);

          //console.log("filas "+rows);

          showSeatMap(index);

          
          $('#input-column').show();
          $('#input-row').show();
          $('#input-colIni').show();
          $('#input-rowIni').show();
          $('#label_col').show();
          $('#label_fil').show();
          $('#label_fini').show();
          $('#label_cini').show();
          $('#dist').show();
          $('#label_capacity').hide();
          $('#input-capacity').hide();

          document.getElementById('input-capacity').disabled=true;
        }else{
          //si el local no tiene asientos numerados Do this 
          //$('#seat-map').empty();

          document.getElementById('input-capacity').disabled=false;
          var tam= $('[id=invisible_id]').size();
          for(i=1;i<=tam;i++){
            $('#seat-map-'+i).hide();
          }
          //$('#seat-map').hide();
          
          $('#input-column').hide();
          $('#input-row').hide();
          $('#input-colIni').hide();
          $('#input-rowIni').hide();
          $('#label_col').hide();
          $('#label_fil').hide();
          $('#label_fini').hide();
          $('#label_cini').hide();
          $('#dist').hide();
          $('#label_capacity').show();
          $('#input-capacity').show();
        }
      });
    
function showSeatMap(index){
    var arreglo = new Array();

          arreglo = getSeatsArray(index);//haremos el arreglo del local 2222
          var seatid="seat-map-"+index;
          //console.log(seatid);

          var tam= $('[id=invisible_id]').size();
          for(var i=1;i<=tam;i++){
            var numeroId = $('[name=local_id]')[0].options[i-1].value;
            $('#seat-map-'+numeroId).hide();
          }           
          
          var sc = $('#seat-map-'+index).seatCharts({
            map: arreglo,
            naming : {
              top : false,
              getLabel : function (character, row, column) {
                return column;
              }
            },
            click : function(){
              if(this.node().hasClass('unavailable'))
                return 'unavailable';
              if(this.node().hasClass('reserved')){
                this.status('reserved');
                return 'reserved';
              }
              if($('#multiple-mode-on').is(':checked')){
                  if(this.status()=='selected'){
                    console.log("clic en un selected");
                    if($('.selected').length>=1){
                      var selec1 = $('.selected')[0].id;
                      var selec2 = this.node().attr('id');
                      var col_ini1 = parseInt(selec1.split("_")[1]);
                      var fil_ini1 = parseInt(selec1.split("_")[0]);
                      var col_ini2 = parseInt(selec2.split("_")[1]);
                      var fil_ini2 = parseInt(selec2.split("_")[0]);
                      var col_ini = col_ini2;
                      var fil_ini = fil_ini2;
                      if(col_ini1 < col_ini2) col_ini = col_ini1;
                      if(fil_ini1 < fil_ini2) fil_ini = fil_ini1;
                      var dif1 = Math.abs(col_ini1 - col_ini2);
                      var dif2 = Math.abs(fil_ini1 - fil_ini2);
                      for(i=col_ini;i<= col_ini+dif1;i++) 
                        for(j=fil_ini;j<= fil_ini+dif2;j++){
                          var id = ""+j+"_"+i;
                          if($('#'+id).length && id!=selec1 && id!=selec2){
                            $('#'+id).removeClass('reserved').addClass('available');
                          }
                        } 
                    }
                    this.node().removeClass('selected').addClass('available');
                    this.status('available');
                    return 'available';
                  }
                  if(this.status()=='available'){
                    console.log('tiene available');
                    this.node().addClass('selected');
                    if($('.selected').length >1){
                      var selec1 = $('.selected')[0].id;
                      var selec2 = $('.selected')[1].id;
                      var col_ini1 = parseInt(selec1.split("_")[1]);
                      var fil_ini1 = parseInt(selec1.split("_")[0]);
                      var col_ini2 = parseInt(selec2.split("_")[1]);
                      var fil_ini2 = parseInt(selec2.split("_")[0]);
                      var col_ini = col_ini2;
                      var fil_ini = fil_ini2;
                      if(col_ini1 < col_ini2) col_ini = col_ini1;
                      if(fil_ini1 < fil_ini2) fil_ini = fil_ini1;
                        var dif1 = Math.abs(col_ini1 - col_ini2);
                        var dif2 = Math.abs(fil_ini1 - fil_ini2);
                      for(i=col_ini;i<= col_ini+dif1;i++) 
                        for(j=fil_ini;j<= fil_ini+dif2;j++){
                          var id = ""+j+"_"+i;
                          if($('#'+id).length){
                            if($('#'+id).hasClass('unavailable')){
                              alert("hay asientos pertencientes a otras zonas en el area seleccionada");
                              this.node().removeClass('selected').addClass('available');
                              this.status('available');
                              return 'available';
                            }
                          }
                        }
                      for(i=col_ini;i<= col_ini+dif1;i++) 
                        for(j=fil_ini;j<= fil_ini+dif2;j++){
                          var id = ""+j+"_"+i;
                          if($('#'+id).length && !$('#'+id).hasClass('selected')){
                            $('#'+id).removeClass('available').addClass('reserved');
                          }
                        }
                    }
                    this.status('selected');
                    return 'selected';
                  }
              }
              if($('#single-mode-on').is(':checked')){
                if(this.status()=='selected'){
                  this.node().removeClass('selected').addClass('available');
                  this.status('available');
                  return 'available';
                }
                if(this.status()=='available'){
                  this.node().removeClass('available').addClass('selected');
                  this.status('selected');
                  return 'selected';
                }
              }
            },
            focus  : function() {
              if(this.node().hasClass('reserved'))
                return this.style();
              if (!this.node().hasClass('unavailable')) {
                  return 'focused';
              
              } else  {
                  return this.style();
              }
            },
            legend : { //Definition legend
              node : $('#legend'),
              items : [
                [ 'a', 'available',   'Libre' ],
                [ 'b', 'unavailable', 'Ocupado'],
                [ 'c', 'reserved', 'Reservado']
              ]
            } });
          $('#seat-map-'+index).show();
}

function getSeatsArray(idLocal){
  var map = new Array;
  $.ajax({
        url: config.routes[0].getSeatsArray,
        type: 'get',
        async: false,
        data: 
        { 
            local_id: idLocal,
        },
        success: function( response ){
            if(response != "")
            {
              for(i=0; i<response.length;i++){
                var texto ="";
                for(j=0;j<response[i].length;j++)
                  texto += response[i][j];
                map.push(texto);
              }
              //return map;
            }
            else
            {
              console.log('no respuesta');  
            }
        },
        error: function( response ){
            console.log(response);
        }
    });
  return map;
}