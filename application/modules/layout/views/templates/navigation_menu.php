<?php
$template_path = base_url()."assets/cc/img/";
$ln = $this->uri->segment(1);
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
        <li class="active"><a href="#"><?php echo $user_name; ?>  -></a>
        </li>
        <li><a href="<?php echo site_url($ln) . '/logout';?>">Logout</a></li>
        <li class="active"><a href="#">PERFIL</a>
        </li>
        <li><a href="#">MENUS</a>
        </li>
        <li><a href="#">PEDIDOS</a>
        </li>
        <li><a href="#">CONTACTO</a>
        </li>
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