<style type="text/css">

</style>
<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
$menuDate = date('Y-m-d', strtotime($this->mdl_menus->form_value('menu_date')));
$datePickerDate = date('d/m/Y', strtotime($menuDate));
$checkDisabled = $this->mdl_menus->form_value('disabled')?true:false;
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('menu'); ?> 
			<span class="dateSpan"><?php echo $datePickerDate; ?> </span>
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
		<div class="col-md-12 martop menuList" id="menuType_<?php echo $menu_type->id; ?>">
			<div class="form-content">
				<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
					<div class="row">
						<div class="col-sm-12">
							<span class="hmargin"><?php echo lang('menu_cms').' '.lang(strtolower($menu_type->menu_name)); ?></span>
								<div class="checkbox rightCheck" style="float:right;">
									<label>
										<?php 
											$checkbox = array( 'name'        => 'disabled',
																				 'id'          => 'disabled', 
																				 'value'       => '1', 
																				 'checked'     => $checkDisabled,                                                    
																			);
											if($readonly) {
												$checkbox['disabled'] = 'disabled';
											}
											echo form_checkbox($checkbox);
										?>
										<?php echo lang('disabled'); ?>
									</label>
								</div>
						</div>
					</div>
				<div class="form-group">
					<input type="hidden" name="menu_type_id" value="<?php echo $menu_type->id; ?>">
					<input type="hidden" name="menu_date" value="<?php echo $menuDate; ?>">
					<div class="col-sm-2">
						<img src="<?php echo base_url(); ?>assets/cc/img/dish1.png" class="imgWidth" />
					</div>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'complement', 'class'=>'form-control', 'value'=>$this->mdl_menus->form_value('complement'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('primary_plate');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'primary_plate', 'class'=>'form-control', 'value'=>$this->mdl_menus->form_value('primary_plate'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('description_primary_plate');?>: </label>
					<div class="col-sm-10">
						<textarea name="description_primary_plate" <?php echo $disabled; ?> class="form-control"><?php echo $this->mdl_menus->form_value('description_primary_plate'); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('image');?>: </label>
					<div class="col-sm-10">
						<input name="primary_image" type="file" class="form-control file2 inline btn btn-primary" data-label="Browse Files" />
						<?php if($this->mdl_menus->form_value('primary_image')) { ?>
						<img src="<?php echo $path . $this->mdl_menus->form_value('primary_image'); ?>" width="150">
						<?php } ?>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('secondary_plate');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'secondary_plate', 'class'=>'form-control', 'value'=>$this->mdl_menus->form_value('secondary_plate'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('description_secondary_plate');?>: </label>
					<div class="col-sm-10">
						<textarea name="description_secondary_plate" <?php echo $disabled; ?> class="form-control"><?php echo $this->mdl_menus->form_value('description_secondary_plate'); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('image');?>: </label>
					<div class="col-sm-10">
						<input name="secondary_image" type="file" class="form-control file2 inline btn btn-primary" data-label="Browse Files" />
						<?php if($this->mdl_menus->form_value('secondary_image')) { ?>
						<img src="<?php echo $path . $this->mdl_menus->form_value('secondary_image'); ?>" width="150">
						<?php } ?>
					</div>
				</div>	
				<div class="form-group">
					<div class="col-sm-2">
						<img src="<?php echo base_url(); ?>assets/cc/img/dish2.png" class="imgWidth" />
					</div>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'postre', 'class'=>'form-control', 'value'=>$this->mdl_menus->form_value('postre'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('half_price');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'half_price', 'class'=>'form-control', 'value'=>$this->mdl_menus->form_value('half_price'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('full_price');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'full_price', 'class'=>'form-control', 'value'=>$this->mdl_menus->form_value('full_price'), $readonly=>true)); ?>
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
		autoclose:true,
		startDate:new Date(),
	}).on('show', function(e) {
			$('.datepicker-dropdown').css({top:$('.spancal').offset().top + $('.spancal').height(), left:$('.spancal').offset().left})
	}).on('changeDate', function(e) {
			var val = $(this).val();
			$('.dateSpan').text(val);
			var split = val.split('/');
			var date = split[2]+'-'+split[1]+'-'+split[0];
			$('input[name="menu_date"]').val(date);
	});
	$(document).on('click', '.spancal', function(){
		$('.datepicker12').datepicker('show');
	})
});
</script>