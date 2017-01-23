<div class="headerbar">
	<h1><?php echo lang('dashboard'); ?></h1>
</div>
<br/>
<?php echo $this->layout->load_view('layout/alerts'); ?>

<div class="row">
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark">
			<div class="num" data-start="0" data-end="<?php echo $shuttles;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/shuttles/index'); ?>"><h3><?php echo lang('shuttles'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-orange-dark">
			<div class="num" data-start="0" data-end="<?php echo $clients;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/clients/index'); ?>"><h3><?php echo lang('clients'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-pink-light">
			<div class="num" data-start="0" data-end="<?php echo $collaborators;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/collaborators/index'); ?>"><h3><?php echo lang('collaborators'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-aqua-light">
			<div class="num" data-start="0" data-end="<?php echo $calendars;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/routes/calendar'); ?>"><h3><?php echo lang('calendar'); ?></h3></a>
		</div>
	</div>
</div>
<div class="row">&nbsp;</div>
<div class="row">
	<div class="col-sm-3">	
		<div class="tile-stats tile-pink">
			<div class="num" data-start="0" data-end="<?php echo $faq;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/faq/index'); ?>"><h3><?php echo lang('faq'); ?></h3></a>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-green">
			<div class="num" data-start="0" data-end="<?php echo $routes;?>" data-postfix="" data-duration="1400" data-delay="0">0</div>
			<a href="<?php echo site_url('admin/routes/schedule'); ?>"><h3><?php echo lang('routes'); ?></h3></a>
		</div>
	</div>
</div>