<style type="text/css">

</style>
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
					<label class="col-sm-2 pull-left"><?php echo lang('client_code');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'client_code', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('client_code'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('name');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'name', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('name'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('surname');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'surname', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('surname'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('client_business_name');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'client_business_name', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('client_business_name'), $readonly=>true)); ?>
					</div>	
				</div>	
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('business');?>: </label>
					<div class="col-sm-10">
						<?php echo form_dropdown('business_id', $business_list, $this->mdl_clients->form_value('business_id'), 'class="form-control" '.$disabled.''); ?>
					</div>	
				</div>	
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('email');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'email', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('email'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('password');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'password', 'type' => 'password', 'class'=>'form-control', 'value'=>$password, $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('telephone');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'telephone', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('telephone'), $readonly=>true)); ?>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('dni');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'dni', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('dni'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('intolerances');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'intolerances', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('intolerances'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('iban');?>: </label>
					<div class="col-sm-10">
						<?php echo form_input(array('name'=>'iban', 'class'=>'form-control', 'value'=>$this->mdl_clients->form_value('iban'), $readonly=>true)); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('bill');?>: </label>
					<div class="col-sm-10">
						<label class="radio-inline"><?php echo form_radio('bill', 1, $this->mdl_clients->form_value('bill') == 1?true:false).' '.lang('yes'); ?></label>
						<label class="radio-inline"><?php echo form_radio('bill', 0, $this->mdl_clients->form_value('bill') == 0?true:false).' '.lang('no'); ?></label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 pull-left"><?php echo lang('billing_data');?>: </label>
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
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change', '[name="bill"]', function(){
		if($(this).val() == 1) {
			$('#billing_data').prop('disabled', false);
		} else {
			$('#billing_data').prop('disabled', true);
			$('#billing_data').val('');
		}
	})
})
</script>