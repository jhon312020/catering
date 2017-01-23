<div class="content">

	<div class="form-group">
		<label class="col-sm-3 control-label">Site title: </label>
		<div class="col-sm-5">
			<input class="form-control" type="text" name="settings[site_title]" class="input-small" value="<?php echo $this->mdl_settings->setting('site_title'); ?>">
		</div>
	</div>
    
	<div class="form-group">
		<label class="col-sm-3 control-label">Email address: </label>
		<div class="col-sm-5">
			<input class="form-control" type="text" name="settings[site_email]" class="input-small" value="<?php echo $this->mdl_settings->setting('site_email'); ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Password: </label>
		<div class="col-sm-5">
			<input class="form-control" type="password" name="user_password" class="input-small" value="">
		</div>
	</div>
	<!--<div class="form-group">
		<label class="col-sm-3 control-label">Google Scripts: </label>
		<div class="col-sm-5">
			<textarea  class="form-control" name="settings[google_scripts]" ><?php echo $this->mdl_settings->setting('google_scripts'); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label">Front Page Id: </label>
		<div class="col-sm-5">
			<input class="form-control" type="text" name="settings[front_id]" class="input-small" value="<?php echo $this->mdl_settings->setting('front_id'); ?>">
		</div>
	</div>-->
	<div class="form-group">
		<label class="col-sm-3 control-label">Admin logo: </label>
		<div class="col-sm-5">
			<?php if($this->mdl_settings->setting('media_admin_logo') != ""){?>
			<img src="<?php echo $this->mdl_settings->setting('media_admin_logo'); ?>" width="100px" height="100px">
			<?php }?>
			<input class="form-control" type="hidden" name="settings[media_admin_logo]" class="input-small" value="<?php echo $this->mdl_settings->setting('media_admin_logo'); ?>">
			<input name="media_admin_logo" type="file" class="form-control file2 inline btn btn-primary" multiple="1" data-label="<i class='glyphicon glyphicon-circle-arrow-up'></i> &nbsp;Browse Files" />
			
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label">Default Language: </label>
		<div class="col-sm-5">
			<select name="settings[def_lang]" class="form-control">
				<option value="en" <?php echo ($this->mdl_settings->setting('def_lang') == "en"?'selected':""); ?>>English</option>
				<option value="es" <?php echo ($this->mdl_settings->setting('def_lang') == "es"?'selected':""); ?>>Spanish</option>
			</select>

		</div>
	</div>
	<!-- <div class="form-group">
		<label class="col-sm-3 control-label">Address: </label>
		<div class="col-sm-5">
			<textarea  class="form-control" name="settings[address]" ><?php //echo $this->mdl_settings->setting('address'); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Telephone No: </label>
		<div class="col-sm-5">
			<input class="form-control" type="text" name="settings[telephone]" class="input-small" value="<?php //echo $this->mdl_settings->setting('telephone'); ?>">
		</div>
	</div> -->
</div>
