<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';

$password = $this->mdl_clients->form_value('password');
if($this->mdl_clients->form_value('password') && !$this->input->post()) {
	$password = base64_decode($this->mdl_clients->form_value('password_key'));
	$password = substr($password, 0, -9);
}
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('client'); ?></h1>
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
		<div class="col-md-12">
			<div class="form-content">
			<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('client_code');?> </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'client_code', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('client_code')? $this->mdl_clients->form_value('client_code') : (isset($client_code) ? $client_code : ''))); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('name');?></label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'name', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('name'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('surname');?></label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'surname', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('surname'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('client_business_name');?></label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'client_business_name', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('client_business_name'), $readonly=>true)); ?>
					</div>	
				</div>	
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('business_title');?></label>
					<div class="col-sm-10">
						<?php echo form_dropdown('business_id', $business_list, $this->mdl_clients->form_value('business_id'), 'required = "required" id="jsBusiness" class="form-control" '.$disabled.''); ?>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('center_title');?></label>
					<div class="col-sm-10">
						<select name='centre_id' id='centre_id' class="form-control" required="required">
							<option value=''>Select</option>
						<?php 
							//echo form_dropdown('business_id', $business_list, $this->mdl_clients->form_value('business_id'), 'class="form-control" '.$disabled.''); 
							foreach($centre_list as $key=>$centre) {
								if ( $this->mdl_clients->form_value('centre_id') == $centre->Id)
									echo '<option selected="selected" class="centres business_'.$centre->bussiness_id.'" value="'.$centre->Id.'">'.$centre->Centre.'</option>';
								else
									echo '<option class="centres business_'.$centre->bussiness_id.'" value="'.$centre->Id.'">'.$centre->Centre.'</option>';
							}
						?>
					</select>
					</div>	
				</div>	
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('email');?></label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'email', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('email'), $readonly=>true, 'autocomplete'=>false)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('password');?></label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'password', 'type' => 'password', 'class'=>'form-control', 'value'=>$password, $readonly=>true, 'autocomplete'=>false )); ?>
						<span style="position: relative; cursor: pointer; float: right; top: -22px; left: -5px;" class="glyphicon showpassword glyphicon-eye-open"></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('telephone');?></label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'telephone', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('telephone'), $readonly=>true)); ?>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('dni');?> </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'dni', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('dni'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('intolerances');?> </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'intolerances', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('intolerances'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('tarifa');?> </label>
					<div class="col-sm-10">
						<?php 
							echo form_dropdown('Tarifa_id', $tarifa_list, $this->mdl_clients->form_value('Tarifa_id'), 'class="form-control" '.$disabled.''); 
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('iban');?> </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'iban', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('iban'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('bill');?> </label>
					<div class="col-sm-10">
						<label class="radio-inline"><?php echo form_radio('bill', 1, $this->mdl_clients->form_value('bill') == 1?true:false).' '.lang('yes'); ?></label>
						<label class="radio-inline"><?php echo form_radio('bill', 0, $this->mdl_clients->form_value('bill') == 0?true:false).' '.lang('no'); ?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('billing_data');?> </label>
					<div class="col-sm-10">
						<textarea <?php echo $readonly || $this->mdl_clients->form_value('bill') == 0?'disabled':''; ?> name="billing_data" id="billing_data" class="form-control"><?php echo $this->mdl_clients->form_value('bill') == 1?$this->mdl_clients->form_value('billing_data'):'';  ?></textarea>
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
	</div>
	<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('orders'); ?></h1>
		<?php /* <a class="btn btn-primary pull-right" href="<?php echo site_url('admin/orders/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a> */ ?>
	</div>
</div>
	<div class="row" style="margin-top:30px;">
		<div class="col-sm-12">
			<table class="table table-bordered datatable data_table">
				<thead>
					<tr>
						<th><?php echo lang('client_code'); ?></th>
						<th><?php echo lang('date'); ?></th>
						<th><?php echo lang('name'); ?></th>
						<th><?php echo lang('business_title'); ?></th>
						<th><?php echo lang('menu_cms'); ?></th>
						<th><?php echo lang('edit'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($orders_by_client_id as $order) { ?>
						<tr>
							<td class=""><?php echo $order->client_code; ?></td>
							<td class=""><?php echo date('d/m/Y', strtotime($order->order_date)); ?></td>
							<td class=""><?php echo $order->name; ?></td>
							<td class=""><?php echo $order->business; ?></td>
							<td class=""><?php  echo str_replace(',','',$order->order_code); ?></td>
							<td class="">
								<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/orders/view/' . $order->id); ?>">
									<i class="entypo-eye"></i>
								</a>
								<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/orders/form/' . $order->id); ?>">
									<i class="entypo-pencil"></i>
								</a>
								<a class="btn btn-warning btn-sm <?php echo $order->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/orders/toggle/' . $order->id . '/' . $order->is_active); ?>">
									<i class="entypo-check" title="<?php echo $order->is_active ? 'Active' : 'In Active'; ?>"></i>
								</a>
								<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/orders/delete/' . $order->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
									<i class="entypo-trash"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change', '[name="bill"]', function(){
		if($(this).val() == 1) {
			$('#billing_data').prop('disabled', false);
		} else {
			$('#billing_data').prop('disabled', true);
			$('#billing_data').val('');
		}
	});
	var conditionalSelect = $("#centre_id"),
	// Save possible options
	options = conditionalSelect.children(".centres").clone();
	$("#jsBusiness").change(function(){
			var value = $(this).val();
			// Remove all "submarket" options               
			conditionalSelect.children(".centres").remove();
			// Attach options that needs to be displayed for the selected value.
			options.clone().filter(".business_"+value).appendTo(conditionalSelect);
	}).trigger("change");
	$('.showpassword').click(function(){
		if ($(this).hasClass('glyphicon-eye-open')){
			$(this).parent().find('input').attr('type','text');
			$(this).removeClass('glyphicon-eye-open');
			$(this).addClass('glyphicon-eye-close');
		} else {
			$(this).parent().find('input').attr('type','password');
			$(this).removeClass('glyphicon-eye-close');
			$(this).addClass('glyphicon-eye-open');
		}
	});
})
</script>