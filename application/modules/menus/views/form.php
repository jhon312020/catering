
<?php
$readonly = ($readonly)?'readonly':'';
//$menuDate = $this->mdl_menus->form_value('menu_date')?date('Y-m-d', strtotime($this->mdl_menus->form_value('menu_date'))):date('Y-m-d');
$datePickerDate = date('d/m/Y', strtotime($menuDate));
$checkDisabled = $this->mdl_menus->form_value('disabled')?true:false;
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('menu'); ?> 
			<span class="dateSpan"><?php echo $datePickerDate; ?> </span>
			<input type='hidden' class="form-control datepicker123" value="<?php echo $datePickerDate; ?>" />
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
		<?php $count = 1; ?>
		<input type="hidden" id="form_number" name="form_number" value="<?php echo $count; ?>" />
		<form method="post" class="form-horizontal" id="menu_form" enctype="multipart/form-data" autocomplete="off">
		<?php
		foreach($menu_types as $key=>$menu_type) {
		?>
		<div class="col-md-12 martop menuList " data-form="<?php echo $count; ?>">
			
			<div class="form-content">
				<div class="row">
					<div class="col-sm-12">
						<span class="hmargin"><?php echo lang('menu_cms').' '.lang(strtolower($menu_type)); ?></span>
							<div class="checkbox rightCheck" style="float:right;">
								<label>
								<?php echo form_checkbox(array('name'=>$menu_type.'['.$count.'][disabled]','value'=> 1, 'class'=>'checkbox_disabled')); ?>
								<?php echo lang('disabled'); ?>
								</label>
							</div>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="<?php echo $menu_type; ?>[<?php echo $count; ?>][menu_type_id]" value="<?php echo $key; ?>">
					<input type="hidden" name="<?php echo $menu_type; ?>[<?php echo $count; ?>][menu_date]" value="<?php echo $menuDate; ?>" class="menu_date">
					<div class="col-sm-2">
						<img src="<?php echo base_url(); ?>assets/cc/img/dish1.png" class="imgWidth" />
					</div>
					<div class="col-sm-10">
						<?php 
							echo form_dropdown(array('name'=>$menu_type .'['.$count.'][Guarnicio]',
												'options'=>$plates['plate3'],
												'class'=>'form-control'
												));
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('primary_plate');?> </label>
					<div class="col-sm-10">
						<?php 
							echo form_dropdown(array('name'=>$menu_type .'['.$count.'][Primer]',
												'options'=>$plates['plate1'],
												'class'=>'form-control'
												));
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('secondary_plate');?> </label>
					<div class="col-sm-10">
						<?php 
							echo form_dropdown(array('name'=>$menu_type .'['.$count.'][Segon]',
												'options'=>$plates['plate2'],
												'class'=>'form-control'
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
							echo form_dropdown(array('name'=>$menu_type .'['.$count.'][Postre]',
												'options'=>$plates['plate4'],
												'class'=>'form-control'
												));
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('half_price');?> </label>
					<div class="col-sm-10">
						<?php 
						echo form_input(array('name'=>$menu_type.'['.$count.'][half_price]', 'class'=>'form-control required_decimal', $readonly=>true)); 
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('full_price');?> </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>$menu_type.'['.$count.'][full_price]', 'class'=>'form-control required_decimal',  $readonly=>true)); ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
			<div class="form-group new_menu_container">
				<h3 class="col-sm-6 pull-left"><a href="javascript:;" style="padding-left:18px;color:#91C848;" onclick="duplicateForm()"><u>[+] <?php echo lang('add_new_menu'); ?></u></a></h3>
			</div>
			<div class="form-group submit_buttons" style="padding-top:20px;">
				<div class="col-sm-12">
				<?php echo $this->layout->load_view('layout/header_buttons'); ?>
				</div>
			</div>
		</form>
	</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker123').datepicker({
		format:'dd/mm/yyyy',
		autoclose:true,
		startDate:new Date(),
		daysOfWeekDisabled: [0,6],
		weekStart: 1,
		locale: 'es'
	}).on('show', function(e) {
			$('.datepicker-dropdown').css({top:$('.spancal').offset().top + $('.spancal').height(), left:$('.spancal').offset().left})
	}).on('changeDate', function(e) {
			var val = $(this).val();
			$('.dateSpan').text(val);
			var split = val.split('/');
			var date = split[2]+'-'+split[1]+'-'+split[0];
			$('.menu_date').val(date);
			/* var formData = {menu_date:date};
			$.ajax({
				url:'<?php //echo site_url('admin/menus/getMenus'); ?>',
				type:'post',
				data:formData,
				dataType:'json',
				success:function(data, textStatus, jqXHR) {
					$('.menuList').show();
					$.each(data, function(i,v){
						$('#menuType_'+v).hide();
					})
				},
				error:function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus+'----'+errorThrown);
				}
			}); */
	});
	$(document).on('click', '.spancal', function(){
		$('.datepicker123').datepicker('show');
	});

	form_html = $('#menu_form').html();

	$('#menu_form').submit(function(){
		var allFilled = true;
		$('.alert-danger').remove();
		$('input[type=text]').each(function() {
			if (!$(this).is(":disabled") && $(this).val() == '') {
				$(this).after('<div class="alert alert-danger top-10 bottom-10">Kindly fill the field</div>');
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

function duplicateForm(){
	new_value = parseInt($('#form_number').val())+1;
	new_html = form_html.replace(/Basic\[1\]/g,'Basic['+new_value+']');
	new_html = new_html.replace(/Diet\[1\]/g,'Diet['+new_value+']');
	$('.submit_buttons').before(new_html);
	$('.submit_buttons:last').remove();
	$('.new_menu_container:first').remove();
	$('#form_number').val(new_value);
}


function isDecimal (s) {
	var isDecimal_re = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
    return String(s).search (isDecimal_re) != -1
}
</script>