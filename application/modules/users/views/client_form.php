<?php if (isset($modal_user_client)) { echo $modal_user_client; } //var_dump($readonly);die;?>
<form method="post" role="form" class="form-horizontal form-groups-bordered">
	<input style="display:none" type="text" name="fakeusernameremembered"/>
	<input style="display:none" type="password" name="password"/>
    <div class="headerbar">
        <h1><?php echo lang('client_form'); ?></h1>
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

        <div id="userInfo">

            <fieldset>
                <legend><?php echo lang('account_information'); ?></legend>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('name'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" <?php echo ($readonly)?'readonly':''; ?> id="name" value="<?php echo $this->mdl_clients->form_value('name'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('surname'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="surname" <?php echo ($readonly)?'readonly':''; ?> id="surname" value="<?php echo $this->mdl_clients->form_value('surname'); ?>">
                    </div>
					</div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('email_address'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" id="email" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_clients->form_value('email'); ?>">
                    </div>
                </div>

                
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('phone'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="phone" id="phone" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_clients->form_value('phone'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('address'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="address" id="address" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_clients->form_value('address'); ?>">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('cp'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="cp" id="cp" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_clients->form_value('cp'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('country'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="country" id="country" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_clients->form_value('country'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('city'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="city" id="city" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_clients->form_value('city'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('nationality'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nationality" id="nationality" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_clients->form_value('nationality'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('dni_passport'); ?>: </label>
                    <div class="col-sm-5">
                        <select name="dni_passport" id="dni_passport" class="form-control" <?php echo ($readonly)?'disabled':''; ?>>
							<?php
							$pass = array('id'=>lang('dni_id'), 'passport'=>lang('dni_passport'));
							foreach($pass as $key=>$value){
								echo '<option value="'.$key.'" '.(($key==$this->mdl_clients->form_value('name'))?"selected":"").'>'.$value.'</option>';
							}
							?>
						</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('doc_no'); ?>: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="doc_no" id="doc_no" <?php echo ($readonly)?'readonly':''; ?> value="<?php echo $this->mdl_clients->form_value('doc_no'); ?>">
                    </div>
                </div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo lang('password'); ?>: </label>
					<div class="col-sm-5">
						<?php echo form_input(array('name'=>'password', 'id'=>'password', (($readonly)?'readonly':'')=>'1', 'class'=>'form-control', 'type'=>'password', $readonly=>true, 'value'=>$this->mdl_clients->form_value('password'), 'style'=>'padding-right:30px;', 'autocomplete'=>"off")); ?>
						<span style="position: relative; cursor: pointer; float: right; top: -22px; left: -5px;" class="glyphicon glyphicon-eye-open showpassword"></span>
					</div>
				</div>
				
            </fieldset>
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