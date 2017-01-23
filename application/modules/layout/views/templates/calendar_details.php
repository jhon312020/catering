<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	$this->load->view('car_navigation_menu');
	if(!$ln || $ln == ""){	$ln = "es"; }
	$extra_array = json_decode($bookings['extra_array'], true);	
?>
<html>
     <head>
	   <style type="text/css">
		.tabalign {
			position: relative;
			top: -45px;
			left: 91px;
			width: 200px;
			border-bottom: none;
			font-family: 'MyFont';
			font-size: 16px !important;
		}
		@media (max-width: 780px) {
		  .tabalign {
				position: relative;
				top: -45px;
			}
		}
		@media (max-width: 767px) {
		  .tabalign {
				position: relative;
				top: -42px;
			}
		}
		@media (max-width: 414px) {
		  .tabalign {
				position: relative;
				top: -39px;
			}
		}
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
		.tabinactive {
			background-color: #9099a8;
			color:#fff;
		}		
	</style>
	</head>
	<body>
	<div class="container" id="reserva01">
		<ul class="nav nav-tabs tabalign" style="">
		    <li><a class="tabinactive" href="javascript:void(0);" onClick="$('#routeForm').submit();"><?php echo lang('routes'); ?></a></li>
		    <li class="active"><a class="tabinactive" href="<?php echo site_url($ln.'/route_details'); ?>"><?php echo lang('reservation'); ?></a></li>
		</ul>
		<form id="routeForm" action="<?php echo site_url($ln.'/route_details'); ?>" method="post">
			<input type="hidden" name="routes" value="1">
		</form>
		<!--<img src="<?php echo $template_path.'images/demobg.jpg'; ?>" style="width:100%;margin:0px!important;padding:0px!important;margin-bottom:15px!important;">-->
		<table>
			<tbody>
				<tr>
					<td>
						<a class="btn btn-info btn-sm" href="<?php echo site_url($ln.'/route_details'); ?>" style="margin-top:10px;margin-right:10px;background-color:#391B38;color:#fff;">
								<i class="fa fa-arrow-left"></i> Back
						</a>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="well" style="margin:0px!important; padding:0px!important;width:100%;margin-top:10px !important;">
			<tbody>
				<tr style="width:100%;margin:0px!important;padding:0px!important;">
					<td style="width:40%;padding-top:15px;">
						<span style="font-size:15px;padding-left:10px;color:#f58847;"><?php echo lang('no_reference'); ?></span><br>
						<span style="font-size:15px;color:#58385f;padding-left:10px;font-weight:bold;"><?php echo $book_reference; ?></span>
					</td>
					<!--<td style="width:25%;padding-top:15px;">
						<span><?php echo lang('thanks_booking'); ?></span>
					</td>
					<td style="width:35%;padding-right:10px;padding-top:15px;">
						<p><?php echo lang('print_booking'); ?>
						<button type="button" class="btn btn-primary btn-md print" style="float:right;background-color:#391B38;color:#fff;" onClick="Function();">
							<span class="glyphicon glyphicon-print"></span> Print
						</button></p>
					</td>-->
				</tr>
			</tbody>
		</table>
		<table style=" padding:0px !important;margin:-3px !important;width:100%;">
			<tr>
				<td style="padding-right:10px !important; width:50% !important;padding-top:10px;">
					<?php if($bookings['book_role'] == 2){ ?>
					<div class="well" style="margin:0px !important; padding-top:10px !important;">
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
					<div class="well" style="margin:0px!important;padding:10px !important;<?php echo ($bookings['book_role'] == 2)?'margin-top:15px!important;':''; ?>">
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
									<td><?php echo Date('H:i', strtotime($bookings['hour'])).'h'; ?></td>
								</tr>
								<?php
								if(isset($return_bookings)){
								?>
								<tr>
									<td style="color:#f18545;"><?php echo lang('date_back'); ?></td>
									<td><?php echo Date('d/m/Y', strtotime($return_bookings['start_journey'])); ?></td>
									<td style="color:#f18545;"><?php echo lang('hour_back'); ?>:</td>
									<td><?php echo Date('H:i', strtotime($return_bookings['hour'])).'h'; ?></td>
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
									<td style="padding-top:10px;"><?php echo $bookings['passenger_price']; ?>&nbsp;&euro;</td>
								</tr>
								<!-- <tr>
									<td style="color:#f18545;"><?php //echo lang('baby'); ?>:</td>
									<td colspan=3><?php //echo $bookings['baby']; ?></td>
								</tr> -->
							</tbody>
						</table>
					</div>
					<div class="well" style="margin:0px!important; margin-top:15px !important;padding:10px !important;">
						<table class="table" style="width:100%;">
							<thead>
								<tr>
									<td style="padding-bottom: 10px !important; font-size: 15px !important; border-bottom: 1px dotted #f18545!important; color:#f18545;">Extras</td>
									<td style="padding-bottom: 10px; font-size: 15px!important; border-bottom: 1px dotted #f18545 !important;font-weight:bold;"></td>
									<td style="padding-bottom: 10px;padding-right:25px; font-size: 15px!important; border-bottom: 1px dotted #f18545 !important;font-weight:bold;"><span style="float:right;"><?php echo (count($extra_array) > 0)?lang('yes'):lang('no'); ?></span></td>
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
									<td style="<?php echo ($count == 1)?'padding-top:15px;':''; ?>float:right;padding-right:25px;"><?php echo $ex['extra_value']; ?>&nbsp;&euro;</td>
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
					<div class="well" style="margin:0px!important; margin-top:15px !important;padding:10px !important;">
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
									<td style="padding-top:15px;padding-right:-15px;"><?php echo $bookings['reduction_value']; ?>&nbsp;&euro;</td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php } ?>
					<?php if($bookings['book_role'] == 2){ ?>
					<div class="well" style="margin:0px !important; margin-top:15px!important; padding-top:10px !important;">
						<table  style="width:100%;">
							<thead>
								<tr>
									<td style="font-size: 14px !important;color:#f18545;"><?php echo lang('price'); ?></td>
									<td style="font-size: 15px !important;text-align:right; padding-right:15px;font-weight:bold;"><?php echo $bookings['price']; ?>&nbsp;&euro;</td>
								</tr>
							</thead>
						</table>
					</div>
					<?php } ?>
					<div class="well" style="margin:0px !important; margin-top:15px!important; padding-top:10px !important;">
						<table  style="width:100%;">
							<thead>
								<tr>
									<td style="font-size: 14px !important;color:#f18545;"><?php echo lang('payment_status'); ?></td>
									<td style="font-size: 15px !important;text-align:right; padding-right:15px;font-weight:bold;">
									<?php //echo ($bookings['book_status'] == 'completed')?lang('completed'):lang('cash_payment');
										if($bookings['book_status'] == 'completed')
											echo lang('completed');
										else if($bookings['book_status'] == 'pending')
											echo lang('pending'); 
										else if($bookings['book_status'] == 'cash')
											echo lang('cash_payment');
										else if($bookings['book_status'] == 'paid')
											echo lang('pre_paid');

									?>
									</td>
								</tr>
							</thead>
						</table>
					</div>
				
				</td>
				<td style="padding-top:10px;">
						<div class="well" style="margin:0px !important;padding:10px !important;">
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
											<td style="<?php echo ($i == 0)?'padding-top:15px;':''; ?>"><?php echo ($ckey == 'dni_passport')?lang('dni_'.$cvalue):$cvalue; ?></td>
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
	</div>	
	</body>
</html>
