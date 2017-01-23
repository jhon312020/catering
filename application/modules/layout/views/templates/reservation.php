<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
	$modalForm = site_url($ln.'/reserva01');
	$terminal_array = array('' => 'Select Terminal', 'Barcelona Airport Terminal 1' => 'Barcelona Airport Terminal 1', 'Barcelona Airport Terminal 2'=>'Barcelona Airport Terminal 2');
?>
<!-- Modal -->
<style type="text/css">
	.reservePop {
		width: auto !important;
	}
	.modal-content {
		border:0px solid #fff !important;
		box-shadow: none !important;
	}
	.displayTable > thead > tr > th{
		text-transform:uppercase;
	}
	.showPassword{
		display:none;
	}
	#firstLeftStep div {
		background-image: url("<?php echo ($ln=='en')?$template_path.'/images/reserva_english.jpg':$template_path.'/images/reserva_spanish.jpg';?>");
		background-position: center top;
		background-repeat: no-repeat; 
		background-size: 100%; 
	}
</style>

<div class="container" id="reserva01">
	<hr class="mob-show mob-hr-line">
	<div class="row">
		<div class="col-sm-9 text-justify sub-head">
				<p><?php echo lang('reserve_tips'); ?></p>
		</div>
		<div class="col-sm-3">
			 <ul class="pagination pull-right">
				<li class="active stepClick" data-class="firstStep">1</li>
				<li class="stepClick" data-class="secondStep">2</li>
				<li class="stepClick" data-class="thirdStep">3</li>
			</ul>
		</div>
	</div>
	<div class="row" style="margin-top:20px;" id="rowHeight">
		<div class="col-sm-3 mob-hide" id="firstLeftStep">
		<div>&nbsp;</div>
			<!--<img src="<?php echo ($ln=='en')?$template_path.'/images/reserva_english.jpg':$template_path.'/images/reserva_spanish.jpg';?>" style="width:100%;"/>-->
		</div>
		<div class="col-sm-3 mob-hide" id="secondLeftStep" style="display:none !important;">
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
				?>
					<h4 style='text-transform:uppercase;'><?php echo lang($key).' '.$arrowDownClass ?></h4>
					<p class="duplicateList" style='text-transform:uppercase;' data-id="<?php echo $value; ?>"></p>
				<?php		
				}
			?>
			
			<hr class="marginTB-10 orangeborder"> 
			<H4 class="resumen" style="text-transform:uppercase;"><?php echo lang('price'); ?> 
				<span class="pull-right orange resumen"><span id="initialPrice">0</span> &euro;</span>
			</H4>
			<div class="extras">
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
					<span id="price_total">0</span> &euro;</span>
				</H4>
			</p>
		</div>
		<div class="col-sm-9 totStep" id="firstStep">
			<div class="modal-dialog reservePop" role="document" style="margin-top:0px !important;height:100%;">
				<div class="modal-content" style="box-shadow:none;height:100%;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel" style="text-align:left !important;"><?php echo lang('choose_your_route'); ?></h4>
					</div>
					<div class="modal-body" style="background-color: #fff;">
						<div class="col-xs-12">
							<div class="row contacto" style="background-color: #fff;">
								<div class="form-group col-xs-12">
									<div class="formErrorArrow formErrorArrowBottom" id="firstPageError" style="display:none;">
										<div class="formErrorContent"></div>
									</div>
								</div>
								
								
								<form method="POST" action="<?php echo $modalForm; ?>" class="validateForm" id="firstStepForm">
									<input type="hidden" name="mode" value="firstStep">
									<!--<div class="form-group col-xs-12"><hr></div>-->
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group col-xs-3">
												<button id="vuelta" class="btn btn-block active mytpbtn" type="button"><?php echo lang('round_trip'); ?></button>
											</div>
											<div class="form-group col-xs-3">
												<button id="ida" class="btn btn-block mytpbtn" type="button"><?php echo lang('one_way'); ?></button>
											</div>
										</div>	
									</div>
									<div class="row">
										<div class="col-sm-12 trip_alert zd-26">
											<div class="form-group col-xs-12" style="margin-bottom:0px !important;">
												<div class="alert alert-info" style="background-color:#391B38;border-color:#391B38;color:#fff;">
													<a href="javascript:void(0);" class="close" style="display:block;color:#fff;opacity:1;" data-hide="trip_alert">&times;</a>
												  <strong>*</strong> <?php echo lang('trip_alert'); ?>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group col-xs-12 zd-21" style="color:#45234b;">
												<label><?php echo lang('start_trip'); ?></label>
											</div>
											<div class="form-group col-xs-12 mar_min_5">
												<?php echo form_dropdown('start_from1', $start_from, null, 'class="form-control validate[required]" onchange="addPlaceInput(this);"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
												<?php echo  form_input(array('name'=>'zone', 'id'=>'zone', 'type'=>'hidden')); ?>
												<?php echo  form_input(array('name'=>'collaborators_id', 'id'=>'collaborators_id', 'type'=>'hidden')); ?>
												<?php echo  form_input(array('name'=>'collaborator_address_id', 'id'=>'collaborator_address_id', 'type'=>'hidden')); ?>
												<?php echo  form_input(array('name'=>'bcnarea_address_id', 'id'=>'bcnarea_address_id', 'type'=>'hidden')); ?>
											</div>
											<div class="form-group col-xs-12 zd-29 ui-front" id="start_journey_div">
												<input type="text" class="form-control validate[required]" name="start_from" id="autoCompletePlace" placeholder="<?php echo lang('from'); ?>"  data-errormessage-value-missing="<?php echo lang('require_field')?>">
											</div>
											<div id="postal_div" style="<?php echo ($this->session->userdata('user_name') != '' && $this->session->userdata('user_type') == 2)?'display:none;':''; ?>">
												<div class="form-group col-xs-6">
													<input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="<?php echo lang('postal_code'); ?>"  data-errormessage-value-missing="<?php echo lang('require_field')?>">
												</div>
												<div class="form-group col-xs-6" style="display:table;height:33px;">
													<a href="javascript:void(0);" style="color:#45234b;display:table-cell;vertical-align:middle;text-decoration:underline;"><?php echo lang('find_postal'); ?></a>
												</div>
											</div>
											<div class="form-group col-xs-12 zd-21" style="color:#45234b;">
												<label><?php echo lang('end_trip'); ?></label>
											</div>
											<div class="form-group col-xs-12 zd-28 ui-front" id="return_journey_div">
												<?php echo form_dropdown('end_at', $terminal_array, null, 'class="form-control validate[required]" id="end_at" data-errormessage-value-missing="'.lang('require_field').'"'); ?>
											</div>
											<div class="col-xs-12" style="padding:0px;">
												<div id="select_ida" class="form-group col-xs-6 zd-26 testId">
													<?php echo form_input(array('name'=>'start_journey', 'id'=>'date1', 'style'=>'padding-left:35px;', 'placeholder'=>lang('go_trip'), 'class'=>'form-control zd-25 validate[required, funcCall[validHumanDate]]', 'data-errormessage-value-missing'=>lang('require_field'))); ?>
													<i style="position: relative; top: -26px; color: #ec7123; left: 8px;"class="entypo-flight"></i>
												</div>
												<div id="select_vuelta" class="form-group col-xs-6 zd-24" style="padding-left:5px;">
													<?php echo form_input(array('name'=>'return_journey', 'id'=>'date2', 'style'=>'padding-left:35px;', 'placeholder'=>lang('return_trip'), 'class'=>'form-control zd-23 validate[required, funcCall[validHumanDate]]', 'data-errormessage-value-missing'=>lang('require_field'))); ?>
													<i style="position: relative; top: -24px; color: #ec7123; left: 8px;display: inline-block;-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-o-transform: rotate(180deg);-ms-transform: rotate(180deg);transform: rotate(180deg);"class="entypo-flight"></i>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<!--<div class="form-group col-xs-12 zd-22" style="" id="flightTime">
												<label><?php echo lang('departure_landing_time'); ?></label>
											</div>-->
											<div class="col-xs-12" style="padding:0px;">
												<div class="form-group col-xs-6 startTripText zd-21" style="color:#45234b;">
													<label><?php echo lang('time_go'); ?> *</label>
												</div>
												<div class="form-group col-xs-6 returnTripText zd-20" style="padding-left: 5px;color:#45234b;">
													<label><?php echo lang('time_back'); ?> *</label>
												</div>
											</div>
											<div class="form-group col-xs-3 mar_min_5 zd-19 hoursDiv startTrip" style="padding-right:5px;">
												<?php echo form_dropdown('hours', $hours, null, 'class="form-control zd-18 validate[required]"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
											</div>
											<div class="form-group col-xs-3 mar_min_5 zd-17 hoursDiv startTrip" style="padding-left:5px;">
												<?php echo form_dropdown('minutes', $minutes, null, 'class="form-control zd-16 validate[required]"'); ?>
											</div>
											<div class="form-group col-xs-3 mar_min_5 hoursDiv returnTrip zd-15" style="padding-right:5px;padding-left:5px;">
												<?php echo form_dropdown('return_hours', $hours, null, 'class="form-control validate[required] zd-14"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
											</div>
											<div class="form-group col-xs-3 mar_min_5 returnTrip zd-13" style="padding-left:5px;">
												<?php echo form_dropdown('return_minutes', $minutes, null, 'class="form-control zd-12"'); ?>
											</div>
											<div class="form-group col-xs-6 mar_min_5 countryDiv zd-11">
												<label style="color:#45234b;margin-bottom:10px;"><?php echo lang('your_country'); ?></label>
												<?php echo form_dropdown('country', $countries, null, 'class="form-control zd-10 validate[required]"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
											</div>
											<div class="form-group col-xs-6 mar_min_5 flight_noDiv zd-9" style="padding-left:5px;">
												<label style="color:#45234b;margin-bottom:10px;"><?php echo lang('flight'); ?></label>
												<?php echo form_input(array('name'=>'flight_no', 'id'=>'flight_no', 'class'=>'form-control zd-8 validate[required]', 'data-errormessage-value-missing'=>lang('require_field'))); ?>
											</div>
											<div class="form-group col-xs-6 mar_min_5 adultsDiv zd-7" style="">
												<label style="color:#45234b;margin-bottom:10px;"><?php echo lang('adults'); ?></label>
												<?php echo form_dropdown('adults', $adults, null, 'class="form-control validate[required] zd-6"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
											</div>
											<div class="form-group col-xs-6 mar_min_5 zd-5" style="padding-left:5px;">
												<label style="color:#45234b;margin-bottom:10px;"><?php echo lang('child'); ?></label><img src="<?php echo $template_path;?>images/popup_info_icon1.png" style="width:22px;" class="pull-right" data-toggle="tooltip" data-placement="top" title="<?php echo lang('kids_popup'); ?>">
												<?php echo form_dropdown('kids', $kids, null, 'class="form-control zd-4"'); ?>
											</div>
											<!--<div class="form-group col-xs-4 mar_min_5" style="padding-left:5px;">
												<label><?php echo lang('baby'); ?></label> <img src="<?php echo $template_path;?>images/popup_info_icon.png" style="width:22px;" class="pull-right">
												<?php echo form_dropdown('babies', $babies, null, 'class="form-control zd-3"'); ?>
											</div>-->
											<!--<div class="form-group col-xs-12 zd-2"><hr></div>-->
											<div class="form-group col-xs-12 zd-1">
												<button type="button" id="firstbutton" class="btn btn-primary btn-lg pickbluebg btn-block" style="font-size:41.67px;font-family:FuturaStdBold;border-radius:26px;">GO</button>
											</div>
										</div>
									</div>
								
								</form>
							</div>
						</div>
					</div>
					<div class="modal-footer" style="background-color: #fff;"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12"><span><?php echo lang('flight_manatory'); ?></span></div>
			</div>	
		</div>
		<div class="col-sm-9 totStep" id="secondStep" style="display:none;">
			<form id="submitForm">
				<div class="panel">
					<div class="panel-heading pickbluebg"><?php echo strtoupper(lang('go_trip')); ?> </div> 
					<table class="table table-striped displayTable" id="startJourneyTable">
						<thead> 
							<tr>
								<th>&nbsp;</th>
								<th><?php echo lang('hour'); ?></th>
								<th><?php echo lang('source'); ?></th>
								<th><?php echo lang('designation'); ?></th>
								<th><?php echo lang('arrival_time'); ?></th>
								<!--<th>one way</th>
								<th>two way</th>
								<th>time</th>-->
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table> 
				</div> 
				<div class="formErrorArrow formErrorArrowBottom" id="reserve_error" style="display:none;">
					<div class="formErrorContent"><?php echo lang('no_seats'); ?></div>
				</div>
				
				<div class="formErrorArrow formErrorArrowBottom" id="seats_error" style="display:none;">
					<div class="formErrorContent"><?php echo lang('seats_error'); ?></div>
				</div>
				<div class="panel" id="returnJourneyPanel" style="display:none;">  
					<div class="panel-heading pickbluebg"><?php echo strtoupper(lang('return_trip')); ?> </div> 
						<table class="table table-striped displayTable"  id="returnJourneyTable">
							<thead>
								<tr>
									<th>&nbsp;</th>
									<th><?php echo lang('hour'); ?></th>
									<th><?php echo lang('source'); ?></th>
									<th><?php echo lang('designation'); ?></th>
									<th><?php echo lang('arrival_time'); ?></th>
									<!--<th>one way</th>
									<th>two way</th>
									<th>time</th>-->
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table> 
					</div> 
					<div class="formErrorArrow formErrorArrowBottom" id="return_reserve_error" style="display:none;">
						<div class="formErrorContent"><?php echo lang('no_seats'); ?></div>
					</div>
					
					<div class="formErrorArrow formErrorArrowBottom" id="return_seats_error" style="display:none;">
						<div class="formErrorContent"><?php echo lang('seats_error'); ?></div>
					</div>
				</form>
				<div class="col-sm-12">
					<button class="btn volver editpop"><?php echo lang('return'); ?></button>
					<button class="btn go goButton"><?php echo lang('next'); ?></button>
				</div>	
		</div>
		<div class="col-sm-9 totStep" id="thirdStep" style="display:none;">
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
							<input type="text" name="passenger_price" id="passenger_price" value="0">
						</div>
						<div class="form-group col-sm-4 validText" style="padding-left:0px;">
							<label for="name"><?php echo lang('name'); ?> *</label>
							<input type="text" class="form-control bord-rad-10 validate[required]" id="fullname" name="name" placeholder="<?php echo lang('name'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-sm-8 validText">
							<label for="surname"><?php echo lang('surname'); ?> *</label>
							<input type="text" class="form-control bord-rad-10 validate[required]" id="surname" name="surname" placeholder="<?php echo lang('surname'); ?>" required  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-sm-4 validText" style="padding-left:0px;">
							<label for="email" id="emailValid">Email *</label>
							<input type="text" class="form-control bord-rad-10 validate[required,custom[email]]" id="email" name="email" placeholder="Email" required  data-errormessage-value-missing="<?php echo lang('require_field')?>" data-errormessage-custom-error="<?php echo lang('invalid_email'); ?>" >
						</div>
						<div class="form-group col-sm-4 validText">
							<label for="confirm_email"><?php echo lang('confirm_email'); ?> *</label>
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
						<label style="position: relative; top: -1px;" for="terms_cond">&nbsp;<?php echo lang('accept'); ?></label>
						<a href="<?php echo site_url($ln.'/terms'); ?>" target="_blank" class="orange" style="position: relative; top: -1px;">&nbsp;<?php echo lang('terms_and_conditions'); ?></a> <span style="position: relative; top: -1px;"><!--&</span> 
						<a style="position: relative; top: -1px;" href="<?php echo site_url($ln.'/terms'); ?>" class="orange" target="_blank"><?php echo lang('privacy_policy'); ?></a>-->
					</p>
					</div>
				</div>
				</form>
				<div class="col-sm-12" style="padding:0px;margin-left:-10px; width:103%;">
				<hr class="picklightblueborder">
				</div>
				<form id="bank_form" action="" method="POST" style="display:none;">
					<input type="text" name="Ds_SignatureVersion" id="Ds_SignatureVersion" value=""/>
					<input type="text" name="Ds_MerchantParameters" id="Ds_MerchantParameters" value=""/>
					<input type="text" name="Ds_Signature" id="Ds_Signature" value="" />
				</form>
				<!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="paypalform" target="_top">-->
				<form action="process/?paypal=checkout" method="post" id="paypalform">
					<input type="hidden" name="duplicate_bool" id="duplicate_bool" value="0">
					<input type="hidden" name="amount" class="amount" value="">
					<input type="hidden" name="itemname" value="Reservation">
					<input type="hidden" name="itemnumber" value="1">
					<input type="hidden" name="itemQty" value="1">
					<input type="hidden" name="BookId" id="BookId">
					<input type="hidden" name="itemdesc" value="" /> 
					<input type="hidden" name="itemprice" class="amount" value="">
					
					<div class="col-sm-12" style="margin-bottom:10px;">
					<?php echo lang('total_pay'); ?>: 
					<button type="button" id="form-submit" class="btn pull-right btn-lg pickbluebg paypalsubmit" style="font-family:FuturaStdBold;padding-left:40px;padding-right:40px;padding-top:15px; padding-bottom:15px;"><?php echo lang('pay'); ?></button> 
					<br> <h3><span id="price_final">12.12</span>&euro;</h3> 
					<div class="paymentValid mypaypalimg" style="position: relative; top: -61px; left: 115px; width: 50%;">
					<!--<span><img src="<?php echo $template_path; ?>images/paypal.jpg"></span>-->
					<span style="font-size:20px;"><?php echo lang('how_pay'); ?></span><br>
					<span>
						<input style="position: relative; top: -2px;" type="radio" class="validate[required]" name="paymentmethod" id="sabadell_bank" value="bank"  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						<label style="position: relative; top: -3px;" for="sabadell_bank"><?php echo lang('pay_by_credit'); ?></label>
					</span>
					
					<span>
						<input style="position: relative; top: -2px;"type="radio" class="validate[required]" name="paymentmethod" id="paybyonline" value="online"  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						<label style="position: relative; top: -3px;" for="paybyonline"><?php echo lang('pay_by_online'); ?>.</label>
					</span>
					
					<?php if($this->session->userdata('user_name') && $this->session->userdata('user_type') == 2){ 
						if($collaborator_details['available_seats'] == 'activate') {
					?>
						<span id="collaborator_seats">
							<input style="position: relative; top: -2px;"type="radio" class="validate[required]" name="paymentmethod" id="available_seats" value="available_seats"  data-errormessage-value-missing="<?php echo lang('require_field')?>">
							<label style="position: relative; top: -3px;" for="available_seats"><?php echo lang('available_seats'); ?>.</label>
						</span>
					<?php } ?>	
					<?php  if($collaborator_details['payment_methods'] == 'online_and_cash'){ ?>
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
<?php $this->load->view('footer');?>
<!--Reservation page script start-->
<script>
//msg_modal.modal('show');
msg_modal.on('hidden.bs.modal', function () {
   //$('#submitimage').trigger('click'); 
   $('#paypalform').submit();
});
var firstStepJson = '';
var return_journey = false;
var addExtra = {};
var extraJson = {};
var code = '';
var price='';
var prevBookId = '';
var prevReturnBookId = '';
var percentage='';
var percentage_value = '';
var price_value = '';
var totAmount = 0;
var iniPrice = 0;
var formError = '<div class="nameformError parentFormundefined" style="opacity: 0.87; position: relative; top: 5px; font-size: 12px; width: 70%; right: initial; float: right;">'+
					'<div class="formErrorContent" style="font-size:10px;!important">* There is no seats</div>'+
				'</div>';
$(document).ready(function(){
	/*First step start*/
	var height = $('#rowHeight').height();
	$('#firstLeftStep div').css('height', height);
	var country = JSON.parse('<?php echo addslashes(json_encode($countries)); ?>');
	$("#firstStepForm").validationEngine({
		promptPosition : 'bottomLeft',
		maxErrorsPerField:1
	});
	$('#firstbutton').click(function(){
		if($('#zone').val() == '') {
			$('#postal_code').addClass('validate[required]');
			//validate[required,funcCall[validEnd]]
		}
		else {
			$('#postal_code').removeClass('validate[required]');
			$('.postal_codeformError').remove();
		}
		var formData = $('#firstStepForm').serializeArray();
		var valid = $("#firstStepForm").validationEngine('validate');
		if(valid) {
			if(firstStepJson != JSON.stringify(formData) || $('#firstPageError').is(':visible')) {
				$('#firstPageError').hide();
				$('#seats_error').hide();
				$('#return_seats_error').hide();
				
				firstStepJson = JSON.stringify(formData);
				$('#startJourneyTable tbody').html('');
				$('#returnJourneyTable tbody').html('');
				$.ajax({
					url:'<?php echo site_url($ln.'/ajaxreturn1'); ?>',
					type:'post',
					data:formData,
					dataType:'json',
					success:function(data, textStatus, jqXHR){
						//console.log(data)
						if(data['error']) {
							$('#firstPageError div').text(data['error']);
							$('#firstPageError').show();
						} else {
							$('#returnJourneyPanel').hide();
							$.each(data['data'], function(i,v){
								$('#startJourneyTable tbody').append(
								'<tr>'+
									'<th scope="row">'+
										'<label>'+
											'<input type="radio" name="book_id" id="blankRadio'+v.id+'" value="'+v.id+'" aria-label="..." data-rates="'+v.rates+'">'+
											'<input type="hidden" name="seats_'+v.id+'"  value="'+v.seats+'">'+
											'<input type="hidden" name="seats_price_'+v.id+'"  value="'+data['rates']+'">'+
											'<input type="hidden" class="hidden_value" name="journey_'+v.id+'"  value=\''+JSON.stringify(v)+'\'>'+
										'</label>'+
									'</th>'+
									'<td>'+v.journey_start+'</td>'+
									'<td>'+data['from_zone']+'</td>'+
									'<td>'+data['to_zone']+'</td>'+
									'<td>'+v.journey_end+'</td>'+
									/*'<td>'+v.oneway_rates+' &euro;</td>'+
									'<td>'+v.twoway_rates+' &euro;</td>'+
									'<td>'+((v.morning)?'morning':'night')+'</td>'+*/
								'</tr>'); 
							});
							if(data['return'].length > 0) {
								return_journey = true;
								$.each(data['return'], function(i,v){
									$('#returnJourneyTable tbody').append(
									'<tr>'+
										'<th scope="row">'+
											'<label>'+
												'<input type="radio" name="return_book_id" id="blankRadio'+v.id+'" value="'+v.id+'" aria-label="..." data-rates="'+v.rates+'">'+
												'<input type="hidden" name="return_seats_'+v.id+'"  value="'+v.seats+'">'+
												'<input type="hidden" class="hidden_value" name="return_journey_'+v.id+'"  value=\''+JSON.stringify(v)+'\'>'+
											'</label>'+
										'</th>'+
										'<td>'+v.journey_start+'</td>'+
										'<td>'+data['to_zone']+'</td>'+
										'<td>'+data['from_zone']+'</td>'+
										'<td>'+v.journey_end+'</td>'+
										/*'<td>'+v.oneway_rates+' &euro;</td>'+
										'<td>'+v.twoway_rates+' &euro;</td>'+
										'<td>'+((v.morning)?'morning':'night')+'</td>'+*/
									'</tr>'); 
								});
								$('#returnJourneyPanel').show();
							}
							$('.stepClick').removeClass('active');
							$('li[data-class=secondStep]').addClass('active');
							$('.totStep').hide();
							$('#secondStep').show();
							
							/*$('.amount').val(data['rates']);
							$('#price_final').text(data['rates']);
							$('#price_total').text(data['rates']);
							$('#initialPrice').text(data['rates']);*/
							var oldPrice = iniPrice;
							var total = totAmount;
							if(oldPrice != 0) {
								total = parseFloat(total) - parseFloat(oldPrice);
							}
							if(percentage != '') {
								total += parseFloat(percentage);
								var per = (parseFloat(percentage_value)*total)/100;
								percentage = per;
								total -= parseFloat(per);
								$('#price_reduction').text(per.toFixed(2));

								$('#promotional_values').val(per.toFixed(2));
							}
							totAmount = total;
							iniPrice = 0;
							var fix_total = total.toFixed(2);
							$('.amount').val(fix_total);
							$('#price_final').text(fix_total);
							$('#price_total').text(fix_total);
							$('#initialPrice').text(0);
							$('#passenger_price').val(0);
							
							
							reservationClick();
							$('#bcnarea_address_id').val(data['bcnaddress_id']);
							if($('#zone').val() == '')
								$('#zone').val(data['zone']);
							
							if($('#firstLeftStep').is(':visible')) {
								$('#firstLeftStep').attr("style", "display: none !important");
								$('#secondLeftStep').show();
							}
							
							$('.duplicateList').each(function(){
								var dataId = $(this).data('id');
								if(dataId == 'flight_time') {
									$(this).text(data['format_starttime']);
								} else if(dataId == 'flightlanding_time') {
									if($('[name=return_hours]').val() != '') {
										$(this).text(data['format_returntime']);
									}
									else {
										$(this).hide();
										$(this).prev().hide();
									}
									
								} else if(dataId == 'start_journey') {
									$(this).text(data['format_startdate']);
								} else if(dataId == 'return_journey') {
									if($('[name=return_journey]').val() != '') {
										$(this).text(data['format_returndate']);
									}
									else {
										$(this).hide();
										$(this).prev().hide();
									}
									
								} else if(dataId == 'country') {
									$(this).text(country[$('[name=country]').val()]);
								} else {
									$(this).text($('[name='+dataId+']').val());
								}
							})
						}
					},
					error:function(jqXHR, textStatus, errorThrown){
						console.log(textStatus+'----'+errorThrown);
					},
				});	
			} else {
				$('.stepClick').removeClass('active');
				$('li[data-class=secondStep]').addClass('active');
				$('.totStep').hide();
				$('#secondStep').show();
				if($('#firstLeftStep').is(':visible')) {
					$('#firstLeftStep').attr("style", "display: none !important");
					$('#secondLeftStep').show();
				}
			}
		} 
	});
	/*First step end*/
	
	$(".more_info_click" ).click(function() {
	   	$(this).find('.show_more_info').toggle();
	});
	$('.editpop').click(function(){
		$('.stepClick').removeClass('active');
		$('li[data-class=firstStep]').addClass('active');
		$('.totStep').hide();
		$('#firstStep').show();
		$('#secondLeftStep').attr("style", "display: none !important");
		$('#firstLeftStep').show();
	});
	$('.stepClick').click(function(){
		if(!$('#'+$(this).data('class')).is(':visible')){
			var bool = true;
			if($(this).data('class') == 'firstStep'){
				$('.stepClick').removeClass('active');
				$(this).addClass('active');
				$('.totStep').hide();
				$('#'+$(this).data('class')).show();
				$('#secondLeftStep').attr("style", "display: none !important");
				$('#firstLeftStep').show();
			} else if($(this).data('class') == 'secondStep') {
				if($('#firstStep').is(':visible')) {
					var formData = $('#firstStepForm').serializeArray();
					if(firstStepJson != JSON.stringify(formData) || $('#firstPageError').is(':visible')) {
						$('#firstbutton').trigger('click');
					} else {
						$('.stepClick').removeClass('active');
						$(this).addClass('active');
						$('.totStep').hide();
						$('#'+$(this).data('class')).show();
						$('#firstLeftStep').attr("style", "display: none !important");
						$('#secondLeftStep').show();
					}
				} else {
					$('.stepClick').removeClass('active');
					$(this).addClass('active');
					$('.totStep').hide();
					$('#'+$(this).data('class')).show();
					$('#firstLeftStep').attr("style", "display: none !important");
					$('#secondLeftStep').show();
				}
			}
			if($(this).data('class') == 'thirdStep') {
				if($('#secondStep').is(':visible')) {
					if($('input[name=book_id]:checked').length == 0){
						bool=false;
						$('#reserve_error').fadeIn();
					}
					if($('input[name=return_book_id]').length !=0 && $('input[name=return_book_id]:checked').length == 0){
						bool=false;
						$('#return_reserve_error').fadeIn();
					}
					if(!bool){
						$('.stepClick').removeClass('active');
						$('li[data-class=secondStep]').addClass('active');
						$('.totStep').hide();
						$('#secondStep').show();
						$('#firstLeftStep').attr("style", "display: none !important");
						$('#secondLeftStep').show();
					}
					else
						seatsAvailable(this,2);
						
				} else {
					var formData = $('#firstStepForm').serializeArray();
					if(firstStepJson != JSON.stringify(formData) || $('#firstPageError').is(':visible')) {
						$('#firstbutton').trigger('click');
					} else {
						if($('input[name=book_id]:checked').length == 0){
							bool=false;
							$('#reserve_error').fadeIn();
						}
						if($('input[name=return_book_id]').length !=0 && $('input[name=return_book_id]:checked').length == 0){
							bool=false;
							$('#return_reserve_error').fadeIn();
						}
						if(!bool){
							$('.stepClick').removeClass('active');
							$('li[data-class=secondStep]').addClass('active');
							$('.totStep').hide();
							$('#secondStep').show();
							$('#firstLeftStep').attr("style", "display: none !important");
							$('#secondLeftStep').show();
						}
						else
							seatsAvailable(this,2);
					}
				}
			}
		}
	});
	function seatsAvailable(invoker,mode){
		var formData = "journey_details="+$('input[name=book_id]:checked').nextAll('.hidden_value').val()+"&mode=seatsAvailable&seats="+$('input[name=adults]').val()+"&start_from="+$('input[name=start_from]').val()+"&end_at="+$('input[name=end_at]').val();
		if($('input[name=return_book_id]').is(':checked'))
			formData += "&return_journey_details="+$('input[name=return_book_id]:checked').nextAll('.hidden_value').val();
		//console.log(formData);
		$.ajax({
			url:'<?php echo site_url($ln.'/ajaxreturn1'); ?>',
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
						$('li[data-class=thirdStep]').addClass('active');
						$('.totStep').hide();
						$('#thirdStep').show();
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
	
	$('.goButton').click(function(){
		if($('input[name=book_id]:checked').length != 0){
			if($('input[name=return_journey]').val() == ''){
				seatsAvailable(this,1);
			}
			else if($('input[name=return_journey]').val() != '' && $('input[name=return_book_id]:checked').length != 0){
				seatsAvailable(this,1);
			}
			else
				$('#return_reserve_error').fadeIn();
		}
		else{
			if($('input[name=return_journey]').val() != '' && $('input[name=return_book_id]:checked').length == 0)
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
		if(valid){
			var formData = $('#loginform').serializeArray();
			formData.push({name:"mode", value:'login'});
			$.ajax({
				url:'<?php echo site_url($ln.'/ajaxreturn1'); ?>',
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
		var total = parseFloat(totAmount);
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
		if(total != parseFloat(totAmount)) {			
			if(percentage != '') {
				total += parseFloat(percentage);
				var per = (parseFloat(percentage_value)*total)/100;
				percentage = per;
				total -= parseFloat(per);
				$('#price_reduction').text(per.toFixed(2));
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
		var tot_fix = total.toFixed(2);
		$('#price_total').text(tot_fix);
		$('#price_final').text(tot_fix);
		$('#total_price').val(tot_fix);
		$('.amount').val(tot_fix);
		$('#extras_array').val(JSON.stringify(extraJson));
		totAmount = total;
		//console.log($('#extras_array').val())
	})
	$('.applicarbtn').click(function(){
		$('.errorCodes').hide();
		if($('#promo_code').val().trim() != '' && code != $('#promo_code').val().trim()){
			$.ajax({
				url:'<?php echo site_url($ln.'/ajaxreturn1'); ?>',
				type:'post',
				data:'code='+$('#promo_code').val()+'&mode=codes',
				dataType:'json',
				success:function(data, textStatus, jqXHR){
					if(data['error']){
						$('.errorCodes').show();
					}
					else{
						var total = parseFloat(totAmount);
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
						$('#price_reduction').text(reduction.toFixed(2));
						code = $('#promo_code').val().trim();
						
						$('#promotional_codes_id').val(data['id']);
						$('#promotional_values').val(reduction);
						$('#promotional_code_values').val(data['price_or_percentage']);
						$('#promotional_type').val(data['discount_type']);
						
						var tot_fix = total.toFixed(2);
						$('#price_total').text(tot_fix);
						$('#price_final').text(tot_fix);
						$('#total_price').val(tot_fix);
						$('.amount').val(tot_fix);
						totAmount = total;
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

				var formData = $('.validateForm1, #submitForm, #paypalform, #firstStepForm').serializeArray();
				formData.push({name:'mode',value:'formsubmit'});
				//console.log(formData);
				//console.log(JSON.stringify(formData));
				
				$('#passenger_price').val(iniPrice.toFixed(2));
				$('.amount').val(totAmount.toFixed(2));
				$.ajax({
					url:'<?php echo site_url($ln.'/ajaxreturn1'); ?>',
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
								$('.stepClick:nth-child(2)').addClass('active');
								$('.totStep').hide();
								$('#'+$('.stepClick:nth-child(2)').data('class')).show();
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
							if(data.time_error) {
								bool = false;
								$('#firstPageError div').text('<?php echo lang('date_error'); ?>');
								$('#firstPageError').show();
								$('.stepClick').removeClass('active');
								$('.stepClick:first').addClass('active');
								$('.totStep').hide();
								$('#'+$('.stepClick:first').data('class')).show();
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
								if(data.payment_method == 'online') {
									if($('.amount').val() > 0) {
										$('#paypalform').submit();
									} else {
										location.replace('<?php echo site_url($ln); ?>/success?cm='+data.book_id+'&amt='+data.amt);
									}
									//$('#submitimage').trigger('click');
									//msg_modal.modal('show');
									
								} else if(data.payment_method == 'bank') {
									if($('.amount').val() > 0) {
										$('#Ds_SignatureVersion').val(data.version);
										$('#Ds_MerchantParameters').val(data.params);
										$('#Ds_Signature').val(data.signature);
										$('#bank_form').attr('action', data.banaba_url);
										$('#bank_form').submit();
									} else {
										location.replace('<?php echo site_url($ln); ?>/success?cm='+data.book_id+'&amt='+data.amt);
									}
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
	var total = parseFloat(totAmount);
	var val = ele.find('.extra_total_'+c).text();
	total -= parseFloat(val);
	if(percentage != '') {
		total += parseFloat(percentage);
		var per = (parseFloat(percentage_value)*total)/100;
		percentage = per;
		total -= parseFloat(per);
		$('#price_reduction').text(per.toFixed(2));
		
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
	var tot_fix = total.toFixed(2);
	$('#price_total').text(tot_fix);
	$('#price_final').text(tot_fix);
	$('#total_price').val(tot_fix);
	$('.amount').val(tot_fix);
	totAmount = total;
	ele.remove();
	delete extraJson[c];
	$('#extras_array').val(JSON.stringify(extraJson));
	delete addExtra[c];
	$('h5[data-extra-name='+c+'] select option:first').prop('selected','selected');
	//console.log($('#extras_array').val())
}
function calPrice(ele) {
	var total = totAmount;
	var initial_price = iniPrice;
	var name = ele.attr('name');
	var data_json = $.parseJSON(ele.closest('label').find('.hidden_value').val());
	var oneway_rates = data_json['oneway_rates'];
	var twoway_rates = data_json['twoway_rates'];
	var rate = oneway_rates;
	var twoway = false;
	if(name == 'book_id') {
		if(return_journey && $('[name=return_book_id]').is(':checked')) {
			var return_data = $.parseJSON($('[name=return_book_id]:checked').closest('label').find('.hidden_value').val());
			return_oneway_rate = return_data['oneway_rates'];
			if((return_data['morning'] && data_json['morning'])||(return_data['night'] && data_json['night'])) {
				twoway = true;
				rate = twoway_rates;
			} else {
				rate = parseFloat(oneway_rates) + parseFloat(return_oneway_rate);
			}
		}
	} else {
		if($('[name=book_id]').is(':checked')) {
			var start_data = $.parseJSON($('[name=book_id]:checked').closest('label').find('.hidden_value').val());
			start_oneway_rate = start_data['oneway_rates'];
			if((start_data['morning'] && data_json['morning'])||(start_data['night'] && data_json['night'])) {
				twoway = true;
				rate = twoway_rates;
			} else {
				rate = parseFloat(oneway_rates) + parseFloat(start_oneway_rate);
			}
		}
	}
	
	total = parseFloat(total) - parseFloat(initial_price);
	total = parseFloat(total) + parseFloat(rate);
	iniPrice = rate;
	
	if(percentage != '') {
		total += parseFloat(percentage);
		var per = (parseFloat(percentage_value)*total)/100;
		percentage = per;
		total -= parseFloat(per);
		$('#price_reduction').text(per.toFixed(2));

		$('#promotional_values').val(per);
	}
	
	var tot_fix = total.toFixed(2);
	$('.amount').val(tot_fix);
	$('#price_final').text(tot_fix);
	$('#price_total').text(tot_fix);
	$('#initialPrice').text(rate.toFixed(2));
	$('#passenger_price').val(rate.toFixed(2));
	totAmount = total;
}
function reservationClick() {
	$('input[name=return_book_id]').unbind();
	$('input[name=book_id]').unbind();
	$('input[name=return_book_id]').bind("mousedown keydown", function() {
		if($('input[name=return_book_id]').is(':checked') && $('input[name=return_book_id]:checked').val() != $(this).val()) {
			calPrice($('input[name=return_book_id]:checked'), 1);
		}
	}).bind("change", function() {
		calPrice($('input[name=return_book_id]:checked'),2);
		$('#return_reserve_error').fadeOut();
		$('#return_seats_error').fadeOut();
	});
	$('input[name=book_id]').bind("change", function() {
		calPrice($('input[name=book_id]:checked'));
		$('#reserve_error').fadeOut();
		$('#seats_error').fadeOut();
	});
}

</script>
<!--Reservation page script end-->