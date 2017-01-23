<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$extra_array = json_decode($bookings['extra_array'], true);	
?>
<html>
     <head>
	   <style>
		td{
			border:none !important;
			line-height: 1.42857;
			padding-bottom:5px;
			vertical-align: top;
			font-size:12px !important;
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
	</style>
	</head>
	<body style="font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;line-height:normal;font-size:12px;color:#58385f;">
		<img src="<?php echo (!$pdf)?$template_path.'images/demobg.jpg':'assets/cc/images/demobg.jpg'; ?>" style="<?php echo (!$pdf)?'width:650px;':'width:100%;'; ?>margin:0px!important;padding:0px!important;margin-bottom:15px!important;">
		<table class="well" style="margin:0px!important; padding:0px!important;<?php echo (!$pdf)?'width:650px;border:1px dotted #88758d;':'width:100%;'; ?>">
			<tbody>
				<tr style="<?php echo (!$pdf)?'width:650px;':'width:100%;'; ?>margin:0px!important;padding:0px!important;">
					<td style="<?php echo (!$pdf)?'width:40%;':'width:40%;'; ?>padding-top:15px;">
						<span style="font-size:15px;padding-left:10px;color:#f58847;"><?php echo lang('no_reference'); ?></span><br>
						<span style="font-size:15px;color:#58385f;padding-left:10px;font-weight:bold;"><?php echo $start_journey['reference_id'].' - '.$bookings['id']; ?></span>
					</td>
					<td style="<?php echo (!$pdf)?'width:25%':'width:25%;'; ?>padding-top:15px;">
						<!--<span style="font-size:15px;color:#f58847;">Estimato Lorem ipsum</span><br>-->
						<span><?php echo lang('thanks_booking'); ?></span>
					</td>
					<td style="<?php echo (!$pdf)?'width:35%;':'width:35%;'; ?>padding-right:10px;<?php echo (!$pdf)?'padding-top:15px;':''; ?>">
						<p><?php echo lang('print_booking'); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
		<table style=" padding:0px !important; <?php echo ($pdf)?'margin:-3px !important;margin-top:-20px!important;margin-bottom:5px !important;':''; ?> <?php echo (!$pdf)?'width:650px;':'width:100%;'; ?>">
			<tr>
				<td style="padding-right:10px !important; width:50% !important;<?php echo (!$pdf)?'padding-top:10px;':''; ?>">
					<?php if($bookings['book_role'] == 2){ ?>
					<div class="well" style="margin:0px !important; padding-top:10px !important;border:1px dotted #88758d;">
						<table  style="width:100%;">
							<thead>
								<tr>
									<td style="font-size: 14px !important;color:#f18545;"><?php echo lang('collaborator_name'); ?></td>
									<td style="font-size: 15px !important;text-align:right; padding-right:15px;font-weight:bold;"><?php echo $bookings['collaborator_name']; ?></td>
								</tr>
							</thead>
						</table>
					</div>
					<?php } ?>
					<div class="well" style="margin:0px!important;padding:10px !important;border:1px dotted #88758d;<?php echo ($bookings['book_role'] == 2)?'margin-top:15px!important;':''; ?>">
						<table style="width:100%;">
							<thead>
								<tr>
									<td colspan=4 style="margin:10px!important; padding:0px !important;padding-bottom:15px !important;font-size:15px !important;border-bottom: 1px dotted #f18545 !important;color:#f18545;"><?php echo lang('booking_information'); ?></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="padding-top:15px;color:#f18545;"><?php echo lang('from'); ?>:</td>
									<td style="padding-top:15px;" colspan=3><?php echo $bookings['start_from']; ?></td>
								</tr>
								<tr>
									<td style="color:#f18545;"><?php echo lang('to'); ?>:</td>
									<td colspan=3><?php echo $bookings['end_at']; ?></td>
								</tr>
								<tr>
									<td style="color:#f18545;"><?php echo lang('date_go'); ?>:</td>
									<td><?php echo Date('d/m/Y', strtotime($bookings['start_journey'])); ?></td>
									<td style="color:#f18545;"><?php echo lang('hour_go'); ?>:</td>
									<td><?php echo Date('h:i a', strtotime($bookings['hour'])); ?></td>
								</tr>
								<?php
								if(isset($return_bookings)){
								?>
								<tr>
									<td style="color:#f18545;"><?php echo lang('date_back'); ?></td>
									<td><?php echo Date('d/m/Y', strtotime($return_bookings['start_journey'])); ?></td>
									<td style="color:#f18545;"><?php echo lang('hour_back'); ?>:</td>
									<td><?php echo Date('h:i a', strtotime($return_bookings['hour'])); ?></td>
								</tr>
								<?php } ?>
								<tr>
									<td style="color:#f18545;"><?php echo lang('country'); ?>:</td>
									<td><?php echo $countries[$bookings['country']]; ?></td>
									<td style="color:#f18545;"><?php echo lang('flight_no'); ?>:</td>
									<td><?php echo $bookings['flight_no']; ?></td>
								</tr>
								<tr>
									<td style="padding-bottom: 10px !important; border-bottom: 1px dotted #f18545!important;color:#f18545;"><?php echo lang('adults'); ?>:</td>
									<td style="padding-bottom: 10px !important; border-bottom: 1px dotted #f18545!important;"><?php echo $bookings['adults']; ?></td>
									<td style="padding-bottom: 10px !important; border-bottom: 1px dotted #f18545!important;color:#f18545;"><?php echo lang('kids'); ?>:</td>
									<td style="padding-bottom: 10px !important; border-bottom: 1px dotted #f18545!important;"><?php echo $bookings['kids']; ?></td>
								</tr>
								<tr>
									<td style="color:#f18545;padding-top:10px;"><?php echo lang('passengers'); ?>:</td>
									<td style="padding-top:10px;"></td>
									<td style="padding-top:10px;"></td>
									<td style="padding-top:10px;"><?php echo $bookings['passenger_price']; ?>&euro;</td>
								</tr>
								<!-- <tr>
									<td style="color:#f18545;"><?php //echo lang('baby'); ?>:</td>
									<td colspan=3><?php //echo $bookings['baby']; ?></td>
								</tr> -->
							</tbody>
						</table>
					</div>
					<div class="well" style="margin:0px!important; margin-top:15px !important;padding:10px !important;border:1px dotted #88758d;">
						<table class="table" style="width:100%;">
							<thead>
								<tr>
									<td style="padding-bottom: 10px !important; font-size: 15px !important; border-bottom: 1px dotted #f18545!important; color:#f18545;">Extras</td>
									<td colspan="3" style="padding-bottom: 10px; font-size: 15px!important; border-bottom: 1px dotted #f18545 !important;font-weight:bold;"><?php echo (count($extra_array) > 0)?lang('yes'):lang('no'); ?></td>
								</tr>
							</thead>
							<tbody>
								<?php
								
								$count=1;
								if(count($extra_array) > 0){
									foreach($extra_array as $ex){
								?>
								<tr>
									<td style="<?php echo ($count == 1)?'padding-top:15px;':''; ?>color:#f18545;"><?php echo $ex['extra_name']; ?>:</td>
									<td style="<?php echo ($count == 1)?'padding-top:15px;':''; ?>">* <?php echo $ex['extra_count']; ?></td>
									<td style="<?php echo ($count == 1)?'padding-top:15px;':''; ?>padding-right:-15px;"><?php echo $ex['extra_value']; ?> &euro;</td>
								</tr>
								<?php
									$count++;
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<?php if($bookings['promotional_code_id']){ ?>
					<div class="well" style="margin:0px!important; margin-top:15px !important;padding:10px !important;border:1px dotted #88758d;">
						<table class="table" style="width:100%;">
							<thead>
								<tr>
									<td style="padding-bottom: 10px !important; font-size: 15px !important; border-bottom: 1px dotted #f18545!important; color:#f18545;"><?php echo lang('deduction'); ?></td>
									<td colspan="3" style="padding-bottom: 10px; font-size: 15px!important; border-bottom: 1px dotted #f18545 !important;font-weight:bold;"><?php echo lang('yes'); ?></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="padding-top:15px;color:#f18545;"><?php echo ($bookings['promotional_type'] == 'price')?'Promotional code deduction price':'Promotional code deduction '.$bookings['promotional_value'].' %'; ?>:</td>
									<td style="padding-top:15px;padding-right:-15px;"><?php echo $bookings['reduction_value']; ?> &euro;</td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php } ?>
					<div class="well" style="margin:0px !important; margin-top:15px!important; padding-top:10px !important;border:1px dotted #88758d;">
						<table  style="width:100%;">
							<thead>
								<tr>
									<td style="font-size: 14px !important;color:#f18545;"><?php echo lang('price'); ?></td>
									<td style="font-size: 15px !important;text-align:right; padding-right:15px;font-weight:bold;"><?php echo $this->input->get('amt'); ?> &euro;</td>
								</tr>
							</thead>
						</table>
					</div>
					<div class="well" style="margin:0px !important; margin-top:15px!important; padding-top:10px !important;border:1px dotted #88758d;">
						<table  style="width:100%;">
							<thead>
								<tr>
									<td style="font-size: 14px !important;color:#f18545;"><?php echo lang('payment_status'); ?></td>
									<td style="font-size: 15px !important;text-align:right; padding-right:15px;font-weight:bold;"><?php echo ($bookings['book_status'] == 'completed')?lang('completed'):lang('cash_payment'); ?></td>
								</tr>
							</thead>
						</table>
					</div>
				
				</td>
				<td style="<?php echo (!$pdf)?'padding-top:10px;vertical-align: top;':''; ?>">
						<div class="well" style="margin:0px !important;padding:10px !important;border:1px dotted #88758d;">
							<table style="width:100%;">
								<thead>
									<tr>
										<td colspan=2 style="margin:10px!important; padding:0px !important;padding-bottom:15px !important;font-size:15px !important;border-bottom: 1px dotted #f18545 !important;color:#f18545;"><?php echo lang('personal_information'); ?></td>
									</tr>
								</thead>
								<tbody>
									<?php
										$key = array('name', 'surname', 'email', 'phone', 'address', 'postcode', 'country', 'city', 'nationality', 'id_or_passport', 'number_of_document');
										$i=0;
										foreach($clients as $ckey=>$cvalue){
										?>
										<tr>
											<td style="<?php echo ($i == 0)?'padding-top:15px;':''; ?>color:#f18545;"><?php $lang_key = $key[$i]; echo lang($key[$i]); ?>:</td>
											<td style="<?php echo ($i == 0)?'padding-top:15px;':''; ?>"><?php echo (($ckey == 'dni_passport')?lang('dni_'.$cvalue):$cvalue); ?></td>
										</tr>
										<?php
										$i++;
										}
									?>
								</tbody>
							</table>
						</div>
				</td>
			</tr>
		</table>
		<div class="row" style="margin-top:30px;border-top:1px dotted #f18545;<?php echo (!$pdf)?'width:650px;':''; ?>">
			<p style="text-align:justify;<?php echo (!$pdf)?'padding-top:10px;':''; ?>">
				<?php echo lang('query_booking'); ?>
			</p>
		</div>	
		
		
		<?php if($ln == 'en' && !$pdf) { ?>
		<div class="row" style="margin-top:30px;width:650px;">
			<p style="font-weight:bold;color:#f18545;">Important Information</p>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<p style="font-weight:bold;">Maximum passenger waiting in origin: 60 min.</p>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">24 h ASSISTANCE DURING YOUR TRIP</p>
			</div>	
			<div class="col-lg-12">
				<p>Please contact us if you have difficulty finding our representative, if you have problems with your luggage or passport, or for any delay.</p>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">CHANGES TO YOUR BOOKING</p>
			</div>	
			<div class="col-lg-12">
				<p>If you need to modify your booking, reply to the same email that you received with your booking confirmation or contact us by phone.</p>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">MINORS, CHILD SEATS, BOOSTERS</p>
			</div>	
			<div class="col-lg-12">
				<p>Minors (children and infants) also pay and take place in all services.</p>
			</div>
			<div class="col-lg-12">
				<p>In the booking process you may have included child seats and boosters. If you have not done and need, please contact us immediately for including in his book, with an extra charge of 6 euros / unit. It is the responsibility of parents or carers use and anchoring child seats and boosters.</p>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">MEETING POINTS</p>
			</div>	
			<div class="col-lg-12">
				<p>So that you can identify them, our representatives will carry a sign with the passenger's name indicated on your booking. Unless expressly stated otherwise, places of meeting with our representatives or drivers are:</p>
			</div>
			<div class="col-lg-12">
				<ul>
					<li>Hotels and similar: In the hotel reception.</li>
					<li>Airports: Inside the terminal, the passenger exit door through which he has come to their flight, where it is common that drivers expect and family.</li>
					<li>Train or bus stations: In the gate output corresponding passenger train, which is common for drivers and relatives wait. Station Sants (Barcelona), in front of the station before the McDonalds restaurant.</li>
					<li>Cruise Ports: At the door of the terminal for which you have reached the ship indicated on your reservation.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">MAXIMUM TIME WAITING FOR PASSENGERS SHUTTLE SERVICES</p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>Airports and Cruise Ports: 60 minutes from the moment you arrive at the meeting point.</li>
					<li>Hotels, apartments and the like: 20 minutes from the time of booking.</li>
					<li>Train o bus stations: 30 minutes from the time of booking.</li>
					<li>Golf courses or any other location not indicated: 20 minutes from the time of booking.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">WAITING TIMES OF OURS DRIVERS</p>
			</div>	
			<div class="col-lg-12">
				<p>Free waiting time included in your booking are: </p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>Hotels: 5 minute shuttle service and 10-minute private service.</li>
					<li>Airports: 60 minutes from touchdown.</li>
					<li>Cruise Ports: 60 minutes from the time of booking.</li>
					<li>Train / bus station: 30 minutes from the time of booking.</li>
				</ul>
			</div>
			<div class="col-lg-12">
				<p>After these times and without hearing, proceed to remove the vehicle and we will finish your service without repayment.</p>
			</div>	
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">BAGGAGE</p>
			</div>
			<div class="col-lg-12">
				<ul>
					<li>Shuttle Service includes one suitcase and one handbag per passenger (extra luggage 3.00 euros / unit). Golf Shuttle also includes a set of golf clubs.</li>
					<li>In private services including baggage volume is limited to the capacity of the hired vehicle. They are paid by the passenger or additional alternative media vehicles that were to be used for transportation of excess baggage.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">CANCELLATION POLICY</p>
			</div>	
			<div class="col-lg-12">
				<p>Maximum amounts in case of no show the customer or Early Termination:</p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>No fees for cancellation up to 24 hours before the start time of the service.</li>
					<li>100% of the total price of the service, when the cancellation occurs less than 24 hours in advance of the start time of the service or the passenger does not appear.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">COMMENTS </p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>For operational reasons and availability, we reserve the right to provide the service with superior vehicles of different capacity or actually hired, without incurring an additional cost to the customer.</li>
					<li>In shuttle service, exceptionally, the group may have to scroll through several vehicles.</li>
					<li>Price does not include tips. Kindly offer them voluntarily, but should not feel coerced or forced in any way.</li>
					<li>In Shuttle service, It is not allowed to transport wheelchairs,animals and big objects.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p>If you wish, we can provide a full range of excursions and city tours during your stay. Request in your hotel.</p>
			</div>	
		</div>
		<?php } else if(!$pdf) { ?>
		<div class="row" style="margin-top:30px;width:650px;">
			<p style="font-weight:bold;color:#f18545;">Información Importante</p>
		</div>
		<!--<div class="row" style="margin-top:30px;width:650px;">
			<p style="font-weight:bold;">Maximum passenger waiting in origin: 60 min.</p>
		</div>-->
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">ASISTENCIA 24 h DURANTE SU VIAJE</p>
			</div>	
			<div class="col-lg-12">
				<p>Póngase en contacto con nosotros si tiene dificultad para localizar a nuestro representante o conductor, si tiene problemas con su equipaje o pasaporte, o ante cualquier retraso.</p>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">MODIFICACIONES EN SU RESERVA</p>
			</div>	
			<div class="col-lg-12">
				<p>Si usted necesita modificar su reserva, hágalo respondiendo al email que recibió con la confirmación de su reserva o póngase en contacto con nosotros por teléfono.</p>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">MENORES DE EDAD, SILLITAS Y ALZADORES</p>
			</div>	
			<div class="col-lg-12">
				<p>Los menores de edad (niños y bebés) también pagan y ocupan plaza en todos los servicios.</p>
			</div>
			<div class="col-lg-12">
				<p>En el proceso de reserva usted puede haber incluido la reserva de sillitas y alzadores. Si no lo ha hecho y los necesita, póngase en contacto con nosotros inmediatamente para incluirlos en su reserva, con un coste extra de 6 euros/unidad. Es responsabilidad de los padres o acompañantes el uso y el anclaje de las sillitas y alzadores.</p>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">PUNTOS DE ENCUENTRO</p>
			</div>	
			<div class="col-lg-12">
				<p>Para que usted pueda identificarlos, nuestros representantes llevarán un cartel con el nombre del pasajero indicado en su reserva. Salvo que expresamente se indique algo diferente, los lugares de encuentro con nuestros representantes o conductores serán los siguientes:</p>
			</div>
			<div class="col-lg-12">
				<ul>
					<li>Hoteles y similares: En la recepción del establecimiento.</li>
					<li>Aeropuertos: Dentro de la terminal, en la puerta de salida de pasajeros por la que haya llegado su vuelo, donde es habitual que esperen los conductores y familiares.</li>
					<li>Estaciones de tren o autobús: En la puerta de salida de pasajeros del tren correspondiente, donde es habitual que esperen los conductores y familiares. En la estación de Sants (Barcelona), en la fachada de la estación delante del Restaurante McDonalds.</li>
					<li>Puertos de Cruceros: En la puerta de la terminal por la que haya llegado el barco indicado en su reserva.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">TIEMPOS DE ESPERA MáXIMOS DE LOS PASAJEROS PARA SERVICIOS SHUTTLE</p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>Aeropuertos y Puertos de Cruceros:60 minutos desde el momento de su llegada al punto de encuentro.</li>
					<li>Hoteles, apartamentos y similares:20 minutos desde la hora de la reserva.</li>
					<li>Estaciones tres/autobús:30 minutos desde la hora de la reserva.</li>
					<li>Campos de golf o cualquier otro lugar no indicado:20 minutos desde la hora de la reserva.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">TIEMPOS DE ESPERA DE LOS CONDUCTORES</p>
			</div>	
			<div class="col-lg-12">
				<p>Los tiempos de espera gratuitos incluidos en su reserva son:</p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>Hoteles: 5 minutos en servicios shuttle y 10 minutos en servicios privados.</li>
					<li>Aeropuertos: 60 minutos desde el momento del aterrizaje.</li>
					<li>Puertos de Cruceros: 60 minutos desde la hora de la reserva.</li>
					<li>Estaciones tren/autobús: 30 minutos desde la hora de la reserva.</li>
				</ul>
			</div>
			<div class="col-lg-12">
				<p>Transcurridos estos tiempos y sin tener noticias suyas, procederemos a retirar el vehículo y daremos por finalizado su servicio sin derecho a devolución.</p>
			</div>	
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">EQUIPAJE</p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>Servicio Shuttle incluye una maleta y un bolso de mano por pasajero (maletas extras 3,00 euros/unidad). Shuttle Golf incluye también un juego de palos de golf.</li>
					<li>En servicios privados el volumen de equipaje incluido estará limitado a la capacidad del vehículo contratado. Serán a cargo del pasajero los medios alternativos o vehículos adicionales que tuviese que utilizar para el transporte del equipaje excedente.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">POLíTICA DE CANCELACIONES</p>
			</div>	
			<div class="col-lg-12">
				<p>Importes máximos en caso de no presentación del cliente o de cancelación anticipada:</p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>Sin gastos de cancelación hasta 24 horas antes de la hora de inicio del servicio.</li>
					<li>100% del precio total del servicio, cuando la cancelación se produzca con menos de 24 horas de antelación sobre la hora de inicio del servicio o el pasajero no comparezca.</li>
				</ul>
			</div>
		</div>
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p style="font-weight:bold;">OBSERVACIONES</p>
			</div>	
			<div class="col-lg-12">
				<ul>
					<li>Por razones de operatividad y disponibilidad, nos reservamos la posibilidad de prestar el servicio con vehículos de categoría superior o de diferente capacidad del efectivamente contratado, sin que ello suponga un sobrecoste para el cliente.</li>
					<li>En servicio shuttle, excepcionalmente, el grupo podría tener que desplazarse en varios vehículos.</li>
					<li>El precio no incluye propinas. Si lo desea puede ofrecerlas voluntariamente, pero no debe sentirse obligado o forzado en modo alguno.</li>
					<li>Si lo desea podemos ofrecerle una completa gama de excursiones y city tours durante su estancia. Consulte en su hotel.</li>
				</ul>
			</div>
		</div>
		<!--<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p>If you wish ,we can provide a full range of excursions and city tours during your stay. Request in your hotel.</p>
			</div>	
		</div>-->
		<div class="row" style="margin-top:30px;width:650px;">
			<div class="col-lg-12">
				<p>PICK´N GO WORLDWIDE S.L B66636606</p>
			</div>	
		</div>
		<?php } ?>
		
	</body>
</html>