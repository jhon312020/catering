<?php
  $menu_selected = $this->uri->segment(2);
  /* Forming the menu statically with the url as key */
  $menus = array('profile' => lang('profile'), 'menus' => lang('menus'), 'orders'=> lang('orders'), 'contact' => lang('contact'));
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
       <?php $cartImage = ($menu_selected == 'payment') ? 'cart-green.png':'cart-white.png'; ?>
      <a href="<?php echo site_url(PAGE_LANGUAGE.'/payment');?>"><img class="cart-logo respo_cart mob-show" src="<?php echo TEMPLATE_PATH.$cartImage; ?>">
       <?php if ($totalCartItems) { ?>
          <span class="basketitems jsTotalCart respo_cart_count mob-show"><?php echo $totalCartItems; ?></span>
          <?php } ?>
      </a>
    </div>
    <div id="navbar3" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="" javascript="return false" class="discard_links"><?php echo $user_info['client_name']; ?></a></li>
		<li><a href="" javascript="return false" class="discard_links"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
        <?php 
		$licount = 1;
        foreach ($menus as $url=>$menu) { 
				?>
          <li class="<?php echo $url == $menu_selected? 'active' : ''; ?>">
						<a href="<?php echo site_url(PAGE_LANGUAGE.'/'.$url); ?>">
							<?php echo strtoupper($menu);
							if($licount == 1) {
							//echo '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>';
							}
							?>
						</a>
					</li>
        <?php  
		$licount;
		} ?>
        <li><a href="<?php echo site_url(PAGE_LANGUAGE.'/logout');?>">LOGOUT</a></li>
        <li>
          <?php $cartImage = ($menu_selected == 'payment') ? 'cart-green.png':'cart-white.png'; ?>
          <a href="<?php echo site_url(PAGE_LANGUAGE.'/payment'); ?>"><img class="cart-logo desk_cart" src="<?php echo TEMPLATE_PATH.$cartImage; ?>">
          <?php if ($totalCartItems) { ?>
          <span class="desk_cart basketitems jsTotalCart"><?php echo $totalCartItems; ?></span>
          <?php } ?>
          </a>
        </li>
      </ul>
    </div>
    <!--/.nav-collapse -->
  </div>
  <!--/.container-fluid -->
</nav>
