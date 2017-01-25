<style type="text/css">

</style>
<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('business').'/ ID '; ?></h1>
	</div>
</div>
<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
	<div class="row">
		<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er) {
		?>	
		<div class="alert alert-danger"><?php echo $er; ?></div>
		<?php	} ?>
	</div>	
	<div class="row" id="business">
		<div class="col-md-12">
			<div class="form-content">
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('name');?>: </label>
				<div class="col-sm-10">
					<?php echo form_input(array('name'=>'name', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('name'), $readonly=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('email');?>: </label>
				<div class="col-sm-10">
					<?php echo form_input(array('name'=>'email', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('email'), $readonly=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('direction');?>: </label>
				<div class="col-sm-10">
					<textarea <?php echo $readonly?'disabled':''; ?> name="direction" class="form-control"><?php echo $this->mdl_business->form_value('direction'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('telephone');?>: </label>
				<div class="col-sm-10">
					<?php echo form_input(array('name'=>'telephone', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('telephone'), $readonly=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('contact_person');?>: </label>
				<div class="col-sm-10">
					<?php echo form_input(array('name'=>'contact_person', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('contact_person'), $readonly=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('time_limit');?>: </label>
					<div class="col-sm-2">
						<?php echo form_dropdown('hours', $hours, date('H', strtotime($this->mdl_business->form_value('time_limit'))), 'class="form-control" '.$disabled.''); ?>
						<div class="text-center">
						<span><?php echo lang('hour'); ?></span>
						</div>
					</div>
					<div class="col-sm-2">
						<?php echo form_dropdown('minutes', $minutes, date('i', strtotime($this->mdl_business->form_value('time_limit'))), 'class="form-control" '.$disabled.''); ?>
						<div class="text-center">
						<span><?php echo lang('minutes'); ?></span>
						</div>
					</div>
			</div>	
			<div class="form-group">
				<div class="col-sm-12">
				<?php echo $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">

</script>