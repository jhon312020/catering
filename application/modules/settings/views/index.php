<form method="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="headerbar">
		<div class="clearfix">
			<h1 class="pull-left"><?php echo lang('settings'); ?></h1>
		</div>
	</div>
	<div class="row">
	<?php echo $this->layout->load_view('layout/alerts'); ?>
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel minimal minimal-gray">
				<div class="panel-heading">
					<div class="panel-title"></div>
					<div class="panel-options">
						
						<ul class="nav nav-tabs">
							<li class="active"><a href="#profile-1" data-toggle="tab">General</a></li>
							<li><a href="#profile-4" data-toggle="tab">Social</a></li>
							<li><a href="#profile-2" data-toggle="tab">Footer</a></li>
							<li><a href="#profile-3" data-toggle="tab">File</a></li>
						</ul>
					</div>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane active" id="profile-1">
							<div class="form-content">
								<?php $this->layout->load_view('settings/form_general'); ?>
							</div>
						</div>
						<div class="tab-pane" id="profile-2">
							<div class="form-content">
								<?php $this->layout->load_view('settings/form_footer'); ?>
							</div>
						</div>
						<div class="tab-pane" id="profile-3">
							<div class="form-content">
								<?php $this->layout->load_view('settings/form_file'); ?>
							</div>
						</div>
						<div class="tab-pane" id="profile-4">
							<div class="form-content">
								<?php $this->layout->load_view('settings/form_social'); ?>
							</div>
						</div>
					</div>
					<div style="margin-top:60px !important;">
						<?php $this->layout->load_view('layout/header_buttons'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
