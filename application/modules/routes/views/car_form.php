
<form method="post" role="form" class="form-horizontal form-groups-bordered">
	<input style="display:none" type="text" name="fakeusernameremembered"/>
	<input style="display:none" type="password" name="password"/>
    <div class="headerbar">
        <h1><?php echo lang('car'); ?></h1>
    </div>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->layout->load_view('layout/header_buttons'); ?>
		</div>
	</div>
    <div class="content">
	<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er){
		?>	
		<div class="alert alert-danger"><?php echo $er; ?></div>
		<?php	
		}
	?>

    	<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo lang('car_name'); ?>: </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="car_name" id="car_name" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_cars->form_value('car_name'); ?>">
            </div>
        </div>		
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo lang('email_address'); ?>: </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="email" id="email" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_cars->form_value('email'); ?>">
            </div>
        </div>					
		<div class="form-group">
			<label class="col-sm-3 control-label"><?php echo lang('password'); ?>: </label>
			<div class="col-sm-5">
				<?php echo form_input(array('name'=>'password', 'id'=>'password', (($readonly)?'readonly':'')=>'1', 'class'=>'form-control', 'type'=>'password', $readonly=>true, 'value'=>$this->mdl_cars->form_value('password'), 'style'=>'padding-right:30px;', 'autocomplete'=>"off")); ?>
				<span style="position: relative; cursor: pointer; float: right; top: -22px; left: -5px;" class="glyphicon glyphicon-eye-open showpassword"></span>
			</div>
		</div>
	</div>
</form>
<script>
$('.showpassword').click(function(){
	if($(this).hasClass('glyphicon-eye-open')){
		$(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
		$('#password').attr('type', 'text');
	}
	else{
		$(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
		$('#password').attr('type', 'password');
	}
});
</script>