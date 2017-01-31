<?php
  $template_path = base_url()."assets/cc/img/";
  $ln = $this->uri->segment(1);
  $menu_selected = $this->uri->segment(2);
  /* Forming the menu statically with the url as key */
  $menus = array('profile'=>'PERFIL', 'menus'=>'MENUS','contact'=>'CONTACTO');
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
      <a class="navbar-brand" href="#"><img src="<?php echo $template_path; ?>gumen-logo.png" alt="Gumen-Catering">
      </a>
    </div>
    <div id="navbar3" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="" javascript="return false"><?php echo $user_info['user_name']; ?></a></li>
        <?php 
        foreach ($menus as $url=>$menu) { 
          if ($url == $menu_selected) { ?>
            <li class="active"><a href="<?php echo site_url($ln).'/'.$url?>"><?php echo $menu; ?></a></li>
        <?php } else { ?>
            <li><a href="<?php echo site_url($ln).'/'.$url?>"><?php echo $menu; ?></a></li>
        <?php } } ?>
        <li><a href="<?php echo site_url($ln) . '/logout';?>">LOGOUT</a></li>
        <li>
          <a href="#"><img class="cart-logo" src="<?php echo $template_path; ?>cart-white.png">
          </a>
        </li>
      </ul>
    </div>
    <!--/.nav-collapse -->
  </div>
  <!--/.container-fluid -->
</nav>
