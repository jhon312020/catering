<?php
  $menu_selected = $this->uri->segment(2);
  /* Forming the menu statically with the url as key */
  $menus = array('profile' => lang('profile'), 'orders'=> lang('orders'), 'menus' => lang('menus'),'contact' => lang('contact'));
  # Used for printing all the array variables */
  //print_r($this->_ci_cached_vars);
?>
<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="<?php echo TEMPLATE_PATH; ?>gumen-logo.png" alt="Gumen-Catering">
      </a>
    </div>
    <div id="navbar3" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="" javascript="return false"><?php echo $user_info['client_name']; ?></a></li>
        <?php 
        foreach ($menus as $url=>$menu) { 
				?>
          <li class="<?php echo $url == $menu_selected? 'active' : ''; ?>">
						<a href="<?php echo site_url(PAGE_LANGUAGE.'/'.$url); ?>">
							<?php echo strtoupper($menu); ?>
						</a>
					</li>
        <?php  } ?>
        <li><a href="<?php echo site_url(PAGE_LANGUAGE.'/logout');?>">LOGOUT</a></li>
        <li>
          <a href="<?php echo site_url(PAGE_LANGUAGE.'/payment'); ?>"><img class="cart-logo" src="<?php echo TEMPLATE_PATH; ?>cart-white.png">
          </a>
        </li>
      </ul>
    </div>
    <!--/.nav-collapse -->
  </div>
  <!--/.container-fluid -->
</nav>
