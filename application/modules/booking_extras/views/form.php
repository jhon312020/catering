<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
?>
<div class="headerbar">
	<h1><?php echo lang('booking_extras_info'); ?></h1>
</div>
<form method="post" class="form-horizontal" enctype="multipart/form-data" >
	<div class="row">
		<?php echo $this->layout->load_view('layout/alerts'); ?>
		<div class="col-md-12">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading"></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('title') . ' (EN)';?>: </label>
						<div class="col-sm-5">
							<?php echo form_input(array('name'=>'title', 'class'=>'form-control', $readonly=>true, 'value'=>$this->mdl_booking_extras->form_value('title'))); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('subtitle') . ' (EN)'; ?>: </label>
						<div class="col-sm-5">
							<?php echo form_input(array('name'=>'subtitle', 'class'=>'form-control', $readonly=>true, 'value'=>$this->mdl_booking_extras->form_value('subtitle'))); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('description') . ' (EN)'; ?>: </label>
						<div class="col-sm-5">
							<?php echo $this->ckeditor->editor("description_en", $this->mdl_booking_extras->form_value('description_en'));?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('title') . ' (ES)';?>: </label>
						<div class="col-sm-5">
							<?php echo form_input(array('name'=>'title_es', 'class'=>'form-control', $readonly=>true, 'value'=>$this->mdl_booking_extras->form_value('title_es'))); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('subtitle') . ' (ES)'; ?>: </label>
						<div class="col-sm-5">
							<?php echo form_input(array('name'=>'subtitle_es', 'class'=>'form-control', $readonly=>true, 'value'=>$this->mdl_booking_extras->form_value('subtitle_es'))); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('description')  . ' (ES)'; ?>: </label>
						<div class="col-sm-5">
							<?php echo $this->ckeditor->editor("description_es", $this->mdl_booking_extras->form_value('description_es'));?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('price'); ?>: </label>
						<div class="col-sm-5">
							<?php echo form_input(array('name'=>'price', 'class'=>'form-control', 'value'=>$this->mdl_booking_extras->form_value('price'), $readonly=>true)); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('type'); ?>: </label>
						<div class="col-sm-5">
							<?php echo form_dropdown('type', array('0'=>'--Select--', '1'=>'Quantity'), $this->mdl_booking_extras->form_value('type'), 'class="form-control" '.$disabled.''); ?>
						</div>
					</div>
					<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('image'); ?>: </label>
					<div class="col-sm-5">
						<input name="image" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />
						<?php if($this->mdl_booking_extras->form_value('image')){?>
						<img src="<?php echo $path . $this->mdl_booking_extras->form_value('image'); ?>">
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
				if(!$readonly){
					echo $this->layout->load_view('layout/header_buttons');
				}
				else{
			?>
			<div class="pull-right">
				<button class="btn btn-primary" name="btn_cancel" value="1"><i class="icon-ok icon-white"></i> <?php echo lang('cancel'); ?></button>
			</div>
			<?php
				}
			?>	
		</div>
		<div class="col-md-6"></div>
	</div>
</form>
