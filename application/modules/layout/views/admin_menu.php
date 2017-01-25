<?php
	$segments = $this->uri->segment_array();
	$end_segment = end($segments);
	$url_segment = $this->uri->segment_array();
?>
<ul id="main-menu" class="">
	<li class="<?php echo $this->router->class == 'dashboard' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/dashboard'); ?>">
			<i class="entypo-gauge"></i>
			<span><?php echo lang('dashboard'); ?></span>
		</a>
	</li>
	<li class="<?php echo $this->router->class == 'business' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/business/index'); ?>">
			<i class="entypo-ticket"></i>
			<span><?php echo lang('business'); ?></span>
		</a>
	</li>
	<li class="<?php echo $this->router->class == 'menus' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/menus/index'); ?>">
			<i class="entypo-ticket"></i>
			<span><?php echo lang('menus'); ?></span>
		</a>
	</li>
	<li class="<?php echo $this->router->class == 'clients' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/clients/index'); ?>">
			<i class="entypo-ticket"></i>
			<span><?php echo lang('clients'); ?></span>
		</a>
	</li>
	<li class="<?php echo $this->router->class == 'conditions' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/conditions/form'); ?>">
			<i class="entypo-ticket"></i>
			<span><?php echo lang('legal_condition'); ?></span>
		</a>
	</li>
	<li class="<?php echo $this->router->class == 'settings' && $this->router->method == 'index' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/settings/index'); ?>">
			<i class="entypo-list"></i>
			<span><?php echo lang('settings'); ?></span>
		</a>
	</li>
</ul>