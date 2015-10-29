$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$('document').ready(function () {
	makeArray();
});

var price; //price
var map = [];
function getPrice(element){
	//console.log(element.options[element.selectedIndex].value);
	$.ajax({
        url: config.routes[1].price_ajax,
        type: 'get',
        data: 
        { 
            id: element.options[element.selectedIndex].value
        },
        success: function( response ){
            //console.log(response);
            if(response != "")
            {
                //console.log(response.price);
                price = response.price;
            }
            else
            {
             	//console.log('no respuesta');  
             	price = 0; 
            }
        },
        error: function( response ){
            
        }
    });
}

function makeArray(){
	zona = $('#zone_id').val();
	$.ajax({
        url: config.routes[4].makeArray,
        type: 'get',
        data: 
        { 
            zone_id: zona
        },
        success: function( response ){
            if(response != "")
            {
            	map = [];
            	rows = response.rows;
            	columns = response.columns;
            	console.log('F'+rows+' C'+columns);
            	for(var i = 0; i < rows; i++){
            		var texto = '';
            		for(var j = 0; j < columns; j++){
            			texto += 'a';
            		}
            		//console.log(texto);
            		map.push(texto);
            	}
                console.log(map);
                $('#parent-map').empty();
                $('#legend').empty();
                $('#parent-map').append('<div id="seat-map"></div>');
                renderSeats();
            }
            else
            {
             	console.log('no respuesta');  
            }
        },
        error: function( response ){
            
        }
    });
	
}

function renderSeats() {

	getPrice(document.getElementById('zone_id'));

	var $cart = $('#selected-seats'), //Sitting Area

	$counter = $('#counter'), //Votes
	$total = $('#total'); //Total money
	$total2 = $('#total2'); //Total money
	var selected = [];
	var sc = $('#seat-map').seatCharts({
		map: map,
		naming : {
			top : false,
			getLabel : function (character, row, column) {
				return column;
			}
		},
		legend : { //Definition legend
			node : $('#legend'),
			items : [
				[ 'a', 'available',   'Libre' ],
				[ 'a', 'unavailable', 'Ocupado'],
				[ 'a', 'reserved', 'Reservado']
			]					
		},
		click: function () { //Click event
			if (this.status() == 'available') { //optional seat
				$('<li>R'+(this.settings.row+1)+' S'+this.settings.label+'</li>')
					.attr('id', 'cart-item-'+this.settings.id)
					.data('seatId', this.settings.id)
					.appendTo($cart);
				
				$counter.text(sc.find('selected').length+1);
				$total.text(recalculateTotal(sc)+price);
				$total2.val(recalculateTotal(sc)+price);
				
				selected.push(this.settings.id);
				console.log(JSON.stringify(selected));
				//$('#seats').val(JSON.stringify(selected));
				$('#payModal').prop('disabled',false);
				return 'selected';
			} else if (this.status() == 'selected') { //Checked
				//Update Number
				$counter.text(sc.find('selected').length-1);
				//update totalnum
				$total.text(recalculateTotal(sc)-price);
				$total2.val(recalculateTotal(sc)-price);
				//Delete reservation
				$('#cart-item-'+this.settings.id).remove();
				//optional
				
				var index = selected.indexOf(this.settings.id);
				if(index > -1){
					selected.splice(index,1);
					//$('#seats').val(JSON.stringify(selected));
					if(selected.length == 0){
						$('#payModal').prop('disabled',true);
						//$('#seats').val("");
					}
					console.log(JSON.stringify(selected));

				}

				return 'available';
			} else if (this.status() == 'unavailable') { //sold
				return 'unavailable';
			} else if (this.status() == 'reserved'){
				return 'reserved';
			} else {
				return this.style();
			}
		}
	});
	//sold seat
	//sc.get(['4_4','4_5','6_6','6_7','8_5','8_6','8_7','8_8', '10_1', '10_2']).status('unavailable');
	//sc.get(['1_1','5_5']).status('reserved');
	
};
//sum total money
function recalculateTotal(sc) {
	var total = 0;
	sc.find('selected').each(function () {
		total += price;
	});
			
	return total;
}
