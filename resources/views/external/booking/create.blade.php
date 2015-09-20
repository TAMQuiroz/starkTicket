@extends('layoutExternal')

@section('style')
	<link href="{{ URL::asset('css/jquery.seat-charts.css')}}" rel="stylesheet">
@stop

@section('content')
	<form action="{{action('BookingController@store')}}" enctype="multipart/form-data">		
		<div class="row">
					<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header>
									<h2>Reserva de eventos</h2>
									<span class="byline">Evento n° 1</span>
								</header>
								<select>
									<option value="fecha1"> Fecha 1 </option>
									<option value="fecha2"> Fecha 2 </option>
									<option value="fecha3"> Fecha 3 </option>
								</select>
								<p>Escoge tus asientos</p>
								<div id="seat-map">
									<div class="front-indicator">Front</div>
									
								</div>
							</section>
						</div>
					<!-- /Content -->
						
					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h2>Detalle de la reserva</h2>
								</header>
								<div id="booking-details">
									<ul id="selected-seats"></ul>
					
									Total: <b>$<span id="total">0</span></b>
								</div>
								<input type="submit" value="Finalizar Reserva">
							</section>
						</div>
					<!-- Sidebar -->
		</div>
	</form>				
@stop

@section('javascript')
		{!!Html::script('js/jquery.seat-charts.js')!!}
		
		<script>
			var firstSeatLabel = 1;
		
			$(document).ready(function() {
				var $cart = $('#selected-seats'),
					$counter = $('#counter'),
					$total = $('#total'),
					sc = $('#seat-map').seatCharts({
					map: [
						'ff_ffff',
						'ff_ffff',
						'ee_eee_e',
						'ee_eee_e',
						'eee__eee',
						'eee__eee',
						'eee__eee',
					],
					seats: {
						f: {
							price   : 100,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						e: {
							price   : 40,
							classes : 'economy-class', //your custom CSS class
							category: 'Economy Class'
						}					
					
					},
					naming : {
						top : false,
						getLabel : function (character, row, column) {
							return firstSeatLabel++;
						},
					},
					legend : {
						node : $('#legend'),
					    items : [
							[ 'f', 'available',   'First Class' ],
							[ 'e', 'available',   'Economy Class'],
							[ 'f', 'unavailable', 'Already Booked']
					    ]					
					},
					click: function () {
						if (this.status() == 'available') {
							//let's create a new <li> which we'll add to the cart items
							$('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
								.attr('id', 'cart-item-'+this.settings.id)
								.data('seatId', this.settings.id)
								.appendTo($cart);
							
							/*
							 * Lets update the counter and total
							 *
							 * .find function will not find the current seat, because it will change its stauts only after return
							 * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
							 */
							$counter.text(sc.find('selected').length+1);
							$total.text(recalculateTotal(sc)+this.data().price);
							
							return 'selected';
						} else if (this.status() == 'selected') {
							//update the counter
							$counter.text(sc.find('selected').length-1);
							//and total
							$total.text(recalculateTotal(sc)-this.data().price);
						
							//remove the item from our cart
							$('#cart-item-'+this.settings.id).remove();
						
							//seat has been vacated
							return 'available';
						} else if (this.status() == 'unavailable') {
							//seat has been already booked
							return 'unavailable';
						} else {
							return this.style();
						}
					}
				});

				//this will handle "[cancel]" link clicks
				$('#selected-seats').on('click', '.cancel-cart-item', function () {
					//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
					sc.get($(this).parents('li:first').data('seatId')).click();
				});

				//let's pretend some seats have already been booked
				sc.get(['1_2', '4_1', '7_1', '7_2']).status('unavailable');
		
		});

		function recalculateTotal(sc) {
			var total = 0;
		
			//basically find every selected seat and sum its price
			sc.find('selected').each(function () {
				total += this.data().price;
			});
			
			return total;
		}
		
		</script>

@stop