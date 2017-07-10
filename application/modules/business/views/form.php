<?php
$readonly = ($readonly)?'readonly':'';
$disabled = ($readonly)?'disabled':'';
$count = count($centres);
//echo'<pre>'; print_r($centres); echo '</pre>';

$password = $this->mdl_business->form_value('password');
if($this->mdl_business->form_value('password') && !$this->input->post()) {
	$password = base64_decode($this->mdl_business->form_value('password_key'));
	$password = substr($password, 0, -9);
}
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left">
			<?php echo lang('business').'/ ID '; ?>
		</h1>
	</div>
</div>
<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="form_number" name="form_number" value="
		<?php echo $count; ?>" />
		<div class="row">
			<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er) {
		?>
			<div class="alert alert-danger">
				<?php echo $er; ?>
			</div>
			<?php	} ?>
		</div>
		<div class="row" id="business">
			<div class="col-md-12">
				<div class="form-content">
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('code_business');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'CodiEmpresa', 'type'=>'number', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('CodiEmpresa'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('name');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'name', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('name'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('email');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'email', 'type'=>'email', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('email'), $readonly=>true, 'required'=>'required')); ?>
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
						<label class="col-sm-2 pull-left">
							<?php echo lang('telephone');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'telephone', 'type'=>'number', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('telephone'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('contact_person');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>'contact_person', 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('contact_person'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							Tarjeta crédito o débito
						</label>
						<div class="col-sm-10">
							<?php
								if ($readonly != 'readonly') {
									
									if ($load_default_value) {
										echo form_checkbox(array( 'id'=>'card', 'name'=>'card', 'value'=>1, 'checked'=>true, $readonly=>1));
									} else {
										echo form_checkbox(array( 'id'=>'card', 'name'=>'card', 'value'=>1, 'checked'=>$this->mdl_business->form_value('card'),$readonly=>1));
									}

								} else {
									echo form_checkbox(array( 'id'=>'card', 'name'=>'card', 'value'=>1, 'checked'=>$this->mdl_business->form_value('card'),'disabled'=>true));
								}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							Giro Bancario
						</label>
						<div class="col-sm-10">
							<?php
								if ($readonly != 'readonly') {
									if ($load_default_value) {
										echo form_checkbox(array( 'id'=>'draft', 'name'=>'draft', 'value'=>1, 'checked'=>true,'readonly'=>$readonly));
									} else {
										echo form_checkbox(array( 'id'=>'draft', 'name'=>'draft', 'value'=>1, 'checked'=>$this->mdl_business->form_value('draft'),'readonly'=>$readonly));
									}
								} else {
									echo form_checkbox(array( 'id'=>'draft', 'name'=>'draft', 'value'=>1, 'checked'=>$this->mdl_business->form_value('draft'),'disabled'=>true));
								}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							Ticket Restaurante
						</label>
						<div class="col-sm-10">
							<?php
								if ($readonly != 'readonly') {
									if ($load_default_value) {
										echo form_checkbox(array( 'id'=>'ticket', 'name'=>'ticket', 'value'=>1, 'checked'=>true,'readonly'=>$readonly));
									} else {
										echo form_checkbox(array( 'id'=>'ticket', 'name'=>'ticket', 'value'=>1, 'checked'=>$this->mdl_business->form_value('ticket'),'readonly'=>$readonly));
									}
								} else {
									echo form_checkbox(array( 'id'=>'ticket', 'name'=>'ticket', 'value'=>1, 'checked'=>$this->mdl_business->form_value('ticket'),'disabled'=>true));
								}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							Efectivo
						</label>
						<div class="col-sm-10">
							<?php
								if ($readonly != 'readonly') {
									if ($load_default_value) {
										echo form_checkbox(array( 'id'=>'cash', 'name'=>'cash', 'value'=>1, 'checked'=>true,'readonly'=>$readonly));
									} else {
										echo form_checkbox(array( 'id'=>'cash', 'name'=>'cash', 'value'=>1, 'checked'=>$this->mdl_business->form_value('cash'),'readonly'=>$readonly));
									}
								} else {
									echo form_checkbox(array( 'id'=>'cash', 'name'=>'cash', 'value'=>1, 'checked'=>$this->mdl_business->form_value('cash'),'disabled'=>true));
								}
							?>
						</div>
					</div>
				</div>
				<!-- Center -- starts -->
				<div id="jscenterForm">
				<?php if ($centres) { $count = 0; foreach($centres as $centre) { $count++; ?>
				<div class="form-content martop">
					<h2>
						<?php echo lang('centre');  ?>
					</h2>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('name');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][Id]", 'type'=>'hidden','class'=>'form-control', 'value'=>$centre->Id)); ?>
							<?php echo form_input(array('name'=>"center[$count][Centre]", 'class'=>'form-control', 'value'=>$centre->Centre, $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('direction');?>
						</label>
						<div class="col-sm-10">
						<?php 
							if ($disabled != '') {
								echo form_textarea(array('name'=>"center[$count][Domicili]", 'class'=>"form-control", 'required'=>'required', 'disabled'=>$disabled),$centre->Domicili );
							} else {
								echo form_textarea(array('name'=>"center[$count][Domicili]", 'class'=>"form-control", 'required'=>'required'),$centre->Domicili );
							}
						?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('cp');?>
						</label>
						<div class="col-sm-2">
							<?php echo form_input(array('name'=>"center[$count][CPostal]", 'class'=>'form-control', 'value'=>$centre->CPostal, $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('population');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][Poblacio]", 'class'=>'form-control', 'value'=>$centre->Poblacio, $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('time_limit');?>
						</label>
						<div class="col-sm-2">
							<?php echo form_dropdown("center[$count][hours]", $hours, date('H', strtotime($centre->time_limit ? $centre->time_limit : '10:00:00')), 'class="form-control" '.$disabled.''); ?>
							<div class="text-center">
								<span>
									<?php echo lang('hour'); ?>
								</span>
							</div>
						</div>
						<div class="col-sm-2">
							<?php echo form_dropdown("center[$count][minutes]", $minutes, date('i', strtotime($centre->time_limit)), 'class="form-control" '.$disabled.''); ?>
							<div class="text-center">
								<span>
									<?php echo lang('minutes'); ?>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('route');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][Ruta]", 'class'=>'form-control', 'value'=>$centre->Ruta, $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('norm_route');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][NomRuta]", 'class'=>'form-control', 'value'=>$centre->NomRuta, $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
				</div>
				<?php } } else { $this->layout->load_view('business/center', array('count'=>$count, 'disabled'=>$disabled)); } ?>
				</div>
				<div class="martop jsButtonContainer">
					<div class="form-group new_menu_container">
						<h3 class="col-sm-6 pull-left">
							<a href="javascript:;" style="padding-left:18px;color:#91C848;" onclick="duplicateForm()">
								<u>[+] 
									<?php echo lang('add_center'); ?>
								</u>
							</a>
						</h3>
					</div>
					<div class="form-group submit_buttons">
						<div class="col-sm-12">
							<?php echo $this->layout->load_view('layout/header_buttons'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php $this->layout->load_view('business/clone_center');?>
<script type="text/javascript">
	form_html = $('#jsCloneCenterForm').html();
	function duplicateForm() {
		new_value = parseInt($('#form_number').val())+1;
		new_html = form_html.replace(/center\[1\]/g,'center['+new_value+']');
		$('.jsButtonContainer').before(new_html);
		$('#form_number').val(new_value);
	}
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
</script>