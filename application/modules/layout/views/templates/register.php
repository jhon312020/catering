<?php
$this->load->view('header');
$template_path = base_url()."assets/cc/img/";
$ln = $this->uri->segment(1);
?>
<!-- Top content -->
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-sm-offset-4 form-box">
          <div class="form-top">
            <div class="logo-heading">
              <img src="<?php echo $template_path; ?>gumen-logo.png" class="img-responsive center-block" alt="" />
            </div>
            <div class="logo-para">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
            </div>
          </div>
          <div class="form-bottom">
            <?php echo validation_errors(); ?>
            <form role="form" action="" method="post" class="login-form">
              <div class="form-group">
                <label class="sr-only" for="name">First Name</label>
                <input type="text" name="name" placeholder="Nombre" class="form-control" id="name" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="surname">Last Name</label>
                <input type="text" name="surname" placeholder="Apellidos" class="form-control" id="surname">
              </div>
              <div class="form-group">
                <label class="sr-only" for="email">Email</label>
                <input type="email" name="email" placeholder="Email" class="form-control" id="email" required>
              </div>
              <div class="form-group">
                <label class="sr-only" for="password">Contrasena</label>
                <input type="password" name="password" placeholder="Contrasena" class="form-control" id="password">
              </div>
              <div class="form-group">
                <label class="sr-only" for="client_code">Empresa</label>
                <input type="text" name="client_code" placeholder="Empresa" class="form-control" id="business" required>
              </div>
              <div class="form-group">
                <input type="checkbox" name="remember" value="1"> <a href="javascript:;" class="btn-link" required> Accepto los terminos y condiciones</a>
              </div>
              <button type="submit" class="btn center-block">CREAR CUENTA</button>
            </form>
            <div class="register">
              <P>Ya tienes cuenta?</p>
              <a href="<?php echo site_url($ln); ?>" class="btn btn-link center-block">Entrar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$this->load->view('footer');
?>
<script>
/*
		Fullscreen background
*/
$.backstretch("<?php echo $template_path; ?>backgrounds/1.jpg");
</script>
