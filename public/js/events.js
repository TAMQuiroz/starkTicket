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
                  if(this.node().hasClass('unavailable')){
                    alert("No se puede seleccionar un asiento no disponible!");
                    this.status('unavailable');
                    return 'unavailable';
                  }

                  if(this.status()=='available' && this.status()!='selected'){
                      var num_cant = $('.seatCharts-cell.selected').length;
                      var unavailable = false;
                      if(num_cant<2){
                        if(num_cant == 1){
                          var id_selec1 = $('.seatCharts-cell.selected').first().attr('id');
                          var id_selec2 = this.node().attr('id');
                          var res = id_selec1.split("_");
                          var fil_ini = parseInt(res[0]);
                          var col_ini = parseInt(res[1]);
                          var res = id_selec2.split("_");
                          var fil_ini2 = parseInt(res[0]);
                          var col_ini2 = parseInt(res[1]);
                          if(col_ini > col_ini2)
                            $('#input-colIni').val(''+col_ini2);
                          else $('#input-colIni').val(''+col_ini);
                          if(fil_ini > fil_ini2)
                            $('#input-rowIni').val(''+fil_ini2);
                          else $('#input-rowIni').val(''+fil_ini);
                          $('#input-column').val(''+(Math.abs(col_ini - col_ini2)+1));
                          $('#input-row').val(''+(Math.abs(fil_ini - fil_ini2)+1));
                          var col_ini = parseInt($('#input-colIni').val());
                          var fil_ini = parseInt($('#input-rowIni').val());
                          var cant_fil = parseInt($('#input-row').val());
                          var cant_col = parseInt($('#input-column').val());
                          unavailable = false;
                          for(i = col_ini; i<col_ini+cant_col;i++){
                            for(j=fil_ini; j<fil_ini + cant_fil; j++){
                              var id = ''+j+'_'+i;
                              if(id!= id_selec2 && id!= id_selec1){
                                  if($('#'+id).hasClass('unavailable')){
                                    $('#input-colIni').val('');
                                    $('#input-rowIni').val('');
                                    $('#input-column').val('');
                                    $('#input-row').val('');
                                    $('.reserved').removeClass('reserved').addClass('available');
                                    $('.selected').removeClass('selected').addClass('available');
                                    alert('No se puede seleccionar estos asientos porque ya están ocupados por otra zona');
                                    unavailable = true;
                                    break;
                                  } 
                                  if($('#'+id).length) //check it exists
                                    $('#'+id).addClass('reserved'); //<---- este es el que funciona
                    
                              }
                            }
                            if(unavailable) break;
                          }
                        }
                        if(!unavailable){
                          this.status('selected');
                          return 'selected';
                        } else {
                          this.status('available');
                          return 'available';
                        }
                      } else{
                        alert('Ya hay dos asientos seleccionados');
                        this.status('available');
                        return 'available';
                      }
                    }
                    if(this.status()=='selected'){
                      $('#input-colIni').val('');
                      $('#input-rowIni').val('');
                      $('#input-column').val('');
                      $('#input-row').val('');
                      $('.seatCharts-cell.reserved').removeClass("reserved").addClass("available");
                      this.status('available');
                      return 'available';
                    }
            },
            focus  : function() {
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
        url: '/localSeats',
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