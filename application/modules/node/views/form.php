<form method="post" class="form-horizontal">

    <div class="headerbar">
        <h1>Node</h1>
        
    </div>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->layout->load_view('layout/header_buttons'); ?>
		</div>
	</div>
    <div class="content">

        <?php echo $this->layout->load_view('layout/alerts'); ?>

        <div id="userInfo">

			<div class="panel minimal minimal-gray">
				<div class="panel-heading">
				<div class="panel-title"></div>
				<div class="panel-options">
					
					<ul class="nav nav-tabs">
						<li class="active"><a href="#profile-1" data-toggle="tab">Information</a></li>
						<li><a href="#profile-2" data-toggle="tab">Seo</a></li>
						<li><a href="#profile-3" data-toggle="tab">Existing Media</a></li>
					</ul>
				</div>
			</div>
			
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active" id="profile-1">


						<div class="form-group">
							<label class="col-sm-3 control-label">Title: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="title" id="title" value="<?php echo $this->mdl_nodes->form_value('title'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Show Title: </label>
							<div class="col-sm-5">
								<input type="checkbox" name="show_title" id="show_title" value='1' <?php echo ($this->mdl_nodes->form_value('show_title') == 1?'checked':''); ?>>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">body: </label>
							<div class="col-sm-5">
								
								<?php echo $this->ckeditor->editor("body",$this->mdl_nodes->form_value('body'));?>
							</div>
						</div>
						
						 <div class="form-group">
							<label class="col-sm-3 control-label">Url: </label>
							<div class="col-sm-5">
								<input class="form-control" type="text" name="url" id="url" value="<?php echo $this->mdl_nodes->form_value('url'); ?>">
							</div>
						</div>
						
						 <div class="form-group">
							<label class="col-sm-3 control-label">Template: </label>
							<div class="col-sm-5">
								
								<SELECT class="form-control" NAME="template">
									<option value="">Default</option>
									<?php 
									foreach($templates as $template):?>
									<option <?php if($template ==  $this->mdl_nodes->form_value('template')){echo "selected";}?> value="<?php print $template;?>"><?php print $template;?></option>
									<?php endforeach;?>
								</SELECT>
								
							</div>
						</div>
						
						
					</div>
					
					<div class="tab-pane" id="profile-2">
						<div class="form-group">
							<label for="field-1" class="col-sm-3 control-label">Key Words</label>
							
							<div class="col-sm-5">
								<input type="text" class="form-control" id="seo_keywords" name="seo_keywords" placeholder="keys" value="<?php echo $this->mdl_nodes->form_value('seo_keywords'); ?>">
							</div>
							
						</div>
						
						<div class="form-group">
							<label for="field-ta" class="col-sm-3 control-label">Meta Tags</label>
							
							<div class="col-sm-5">
								<textarea class="form-control" id="seo_meta_tags" name="seo_meta_tags" placeholder="Meta"><?php echo $this->mdl_nodes->form_value('seo_meta_tags'); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="field-ta" class="col-sm-3 control-label">Meta Description</label>
							
							<div class="col-sm-5">
								<textarea class="form-control" id="seo_meta_desc" name="seo_meta_desc" placeholder="Meta Desc"><?php echo $this->mdl_nodes->form_value('seo_meta_desc'); ?></textarea>
							</div>
						</div>
					</div>
					
					<div class="tab-pane" id="profile-3">
						<?php $this->layout->load_view('node/media_files'); ?>
					</div>
				
				</div>
			</div>
        </div>
    </div>
</form>
