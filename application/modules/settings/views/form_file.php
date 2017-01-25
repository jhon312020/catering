<div class="content">
	<div class="form-group">
		<label class="col-sm-2">Site url: </label>
		<div class="col-sm-9">
			<input class="form-control" type="text" name="settings[site_url]" class="input-small" value="<?php echo $this->mdl_settings->setting('site_url'); ?>">
			end with "/"
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2">Upload Folder: </label>
		<div class="col-sm-9">
			<input class="form-control" type="text" name="settings[upload_folder]" class="input-small" value="<?php echo $this->mdl_settings->setting('upload_folder'); ?>">
			end with "/"
		</div>
	</div>
</div>
