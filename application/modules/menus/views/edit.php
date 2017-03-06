<?php
//echo '<pre>'; print_r($menu_types); echo '</pre>';
//echo '<pre>'; print_r($menus); echo '</pre>';
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
$menuDate = date('Y-m-d', $strtotime);
$datePickerDate = date('d/m/Y', strtotime($menuDate));
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
		<form method="post" id="menu_edit_form" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
		<?php
		foreach($menus as $menu) {
			$menu_id = $menu['id'];
		?>
		<div class="col-md-12 martop menuList">
			<div class="form-content">
					<div class="row">
						<div class="col-sm-12">
							<span class="hmargin"><?php echo lang(strtolower($menu_types[$menu['Regim']])); ?></span>
								<div class="checkbox rightCheck" style="float:right;">
									<label>
										<?php 
											$checkbox = array( 'name'=> 'data['.$menu_id.'][disabled]',
																 'value' => '1', 
																 'checked' => $menu['disabled'],
																 'class'=>'checkbox_disabled'
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
					<input type="hidden" name="data[<?php echo $menu_id; ?>][id]" value="<?php echo $menu['id']; ?>">
					<input type="hidden" name="data[<?php echo $menu_id; ?>][Regim]" value="<?php echo $menu['menu_type_id']; ?>">
					<input type="hidden" name="data[<?php echo $menu_id; ?>][menu_date]" value="<?php echo $menuDate; ?>">
					<div class="col-sm-2">
						<img src="<?php echo base_url(); ?>assets/cc/img/dish1.png" class="imgWidth" />
					</div>
					<div class="col-sm-10">
						<?php 
							echo form_dropdown(array('name'=>'data['.$menu_id.'][Guarnicio]',
													'options'=>$plates['plate3'],
													'class'=>'form-control',
													'selected'=>$menu['Guarnicio']
												));
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('primary_plate');?>: </label>
					<div class="col-sm-10">
						<?php 
							echo form_dropdown(array('name'=>'data['.$menu_id.'][Primer]',
													'options'=>$plates['plate1'],
													'class'=>'form-control',
													'selected'=>$menu['Primer']
												));
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('secondary_plate');?>: </label>
					<div class="col-sm-10">
						<?php 
							echo form_dropdown(array('name'=>'data['.$menu_id.'][Segon]',
													'options'=>$plates['plate2'],
													'class'=>'form-control',
													'selected'=>$menu['Segon']
												));
						?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
						<img src="<?php echo base_url(); ?>assets/cc/img/dish2.png" class="imgWidth" />
					</div>
					<div class="col-sm-10">
						<?php 
							echo form_dropdown(array('name'=>'data['.$menu_id.'][Postre]',
													'options'=>$plates['plate4'],
													'class'=>'form-control',
													'selected'=>$menu['Postre']
												));
						?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
			<div class="form-group top-10">
				<div class="col-sm-12">
				<?php echo $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
		</form>
	</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#menu_edit_form').submit(function(){
		var allFilled = true;
		$('.alert-danger').remove();
		$('input[type=text]').each(function() {
			if (!$(this).is(":disabled") && $(this).val() == '') {
				$(this).after('<div class="alert alert-danger top-10 bottom-10 ">Kindly fill the field</div>');
				allFilled = false;
			} else if (!$(this).is(":disabled") && $(this).hasClass('required_decimal')) {
				if (!isDecimal($(this).val())) {
					$(this).after('<div class="alert alert-danger top-10 bottom-10">Kindly fill with decimal or integer value</div>');
					allFilled = false;
				}
			}
		});
		if (allFilled == false) {
			return false;
		}
	});

	$(document).on('click', '.checkbox_disabled', function(){
		if ($(this).is(":checked")) {
			$(this).parents('.form-content').find('select').attr('disabled',true);
			$(this).parents('.form-content').find('input[type=text]').attr('disabled',true);
		} else {
			$(this).parents('.form-content').find('select').attr('disabled',false);
			$(this).parents('.form-content').find('input[type=text]').attr('disabled',false);
		}
	});

});

function isDecimal (s) {
	var isDecimal_re = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
    return String(s).search (isDecimal_re) != -1
}
</script>