$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
		var price = 150; //price
		$(document).ready(function() {
			var $cart = $('#selected-seats'), //Sitting Area

			$counter = $('#counter'), //Votes
			$total = $('#total'); //Total money
			var selected = [];
			var sc = $('#seat-map').seatCharts({
				map: [  //Seating chart
					'aaaaaaaaaa',
		            'aaaaaaaaaa',
		            '__________',
		            'aaaaaaaaaa',
		            'aaaaaaaaaa',
					'aaaaaaaaaa',
					'aaaaaaaaaa',
					'aaaaaaaaaa',
					'aaaaaaaaaa',
		            'aa__aa__aa'
				],
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
						
						selected.push(this.settings.id);
						//console.log(JSON.stringify(selected));
						$('#seats').val(JSON.stringify(selected));
						
						return 'selected';
					} else if (this.status() == 'selected') { //Checked
						//Update Number
						$counter.text(sc.find('selected').length-1);
						//update totalnum
						$total.text(recalculateTotal(sc)-price);
						//Delete reservation
						$('#cart-item-'+this.settings.id).remove();
						//optional
						
						var index = selected.indexOf(this.settings.id);
						if(index > -1){
							selected.splice(index,1);
							$('#seats').val(JSON.stringify(selected));
							if(selected.length == 0)
								$('#seats').val("");
							//console.log(JSON.stringify(selected));

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
			sc.get(['4_4','4_5','6_6','6_7','8_5','8_6','8_7','8_8', '10_1', '10_2']).status('unavailable');
			sc.get(['1_1','5_5']).status('reserved');
			
		});
		//sum total money
		function recalculateTotal(sc) {
			var total = 0;
			sc.find('selected').each(function () {
				total += price;
			});
					
			return total;
		}
