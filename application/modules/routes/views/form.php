<style type="text/css">
	@page { margin: 10mm; } /* All margins set to 2cm */
	@media print {
		 body, .page-container, .sidebar-menu {margin:0 !important; padding-left: 0px !important;}
	    .btn {
	        display: none !important;
	    }
	    .list-inline, .sidebar-menu, .col-md-5 .panel-heading  {
	    	display: none !important;
	    }
	    .col-md-6, .col-md-5 {
	    	float: left !important;
	    	margin-left: 0px !important;
	    	padding-left:0px !important;
	    	width:55% !important;
	    }
	    .col-md-7 {
	    	float: left !important;
	    	margin-left: 0px !important;
	    	padding-left:0px !important;
	    	width:42% !important;
	    }
	}
</style>
<div class="headerbar">
	<h1><?php echo lang('route'); ?></h1>
	<?php
		$zones = $this->mdl_routes->form_value('zone');
		$hours1 = $this->mdl_routes->form_value('hours');
		$minutes1 = $this->mdl_routes->form_value('minutes');
	?>
</div>
<form method="post" class="form-horizontal" enctype="multipart/form-data" >
	<div class="row">
		<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er){
		?>	
		<div class="alert alert-danger"><?php echo $er; ?></div>
		<?php	
		}
		$inputOption = array('name'=>'','class'=>'form-control', 'placeholder'=>'Lorem Ipsum','value'=>null);
		?>
		<div class="col-md-5">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar"><h1>&nbsp;</h1></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('route') .' '.  lang('no'); ?>: </label>
						<div class="col-sm-9">
							<?php
								$inputOption['name']  = 'reference_id';
								$inputOption['value'] = $this->mdl_routes->form_value('reference_id');
								$inputOption['placeholder'] = '01';
								$inputOption['class'] = 'form-control';
								if($readonly){ $inputOption['readonly']=1; }
								echo form_input($inputOption);
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('car'); ?>: </label>
						<div class="col-sm-9">
						<?php 
							echo form_dropdown('car', $cars, $this->mdl_routes->form_value('car'), ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"' ); 
						?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('driver'); ?>: </label>
						<div class="col-sm-9">
							<?php
								$inputOption['name']  = 'driver';
								$inputOption['value'] = $this->mdl_routes->form_value('driver');
								$inputOption['placeholder'] = 'Lorem Ipsum';
								$inputOption['class'] = 'form-control';
								if($readonly){ $inputOption['readonly']=1; }
								echo form_input($inputOption);
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('seats'); ?>: </label>
						<div class="col-sm-9">
							<?php
								$inputOption['name']  = 'seats';
								$inputOption['value'] = $this->mdl_routes->form_value('seats');
								$inputOption['placeholder'] = '10';
								$inputOption['class'] = 'form-control';
								if($readonly){ $inputOption['readonly']=1; }
								echo form_input($inputOption);
							?>
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-3 control-label">Days of the week: </label>
						<div class="col-sm-9">
							<?php
								$daysName = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
								$daysValue = $this->mdl_routes->form_value('days');
								foreach($daysName as $key => $day) {
									$inputOption = array();
									$inputOption['name']  = 'days[]';
									$inputOption['style']  = 'position:relative;top:2px;margin-right:5px;' . ($key !== 0 ? 'margin-left:5px;' : '');
									$inputOption['value']  = $day;
									$inputOption['id']  = 'id-'.$key;
									$inputOption['checked'] = ($daysValue && in_array($day, $daysValue));
									if($readonly){ $inputOption['readonly']=1; }
									echo '<label for="id-'.$key.'">';
									echo form_checkbox($inputOption);
									echo $day.'</label>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<?php if ($this->session->userdata('methodFrom') !== 'calendar'){ ?>
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar"><h1>&nbsp;</h1></div>
				<div class="panel-body" id="routeSteps">
					<?php
						if ($zones) {
							foreach ($zones as $key => $zone) {
								printf("<div class='form-group'><label class='col-sm-2 control-label'>%s</label><div class='col-sm-4'>%s</div><div class='col-sm-3'>%s</div><div class='col-sm-2'>%s</div><div class='col-sm-1' style='width:auto;padding:0;margin:0;'><i class='entypo-cancel-circled close' onclick='removeStep(this);'></i></div></div>", 
									lang('step').' '.($key+1).':',
									form_dropdown('zone[]', $bcn, $zone, ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"'),
									form_dropdown('hours[]', $hours, $hours1[$key], ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"'),
									form_dropdown('minutes[]', $minutes, $minutes1[$key], ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"')
								);
							}
						}
						else {
					?>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo lang('step'); ?> 1:</label>
						<div class="col-sm-4">
							<?php echo form_dropdown('zone[]', $bcn, null, ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"' ); ?>
						</div>
						<div class="col-sm-3">
							<?php echo form_dropdown('hours[]', $hours, null, ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"' ); ?>
						</div>
						<div class="col-sm-2">
							<?php echo form_dropdown('minutes[]', $minutes, null, ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"' ); ?>
						</div>
						<div class="col-sm-1" style="width:auto;padding:0;margin:0;">
							<i class="entypo-cancel-circled close" onclick="removeStep(this)"></i>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"><?php echo lang('step'); ?> 2: </label>
						<div class="col-sm-4">
							<?php echo form_dropdown('zone[]', $bcn, null, ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"' ); ?>
						</div>
						<div class="col-sm-3">
							<?php echo form_dropdown('hours[]', $hours, null, ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"' ); ?>
						</div>
						<div class="col-sm-2">
							<?php echo form_dropdown('minutes[]', $minutes, null, ($readonly) ? 'class="form-control" readonly=1' : 'class="form-control"' ); ?>
						</div>
						<div class="col-sm-1" style="width:auto;padding:0;margin:0;">
							<i class="entypo-cancel-circled close" onclick="removeStep(this)"></i>
						</div>
					</div>
					<?php } ?>
					<?php if (!$readonly){ ?>
					<div class="row">
						<div class="col-sm-10 pull-right">
							<button class="btn btn-lg btn-default btn-block" value="1" style="text-transform:uppercase;font-weight:bold;background:#CCCCCC;border-radius:10px;color:#FFFFFF;font-size:16px;" onclick="createStep();return false;">
								<i class="icon-ok icon-white"></i> Add Step
							</button>
						</div>
					</div>
					<div class="row" style="margin-top:15px;">
						<div class="col-sm-10 pull-right">
							<button class="btn btn-primary btn-lg" style="padding:10px 16px;width:30%;margin:0px 10px 0px 0px;" name="btn_submit" value="1">
								Save
							</button>
						    <button class="btn btn-danger btn-lg" style="padding:10px 16px;width:30%;margin:0px 10px 0px 10px;" name="btn_cancel" value="1">
						    	Cancel
						    </button>
						    <button class="btn btn-danger print btn-lg" style="padding:10px 16px;width:30%;margin:0px 0px 0px 10px;" name="btn_print" value="1" onclick="window.print();return false;">
						    	Print
						    </button>
						</div>
					</div>
					<?php } else { ?>
					<div class="row" style="margin-top:15px;">
						<div class="col-sm-10 pull-right">
						    <button class="btn btn-danger btn-lg" style="padding:10px 16px;width:30%;margin:0px 0px 0px 10px;" name="btn_print" value="1" onclick="location.href='<?php echo site_url('/admin/routes/schedule');?>'; return false;">
						    	Back
						    </button>
						    <button class="btn btn-danger print btn-lg" style="padding:10px 16px;width:30%;margin:0px 0px 0px 10px;" name="btn_print" value="1" onclick="window.print();return false;">
						    	Print
						    </button>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } else { ?>
			<div class="panel minimal minimal-gray">
				<div class="panel-heading headerbar"><h1>Booking Information</h1></div>
				<div class="panel-body">
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</form>
<script type="text/javascript">
	function createStep(){
		var noOfRows = $('select[name="zone[]"]').length;
		var lastRow = $('#routeSteps div[class="form-group"]').last();
		var newRow = '<div class="form-group"><label class="col-sm-2 control-label"><?php echo lang('step'); ?> '+ (parseInt(noOfRows)+1) +': </label><div class="col-sm-4">';
		newRow += '<?php echo str_replace(array("\r\n", "\n", "\r"), '', form_dropdown('zone[]', $bcn, null, 'class="form-control"')); ?>';
		newRow += '</div><div class="col-sm-3">';
		newRow += '<?php echo str_replace(array("\r\n", "\n", "\r"), '', form_dropdown('hours[]', $hours, null, 'class="form-control"')); ?>';
		newRow += '</div><div class="col-sm-2">';
		newRow += '<?php echo str_replace(array("\r\n", "\n", "\r"), '', form_dropdown('minutes[]', $minutes, null, 'class="form-control"')); ?>';
		newRow += '</div><div class="col-sm-1" style="width:auto;padding:0;margin:0;"><i class="entypo-cancel-circled close" onclick="removeStep(this);"></i></div></div>';
		lastRow.after(newRow);
	}
	function removeStep(current){
		var $this = $(current);
		var currentRow = $this.parent().parent();
		var nextRow = currentRow.next();
		var label = nextRow.find('label');
		var totalRow = $('#routeSteps').find('div.form-group label');
		while (label.length){
			label.text('Step '+ (parseInt(label.text().replace('Step ','')) - 1) + ':');
			nextRow = nextRow.next();
			label = nextRow.find('label');
		}
		if (totalRow.length > 1){ currentRow.remove(); }
	}
</script>