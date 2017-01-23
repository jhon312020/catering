<?php

	//echo $lang;

	$template_path = base_url()."assets/cc/";

	$ln = $this->uri->segment(1);

	//echo $ln;die;

	$this->load->view('navigation_menu');

	if(!$ln || $ln == ""){	$ln = "es"; }

	$extra_array = json_decode($bookings['extra_array'], true);	

?>

<html>

     <head>

	   <style>

	   /*

 * Row with equal height columns

 * --------------------------------------------------

 */

.row-eq-height {

  display: -webkit-box;

  display: -webkit-flex;

  display: -ms-flexbox;

  display:         flex;

}

		td{

			border:none !important;

			line-height: 1.42857;

			padding-bottom:5px;

			vertical-align: top;

			font-size:15px !important;

		}

		.well {

			border:1px dotted #88758d;

			padding: 19px;

			margin-bottom: 20px;

		}

		body {

			font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;

			line-height: normal;

			font-size: 12px;

			color: #58385f;

		}

		/* columns of same height styles */

		.row-full-height {

		  height: 100%;

		}

		.col-full-height {

		  height: 100%;

		  vertical-align: middle;

		}

		.row-same-height {

		  display: table;

		  width: 100%;

		  /* fix overflow */

		  table-layout: fixed;

		}

		.col-xs-height {

		  display: table-cell;

		  float: none !important;

		}

		@media (min-width: 768px) {

		  .col-sm-height {

			display: table-cell;

			float: none !important;

		  }

		}

		@media (min-width: 992px) {

		  .col-sm-height {

			display: table-cell;

			float: none !important;

		  }

		}

		@media (min-width: 1200px) {

		  .col-sm-height {

			display: table-cell;

			float: none !important;

		  }

		}

	</style>

	</head>

	<body>

	<div class="container" id="reserva01">

		<img src="<?php echo $ln=='en'? $template_path.'images/header_english.jpg':$template_path.'images/header_spanish.jpg'; ?>" style="width:100%;margin:0px!important;padding:0px!important;margin-bottom:15px!important;">

		<div class="row" style="margin-top:25px!important;">

			<div class="col-sm-12">

				<div class="col-sm-6" style="height:50px;background-color:#391B38;display: table;">

					<span style="font-size:18;padding-left:10px;color:#fff;vertical-align:middle;display: table-cell;"><?php echo lang('no_reference').': <span style="font-weight:bold;">'.$book_reference; ?></span></span>

				</div>

				<div class="col-sm-6" style="height:50px;background-color:#391B38;color:#fff;display: table;font-weight:bold;">

					<?php if($bookings['book_role'] == 2){ ?>

						<span style="font-size: 18px !important;color:#fff;vertical-align:middle;display: table-cell;"><?php echo lang('collaborator_name').': '.$bookings['collaborator_name']; ?></span>

					<?php } ?>

				</div>

			</div>

		</div>

		<div class="row" >

			<div class="col-sm-12">

				<div class="col-sm-6">

					<div style="width:100%;display: table;height:50px;border-bottom: 1px dotted #7D4884 !important;margin-top:10px;">

						<span style="font-size:18px !important;padding-left:10px;color:#7D4884;vertical-align:middle;display: table-cell;"><?php echo lang('booking_information'); ?></span>	

					</div>

					<div>

						<table class="table" style="margin-top:10px;">

							<tbody>

								<tr>

									<td style="color:#7D4884;"><?php echo lang('from'); ?>:</td>

									<td style="" colspan=3><?php echo $bookings['start_from']; ?></td>

								</tr>

								<tr>

									<td style="color:#7D4884;"><?php echo lang('to'); ?>:</td>

									<td colspan=3><?php echo $bookings['end_at']; ?></td>

								</tr>

								<tr>

									<td style="color:#7D4884;"><?php echo lang('date_go'); ?>:</td>

									<td><?php echo Date('d/m/Y', strtotime($bookings['start_journey'])); ?></td>

									<td style="color:#7D4884;"><?php echo lang('hour_go'); ?>:</td>

									<td><?php echo Date('H:i', strtotime($bookings['hour'])).'h'; ?></td>

								</tr>

								<?php

								if(isset($return_bookings)){

								?>

								<tr>

									<td style="color:#7D4884;"><?php echo lang('date_back'); ?></td>

									<td><?php echo Date('d/m/Y', strtotime($return_bookings['start_journey'])); ?></td>

									<td style="color:#7D4884;"><?php echo lang('hour_back'); ?>:</td>

									<td><?php echo Date('H:i', strtotime($return_bookings['hour'])).'h'; ?></td>

								</tr>

								<?php } ?>

								<tr>

									<td style="color:#7D4884;"><?php echo lang('country'); ?>:</td>

									<td><?php echo $countries[$bookings['country']]; ?></td>

									<td style="color:#7D4884;"><?php echo lang('flight_no'); ?>:</td>

									<td><?php echo $bookings['flight_no']; ?></td>

								</tr>

								<tr>

									<td style="color:#7D4884;border-bottom: 1px dotted #7D4884!important;"><?php echo lang('adults'); ?>:</td>

									<td style=""><?php echo $bookings['adults']; ?></td>

									<td style="color:#7D4884;"><?php echo lang('kids'); ?>:</td>

									<td style="border-bottom: 1px dotted #7D4884!important;"><?php echo $bookings['kids']; ?></td>

								</tr>

								<tr style="border-bottom:1px solid #391B38 !important;">

									<td colspan=3 style="color:#7D4884;padding-top: 15px; padding-bottom: 15px;"><?php echo lang('passengers_price'); ?>:</td>

									<td style="text-align:right;padding-top: 15px; padding-bottom: 15px;"><?php echo $bookings['passenger_price']; ?>&nbsp;&euro;</td>

								</tr>

							</tbody>

						</table>

					</div>

					<div style="width:100%;display: table;height:50px;border-bottom: 1px dotted #7D4884 !important;color:#7D4884 !important;">

						<span style="font-size:20px;padding-left:10px;vertical-align:middle;display: table-cell;">Extras</span>	

					</div>

					<?php if(count($extra_array) > 0) { ?>

					<div style="width:100%;display: table;height:50px;border-bottom: 1px dotted #7D4884 !important;color:#7D4884 !important;">

						<table class="table">

							<tbody>

								<?php

								$count=1;

									foreach($extra_array as $ex) {

								?>

								<tr>

									<td style="font-size:20px !important;"><?php echo $ex['extra_name'].' (+'.$ex['extra_count'].')'; ?></td>

									<td style="text-align:right;font-size:20px !important;">+<?php echo $ex['extra_value']; ?>&nbsp;&euro;</td>

								</tr>

								<?php

									$count++;

								}

								?>

							</tbody>

						</table>

					</div>

					<?php } ?>

					<?php if($bookings['promotional_code_id']){ ?>

					<div style="width:100%;display: table;height:50px;">

						<table class="table">

							<tbody>

								<tr style="border-bottom:1px solid #391B38 !important;color:#7D4884;">

									<td style="font-size:20px !important;padding-top: 15px; padding-bottom: 15px;"><?php echo ($bookings['promotional_type'] == 'price')?'Promotional code deduction price':'Promotional code deduction '.$bookings['promotional_value'].' %'; ?></td>

									<td style="font-size:20px !important;text-align:right;padding-top: 15px; padding-bottom: 15px;">-<?php echo $bookings['reduction_value']; ?>&nbsp;&euro;</td>

								</tr>

							</tbody>

						</table>	

					</div>

					<?php } ?>

				</div>

				<div class="col-sm-6">

					<div style="width:100%;display: table;height:50px;border-bottom: 1px dotted #7D4884 !important;margin-top:10px;">

						<span style="font-size:18px !important;padding-left:10px;color:#7D4884;vertical-align:middle;display: table-cell;"><?php echo lang('personal_information'); ?></span>	

					</div>

					<div style="width:100%;">

						<table class="table" style="margin-top:10px;">

							<tbody>

								<?php

									$key = array('name', 'surname', 'email', 'phone', 'address', 'postcode', 'country', 'city', 'nationality', 'id_or_passport', 'number_of_document');

									$i=0;

									foreach($clients as $ckey=>$cvalue){

									?>

									<tr style="<?php echo ($key[$i] == 'number_of_document')?'border-bottom: 1px solid #391B38 !important;padding-bottom:10px !important;':''; ?>">

										<td style="color:#7D4884;"><?php echo lang($key[$i]); ?>:</td>

										<td style=""><?php echo ($ckey == 'dni_passport')?lang('dni_'.$cvalue):$cvalue; ?></td>

									</tr>

									<?php

									$i++;

									}

								?>

							</tbody>

						</table>

					</div>

					<?php 

						$payment_status = '';

						switch($bookings['book_status']) {

							case 'completed':

								$payment_status = lang('completed');

								break;

							case 'pending':

								$payment_status = lang('pending');

								break;

							case 'cash':

								$payment_status = lang('cash_payment');

								break;

							case 'paid':

								$payment_status = lang('pre_paid');

								break;		

						}

					?>

					<div style="width:100%;">

						<div class="col-sm-6" style="display: table;height:50px;background-color:#DFDFDF;">

							<span style="vertical-align:middle;display: table-cell;font-size:20px;color:#ec7123 !important;font-weight:bold;padding-left:10px;color:#f58847;"><?php echo lang('price').'  <span style="color:#7D4884 !important;font-weight:normal;">('.$payment_status.')</span>'; ?></span>	

						</div>

						<div class="col-sm-6" style="display: table;height:50px;background-color:#DFDFDF;">

							<span style="color:#391B38 !important;font-weight:bold;text-align:right;vertical-align:middle;display: table-cell;font-size:20px;"><?php echo $bookings['price']; ?>&nbsp;&euro;</span>	

						</div>

					</div>

				</div>

			</div>

		</div>	

		<div class="row">

			<div class="col-sm-12">

				<h3 style="font-weight:bold;"><?php echo strtoupper(lang('important_information')); ?><h3>

			</div>

			<?php if($ln == 'en') { ?>

			<div class="col-sm-12 row-same-height">

				<div class="col-sm-height" style="width:22%;background-color:#816780;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">Pick’n Go is a shared shuttle service. (Keep it simple. Who cares if it's minivan or minibus?)</span>

					</div>

				</div>

				<div class="col-sm-height" style="width:22%;background-color:#4b254a;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">All our drivers hold a sign with Pick'n Go logo. They all wear blue jeans and colorful converse shoes</span>

					</div>

				</div>

				<div class="col-sm-height" style="width:28%;background-color:#816780;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">All our vans have logo on doors (is it necessary to explain the car- exceptions? You will let them know if that's the case, right?)</span>

					</div>	

				</div>

				<div class="col-sm-height" style="width:18%;background-color:#4b254a;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">Check the map below to locate our vehicles at the exit of the terminal</span>

					</div>	

				</div>

				<div class="col-sm-height" style="width:18%;background-color:#816780;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">It is strictly forbidden to get off the vehicle until final destination.</span>

					</div>	

				</div>

			</div>

			<?php } else { ?>

			<div class="col-sm-12 row-same-height">

				<div class="col-sm-height" style="width:22%;background-color:#816780;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">Pick'n es un servicio de transporte compartido. (Asi de simple. Que importa si es un minivan o microbús?)</span>

					</div>

				</div>

				<div class="col-sm-height" style="width:22%;background-color:#4b254a;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">Todos nuestros conductores llevan un distintivo con el logo de Pick'n Go Todos usan jeans azul y converse de colores</span>

					</div>

				</div>

				<div class="col-sm-height" style="width:28%;background-color:#816780;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">Todos nuestros vehículos tienen logotipo en las puertas (¿es necesario explicar las excepciones de coche? Nos lo hareis saber si es necesario, no?)</span>

					</div>	

				</div>

				<div class="col-sm-height" style="width:18%;background-color:#4b254a;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">Comprobar el mapa para localizar nuestros vehículos a la salida de la terminal</span>

					</div>	

				</div>

				<div class="col-sm-height" style="width:18%;background-color:#816780;">

					<div style="padding:10px;">

						<span style="color:#fff;font-size:16px !important;">Está estrictamente prohibido bajarse del vehículo hasta llegar a su destino.</span>

					</div>	

				</div>

			</div>

			<?php } ?>

		</div>

		<div class="row" style="margin-top:30px;border-top:1px dotted #f18545;">

			<div class="col-sm-12">

				<p style="text-align:justify;padding-top:10px;">

					<?php echo lang('query_booking'); ?>

				</p>

			</div>	

		</div>

		<div class="row" style="margin-top:20px;">

			<div class="col-sm-12">

				<img src="<?php echo $template_path.'images/routes.png'; ?>" style="margin:0px!important;padding:0px!important;margin-bottom:15px!important;width:100%;">			

			</div>	

		</div>

		<div class="row" style="margin-top:20px;">

			<div class="col-sm-12">

				<h3 style="font-weight:bold;color:#f18545;">BOOKING TERMS & CONDITIONS<h3>

			</div>	

		</div>

		<?php if($ln == 'en') { ?>

		<div class="row">

			<div class="col-sm-12">

				<div class="row" style="">

					<div class="col-sm-12">

						<p style="font-weight:bold;">Airport pick-up</p>

						<p>Our hostess will be waiting for you at arrivals lounge, holding a board with your name. If you can’t find her, please call to our airport assistance number +34628 000 785 (9.00am-22.00pm) or +34646 401 942 (24hs)</p>

						<p>Once you meet our staff, you may be waiting up to 30 minutes. Please understand it’s a shared van and we need to accommodate other passengers.</p>

						<p>If your flight is delayed, don’t worry! We check all the timings and we wait for you. </p>

						<p>We reserve the right for pick-ups on flights arriving at 23hr that have a 2 hour delay or more. </p>

					</div>	

				</div>

				<div class="row" style="">

					<div class="col-sm-12">

						<p style="font-weight:bold;">Hotel / other pick-up</p>

						<p>Please be ready 10 minutes beforehand. We may take up to 30 minutes to pick you up from the time you designate, as we normally pick up other passengers in the same ride. Please be patient as we ALWAYS deliver. </p>

						<p>In case we come pick you and you’re not ready you will have 5 extra minutes to show up, otherwise our drivers will leave you. No expenses will be covered.</p>
                        
                        <p>Pick'n Go is an independent company that serves hotels and individuals in Barcelona. Pick'n Go does not belong to any hotel and its activity is totally external.</p>

					</div>	

				</div>

				<div class="row" style="">

					<div class="col-sm-12">

						<p style="font-weight:bold;">CANCELLATION POLICY</p>

						<p>No fees for cancellation up to 24hours prior the start time of service.</p>

						<p>100% of the total price of the service, when the cancellation occurs less than 24hrs prior the service or the passenger does not appear.</p>

					</div>	

				</div>

			</div>

		</div>	

		<?php } else { ?>

		<div class="row">

			<div class="col-sm-12">

				<div class="row" style="">

					<div class="col-sm-12">

						<p style="font-weight:bold;">Recogida en el aeropuerto</p>

						<p>Nuestra hostes le estará esperando en la puerta de llegadas, sosteniendo  una tablet con su nombre. Si no puede encontrarla, por favor llame a nuestro número de asistencia en aeropuerto +34628 000 785 (9:00-10:00) o al +34646 401 942 (24 hs)</p>

						<p>Una vez que usted este con nuestro personal,  puede que tenga que  esperar hasta 30 minutos. Por favor, comprenda que es una furgoneta compartida y necesitamos dar cabida a otros pasajeros. </p>

						<p>Si su vuelo se retrasa, no se preocupe! Comprobamos todos los horarios y sus modificaciones  y le esperamos!!</p>

						<p>En vuelos con llegadas a partir de las 23h y que tengan un retraso de 2 horas o más, nos reservamos el derecho de realizar el servicio.</p>

					</div>	

				</div>

				<div class="row" style="">

					<div class="col-sm-12">

						<p style="font-weight:bold;">Hotel / otros Pick-up</p>

						<p>Por favor esten listos con 10 minutos de antelacion. Pick'n Go dispondrá un margen de 30 minutos, desde la hora de su reserva, para recogerle, normalmente recogemos a otros pasajeros en el mismo trayecto. Por favor tenga paciencia, SIEMPRE llegamos.</p>

						<p>En caso de que vengamos  a buscarle y usted no esté listo tendrá 5 minutos extras o de lo contrario nuestros conductors se iran. En ese caso no nos haremos responsables de cualquier gasto extra que pudiera tener. </p>
                        
                       <p>Pick'n Go es una empresa independiente que da servicio a hoteles y particulares en Barcelona. Pick'n Go no pertenece a ningún hotel y su actividad es totalemnte externa.</p>

					</div>	

				</div>

				<div class="row" style="">

					<div class="col-sm-12">

						<p style="font-weight:bold;">POLITICA DE CANCELACION</p>

						<p>No se cobrara el recargo de los servicios cuando se cancele con 24hrs de antelacion al servicio.</p>

						<p>Se cobrara el 100% del servicios cuando la cancelacion sea inferior a 24hrs o los pasajeros no aparezcan</p>

					</div>	

				</div>

			</div>

		</div>		

		<?php } ?>

	</div>

	<?php $this->load->view('footer'); ?>	

	<script>

	function Function(){

		var e = $('#reserva01').clone();

		$('button.print', e).remove();

		

		var content = e.html();

		var printWindow = window.open('', '', 'height=400,width=800');

			printWindow.document.write('<html><head><title>DIV Contents</title>');

				   printWindow.document.write('<style>'+

		'td{'+

			'border:none !important;'+

			'padding-bottom:5px;'+

			'line-height: 1.42857;'+

			'vertical-align: top;'+

			'font-size:12px !important;'+

		'}'+

		'.well {'+

			'border:1px dotted #88758d;'+

			'padding: 19px;'+

			'margin-bottom: 20px;'+

		'}'+

		'body {'+

			'font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;'+

			'line-height: normal;'+

			'font-size: 12px;'+

			'color: #58385f;'+

		'}'+

	'</style>')



			printWindow.document.write('</head><body>');

            printWindow.document.write(content);

			

			printWindow.document.write('</body></html>');

			printWindow.document.close();

			

            

            printWindow.document.close();

            printWindow.print();

	}

	</script>

	

	</body>

</html>

