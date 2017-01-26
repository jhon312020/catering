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
            <form role="form" action="" method="post" class="login-form">
              <div class="form-group">
                <label class="sr-only" for="form-username">First Name</label>
                <input type="text" name="form-username" placeholder="Nombre" class="form-username form-control" id="form-username">
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-username">Last Name</label>
                <input type="text" name="form-username" placeholder="Apellidos" class="form-username form-control" id="form-username">
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-username">Email</label>
                <input type="email" name="form-username" placeholder="Email" class="form-username form-control" id="form-username">
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-username">Contrasena</label>
                <input type="text" name="form-username" placeholder="Contrasena" class="form-username form-control" id="form-username">
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-password">Empresa</label>
                <input type="password" name="form-password" placeholder="Empresa" class="form-password form-control" id="form-password">
              </div>
              <div class="form-group">
                <input type="checkbox" name="remember" value="1"> <a href="javascript:;" class="btn-link"> Accepto los terminos y condiciones</a>
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