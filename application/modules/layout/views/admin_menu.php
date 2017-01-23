		<?php
			$websiteClass = array('homepage','partners','aboutus','franchises','concierge','faq','contacts', 'captions', 'booking_extras', 'promotional_codes', 'terms_and_conditions');
			$end_segment = end($this->uri->segment_array());
			$url_segment = $this->uri->segment_array();
			if (! isset($url_segment[4])) {
				$url_segment[4] = '';
			}
			if($this->session->userdata('user_type') == '1') {
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
					<li class="<?php echo $this->router->class == 'homepage' ? 'opened active' : ''; ?>">
						<a href="#"><i class="entypo-list"></i><span><?php echo lang('home'); ?></span></a>
						<ul>
							<li class="<?php echo ($this->router->method == 'slider' or  $url_segment[4] == 'slider') ? 'opened active' : ''; ?>">
								<a href="<?php echo site_url('admin/homepage/slider'); ?>">
									<i class="entypo-pencil"></i>
									<span><?php echo lang('slider_texts'); ?></span>
								</a>
							</li>
							<li class="<?php echo ($this->router->method == 'banner' or $url_segment[4]== 'banner') ? 'opened active' : ''; ?>">
								<a href="<?php echo site_url('admin/homepage/banner'); ?>">
									<i class="entypo-pencil"></i>
									<span><?php echo lang('banner'); ?></span>
								</a>
							</li>
							<li class="<?php echo ($this->router->method == 'box' or  $url_segment[4]== 'box') ? 'opened active' : ''; ?>">
								<a href="<?php echo site_url('admin/homepage/box'); ?>">
									<i class="entypo-pencil"></i>
									<span><?php echo lang('news'); ?></span>
								</a>
							</li>
						</ul>
					</li>
					<li class="<?php echo ($this->router->class == 'aboutus' or $end_segment == 'aboutus') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/captions/form/5/aboutus'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('about'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->class == 'partners' or $end_segment == 'partners') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/partners/index'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('partners'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->class == 'franchises' or $end_segment == 'franchises') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/captions/form/1/franchises'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('franchises_cms'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->class == 'concierge' or $end_segment == 'concierge') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/captions/form/3/concierge'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('concierge_cms'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->class == 'faq' or $end_segment == 'faq') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/faq/index'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('faq'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->class == 'contacts' or $end_segment == 'contacts') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/contacts/index'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('contacts'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->class == 'terms_and_conditions' or $end_segment == 'terms_and_conditions') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/captions/form/7/terms_and_conditions'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('terms_and_conditions_cms'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->class == 'booking_extras' or $end_segment == 'booking_extras') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/booking_extras/index'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('booking_extras'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->class == 'promotional_codes' or $end_segment == 'promotional_codes') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/promotional_codes/index'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('promotional_codes'); ?></span>
						</a>
					</li>
				</ul>
			</li>
			<li class="<?php echo $this->router->class == 'shuttles' ? 'opened active' : ''; ?>">
				<a href="<?php echo site_url('admin/shuttles/index'); ?>">
					<i class="entypo-flight"></i>
					<span><?php echo lang('shuttles'); ?></span>
				</a>
			</li>
			<li class="<?php echo $this->router->class == 'clients' ? 'opened active' : ''; ?>">
				<a href="<?php echo site_url('admin/clients/index'); ?>">
					<i class="entypo-ticket"></i>
					<span><?php echo lang('clients'); ?></span>
				</a>
			</li>
			<li class="<?php echo $this->router->class == 'collaborators' ? 'opened active' : ''; ?>">
				<a href="<?php echo site_url('admin/collaborators/index'); ?>">
					<i class="entypo-users"></i>
					<span><?php echo lang('collaborators'); ?></span>
				</a>
			</li>
			<li class="<?php echo ($this->router->class == 'routes' && $this->router->method != 'bcn_area' && $this->router->method != 'bcn_form' && $this->router->method != 'bcnareas_address' && $this->router->method != 'bcn_address_form') ? 'opened active' : ''; ?>">
				<a href="#"><i class="entypo-address"></i><span><?php echo lang('routes'); ?></span></a>
				<ul>
					<li class="<?php echo $this->router->method == 'calendar' || $this->router->method == 'calendarForm' || $this->router->method == 'calendarView' || $this->session->userdata('methodFrom') == 'calendar' ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/routes/calendar'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('calendar'); ?></span>
						</a>
					</li>
					<li class="<?php echo $this->router->method == 'schedule' || $this->session->userdata('methodFrom') == 'schedule' ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/routes/schedule'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('routes'); ?></span>
						</a>
					</li>
					<li class="<?php echo $this->session->userdata('methodFrom') == 'carChannel' ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/routes/carChannel'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('car_channel'); ?></span>
						</a>
					</li>
					
				</ul>
			</li>
			<li class="<?php echo ($this->router->class == 'settings' || $this->router->method == 'bcn_area' || $this->router->class == 'rates'  || $this->router->method == 'bcn_form' || $this->router->method == 'bcnareas_address' || $this->router->method == 'bcn_address_form') ? 'opened active' : ''; ?>" >
				<a href="#">
					<i class="entypo-cog"></i>
					<span><?php echo lang('settings'); ?></span>
				</a>
				<ul>
					<li class="<?php echo ($this->router->method == 'bcn_area' || $this->router->method == 'bcn_form') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/routes/bcn_area'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('bcn_area'); ?></span>
						</a>
					</li>
					<li class="<?php echo ($this->router->method == 'bcnareas_address' || $this->router->method == 'bcn_address_form') ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/routes/bcnareas_address'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('bcn_area_address'); ?></span>
						</a>
					</li>
					<li class="<?php echo $this->router->class == 'rates' ? 'opened active' : ''; ?>">
						<a href="<?php echo site_url('admin/rates/index'); ?>">
							<i class="entypo-list"></i>
							<span><?php echo lang('rates'); ?></span>
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
			<li class="<?php echo $this->router->class == 'charts' ? 'opened active' : ''; ?>">
				<a href="<?php echo site_url('admin/charts'); ?>">
					<i class="entypo-chart-bar"></i>
					<span><?php echo lang('charts'); ?></span>
				</a>
			</li>	
		</ul>
		<?php 
			} else if($this->session->userdata('user_type') == '6') {
		?>
			<ul id="main-menu" class="">
				<li class="<?php echo $this->router->class == 'dashboard' ? 'opened active' : ''; ?>">
					<a href="<?php echo site_url('admin/dashboard'); ?>">
						<i class="entypo-gauge"></i>
						<span><?php echo lang('dashboard'); ?></span>
					</a>
				</li>
				<li class="<?php echo $this->router->class == 'shuttles' ? 'opened active' : ''; ?>">
					<a href="<?php echo site_url('admin/shuttles/index'); ?>">
						<i class="entypo-flight"></i>
						<span><?php echo lang('shuttles'); ?></span>
					</a>
				</li>
				<li class="<?php echo $this->router->class == 'clients' ? 'opened active' : ''; ?>">
					<a href="<?php echo site_url('admin/clients/index'); ?>">
						<i class="entypo-ticket"></i>
						<span><?php echo lang('clients'); ?></span>
					</a>
				</li>
				<li class="<?php echo $this->router->class == 'collaborators' ? 'opened active' : ''; ?>">
					<a href="<?php echo site_url('admin/collaborators/index'); ?>">
						<i class="entypo-users"></i>
						<span><?php echo lang('collaborators'); ?></span>
					</a>
				</li>
				<li class="<?php echo ($this->router->class == 'routes' && $this->router->method != 'bcn_area' && $this->router->method != 'bcn_form' && $this->router->method != 'bcnareas_address' && $this->router->method != 'bcn_address_form') ? 'opened active' : ''; ?>">
					<a href="#"><i class="entypo-address"></i><span><?php echo lang('routes'); ?></span></a>
					<ul>
						<li class="<?php echo $this->router->method == 'calendar' || $this->router->method == 'calendarForm' || $this->router->method == 'calendarView' || $this->session->userdata('methodFrom') == 'calendar' ? 'opened active' : ''; ?>">
							<a href="<?php echo site_url('admin/routes/calendar'); ?>">
								<i class="entypo-list"></i>
								<span><?php echo lang('calendar'); ?></span>
							</a>
						</li>
						<li class="<?php echo $this->session->userdata('methodFrom') == 'carChannel' ? 'opened active' : ''; ?>">
							<a href="<?php echo site_url('admin/routes/carChannel'); ?>">
								<i class="entypo-list"></i>
								<span><?php echo lang('car_channel'); ?></span>
							</a>
						</li>
						
					</ul>
				</li>
			</ul>		
		<?php		
			}
		?>