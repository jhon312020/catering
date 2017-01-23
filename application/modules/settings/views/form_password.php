<div class="content">
	<div class="form-group">
		<label class="col-sm-3 control-label">Editor email: </label>
		<div class="col-sm-5">
			<input class="form-control" type="text" name="editor_email" class="input-small" value="<?php echo $editor->email; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Editor password: </label>
		<div class="col-sm-5">
			<input class="form-control" type="password" name="editor_password" class="input-small" value="<?php echo str_replace('_pickngo', '', base64_decode($editor->secret_key)); ?>">
		</div>
	</div>
</div>
