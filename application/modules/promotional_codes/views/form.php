<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
?>
<div class="headerbar">
	<h1><?php echo lang('promotional_codes'); ?></h1>
</div>
<form method="post" class="form-horizontal" enctype="multipart/form-data" >
	<div class="row">
		<?php echo $this->layout->load_view('layout/alerts'); ?>
		<div class="col-md-12">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading"></div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('code');?>: </label>
						<div class="col-sm-5">
							<?php echo form_input(array('name'=>'code', 'class'=>'form-control', $readonly=>true, 'value'=>$this->mdl_promotional_codes->form_value('code'))); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('discount_type'); ?>: </label>
						<div class="col-sm-5">
							<?php 
								echo form_dropdown('discount_type', array(''=>'Select Discount Type', 'percentage'=>'Percentage', 'price'=>'Price', ), $this->mdl_promotional_codes->form_value('discount_type'), 'class="form-control" '.($readonly ? 'readonly' : ''));
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('price_or_percentage'); ?>: </label>
						<div class="col-sm-5">
							<?php echo form_input(array('name'=>'price_or_percentage', 'class'=>'form-control', $readonly=>true, 'value'=>$this->mdl_promotional_codes->form_value('price_or_percentage'))); ?>
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
