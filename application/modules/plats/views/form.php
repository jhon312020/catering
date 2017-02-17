<?php
	$readonly = ($readonly)?'readonly':'';
	$disabled = ($readonly)?'disabled':'';
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('add_plato'); ?></h1>
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
				<label class="col-sm-2 pull-left"><?php echo lang('name');?> </label>
				<div class="col-sm-10">
					<?php echo form_input(array('name'=>'Plat', 'class'=>'form-control', 'value'=>$this->mdl_plats->form_value('Plat'), $readonly=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('internal_code');?> </label>
				<div class="col-sm-10">
					<?php echo form_dropdown(array('name'=>'OrdrePlat', 'class'=>'form-control', $readonly=>true), $internal_codes); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('description');?> </label>
				<div class="col-sm-10">
					<?php echo form_textarea(array('name'=>'Ingredients', 'class'=>'form-control', 'value'=>$this->mdl_plats->form_value('Ingredients'), $readonly=>true)); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 pull-left"><?php echo lang('image');?> </label>
				<div class="col-sm-10">
					<?php echo form_upload(array('name'=>'image', 'class'=>'form-control file2 inline btn btn-primary', 'value'=>$this->mdl_plats->form_value('price'), $readonly=>true)); ?>
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