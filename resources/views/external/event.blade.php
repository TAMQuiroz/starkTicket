@extends('layoutExternal')

@section('style')
	<style>
      #map {
        width: 400px;
        height: 400px;
      }
    </style>
@stop

@section('content')
	<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row">
				
					<!-- Content -->
						<div id="content" class="8u skel-cell-important">
							<section>
								<header>
									<h2>PIAF DE PAM GEMS</h2>
									<!--<span class="byline">Donec vivamus fermentum nibh in augue praesent</span>-->
									<p>Teatro Peruano Japonés</p>
								</header>
								<p><a href="#" class="image full">{!! Html::image('images/piaf.jpg') !!}</a></p>
								<p>Maecenas pede nisl, elementum eu, ornare ac, malesuada at, erat. Proin gravida orci porttitor enim accumsan lacinia. Donec condimentum, urna non molestie semper, ligula enim ornare nibh, quis laoreet eros quam eget ante. Aliquam libero. Vivamus nisl nibh, iaculis vitae, viverra sit amet, ullamcorper vitae, turpis. Aliquam erat volutpat. Vestibulum dui sem, pulvinar sed, imperdiet nec, iaculis nec, leo. Fusce odio. Etiam arcu dui, faucibus eget, placerat vel, sodales eget, orci. Donec ornare neque ac sem. Mauris aliquet. Aliquam sem leo, vulputate sed, convallis at, ultricies quis, justo. Donec nonummy magna quis risus. Quisque eleifend. Phasellus tempor vehicula justo.</p>
								<br>
								<button type="button" class="btn btn-info">Comprar Entrada</button>
								<button type="button" class="btn btn-info">Reservar</button>
								<div class="seats">
									<div class="demo">
							   			<div id="seat-map">
											<div class="front">SCREEN</div>					
										</div>
										<div class="booking-details">
											<p>Movie: <span> Gingerclown</span></p>
											<p>Time: <span>November 3, 21:00</span></p>
											<p>Seat: </p>
											<ul id="selected-seats"></ul>
											<p>Tickets: <span id="counter">0</span></p>
											<p>Total: <b>$<span id="total">0</span></b></p>
													
											<button class="checkout-button">BUY</button>
													
											<div id="legend"></div>
										</div>
										<div style="clear:both"></div>
								   </div>

								   
								</div>
							</section>
						</div>
					<!-- /Content -->
						
					<!-- Sidebar -->
						<div id="sidebar" class="4u">
							<section>
								<header>
									<h2 class="detail">Detalle de evento</h2>
									<!--<span class="byline">Praesent lacus congue rutrum</span>-->
								</header>
								<h3 class="dates">Fechas del evento</h3>
								<p>Del 17 de Septiembre al 26 de Octubre 2015</p>
								<br>
								<h3 class="dates">Ubicación</h3>

								<p>Av. Gregorio Escobedo 803, Jesús María 15076</p>
								<div id="map"></div>

								<h3 class="dates">Distribución de asientos</h3>
								<p>{!! Html::image('images/asientos.jpg') !!}</p>
							</section>
						</div>
					<!-- Sidebar -->
						
				</div>
			
			</div>
		</div>
	<!-- Main -->
	
@stop

@section('javascript')
	<script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          center: new google.maps.LatLng(-12.087444,-77.054986),
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script type="text/javascript">
		var price = 10; //price
		$(document).ready(function() {
			var $cart = $('#selected-seats'), //Sitting Area
			$counter = $('#counter'), //Votes
			$total = $('#total'); //Total money
			
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
									
						return 'selected';
					} else if (this.status() == 'selected') { //Checked
							//Update Number
							$counter.text(sc.find('selected').length-1);
							//update totalnum
							$total.text(recalculateTotal(sc)-price);
								
							//Delete reservation
							$('#cart-item-'+this.settings.id).remove();
							//optional
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
		</script>
@stop