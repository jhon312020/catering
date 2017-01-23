<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
	$modalForm = site_url($ln.'/reserva01');
?>
<div class="col-md-4"></div>
<div class="col-md-4">

<!-- Modal -->
<style type="text/css">
	.modal-dialog {
		
		width: auto !important;
	}
	.modal-content {
		border:0px solid #fff !important;
		box-shadow: none !important;
	}
</style>
	
	<hr class="mob-show mob-hr-line">

<div class="modal-dialog reservePop" role="document" style="margin-top:20px!important;">
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo lang('choose_your_route'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="col-xs-12">
					<div class="row contacto">
						<div class="form-group col-xs-6">
							<button id="vuelta" class="btn btn-block active mytpbtn" type="button"><?php echo lang('round_trip'); ?></button>
						</div>
						<div class="form-group col-xs-6">
							<button id="ida" class="btn btn-block mytpbtn" type="button"><?php echo lang('one_way'); ?></button>
						</div>
						<?php echo form_open($modalForm, array('class'=>'validateForm')); ?>
						<form method="POST" action="<?php echo $modalForm; ?>" class="validateForm">
						<div class="form-group col-xs-12"><hr></div>
						<div class="form-group col-xs-12 trip_alert zd-26">
							<div class="alert alert-info" style="background-color:#391B38;border-color:#391B38;color:#fff;">
								<a href="javascript:void(0);" class="close" style="display:block;color:#fff;opacity:1;" data-hide="trip_alert">&times;</a>
							  <strong>*</strong> <?php echo lang('trip_alert'); ?>
							</div>
						</div>
						<div class="form-group col-xs-12">
							<?php echo form_dropdown('start_from1', $start_from, null, 'class="form-control validate[required]" onchange="addPlaceInput(this);"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
							<?php echo  form_input(array('name'=>'zone', 'id'=>'zone', 'type'=>'hidden')); ?>
							<?php echo  form_input(array('name'=>'collaborator_address_id', 'id'=>'collaborator_address_id', 'type'=>'hidden')); ?>
							<?php echo  form_input(array('name'=>'collaborators_id', 'id'=>'collaborators_id', 'type'=>'hidden')); ?>
						</div>
						<div class="form-group col-xs-12 zd-29 ui-front">
							<input type="text" class="form-control validate[required,funcCall[validStart]]" name="start_from" id="autoCompletePlace" placeholder=<?php echo lang('from'); ?>  data-errormessage-value-missing="<?php echo lang('require_field')?>">
						</div>
						<div class="form-group col-xs-12 zd-28 ui-front">
							<?php echo form_input('end_at', null, 'class="form-control zd-27 validate[required,funcCall[validEnd]]" id="end_at" placeholder="'.lang('to').'"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div id="select_ida" class="form-group col-xs-6 zd-26 testId">
							<?php echo form_input(array('name'=>'start_journey', 'id'=>'date1', 'style'=>'padding-left:35px;', 'placeholder'=>lang('go_trip'), 'class'=>'form-control zd-25 validate[required, funcCall[validHumanDate]]', 'data-errormessage-value-missing'=>lang('require_field'))); ?>
							<i style="position: relative; top: -26px; color: #ec7123; left: 8px;"class="entypo-flight"></i>
						</div>
						<div id="select_vuelta" class="form-group col-xs-6 zd-24" style="padding-left:5px;">
							<?php echo form_input(array('name'=>'return_journey', 'id'=>'date2', 'style'=>'padding-left:35px;', 'placeholder'=>lang('return_trip'), 'class'=>'form-control zd-23 validate[required, funcCall[validHumanDate]]', 'data-errormessage-value-missing'=>lang('require_field'))); ?>
							<i style="position: relative; top: -24px; color: #ec7123; left: 8px;display: inline-block;-webkit-transform: rotate(180deg);-moz-transform: rotate(180deg);-o-transform: rotate(180deg);-ms-transform: rotate(180deg);transform: rotate(180deg);"class="entypo-flight"></i>
						</div>
						<div class="form-group col-xs-12 zd-22" style="display:none;margin-top: -15px;" id="flightTime">
							<label><?php echo lang('departure_landing_time'); ?></label>
						</div>
						<div class="form-group col-xs-6 startTripText zd-21" style="margin-top: -15px;">
							<label><?php echo lang('time_go'); ?></label>
						</div>
						<div class="form-group col-xs-6 returnTripText zd-20" style="padding-left: 5px;margin-top: -15px;">
							<label><?php echo lang('time_back'); ?></label>
						</div>
						<div class="form-group col-xs-3 mar_min_5 zd-19 hoursDiv startTrip" style="padding-right:5px;margin-top: -15px;">
							<?php echo form_dropdown('hours', $hours, null, 'class="form-control zd-18 validate[required]"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div class="form-group col-xs-3 mar_min_5 zd-17 hoursDiv startTrip" style="padding-left:5px;margin-top: -15px;">
							<?php echo form_dropdown('minutes', $minutes, null, 'class="form-control zd-16 validate[required]"'); ?>
						</div>
						<div class="form-group col-xs-3 mar_min_5 hoursDiv returnTrip zd-15" style="padding-right:5px;padding-left:5px;margin-top: -15px;">
							<?php echo form_dropdown('return_hours', $hours, null, 'class="form-control validate[required] zd-14"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div class="form-group col-xs-3 mar_min_5 returnTrip zd-13" style="padding-left:5px;margin-top: -15px;">
							<?php echo form_dropdown('return_minutes', $minutes, null, 'class="form-control zd-12"'); ?>
						</div>
						<div class="form-group col-xs-6 mar_min_5 countryDiv zd-11">
							<label><?php echo lang('your_country'); ?></label>
							<?php echo form_dropdown('country', $countries, null, 'class="form-control zd-10 validate[required]"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div class="form-group col-xs-6 mar_min_5 flight_noDiv zd-9" style="padding-left:5px;">
							<label><?php echo lang('flight'); ?></label>
							<?php echo form_input(array('name'=>'flight_no', 'id'=>'flight_no', 'class'=>'form-control zd-8 validate[required]', 'data-errormessage-value-missing'=>lang('require_field'))); ?>
						</div>
						<div class="form-group col-xs-6 mar_min_5 adultsDiv zd-7" style="">
							<label><?php echo lang('adults'); ?></label>
							<?php echo form_dropdown('adults', $adults, null, 'class="form-control validate[required] zd-6"  data-errormessage-value-missing="'.lang('require_field').'"'); ?>
						</div>
						<div class="form-group col-xs-6 mar_min_5 zd-5" style="padding-left:5px;">
							<label><?php echo lang('child'); ?></label><img src="<?php echo $template_path;?>images/popup_info_icon.png" style="width:22px;" class="pull-right" data-toggle="tooltip" data-placement="top" title="Kids are under 5 years. Others are considered only adults.">
							<?php echo form_dropdown('kids', $kids, null, 'class="form-control zd-4"'); ?>
						</div>
						<!--<div class="form-group col-xs-4 mar_min_5" style="padding-left:5px;">
							<label><?php echo lang('baby'); ?></label> <img src="<?php echo $template_path;?>images/popup_info_icon.png" style="width:22px;" class="pull-right">
							<?php echo form_dropdown('babies', $babies, null, 'class="form-control zd-3"'); ?>
						</div>-->
						<div class="form-group col-xs-12 zd-2"><hr></div>
						<div class="form-group col-xs-12 zd-1">
							<button type="submit" class="btn btn-primary btn-lg pickbluebg btn-block" style="font-size:41.67px;font-family:FuturaStdBold;">GO</button>
						</div>
						</form>
					</div>
				</div>
	  		</div>
	    	<div class="modal-footer"></div>
	    </div>
  	</div>
</div>
<div class="col-md-4"></div>
<div class="row" style="margin-top:-15px;">&nbsp;</div>	
<?php $this->load->view('footer');?>