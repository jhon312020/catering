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
						<?php echo $this->layout->load_view('layout/web_alerts'); ?>
            <form role="form" action="" method="post" class="login-form">
              <div class="form-group">
                <label class="sr-only" for="form-username">Username</label>
                <input type="text" name="form-username" placeholder="<?php echo lang('username'); ?>" class="form-username form-control" id="form-username">
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-password">Password</label>
                <input type="password" name="form-password" placeholder="<?php echo lang('password'); ?>" class="form-password form-control" id="form-password">
              </div>
              <div class="forget form-group">
                <a href="" class="btn btn-link">He olvidado mi constrasena</a>
              </div>
              <button type="submit" class="btn center-block"><a href="javascript:;">ENTRAR</a></button>
            </form>
            <div class="register">
              <P>Todavia no tienes tu cuenta?</p>
              <a href="<?php echo site_url($ln.'/register'); ?>" class="btn btn-link center-block">Registrate</a>
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