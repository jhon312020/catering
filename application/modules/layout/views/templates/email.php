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

        <title>Pick-N-Go</title>

	</head>

	

	<body style="font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;line-height: normal;font-size: 12px;color: #58385f;">

    <style>

		td{

			border:none !important;

			line-height: 1.42857;

			padding:0px!important;

			vertical-align: top !important;

			font-size:12px !important;

			margin:0 !important;

		}

		table{

			padding: 2px !important;

			margin: 0px !important;

            vertical-align: top !important;

		}

		tr{

			padding: 2px !important;

			margin: 0px !important;

            vertical-align: top !important;

		}

		span{

			padding: 2px !important;

			margin: 0px !important;

            vertical-align: top !important;

		}

        p {

            margin:0px !important;

            vertical-align: top !important;

        }

	</style>

        <p style="text-align:center;width:750px;" width="750"><?php echo lang('print_booking'); ?></p>

        <p style="margin:0px;height:10px !important;">&nbsp;</p>

		<img src="<?php echo $ln=='en'? $template_path.'images/header_english.jpg':$template_path.'images/header_spanish.jpg'; ?>" width="750" style="width:750px; margin:0px!important;padding:0px!important;">

        <p style="margin:0px;height:10px !important;">&nbsp;</p><p style="margin:0px;height:10px !important;">&nbsp;</p>

		<table width="750" style="margin:0px!important;width:750px;background-color: #432241">

			<tbody>

				<tr style="padding: 19px;margin-bottom: 20px;">

					<td style="width:350px;padding-top:10px;padding-bottom:10px;vertical-align:top !important;">

						<span style="padding:10px;padding-right:0px;font-size:13px;font-weight:bold;color:#fff;padding-left:0px !important;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang('no_reference'); ?>:</span>&nbsp;<span style="padding:10px;padding-left:0px;font-size:13px;font-weight:bold;color:#fff;"><?php echo $book_reference; ?></span>

					</td>

                    <td style="width:350px;padding-top:10px;padding-bottom:10px;vertical-align:top !important;">

						<span style="padding:10px;padding-right:0px;font-size:13px;font-weight:bold;color:#fff;padding-left:0px !important;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang('collaborator_name'); ?>:</span>&nbsp;<span style="padding:10px;padding-left:0px;font-size:13px;font-weight:bold;color:#fff;"><?php echo $bookings['collaborator_name']; ?></span>

					</td>

				</tr>

			</tbody>

		</table>

		<table style="padding:0px !important;margin:0px !important; width:750px;" width="750">

            <tbody>

                <tr>

                    <td style="padding-right:5px !important; width:375px !important;padding-top:10px;vertical-align: text-top;" width="375">

                        <table  style="width:100%;padding-left:10px;padding-right:10px;">

                        <tbody>

                            <tr>

                                <td colspan=4 style="font-size:15px!important;color:#7D4884;"><?php echo lang('booking_information'); ?><p style="border-bottom:1px dotted #391b38;margin-top:0px;height:10px;margin-bottom:0px;">&nbsp;</p></td>

                            </tr>

                            <tr>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('from'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;" colspan=3><?php echo $bookings['start_from']; ?></td>

                            </tr>

                            <tr>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('to'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;" colspan=3><?php echo $bookings['end_at']; ?></td>

                            </tr>

                            <tr>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('date_go'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;"><?php echo Date('d/m/Y', strtotime($bookings['start_journey'])); ?></td>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('hour_go'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;"><?php echo Date('H:i', strtotime($bookings['hour'])).'h'; ?></td>

                            </tr>

                            <?php

                            if(isset($return_bookings)){

                            ?>

                            <tr>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('date_back'); ?></td>

                                <td style="padding-top:5px;color:#57385F;"><?php echo Date('d/m/Y', strtotime($return_bookings['start_journey'])); ?></td>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('hour_back'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;"><?php echo Date('H:i', strtotime($return_bookings['hour'])).'h'; ?></td>

                            </tr>

                            <?php } ?>

                            <tr>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('country'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;"><?php echo $countries[$bookings['country']]; ?></td>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('flight_no'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;"><?php echo $bookings['flight_no']; ?></td>

                            </tr>

                            <tr>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('adults'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;"><?php echo $bookings['adults']; ?></td>

                                <td style="padding-top:5px;color:#7D4884;"><?php echo lang('kids'); ?>:</td>

                                <td style="padding-top:5px;color:#57385F;"><?php echo $bookings['kids']; ?></td>

                            </tr>

                            <tr><td colspan=4> <p style="border-bottom:1px dotted #7D4884;margin:0px !important;">&nbsp;</p> </td></tr>

                            <tr>

                                <td colspan=3 style="padding-top:10px;padding-bottom:8px; color:#7D4884;"><?php echo lang('passengers_price'); ?>:</td>

                                <td style="padding-top:10px;padding-bottom:8px;color:#7D4884;text-align:right;"><?php echo $bookings['passenger_price']; ?>&nbsp;&euro;&nbsp;&nbsp;</td>

                            </tr>

                            <tr><td colspan=4> <p style="border-top:1px solid #391B38;margin:0px !important;">&nbsp;</p> </td></tr>

                            

                        </tbody>

                    </table>

                    <table  style="padding:10px;width:100%;">

                        <tbody>

                            <tr>

                                <td colspan=4 style="font-size: 15px !important; color:#7D4884;font-weight:bold;">Extras<p style="border-bottom:1px dotted #7D4884;margin-top:0px;height:10px!important;margin-bottom:0px;">&nbsp;</p></td>

                            </tr>

                            <?php

                            

                            $count=1;

                            if(count($extra_array) > 0){

                                foreach($extra_array as $ex){

                            ?>

                            <tr>

                                <td colspan=2 style="<?php echo ($count == 1)?'padding-top:5px;':''; ?>color:#7D4884;padding-top:5px;font-weight:bold;"><?php echo $ex['extra_name'].' (+'.$ex['extra_count'].')'; ?></td>

                                <td colspan=2 style="<?php echo ($count == 1)?'padding-top:5px;':''; ?>float:right;color:#57385F;padding-top:5px;font-weight:bold;text-align:right;">+<?php echo $ex['extra_value']; ?>&nbsp;&euro;&nbsp;&nbsp;</td>

                            </tr>

                            <?php

                                $count++;

                                }

                            }

                            ?>

                        </tbody>

                    </table>

                </td>

                <td style="padding-top:10px;vertical-align: top;">

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

                    <table  style="width:100%;padding-left:10px;padding-right:10px;">

                        <tbody>

                            <tr>

                                <td colspan=2 style="font-size:15px !important;color:#7D4884;"><?php echo lang('personal_information'); ?> <p style="border-bottom:1px dotted #391b38;margin-top:0px;height:10px !important;margin-bottom:0px;">&nbsp;</p></td>

                            </tr>

                            <?php

                                $key = array('name', 'surname', 'email', 'phone', 'address', 'postcode', 'country', 'city', 'nationality', 'id_or_passport', 'number_of_document');

                                $i=0;

                                foreach($clients as $ckey=>$cvalue){

                                ?>

                                <tr>

                                    <td style="<?php echo ($i == 0)?'padding-top:5px;':''; ?>color:#7D4884;padding-top:5px;"><?php $lang_key = $key[$i]; echo lang($key[$i]); ?>:</td>

                                    <td style="<?php echo ($i == 0)?'padding-top:5px;':''; ?>color:#57385F;padding-top:5px;"><?php echo (($ckey == 'dni_passport')?lang('dni_'.$cvalue):$cvalue); ?></td>

                                </tr>

                                <?php

                                $i++;

                                }

                            ?>

                            <td colspan=2 ><p style="border-bottom:1px solid #391B38;margin:0px !important;">&nbsp;</p></td>

                        </tbody>

                    </table>

                </td>

                </tr>

                <tr>

                <td><?php if($bookings['promotional_code_id']){ ?>

                    <table  style="width:100%;padding-left:10px;padding-right:10px;font-weight:bold;">

                        <tbody>

                            <tr><td colspan=4> <p style="border-bottom:1px dotted #7D4884;margin:0px !important;">&nbsp;</p> </td></tr>

                            <tr>

                                <td colspan=3 style="padding-top:10px;padding-bottom:8px; color:#7D4884;"><?php echo ($bookings['promotional_type'] == 'price')?'Promotional code deduction price':'Promotional code deduction '.$bookings['promotional_value'].' %'; ?>:</td>

                                <td style="padding-top:10px;padding-bottom:8px;color:#7D4884;text-align:right;">-<?php echo $bookings['reduction_value']; ?>&nbsp;&euro;&nbsp;&nbsp;</td>

                            </tr>

                            <tr><td colspan=4> <p style="border-top:1px solid #391B38;margin:0px !important;">&nbsp;</p> </td></tr>

                        </tbody>

                    </table>

                    <?php } ?>

                </td>

                <td>

                    <table  style="width:100%;padding-left:10px;padding-right:10px;">

                        <tr>

                            <td colspan=2>

                                <table  style="width:100%;background-color:#DFDFDF;">

                                    <tbody>

                                        <tr>

                                            <td style="font-size: 14px !important;font-weight:bold;"><p style="margin:0px !important;">&nbsp;</p><p style="margin:0px !important;">&nbsp;&nbsp;<?php echo '<span style="color:#EC7124;">'.lang('price').'</span> <span style="color:#391B38!important;font-weight:normal !important;">('.$payment_status.')</span>'; ?></p><p style="margin:0px !important;">&nbsp;</p></td>

                                            <td style="font-size: 15px !important;text-align:right;color:#57385F;"><p style="margin:0px !important;">&nbsp;</p><p style="margin:0px !important;font-weight:bold;"><?php echo $bookings['price']; ?>&nbsp;&euro;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><p style="margin:0px !important;">&nbsp;</p></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </td>

                        </tr>

                    </table>

                </td>

			</tr>

		</table>

		<table cellpadding="0" cellspacing="0" style="width:750px;" width="750">

            <tbody>

                <tr>

                    <td style="font-size:20px !important;color:#7D4884;font-weight: bold;" width="750">

                        <p style="margin:0px !important;">&nbsp;</p>

                        <p style="margin-bottom:10px;"><?php echo strtoupper(lang('important_information')); ?></p>

                    </td>

                </tr>

                <tr>

                    <td width="750">

                        <table style="border: 0px;" cellpadding=0 cellspacing=0>

                            <tr style="background-color: #4b254a;">

                                <?php if($ln == 'en') { ?>

                                <td bgcolor="#816780" style="color: #fff;"><table style="width:100%;" cellpadding="10" cellspacing="5" ><tr><td style="color: #fff;">Pick’n Go is a shared shuttle service. (Keep it simple. Who cares if it's minivan or minibus?).</td></tr></table></td>

                                <td style="color: #fff;background-color: #4b254a;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">All our drivers hold a sign with Pick'n Go logo. They all wear blue jeans and colorful converse shoes.</td></tr></table></td>

                                <td bgcolor="#816780" style="color: #fff;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">All our vans have logo on doors (is it necessary to explain the car- exceptions? You will let them know if that's the case, right?).</td></tr></table></td>

                                <td style="color: #fff;background-color: #4b254a;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">Check the map below to locate our vehicles at the exit of the terminal.</td></tr></table></td>

                                <td bgcolor="#816780" style="color: #fff;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">It is strictly forbidden to get off the vehicle until final destination.</td></tr></table></td>

                                <?php } else { ?>

                                <td bgcolor="#816780" style="color: #fff;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">Pick'n es un servicio de transporte compartido. (Asi de simple. Que importa si es un minivan o microbús?)</td></tr></table></td>

                                <td style="color: #fff;background-color: #4b254a;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">Todos nuestros conductores llevan un distintivo con el logo de Pick'n Go Todos usan jeans azul y converse de colores</td></tr></table></td>

                                <td bgcolor="#816780" style="color: #fff;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">Todos nuestros vehículos tienen logotipo en las puertas (¿es necesario explicar las excepciones de coche? Nos lo hareis saber si es necesario, no?)</td></tr></table></td>

                                <td style="color: #fff;background-color: #4b254a;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">Comprobar el mapa para localizar nuestros vehículos a la salida de la terminal</td></tr></table></td>

                                <td bgcolor="#816780" style="color: #fff;"><table style="width:100%;" cellpadding="10" cellspacing="5"><tr><td style="color: #fff;">Está estrictamente prohibido bajarse del vehículo hasta llegar a su destino.</td></tr></table></td>

                                <?php } ?>

                            </tr>

                        </table>

                    </td>

                </tr>

                <tr><td><p style="border-bottom:1px dotted #EC7124;margin:0px !important;">&nbsp;</p></td></tr>

            </tbody>

		</table>

		<table width="750">

            <tr>

                <td width="750">

                    <p style="text-align:justify;color:#57385F;margin-top:2px !important;">

                        <?php echo lang('query_booking'); ?>

                    </p>

                    <p>&nbsp;</p>

                </td>

            </tr>

            <tr>

                <td width="750" style="width:750px;">

                    <img src="<?php echo $template_path.'images/routes.png'; ?>" style="margin:0px!important;padding:0px!important;padding-top:10px;width:750px;" width="750">

                </td>

            </tr>



		<?php if($ln == 'en') { ?>

            <tr>

                <td style="width:750" width="750">

                    <table>

                        <tr>

                            <td style="width:750px" width="750">

                                <table>

                                    <tr>

                                        <td>

                                            <p style="font-weight:bold;color:#EC7124;padding-top:10px;margin:0px;">BOOKING TERMS & CONDITIONS</p>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="font-weight:bold;color:#57385F;margin:0px;">Airport pick-up</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="color:#57385F;margin:0px;">Our hostess will be waiting for you at arrivals lounge, holding a board with your name. If you can’t find her, please call to our airport assistance number +34628 000 785 (9.00am-22.00pm) or +34646 401 942 (24hs).</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="color:#57385F;margin:0px;">Once you meet our staff, you may be waiting up from 30 minutes. Please understand it’s a shared van and we need to accommodate other passengers.</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="color:#57385F;margin:0px;">If your flight is delayed, don’t worry! We check all the timings and we wait for you. </p>

											<p style="margin:0px;height:10px !important;">&nbsp;</p>

											<p style="color:#57385F;margin:0px;">We reserve the right for pick-ups on flights arriving at 23hr that have a 2 hour delay or more. </p>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;font-weight:bold;color:#57385F;">Hotel / other pick-up</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;color:#57385F;">Please be ready 10 minutes beforehand. We may take up to 30 minutes to pick you up from the time you designate, as we normally pick up other passengers in the same ride. Please be patient as we ALWAYS deliver. </p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;color:#57385F;">In case we come pick you and you’re not ready you will have 5 extra minutes to show up, otherwise our drivers will leave you. No expenses will be covered.</p>
                                            
                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>
                                            
                                            <p style="margin:0px;color:#57385F;">Pick'n Go is an independent company that serves hotels and individuals in Barcelona. Pick'n Go does not belong to any hotel and its activity is totally external.</p>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td><p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;font-weight:bold;color:#57385F;">CANCELLATION POLICY</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;color:#57385F;">No fees for cancellation up to 24hours prior the start time of service.</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p width="375" style="margin:0px;color:#57385F;">100% of the total price of the service, when the cancellation occurs less than 24hrs prior the service or the passenger does not appear.</p>

                                        </td>

                                    </tr>

                                </table>

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

		<?php } else { ?>

            <tr>

                <td style="width:750" width="750">

                    <table>

                        <tr>

                            <td style="width:750px" width="750">

                                <table>

                                    <tr>

                                        <td>

                                            <p style="font-weight:bold;color:#EC7124;padding-top:10px;margin:0px;">BOOKING TERMS & CONDITIONS</p>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="font-weight:bold;color:#57385F;margin:0px;">Recogida en el aeropuerto</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="color:#57385F;margin:0px;">Nuestra hostes le estará esperando en la puerta de llegadas, sosteniendo  una tablet con su nombre. Si no puede encontrarla, por favor llame a nuestro número de asistencia en aeropuerto +34628 000 785 (9:00-10:00) o al +34646 401 942 (24 hs)</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="color:#57385F;margin:0px;">Una vez que usted este con nuestro personal,  puede que tenga que  esperar hasta 30 minutos. Por favor, comprenda que es una furgoneta compartida y necesitamos dar cabida a otros pasajeros. </p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="color:#57385F;margin:0px;">Si su vuelo se retrasa, no se preocupe! Comprobamos todos los horarios y sus modificaciones  y le esperamos!!</p>

											<p style="margin:0px;height:10px !important;">&nbsp;</p>

											<p style="color:#57385F;margin:0px;">En vuelos con llegadas a partir de las 23h y que tengan un retraso de 2 horas o más, nos reservamos el derecho de realizar el servicio.</p>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;font-weight:bold;color:#57385F;">Hotel / otros Pick-up</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;color:#57385F;">Por favor esten listos con 10 minutos de antelacion. Pick'n Go dispondrá un margen de 30 minutos, desde la hora de su reserva, para recogerle, normalmente recogemos a otros pasajeros en el mismo trayecto. Por favor tenga paciencia, SIEMPRE llegamos.</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;color:#57385F;">En caso de que vengamos  a buscarle y usted no esté listo tendrá 5 minutos extras o de lo contrario nuestros conductors se iran. En ese caso no nos haremos responsables de cualquier gasto extra que pudiera tener. </p>
                                            
                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>
                                            
                                            <p style="margin:0px;color:#57385F;">Pick'n Go es una empresa independiente que da servicio a hoteles y particulares en Barcelona. Pick'n Go no pertenece a ningún hotel y su actividad es totalemnte externa.</p>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td><p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;font-weight:bold;color:#57385F;">POLITICA DE CANCELACION</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p style="margin:0px;color:#57385F;">No se cobrara el recargo de los servicios cuando se cancele con 24hrs de antelacion al servicio.</p>

                                            <p style="margin:0px;height:10px !important;">&nbsp;</p>

                                            <p width="375" style="margin:0px;color:#57385F;">Se cobrara el 100% del servicios cuando la cancelacion sea inferior a 24hrs o los pasajeros no aparezcan</p>

                                        </td>

                                    </tr>

                                </table>

                            </td>

                        </tr>

                    </table>

                </td>

            </tr>

		<?php } ?>

		</table>

	</body>

</html>