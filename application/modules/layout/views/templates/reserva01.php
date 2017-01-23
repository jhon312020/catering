<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
	$flightTime = $this->input->post('hours') . ':' . $this->input->post('minutes');
	$flightTime = date('H:i', strtotime($flightTime));
	$landingTime = $this->input->post('return_hours') . ':' . $this->input->post('return_minutes');
	$landingTime = date('H:i', strtotime($landingTime));
	$_POST['flight_time'] = $flightTime;
	$_POST['flightlanding_time'] = $landingTime;
	$post_array = $this->input->post();
?>
<style>
.displayTable > thead > tr > th{
	text-transform:uppercase;
}
.showPassword{
	display:none;
}
</style>
<div class="container" id="reserva01">
	<hr class="mob-show mob-hr-line">
	<div class="row">
		<div class="col-sm-10 text-justify sub-head">
				<p><?php echo lang('reserve_tips'); ?></p>
		</div>
		<div class="col-sm-2">
			 <ul class="pagination pull-right">
				<li class="active stepClick" data-class="firstStep">1</li>
				<li class="stepClick" data-class="secondStep">2</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3 mob-hide">
			<p class="text-justify">
				<H4 class="resumen" style='text-transform:uppercase;'><?php echo lang('summary'); ?> 
					<span data-toggle="modal" data-target="#myModal" class="pull-right orange editpop" style="cursor:pointer;text-transform:uppercase;"><?php echo lang('edit'); ?></span>
				</H4> 
				<hr class="marginTB-10 orangeborder">
			</p>
			<?php
				$arrowDownClass = "<span class='pull-right glyphicon glyphicon-chevron-down orange'></span>";
				$leftSidebar = array(
					'source'=>'start_from',
					'designation'=>'end_at',
					'start_date'=>'start_journey',
					'end_date'=>'return_journey',
					'no_of_passengers'=>'adults',
					'country_origin'=>'country',
					'flight_no'=>'flight_no',
					'flight_time'=>'flight_time',
					'flightlanding_time'=>'flightlanding_time',
				);
				foreach ($leftSidebar as $key => $value) {
					$valueStr = $this->input->post($value);
					switch ($value) {
						case 'start_journey':
							$valueStr = date('l d - F', strtotime($result['start_journey']));
							break;
						case 'return_journey':
							$valueStr = date('l d - F', strtotime($this->input->post('return_journey')));
							break;
						case 'country':
							$valueStr = $countries[$this->input->post('country')];
							break;
						case 'adults':
							$valueStr = $this->input->post('adults');
							break;
					}
					if($value == 'return_journey'){
						if($this->input->post('return_journey') != '')
							printf("<h4 style='text-transform:uppercase;'>%s $arrowDownClass</h4><p style='text-transform:uppercase;'>%s</p><input type='hidden' name='%s' value='%s'>", lang($key), date('l d - F', strtotime($result['return_journey'])), $value, $this->input->post($value));
					}
					else if($value == 'flight_time'){
						if($this->input->post('start_from1') == 'airport')
							printf("<h4 style='text-transform:uppercase;'>%s $arrowDownClass</h4><p style='text-transform:uppercase;'>%s</p><input type='hidden' name='%s' value='%s'>", lang('flightlanding_time'), $valueStr, $value, $this->input->post($value));
						else
							printf("<h4 style='text-transform:uppercase;'>%s $arrowDownClass</h4><p style='text-transform:uppercase;'>%s</p><input type='hidden' name='%s' value='%s'>", lang($key), $valueStr, $value, $this->input->post($value));
					}
					else if($value == 'flightlanding_time'){
						if($this->input->post('return_journey') != ''){
							if($this->input->post('start_from1') == 'airport')
								printf("<h4 style='text-transform:uppercase;'>%s $arrowDownClass</h4><p style='text-transform:uppercase;'>%s</p><input type='hidden' name='%s' value='%s'>", lang('flight_time'), $valueStr, $value, $this->input->post($value));
							else
								printf("<h4 style='text-transform:uppercase;'>%s $arrowDownClass</h4><p style='text-transform:uppercase;'>%s</p><input type='hidden' name='%s' value='%s'>", lang($key), $valueStr, $value, $this->input->post($value));
						}
					}
					else
						printf("<h4 style='text-transform:uppercase;'>%s $arrowDownClass</h4><p style='text-transform:uppercase;'>%s</p><input type='hidden' name='%s' value='%s'>", lang($key), $valueStr, $value, $this->input->post($value));
					
				}
			?>
			
			<hr class="marginTB-10 orangeborder"> 
			<H4 class="resumen" style="text-transform:uppercase;"><?php echo lang('price'); ?> 
				<span class="pull-right orange resumen"><?php echo $result['rates']; ?> &euro;</span>
			</H4>
			<div class="extras">
			<!--<div class="extra"><span>Maleta Extra</span> x 01 <span class="pull-right">+3,50E <img src="<?php echo $template_path; ?>/images/del_icon.png"></span></div>-->
			
			</div>
			<p class="text-justify">
				<hr class="marginTB-10 orangeborder reduction" style="display:none;">
				<H4 class="resumen reduction" style="display:none;">Promotional code <span id="percentage_reduction"></span> <span class="pull-right orange resumen">
					<span id="price_reduction"></span> &euro;</span>
				</H4>
			</p>
			<p class="text-justify">
				<hr class="marginTB-10 orangeborder">
				<H4 class="resumen"><?php echo lang('total'); ?> <span class="pull-right orange resumen">
					<span id="price_total"><?php echo $result['rates']; ?></span> &euro;</span>
				</H4>
			</p>
		</div>
		
		<div class="col-sm-9 totStep" id="firstStep">
		<form id="submitForm">
			<div class="panel">
				<div class="panel-heading pickbluebg"><?php echo strtoupper(lang('go_trip')); ?> </div> 
				<table class="table table-striped displayTable">
					<thead> 
						<tr>
							<th>&nbsp;</th>
							<th><?php echo lang('hour'); ?></th>
							<th><?php echo lang('source'); ?></th>
							<th><?php echo lang('designation'); ?></th>
							<th><?php echo lang('arrival_time'); ?></th>
							<th><?php echo lang('price'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php 
					foreach($result['data'] as $data){ 
					?>
						<tr>
							<th scope="row">
								<label>
									<input type="radio" name="book_id" id="blankRadio<?php echo $data['id']; ?>" value="<?php echo $data['id']; ?>" aria-label="...">
									<input type="hidden" name="seats_<?php echo $data['id']; ?>"  value="<?php echo $data['seats']; ?>">
									<input type="hidden" name="seats_price_<?php echo $data['id']; ?>"  value="<?php echo $result['rates']; ?>">
									<input type="hidden" class="hidden_value" name="journey_<?php echo $data['id']; ?>"  value='<?php echo json_encode($data); ?>'>
								</label>
							</th>
							<td><?php echo $data['journey_start']; ?></td>
							<td><?php echo $result['from_zone']; ?></td>
							<td><?php echo $result['to_zone']; ?></td>
							<td><?php echo $data['journey_end']; ?></td>
							<td><?php echo $result['rates']; ?> &euro;
							</td>
						</tr> 
					<?php } ?>
				</tbody>
			</table> 
			
			</div> 
			<!--<div class="nameformError parentFormundefined" id="reserve_error" style="opacity: 0.87;right: initial;position:relative;top:-12px;font-size:12px;display:none;">
				<div class="formErrorArrow formErrorArrowBottom">
					
				</div>
				<div class="formErrorContent"><?php echo lang('no_seats'); ?></div>
			</div>-->
			<div class="formErrorArrow formErrorArrowBottom" id="reserve_error" style="display:none;">
				<div class="formErrorContent"><?php echo lang('no_seats'); ?></div>
			</div>
			
			<div class="formErrorArrow formErrorArrowBottom" id="seats_error" style="display:none;">
				<div class="formErrorContent"><?php echo lang('seats_error'); ?></div>
			</div>
			
			<?php if($this->input->post('return_journey')) { ?>	
				<div class="panel">  <div class="panel-heading pickbluebg"><?php echo strtoupper(lang('return_trip')); ?> </div> 
					<table class="table table-striped displayTable">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th><?php echo lang('hour'); ?></th>
								<th><?php echo lang('source'); ?></th>
								<th><?php echo lang('designation'); ?></th>
								<th><?php echo lang('arrival_time'); ?></th>
								<th><?php echo lang('price'); ?></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						foreach($result['return'] as $data){ 
						?>
							<tr>
								<th scope="row">
									<label>
										<input type="radio" name="return_book_id" id="blankRadio<?php echo $data['id']; ?>" value="<?php echo $data['id']; ?>" aria-label="...">
										<input type="hidden" name="return_seats_<?php echo $data['id']; ?>"  value="<?php echo $data['seats']; ?>">
										<input type="hidden" class="hidden_value" name="return_journey_<?php echo $data['id']; ?>"  value='<?php echo json_encode($data); ?>'>
									</label>
								</th>
								<td><?php echo $data['journey_start']; ?></td>
								<td><?php echo $result['to_zone']; ?></td>
								<td><?php echo $result['from_zone']; ?></td>
								<td><?php echo $data['journey_end']; ?></td>
								<td><?php echo $result['rates']; ?> &euro;</td>
							</tr> 
						<?php } ?>
						</tbody>
					</table> 
				</div> 
				<div class="formErrorArrow formErrorArrowBottom" id="return_reserve_error" style="display:none;">
					<div class="formErrorContent"><?php echo lang('no_seats'); ?></div>
				</div>
				
				<div class="formErrorArrow formErrorArrowBottom" id="return_seats_error" style="display:none;">
					<div class="formErrorContent"><?php echo lang('seats_error'); ?></div>
				</div>
				
			<?php } ?>
			</form>
				<button class="btn volver editpop" data-toggle="modal" data-target="#myModal"><?php echo lang('return'); ?></button> <button class="btn go goButton"><?php echo lang('next'); ?></button>
		</div>
		
		<div class="col-sm-9 totStep" id="secondStep" style="display:none;">
			<div class="row mybox-1">
				<div class="col-sm-12"><h5><?php echo lang('includes'); ?></h5></div>
				<div class="col-sm-12">
					<ul class="res_inc">
						<li><span><?php echo lang('low_cost'); ?></li>
						<li><span><?php echo lang('special_discounts'); ?></span></li>
						<li><span><?php echo lang('child_free'); ?></span></li>
						<li><span><?php echo lang('free_internet'); ?></span></li>
						<li><span><?php echo lang('payment_facilities'); ?></span></li>
						<li><span><?php echo lang('bag_free'); ?></span></li>
						<li><span><?php echo lang('pack_map'); ?></span></li>
						<li><span><?php echo lang('mb_enable_device'); ?></span></li>
					</ul>
				</div>
			</div>
			<div class="row">
			<h4 class="sub_sel_ext" style="padding-left: 13px;"><?php echo lang('select_your_extras'); ?></h4>
			</div>
			<?php
			$mat_count=1;
			foreach($booking as $book) {
				$title = ($ln == 'en')?$book['title']:$book['title_es'];
			?>	
			<div class="row mybox-2" id="extraDiv_<?php echo $book['id']; ?>">
				<div class="col-sm-2 mycolwid2"><img src="<?php echo $template_path.'/images/booking_extras/'.$book['image']; ?>"></div>
				<div class="col-sm-10 mycolwid10">
					<span class="orange txt-size-20"><?php echo $title; ?>: </span>
					<h5 class="pull-right" data-extra-name="<?php echo $mat_count; ?>" data-extra-title="<?php echo $title; ?>">
						<span class="my_right_price" data-extra-price="<?php echo $book['price']; ?>"> <?php echo $book['price'].'&euro; / '.(($book['type'])?lang('unit'):$title); ?></span> 
						<br><br> 
						<?php 
						if($book['type']){
						?>
						<select size="1" class="mynumber_input">
						<?php foreach(range(1,10) as $sel) { ?>
						<option><?php echo $sel<10?'0'.$sel:$sel; ?></option>
						<?php } ?>
						</select>
						<?php } ?>
						<button class="btn btn-default orangebg2 addextra"><span class="mob_show_opc">+</span><span class="mob_hide_opc"><?php echo lang('add'); ?></span></button>
					</h5> 
					<br>
					<?php echo ($ln == 'en')?$book['subtitle']:$book['subtitle_es']; ?>
					<br><br> <span class="more_info_click orange txt-size-14"><?php echo lang('more_info'); ?>
					<div class="show_more_info orange txt-size-14 mar-top-20" style="display:none;">
					<?php echo ($ln == 'en')?$book['description_en']:$book['description_es']; ?>
					</div></span>
				</div>
			</div>				
			<?php	
				$mat_count++;
			}
			?>
			<div class="row mybox-3">
				<div class="col-xs-12 myapplicar">
					<div class="col-xs-4" style="padding-left:0px;"><h4 style="font-weight:bold;"><?php echo lang('promotional_code'); ?></h4></div>
					<div class="col-xs-5" style="margin-top:3px;"> <input type="text" class="form-control light_violet applicartxt bord-rad-10" id="promo_code" name="promo_code"></div>
					<div style="margin-top:3px"> <button class="btn btn-default pull-right applicarbtn"><?php echo lang('apply'); ?></button></div>
				</div>
				<div class="col-sm-12 errorCodes" style="display:none;">
					<span style="position: relative; left: 33%; top: -4px; color: red;"><?php echo lang('invalid_codes'); ?></span>
				</div>
			</div>
			<div class="row mybox-4 loginform">
				<form id="loginform">
					<input style="display:none" type="text" name="fakeusernameremembered"/>
					<input style="display:none" type="password" name="fakepassword"/>
					<div class="col-sm-12">
						<div class="form-group col-sm-5" style="padding-left:0px;">
							<label for="email" class="h4"><?php echo lang('user'); ?></label>
							<input type="text" class="form-control bord-rad-10 bor-col-wht validate[required,custom[email]]" id="login_email" name="login_email" placeholder="Enter name" required>
						</div>
						<div class="form-group col-sm-5 validTextpassword">
							<label for="password" class="h4"><?php echo lang('password'); ?></label>
							<input type="password" class="form-control bord-rad-10 bor-col-wht validate[required]" id="login_password" name="login_password" placeholder="Enter password" required>
						</div>
						<div class="form-group">
							<button type="button"  id="form-submit" class="btn pull-right light_violet mygo btnnewsize logincheck" style="margin-top:40px;"><?php //echo lang('go'); ?>Go</button>
						</div>
						<div class="pull-left"><a href="<?php echo site_url($ln.'/recovery_password/clients'); ?>" class="forget_link" target="_blank"><?php echo lang('you_have_forgotten_the_password'); ?></a></div>
						<div class="col-sm-12 errorlogin" style="display:none;">
							<span style="position: relative; left: 33%; top: -4px; color: red;"><?php echo lang('invalid_credentials'); ?></span>
						</div>
					</div>
				</form>
			</div>
			<div class="row mybox-5 clientDetails">
				<form class="validateForm1">
					<input style="display:none" type="text" name="fakeusernameremembered"/>
					<input style="display:none" type="password" name="fakepassword"/>
					<div class="col-sm-12">
						<h3><?php echo lang('your_reservation_includes'); ?></h3>
						<input type="hidden" name="client_id" id="client_id">
						<div class="form-group col-sm-4 hiddenData" style="padding-left:0px;display:none;">
							<input type="text" name="extras_array" id="extras_array">
							<input type="text" name="total_price" id="total_price">
							<input type="text" name="promotional_codes_id" id="promotional_codes_id">
							<input type="text" name="promotional_values" id="promotional_values">
							<input type="text" name="promotional_code_values" id="promotional_code_values">
							<input type="text" name="promotional_type" id="promotional_type">
							<?php/*
							foreach($this->input->post() as $key=>$value){
							?>
							<input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
							<?php	
							}*/
							?>
							<!--<input type="text" class="form-control bord-rad-10" id="booking_details" name="booking_details" value='<?php echo json_encode($this->input->post()); ?>'>-->
						</div>
						<div class="form-group col-sm-4 validText" style="padding-left:0px;">
							<label for="name"><?php echo lang('name'); ?></label>
							<input type="text" class="form-control bord-rad-10 validate[required]" id="fullname" name="name" placeholder="<?php echo lang('name'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-sm-8 validText">
							<label for="surname"><?php echo lang('surname'); ?></label>
							<input type="text" class="form-control bord-rad-10 validate[required]" id="surname" name="surname" placeholder="<?php echo lang('surname'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-sm-4 validText" style="padding-left:0px;">
							<label for="email" id="emailValid">Email</label>
							<input type="text" class="form-control bord-rad-10 validate[required,custom[email]]" id="email" name="email" placeholder="Email" required  data-errormessage-value-missing="<?php echo lang('require_field')?>" data-errormessage-custom-error="<?php echo lang('invalid_email'); ?>" >
						</div>
						<div class="form-group col-sm-4 validText">
							<label for="confirm_email"><?php echo lang('confirm_email'); ?></label>
							<input type="text" class="form-control bord-rad-10 validate[required,equals[email]]" id="confirm_email" name="confirm_email" placeholder="<?php echo lang('confirm_email'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>" data-errormessage-pattern-mismatch="<?php echo lang('field_match')?>">
						</div>
						<div class="form-group col-sm-4 validText">
							<label for="phone"><?php echo lang('phone'); ?></label>
							<input type="text" class="form-control bord-rad-10" id="phone" name="phone" placeholder="<?php echo lang('phone'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>" data-errormessage-custom-error="<?php echo lang('invalid_integer'); ?>">
						</div>
						<div class="form-group col-sm-8 validText" style="padding-left:0px;">
							<label for="address"><?php echo lang('street_address'); ?></label>
							<input type="text" class="form-control bord-rad-10" id="address" name="address" placeholder="Direction" required  data-errormessage-value-missing="<?php echo lang('require_field')?>" >
						</div>
						<div class="form-group col-sm-4 validText">
							<label for="postal_code"><?php echo lang('postcode'); ?></label>
							<input type="text" class="form-control bord-rad-10" id="cp" name="cp" placeholder="<?php echo lang('postcode'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>" data-errormessage-custom-error="<?php echo lang('invalid_zip'); ?>">
						</div>
						<div class="form-group col-sm-4 validText" style="padding-left:0px;">
							<label for="client_country"><?php echo lang('country'); ?></label>
							<input type="text" class="form-control bord-rad-10" id="client_country" name="client_country" placeholder="<?php echo lang('country'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-sm-8 validText">
						<div class="form-group col-sm-6" style="padding-left:0px;">
							<label for="city"><?php echo lang('city'); ?></label>
							<input type="text" class="form-control bord-rad-10" id="city" name="city" placeholder="<?php echo lang('city'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						</div>
						<div class="form-group col-sm-4 validText" style="padding-left:0px;">
							<label for="nationality"><?php echo lang('nationality'); ?></label>
							<input type="text" class="form-control bord-rad-10" id="nationality" name="nationality" placeholder="<?php echo lang('nationality'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-sm-4 validText">
							<label for="dni_passport"><?php echo lang('id_or_passport'); ?></label>
							<!--<input type="text" class="form-control bord-rad-10 validate[required]" id="dni_passport" name="dni_passport" placeholder="pasaporte" required>-->
							<select class="form-control" id="dni_passport" name="dni_passport" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
								<option value="id"><?php echo lang('dni_id'); ?></option>
								<option value="passport"><?php echo lang('dni_passport'); ?></option>
							</select>
						</div>
						<div class="form-group col-sm-4 validText">
							<label for="doc_no"><?php echo lang('number_of_document'); ?></label>
							<input type="text" class="form-control bord-rad-10" id="doc_no" name="doc_no" placeholder="<?php echo lang('number_of_document'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-sm-4" style="padding-left:0px;">	</div>
						<div class="form-group col-sm-8 showExtras">
							<input type="checkbox" name="save_extra" id="save_extra" value="1"> <label style="position: relative; top: -1px;" for="save_extra"><?php echo lang('save_my_details_for_future_bookings'); ?></label>
						</div>
						<div class="col-sm-2"></div>
						<div class="form-group col-sm-4 validText showPassword"  style="padding-left:0px;">
							<label for="password"><?php echo lang('password'); ?></label>
							<input type="password" class="form-control bord-rad-10 validate[required]" id="password" name="password" placeholder="Password" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-sm-4 validText showPassword">
							<label for="confirm_password"><?php echo lang('confirm_password'); ?></label>
							<input type="password" class="form-control bord-rad-10 validate[required,equals[password]]" id="confirm_password" name="confirm_password" placeholder="<?php echo lang('confirm_password'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="col-sm-2"></div>
				</div>
				<div class="col-sm-12" style="padding:0px;margin-left:-10px; width:103%;">
					<hr class="picklightblueborder">
				</div>
				
				<div class="col-sm-12">
					<div class="col-sm-4" style="padding-left:0px;"><?php echo lang('terms_and_conditions'); ?></div>
					<div class="col-sm-8">
					<p class="txt-size-14 validateRadio">
						<input value="1" class="validate[required]" name="terms_cond" id="terms_cond" type="checkbox">
						<label style="position: relative; top: -1px;" for="terms_cond">&nbsp;<?php echo lang('accept'); ?> </label>
						<a href="<?php echo site_url($ln.'/terms'); ?>" target="_blank" class="orange" style="position: relative; top: -1px;">&nbsp;<?php echo lang('terms_and_conditions'); ?></a> <span style="position: relative; top: -1px;">&</span> 
						<a style="position: relative; top: -1px;" href="<?php echo site_url($ln.'/terms'); ?>" class="orange" target="_blank"><?php echo lang('privacy_policy'); ?></a>
					</p>
					</div>
				</div>
				</form>
				<div class="col-sm-12" style="padding:0px;margin-left:-10px; width:103%;">
				<hr class="picklightblueborder">
				</div>
				
				<!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="paypalform" target="_top">-->
				<form action="process/?paypal=checkout" method="post" id="paypalform">
					<input type="hidden" name="duplicate_bool" id="duplicate_bool" value="0">
					<input type="hidden" name="amount" class="amount" value="<?php echo $result['rates']; ?>">
					<input type="hidden" name="itemname" value="Reservation">
					<input type="hidden" name="itemnumber" value="1">
					<input type="hidden" name="itemQty" value="1">
					<input type="hidden" name="BookId" id="BookId">
					<input type="hidden" name="itemdesc" value="" /> 
					<input type="hidden" name="itemprice" class="amount" value="<?php echo $result['rates']; ?>">
					
					<div class="col-sm-12" style="margin-bottom:10px;"><?php echo lang('total_pay'); ?>: 
					<button type="button" id="form-submit" class="btn pull-right btn-lg pickbluebg paypalsubmit" style="font-family:FuturaStdBold;padding-left:40px;padding-right:40px;padding-top:15px; padding-bottom:15px;"><?php echo lang('pay'); ?></button> 
					<br> <h3><span id="price_final"><?php echo $result['rates']; ?></span>&euro;</h3> 
					<div class="paymentValid mypaypalimg">
					<!--<span><img src="<?php echo $template_path; ?>images/paypal.jpg"></span>-->
					<?php if($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2){ 
						if($collaborator_details['available_seats'] == 'activate' && $collaborator_details['no_of_available_seats'] >= $this->input->post('adults')) {
					?>
						<span id="collaborator_seats">
							<input style="position: relative; top: -2px;"type="radio" class="validate[required]" name="paymentmethod" id="available_seats" value="available_seats"  data-errormessage-value-missing="<?php echo lang('require_field')?>">
							<label style="position: relative; top: -3px;" for="available_seats"><?php echo lang('available_seats'); ?>.</label>
						</span>
					<?php } if($collaborator_details['available_seats'] == 'activate' && $collaborator_details['payment_methods'] == 'online' && $collaborator_details['no_of_available_seats'] >= $this->input->post('adults')){ ?>	
						<span>
							<input style="position: relative; top: -2px;"type="radio" class="validate[required]" name="paymentmethod" id="paybyonline" value="online"  data-errormessage-value-missing="<?php echo lang('require_field')?>">
							<label style="position: relative; top: -3px;" for="paybyonline"><?php echo lang('pay_by_online'); ?>.</label>
						</span>
					<?php } ?>
					<?php  if($collaborator_details['payment_methods'] == 'online_and_cash'){ ?>
						<span>
							<input style="position: relative; top: -2px;"type="radio" class="validate[required]" name="paymentmethod" id="paybyonline" value="online"  data-errormessage-value-missing="<?php echo lang('require_field')?>">
							<label style="position: relative; top: -3px;" for="paybyonline"><?php echo lang('pay_by_online'); ?>.</label>
						</span>
						<span>
							<input type="radio" class="validate[required]" name="paymentmethod" id="paybycash" value="cash"> 
							<label style="position: relative; top: -2px;" for="paybycash"  data-errormessage-value-missing="<?php echo lang('require_field')?>"><?php echo lang('pay_by_cash'); ?>.</label>
						</span>
					<?php } } ?>
					
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	</div>
	<style type="text/css">
	.mypaypalimg {margin-top:-50px;margin-left:14%;}
	@media(max-width:992px) {
		.mypaypalimg span {display: inline-block;}
	}
	@media(max-width:475px) {
		.mypaypalimg {
			width:45%;
			margin-top: 25px;
		}
	}
	</style>
<?php $this->load->view('footer');?>
<script>
//msg_modal.modal('show');
msg_modal.on('hidden.bs.modal', function () {
   //$('#submitimage').trigger('click'); 
   $('#paypalform').submit();
});
var addExtra = {};
var extraJson = {};
var code = '';
var price='';
var percentage='';
var percentage_value = '';
var price_value = '';
var formError = '<div class="nameformError parentFormundefined" style="opacity: 0.87; position: relative; top: 5px; font-size: 12px; width: 70%; right: initial; float: right;">'+
					'<div class="formErrorContent" style="font-size:10px;!important">* There is no seats</div>'+
				'</div>';
$(document).ready(function(){
	$('#zone').val('<?php echo $this->input->post('zone'); ?>');
	$('#collaborators_id').val('<?php echo $this->input->post('collaborators_id'); ?>');
	
	$(".more_info_click" ).click(function() {
	   	$(this).find('.show_more_info').toggle();
	});
	$('select[name=start_from1]').val('<?php echo $this->input->post('start_from1'); ?>');
	$('select[name=start_from1]').trigger('change');
	
	$('.editpop').click(function(){
		if('<?php echo $this->input->post('return_journey'); ?>' != ''){
			$('#vuelta').trigger('click');
		}
		else{
			$('#ida').trigger('click');
		}
		$.each(<?php echo json_encode($this->input->post()); ?>, function(i,v){
			$('[name='+i+']').val(v);
		});
		$(".formError").remove();
	});
	
	$('a[data-toggle=modal]').click(function(){
		$('#myModal select').each(function(){
			$(this).val($(this).find('option:first').val());	
		});
		$('#myModal input').val('');
	});
	$('.stepClick').click(function(){
		if(!$('#'+$(this).data('class')).is(':visible')){
			var bool = true;
			if($(this).data('class') == 'secondStep'){
				if($('input[name=book_id]:checked').length == 0){
					bool=false;
					$('#reserve_error').fadeIn();
				}
				if($('input[name=return_book_id]').length !=0 && $('input[name=return_book_id]:checked').length == 0){
					bool=false;
					$('#return_reserve_error').fadeIn();
				}
				if(!bool)
					return false;
			}
			if(bool){
				if($(this).data('class') == 'firstStep'){
					$('.stepClick').removeClass('active');
					$(this).addClass('active');
					$('.totStep').hide();
					$('#'+$(this).data('class')).show();

				} else {
					seatsAvailable(this,2);
				}
			}
				
		}
	});
	function seatsAvailable(invoker,mode){
		var formData = "journey_details="+$('input[name=book_id]:checked').nextAll('.hidden_value').val()+"&mode=seatsAvailable&seats=<?php echo $this->input->post('adults'); ?>&start_from=<?php echo $this->input->post('start_from'); ?>&end_at=<?php echo $this->input->post('end_at'); ?>";
		if($('input[name=return_book_id]').is(':checked'))
			formData += "&return_journey_details="+$('input[name=return_book_id]:checked').nextAll('.hidden_value').val();
		//console.log(formData);
		$.ajax({
			url:'<?php echo site_url('node/ajaxreturn'); ?>',
			type:'post',
			data:formData,
			dataType:'json',
			success:function(data, textStatus, jqXHR){
				$('#extraDiv_2').show();
				if(data.baby_seats_error){
					$('#extraDiv_2').hide();
				}
				if(data.error){
					if(data.seats_error){
						$('#seats_error').fadeIn();
					}
					if(data.return_seats_error){
						$('#return_seats_error').fadeIn();
					}
				} else {
					$('#return_reserve_error').fadeOut();
					$('#return_seats_error').fadeOut();
					$('#reserve_error').fadeOut();
					$('#seats_error').fadeOut();
					if(mode == 1){
						$('.stepClick').removeClass('active');
						$('li[data-class=secondStep]').addClass('active');
						$('.totStep').hide();
						$('#secondStep').show();
					} else {
						$('.stepClick').removeClass('active');
						$(invoker).addClass('active');
						$('.totStep').hide();
						$('#'+$(invoker).data('class')).show();
					}
				}
			},
			error:function(jqXHR, textStatus, errorThrown){
				console.log(textStatus+'----'+errorThrown);
			},
		});
	}
	$('input[name=book_id]').click(function(){
		$('#reserve_error').fadeOut();
		$('#seats_error').fadeOut();
	})
	$('input[name=return_book_id]').click(function(){
		$('#return_reserve_error').fadeOut();
		$('#return_seats_error').fadeOut();
	})
	$('.goButton').click(function(){
		if($('input[name=book_id]:checked').length != 0){
			if('<?php echo $this->input->post('return_journey'); ?>' == ''){
				seatsAvailable(this,1);
			}
			else if('<?php echo $this->input->post('return_journey'); ?>' != '' && $('input[name=return_book_id]:checked').length != 0){
				seatsAvailable(this,1);
			}
			else
				$('#return_reserve_error').fadeIn();
		}
		else{
			if('<?php echo $this->input->post('return_journey'); ?>' != '' && $('input[name=return_book_id]:checked').length == 0)
				$('#return_reserve_error').fadeIn();
							
			$('#reserve_error').fadeIn();
		}
		/*var bool = true;
		if($('input[name=book_id]:checked').length == 0){
			bool=false;
			$('#reserve_error').fadeIn();
		}
		if($('input[name=return_book_id]').length !=0 && $('input[name=return_book_id]:checked').length == 0){
			bool=false;
			$('#return_reserve_error').fadeIn();
		}
		if(bool){
			$('.stepClick').removeClass('active');
			$('li[data-class=secondStep]').addClass('active');
			$('.totStep').hide();
			$('#secondStep').show();
		}*/
	});
	$('.logincheck').click(function(){
		/* var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test($('#subemail').val())){
		} */
		$('.errorlogin').hide();
		valid = $("#loginform").validationEngine('validate');
		console.log(valid)
		if(valid){
			var formData = $('#loginform').serializeArray();
			formData.push({name:"mode", value:'login'});
			$.ajax({
				url:'<?php echo site_url('node/ajaxreturn'); ?>',
				type:'post',
				data:formData,
				dataType:'json',
				success:function(data, textStatus, jqXHR){
					if(!data['error']){
						$('.errorlogin').hide();
						
						$.each(data, function(i,v){
							$('.clientDetails #'+i).val(v);
						});
						$('#confirm_email').val(data['email']);
						$('#fullname').val(data['name']);
						
						$('#confirm_password').val(data['password']);
						$('.showExtras').hide();
						if($('#confirm_password').is(':visible')){
							$('.showPassword').hide();
						}
					}
					else{
						$('#client_id').val('');
						$('.showExtras').show();
						if($('#save_extra').is(':checked'))
							$('.showPassword').show();
						else
							$('.showPassword').hide();
						$('.errorlogin').show();
						$('.clientDetails').find('input:text, input:password').val('');
						if($('#save_extra').is(':checked'))
							$('.showPassword').show();
						
					}
				},
				error:function(jqXHR, textStatus, errorThrown){
					console.log(textStatus+'----'+errorThrown);
				},
			});
		}
	});
	
	$('.addextra').click(function(){
		var selVal = $(this).closest('h5').find('select').val();
		if(isNaN(selVal))
			selVal = 1;
		
		var ename = $(this).closest('h5').data('extra-name');
		var title = $(this).closest('h5').data('extra-title');
		var eprice = $(this).closest('h5').find('span').data('extra-price');
		var total = parseFloat($('#price_total').text());
		if(ename == 2){
			if($('.baby_seatsformError').length > 0)
				$('.baby_seatsformError').remove();
			if($('.baby_return_seatsformError').length > 0)
				$('.baby_return_seatsformError').remove();
			
		}
		if(addExtra[ename]){
			if(addExtra[ename] != selVal){
				var oldVal = addExtra[ename] * eprice;
				var val = selVal * eprice;
				total = total - parseFloat(oldVal) + parseFloat(val);
				$('.extra_count_'+ename).text(selVal);
				$('.extra_total_'+ename).text(val);
				addExtra[ename] = selVal;
				
				extraJson[ename].extra_name = title;
				extraJson[ename].extra_count= selVal;
				extraJson[ename].extra_value= val;
				
			}
		}
		else{
			var val = selVal * eprice;
			addExtra[ename] = selVal;
			$('.extras').append('<div class="extra" data-ecount="'+ename+'">'+title+' x <span class="extra_count_'+ename+'">'+selVal+'</span> <span class="pull-right">+<span class="extra_total_'+ename+'">'+val+'</span>&euro; <img src="<?php echo $template_path; ?>/images/del_icon.png" style="cursor:pointer;" class="addExtraImage" onClick="delprice(this);"></span></div>');
			extraJson[ename] = {};
			extraJson[ename].extra_name = title;
			extraJson[ename].extra_count= selVal;
			extraJson[ename].extra_value= val;
			
			$('#extras').val();
			total += parseFloat(val);
		}
		if(total != parseFloat($('#price_total').text())) {			
			if(percentage != '') {
				total += parseFloat(percentage);
				var per = (parseFloat(percentage_value)*total)/100;
				percentage = per;
				total -= parseFloat(per);
				$('#price_reduction').text(per);
				$('#promotional_values').val(per);

			} /*else if (price_value != '') {
				total += parseFloat(price_value);
				var pv = total;
				total -= parseFloat(price);
				console.log(total+'-----'+pv);
				if(total < 0) {
					price_value = pv;
					total = 0;
				} else {
					price_value = '';
				}
			}	*/
		}
		$('#price_total').text(total);
		$('#price_final').text(total);
		$('#total_price').val(total);
		$('.amount').val(total);
		$('#extras_array').val(JSON.stringify(extraJson));
		console.log($('#extras_array').val())
	})
	$('.applicarbtn').click(function(){
		$('.errorCodes').hide();
		if($('#promo_code').val().trim() != '' && code != $('#promo_code').val().trim()){
			$.ajax({
				url:'<?php echo site_url('node/ajaxreturn'); ?>',
				type:'post',
				data:'code='+$('#promo_code').val()+'&mode=codes',
				dataType:'json',
				success:function(data, textStatus, jqXHR){
					if(data['error']){
						$('.errorCodes').show();
					}
					else{
						var total = parseFloat($('#price_total').text());
						var reduction = '';
						code = data['code'];
						if(code != ''){
							if(price != ''){
								total += parseFloat(price);
							}
							else if(percentage != ''){
								total += parseFloat(percentage);
							}
						}
						
						if(data['discount_type'] == 'price'){
							$('#percentage_reduction').text('');
							var pv = total;
							total -= parseFloat(data['price_or_percentage']);
							price = data['price_or_percentage'];
							reduction = data['price_or_percentage'];
							percentage = '';
							/*if(total < 0) {
								price_value = pv;
								total = 0;
							} else {
								price_value = '';
							}*/
						}
						else if(data['discount_type'] == 'percentage'){
							price = '';
							$('#percentage_reduction').text(data['price_or_percentage']+'%');
							percentage_value = data['price_or_percentage'];
							var per = (parseFloat(data['price_or_percentage'])*total)/100;
							percentage = per;
							reduction = per;
							total -= parseFloat(per);
						}
						$('.reduction').show();
						$('#price_reduction').text(reduction);
						code = $('#promo_code').val().trim();
						
						$('#promotional_codes_id').val(data['id']);
						$('#promotional_values').val(reduction);
						$('#promotional_code_values').val(data['price_or_percentage']);
						$('#promotional_type').val(data['discount_type']);
						
						$('#price_total').text(total);
						$('#price_final').text(total);
						$('#total_price').val(total);
						$('.amount').val(total);
					}
					
				},
				error:function(jqXHR, textStatus, errorThrown){
					console.log(textStatus+'----'+errorThrown);
				},
			});
		}
	});
	var valid = $(".validateForm1").validationEngine({
		promptPosition : 'bottomLeft',
		maxErrorsPerField:1
	});
	$('#save_extra').click(function(){
		if($(this).is(':checked') && $('#client_id').val() == '')
			$('.showPassword').fadeIn();
		else
			$('.showPassword').fadeOut();
	})
	$("#loginform").validationEngine({
		promptPosition : 'bottomLeft',
		maxErrorsPerField:1
	});
	$("#paypalform").validationEngine({
		promptPosition : 'bottomLeft',
		maxErrorsPerField:1
	});
	$('#dupliacteConfirmbutton').click(function(){
		$('#duplicate_bool').val('1');
		$('.paypalsubmit').trigger('click');	
	});
	$('.paypalsubmit').click(function(){
		var ele = $(this);
		ele.prop('disabled', true);

		var valid = $(".validateForm1").validationEngine('validate');
		if(valid)
			valid = $("#paypalform").validationEngine('validate');
		else
			ele.prop('disabled', false);
		//console.log(valid)
		if(valid){
			if($('#terms_cond').is(':checked')){

				var formData = $('.validateForm1, #submitForm, #paypalform').serializeArray();
				formData.push({name:'mode',value:'formsubmit'});
				$.each(<?php echo json_encode($post_array); ?>, function(i,v){
					formData.push({name:i,value:v});
				});
				//console.log(formData);
				//console.log(JSON.stringify(formData));
				$.ajax({
					url:'<?php echo site_url('node/ajaxreturn'); ?>',
					type:'post',
					data:formData,
					dataType:'json',
					success:function(data, textStatus, jqXHR){
						if(data.error){
							ele.prop('disabled', false);
							var bool = true;
							if(data.email_error){
								$('.clientDetails #emailValid').after('<div class="emailformError parentFormundefined formError" style="opacity: 0.87; position: absolute; top: 48.2px; left: 0px; right: initial; margin-top: 0px;"><div class="formErrorArrow formErrorArrowBottom"><div class="line1"></div><div class="line2"></div><div class="line3"></div><div class="line4"></div><div class="line5"></div><div class="line6"></div><div class="line7"></div><div class="line8"></div><div class="line9"></div><div class="line10"></div></div><div class="formErrorContent">'+data.email_error+'</div></div>');
							}
							if(data.seats_error || data.return_seats_error){
								bool = false;
								$('.stepClick').removeClass('active');
								$('.stepClick:first').addClass('active');
								$('.totStep').hide();
								$('#'+$('.stepClick:first').data('class')).show();
								$('div[data-ecount=2] .addExtraImage').trigger('click');
								$('#extraDiv_2').hide();
							}
							if(data.seats_error){
								$('#seats_error').fadeIn();
							}
							if(data.return_seats_error){
								$('#return_seats_error').fadeIn();
							}
							if(data.available_seats_error){
								$('#collaborator_seats').append('<div class="available_seatsformError parentFormpaypalform formError" style="opacity: 0.87; position: absolute; top: 36.9px; left: 349.95px; right: initial; margin-top: 0px; display: block;"><div class="formErrorContent"><?php echo lang('less_seats'); ?>.</div></div>');
							}
							if(bool){
								if(data.baby_seats_error && data.return_baby_seats_error) {
									//$('div[data-ecount=2] .addExtraImage').trigger('click');
									//$('#extraDiv_2').hide();
								}
								if(data.baby_seats_error) {
									$('html, body').animate({
										'scrollTop' : $("#extraDiv_2").position().top
									},2000);
									//$('div[data-ecount=2] .addExtraImage').trigger('click');
									if($('.baby_seatsformError').length == 0){
									$('#extraDiv_2').after('<div class="baby_seatsformError parentFormpaypalform formError" style="opacity: 0.87; position: relative; top: -11px; left: 7px; right: initial; margin-top: 0px; display: block;"><div class="formErrorContent"><?php echo lang('baby_error'); ?>.'+data.go_babay_seats+'</div></div>');
									}
								}
								if(data.return_baby_seats_error) {
									$('html, body').animate({
										'scrollTop' : $("#extraDiv_2").position().top
									},2000);
									//$('div[data-ecount=2] .addExtraImage').trigger('click');
									if($('.baby_return_seatsformError').length == 0){
									$('#extraDiv_2').after('<div class="baby_return_seatsformError parentFormpaypalform formError" style="opacity: 0.87; position: relative; top: -11px; left: 7px; right: initial; margin-top: 0px; display: block;"><div class="formErrorContent"><?php echo lang('return_baby_error'); ?>.'+data.return_babay_seats+'</div></div>');
									}
								}
							}
						} else {
							if(data.start_duplicate && data.return_duplicate){
								$('.duplicate_message').hide();
								$('#both_duplicate').show();
								duplicate_modal.modal('show');
								ele.prop('disabled', false);
							} else if (data.start_duplicate) {	
								$('.duplicate_message').hide();
								$('#start_duplicate').show();
								duplicate_modal.modal('show');
								ele.prop('disabled', false);
							} else if (data.return_duplicate) {
								$('.duplicate_message').hide();
								$('#return_duplicate').show();
								duplicate_modal.modal('show');
								ele.prop('disabled', false);
							} else {
								$('#BookId').val(data.book_id);
								//$('input[name=cancel_return]').val($('input[name=cancel_return]').val()+'?cm='+data.url);
								if(data.online) {
									if($('.amount').val() > 0) {
										$('#paypalform').submit();
									} else {
										location.replace('<?php echo site_url($ln); ?>/success?cm='+data.book_id+'&amt='+data.amt);
									}
									//$('#submitimage').trigger('click');
									//msg_modal.modal('show');
									
								}
								else{
									location.replace('<?php echo site_url($ln); ?>/success?cm='+data.book_id+'&amt='+data.amt);
								}
							}							
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						console.log(textStatus+'----'+errorThrown);
					},
				});
			}
		}
		else
			ele.prop('disabled', false);
	})
});
function delprice(invoker){
	var ele = $(invoker).closest('.extra');
	var c = ele.data('ecount');
	var total = parseFloat($('#price_total').text());
	var val = ele.find('.extra_total_'+c).text();
	total -= parseFloat(val);
	if(percentage != '') {
		total += parseFloat(percentage);
		var per = (parseFloat(percentage_value)*total)/100;
		percentage = per;
		total -= parseFloat(per);
		$('#price_reduction').text(per);
		
		$('#promotional_values').val(per);
	} /*else if (price_value != '') {
		var pv = total;
		total += parseFloat(price_value);
		total -= parseFloat(price);
		if(total < 0) {
			price_value = pv;
			total = 0;
		} else {
			price_value = '';
		}
	}
	if(total < 0) {
		price_value = ppv;
		total = 0;
	}*/
	$('#price_total').text(total);
	$('#price_final').text(total);
	$('#total_price').val(total);
	$('.amount').val(total);
	ele.remove();
	delete extraJson[c];
	$('#extras_array').val(JSON.stringify(extraJson));
	delete addExtra[c];
	$('h5[data-extra-name='+c+'] select option:first').prop('selected','selected');
	console.log($('#extras_array').val())
}
</script>
