<?php
	$segments = $this->uri->segment_array();
	$end_segment = end($segments);
	$websiteClass = array('home','contacts');
	$settingClass = array('business','menus', 'legal_conditions', 'drinks', 'settings');
	$url_segment = $this->uri->segment_array();
?>
<ul id="main-menu" class="">
	<li class="<?php echo $this->router->class == 'dashboard' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/dashboard'); ?>">
			<i class="entypo-gauge"></i>
			<span><?php echo lang('dashboard'); ?></span>
		</a>
	</li>
	<li class="<?php echo in_array($this->router->class, $websiteClass) ? 'opened active' : ''; ?>">
		<a href="#"><i class="entypo-newspaper"></i><span><?php echo lang('website'); ?></span></a>
		<ul>
			<li class="<?php echo ($this->router->class == 'home') ? 'opened active' : ''; ?>">
				<a href="javascript:;<?php //echo site_url('admin/home'); ?>">
					<i class="entypo-list"></i>
					<span><?php echo lang('home'); ?></span>
				</a>
			</li>
			<li class="<?php echo ($this->router->class == 'contacts') ? 'opened active' : ''; ?>">
				<a href="javascript:;<?php //echo site_url('admin/contacts'); ?>">
					<i class="entypo-list"></i>
					<span><?php echo lang('contacts'); ?></span>
				</a>
			</li>
		</ul>
	</li>	
	<li class="<?php echo $this->router->class == 'clients' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/clients/index'); ?>">
			<i class="entypo-ticket"></i>
			<span><?php echo lang('clients'); ?></span>
		</a>
	</li>
	<li class="<?php echo $this->router->class == 'orders' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/orders/index'); ?>">
			<i class="entypo-ticket"></i>
			<span><?php echo lang('menu_reservations'); ?></span>
		</a>
	</li>
	<li class="<?php echo in_array($this->router->class, $settingClass) ? 'opened active' : ''; ?>">
		<a href="#"><i class="entypo-newspaper"></i><span><?php echo lang('settings'); ?></span></a>
		<ul>
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
			<li class="<?php echo $this->router->class == 'conditions' ? 'opened active' : ''; ?>">
				<a href="<?php echo site_url('admin/conditions/form'); ?>">
					<i class="entypo-ticket"></i>
					<span><?php echo lang('legal_condition'); ?></span>
				</a>
			</li>
			<li class="<?php echo $this->router->class == 'drinks' ? 'opened active' : ''; ?>">
				<a href="<?php echo site_url('admin/drinks/index'); ?>">
					<i class="entypo-ticket"></i>
					<span><?php echo lang('cool_drinks'); ?></span>
				</a>
			</li>
			<li class="<?php echo $this->router->class == 'settings' && $this->router->method == 'index' ? 'opened active' : ''; ?>">
				<a href="<?php echo site_url('admin/settings/index'); ?>">
					<i class="entypo-list"></i>
					<span><?php echo lang('settings'); ?></span>
				</a>
			</li>
		</ul>
	</li>	
	<li class="<?php echo $this->router->class == 'statistics' ? 'opened active' : ''; ?>">
		<a href="<?php echo site_url('admin/statistics/index'); ?>">
			<i class="entypo-ticket"></i>
			<span><?php echo lang('statistics'); ?></span>
		</a>
	</li>
</ul>