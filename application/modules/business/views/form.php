<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
$count = 1;
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left">
			<?php echo lang('business').'/ ID '; ?>
		</h1>
	</div>
</div>
<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="form_number" name="form_number" value="
		<?php echo $count; ?>" />
		<div class="row">
			<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er) {
		?>
			<div class="alert alert-danger">
				<?php echo $er; ?>
			</div>
			<?php	} ?>
		</div>
		<div class="row" id="business">
			<div class="col-md-12">
				<div class="form-content">
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('code_business');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'name', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('code_business'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('name');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'name', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('name'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('email');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'email', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('email'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('telephone');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'telephone', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('telephone'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('contact_person');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'contact_person', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('contact_person'), $readonly=>true)); ?>
						</div>
					</div>
				</div>
				<!-- Center -- starts -->
				<div id="jscenterForm">
				<div class="form-content martop">
					<h2>
						<?php echo lang('center'); ?>
					</h2>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('name');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][name]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('name'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('direction');?>
						</label>
						<div class="col-sm-10>
						<?php echo form_textarea(array('name'=>"center[$count][direction]", 'class'=>"form-control"),$this->mdl_business->form_value('direction') ); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('cp');?>
						</label>
						<div class="col-sm-2">
							<?php echo form_input(array('name'=>"center[$count][cp]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('cp'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('population');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][population]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('population'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('time_limit');?>
						</label>
						<div class="col-sm-2">
							<?php echo form_dropdown("center[$count][hours]", $hours, date('H', strtotime($this->mdl_business->form_value('time_limit') ? $this->mdl_business->form_value('time_limit') : '10:00:00')), 'class="form-control" '.$disabled.''); ?>
							<div class="text-center">
								<span>
									<?php echo lang('hour'); ?>
								</span>
							</div>
						</div>
						<div class="col-sm-2">
							<?php echo form_dropdown("center[$count][minutes]", $minutes, date('i', strtotime($this->mdl_business->form_value('time_limit'))), 'class="form-control" '.$disabled.''); ?>
							<div class="text-center">
								<span>
									<?php echo lang('minutes'); ?>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('route');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][route]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('route'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('norm_route');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][norm_route]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('norm_route'), $readonly=>true)); ?>
						</div>
					</div>
				</div>
				</div>
				<div class="martop jsButtonContainer">
					<div class="form-group new_menu_container">
						<h3 class="col-sm-6 pull-left">
							<a href="javascript:;" style="padding-left:18px;color:#91C848;" onclick="duplicateForm()">
								<u>[+] 
									<?php echo lang('add_new_menu'); ?>
								</u>
							</a>
						</h3>
					</div>
					<div class="form-group submit_buttons">
						<div class="col-sm-12">
							<?php echo $this->layout->load_view('layout/header_buttons'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	form_html = $('#jscenterForm').html();
	function duplicateForm() {
	new_value = parseInt($('#form_number').val())+1;
	new_html = form_html.replace(/Basic\[1\]/g,'Basic['+new_value+']');
	new_html = new_html.replace(/Diet\[1\]/g,'Diet['+new_value+']');
	$('.jsButtonContainer').before(new_html);
	//$('.submit_buttons:last').remove();
	//$('.new_menu_container:first').remove();
	$('#form_number').val(new_value);
}
</script>