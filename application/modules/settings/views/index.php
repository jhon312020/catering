<form method="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="headerbar">
		<div class="clearfix">
			<h1 class="pull-left"><?php echo lang('settings'); ?></h1>
			<?php $this->layout->load_view('layout/header_buttons'); ?>
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
							<li><a href="#profile-5" data-toggle="tab">Editor details</a></li>
						</ul>
					</div>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane active" id="profile-1">
							<?php $this->layout->load_view('settings/form_general'); ?>
						</div>
						<div class="tab-pane" id="profile-2">
							<?php $this->layout->load_view('settings/form_footer'); ?>
						</div>
						<div class="tab-pane" id="profile-3">
							<?php $this->layout->load_view('settings/form_file'); ?>
						</div>
						<div class="tab-pane" id="profile-4">
							<?php $this->layout->load_view('settings/form_social'); ?>
						</div>
						<div class="tab-pane" id="profile-5">
							<?php $this->layout->load_view('settings/form_password'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
