@extends('layoutExternal')

@section('style')
	<style>
      #map {
        width: 400px;
        height: 400px;
      }
    </style>
@stop

@section('title')
	Evento
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
								<div class="table-responsive">
								  <table class="table table-bordered" style="widht:1px">
								    <thead>
								        <tr>
								            <th>Zona</th>
								            <th>Precio</th>
								        </tr>
								    </thead>
								    <tbody>
								        <tr>
								            <td>VIP</td>  
								            <td>S/150.00</td>
								        </tr>
								        <tr>
								            <td>Platea</td>  
								            <td>S/.70</td>
								        </tr>
								    </tbody>
								  </table>
								</div>
								<a href="{{url('client/event/1/buy')}}"><button type="button" class="btn btn-info">Comprar Entrada</button></a> <!---->
								<a href="{{url('client/1/reservanueva')}}"><button type="button" class="btn btn-info">Reservar Entrada</button></a>
								<br><br>
								<div class="form-group">
								  <label for="comment">Ingrese comentario:</label>
								  <textarea class="form-control" rows="5" id="comment"></textarea>
								  <button type="submit" class="btn btn-info">Aceptar</button>
								  <br><br>
								  <label for="comment">Comentarios:</label>
								  <h6><button class="btn btn-info">x</button> Peppa: </h6>
								  <input class="form-control" type="text" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. " readonly>
								  <h6><button class="btn btn-info">x</button> Suzy: </h6>	
								  <input class="form-control" type="text" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. " readonly>
								  <h6><button class="btn btn-info">x</button> George: </h6>	
								  <input class="form-control" type="text" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna. " readonly>
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
								<h3 class="dates">Horario</h3>
								<p>Función a las 20:00</p>
								<h3 class="dates">Ubicación</h3>

								<p>Av. Gregorio Escobedo 803, Jesús María 15076</p>
								<div id="map"></div>

								<h3 class="dates">Distribución de Zonas</h3>
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