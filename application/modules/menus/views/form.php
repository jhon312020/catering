<style type="text/css">

</style>
<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('menu'); ?> <span class="dateSpan"><?php echo (($readonly)?Date('d/m/Y', strtotime($this->mdl_menus->form_value('menu_date'))):Date('d/m/Y')); ?> </span>
			<input type='hidden' class="form-control datepicker12" />
			<span class="spancal glyphicon glyphicon-calendar"></span>
		</h1>
	</div>
</div>
	<div class="row">
		<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er) {
		?>	
		<div class="alert alert-danger"><?php echo $er; ?></div>
		<?php	} ?>
	</div>	
	<div class="row" id="business">
		<?php
		foreach($menu_types as $menu_type) {
		?>
		<div class="col-md-12 martop">
			<div class="form-content">
				<div class="row">
					<div class="col-sm-12">
						<span class="hmargin"><?php echo lang('menu').' '.$menu_type->menu_name; ?></span>
							<div class="checkbox rightCheck" style="float:right;">
								<label><input type="checkbox" name="disabled" value="1"><?php echo lang('disabled'); ?></label>
							</div>
					</div>
				</div>
			<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
				<div class="form-group">
					<input type="hidden" name="menu_type_id" value="<?php echo $menu_type->id; ?>">
					<input type="hidden" name="menu_date" value="<?php echo Date('Y-m-d'); ?>">
					<div class="col-sm-2">
						<img src="<?php echo base_url(); ?>assets/cc/img/dish1.png" class="imgWidth" />
					</div>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'complement', 'class'=>'form-control', 'value'=>isset($result[$menu_type->id])?$result[$menu_type->id]['complement']:'', $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('primary_plate');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'primary_plate', 'class'=>'form-control', 'value'=>isset($result[$menu_type->id])?$result[$menu_type->id]['primary_plate']:'', $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('description_primary_plate');?>: </label>
					<div class="col-sm-10">
						<textarea <?php echo $readonly?'disabled':''; ?> name="description_primary_plate" class="form-control"><?php echo isset($result[$menu_type->id])?$result[$menu_type->id]['primary_plate']:''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('image');?>: </label>
					<div class="col-sm-10">
						<input name="primary_image" type="file" class="form-control file2 inline btn btn-primary" data-label="Browse Files" />
						<div class="row" style="margin-top:10px;">
							<div class="col-sm-12">
								<?php 
								if($this->mdl_menus->form_value('id')) {
									$files = glob($path.'primary_image/'.$this->mdl_menus->form_value('id').'/*.*');
									foreach($files as $file) {
										echo "<img class='img_size' src='".base_url()."assets/cc/images/menus/primary_image/".$this->mdl_menus->form_value('id')."/".basename($file)."'>";
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('secondary_plate');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'secondary_plate', 'class'=>'form-control', 'value'=>isset($result[$menu_type->id])?$result[$menu_type->id]['primary_plate']:'', $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('description_secondary_plate');?>: </label>
					<div class="col-sm-10">
						<textarea <?php echo $readonly?'disabled':''; ?> name="description_secondary_plate" class="form-control"><?php echo isset($result[$menu_type->id])?$result[$menu_type->id]['primary_plate']:''; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('image');?>: </label>
					<div class="col-sm-10">
						<input name="secondary_image" type="file" class="form-control file2 inline btn btn-primary" data-label="Browse Files" />
						<div class="row" style="margin-top:10px;">
							<div class="col-sm-12">
								<?php 
								if($this->mdl_menus->form_value('id')) {
									$files = glob($path.'secondary_image/'.$this->mdl_menus->form_value('id').'/*.*');
									foreach($files as $file) {
										echo "<img class='img_size' src='".base_url()."assets/cc/images/menus/secondary_image/".$this->mdl_menus->form_value('id')."/".basename($file)."'>";
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<div class="col-sm-2">
						<img src="<?php echo base_url(); ?>assets/cc/img/dish2.png" class="imgWidth" />
					</div>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'postre', 'class'=>'form-control', 'value'=>isset($result[$menu_type->id])?$result[$menu_type->id]['primary_plate']:'', $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
					<?php echo $this->layout->load_view('layout/header_buttons'); ?>
					</div>
				</div>
			</form>
			</div>
		</div>
		<?php } ?>
	</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker12').datepicker({
		format:'dd/mm/yyyy',
		autoclose:true
	}).on('show', function(e) {
			$('.datepicker-dropdown').css({top:$('.spancal').offset().top + $('.spancal').height(), left:$('.spancal').offset().left})
	}).on('changeDate', function(e) {
			var val = $(this).val();
			$('.dateSpan').text(val);
			var split = val.split('/');
			var date = split[0]+'-'+split[1]+'-'+split[2];
			$('input[name="menu_date"]').val(date)
	});
	$(document).on('click', '.spancal', function(){
		$('.datepicker12').datepicker('show');
	})
});
</script>