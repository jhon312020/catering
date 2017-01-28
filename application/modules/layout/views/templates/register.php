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
            <form role="form" action="" method="post" class="login-form" data-toggle="validator">
              <div class="form-group">
                <label class="sr-only" for="form-username"><?php echo lang('name'); ?></label>
                <input type="text" name="name" id = "form-username" placeholder="<?php echo lang('name'); ?>" class="form-username form-control" 
                  data-error="<?php echo lang('name_error'); ?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-surname"><?php echo lang('surname'); ?></label>
                <input type="text" name="surname" id = "form-surname" placeholder="<?php echo lang('surname'); ?>" class="form-username form-control" 
                  data-error="<?php echo lang('surname_error'); ?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-email">Email</label>
                <input type="email" name="email" id="form-email" placeholder="Email" class="form-username form-control" 
                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                  data-error="<?php echo lang('invalid_email'); ?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-password"><?php echo lang('password');?></label>
                <input type="password" name="password" id="form-password" placeholder="<?php echo lang('password');?>" class="form-password form-control" 
                  data-error="<?php echo lang('password_error');?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-business"><?php echo lang('business');?></label>
                <input type="text" id="form-business" name="client_code" placeholder="<?php echo lang('business');?>" class="form-username form-control" 
                  data-error="<?php echo lang('business_error');?>" 
                required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label>
                  <input type="checkbox" name="terms" value="1" 
                    required 
                    data-error="<?php echo lang('checkbox_error');?>"
                    style="position:relative;top:2px;"> <?php echo lang('accept_terms'); ?>
                </label>
                <div class="help-block with-errors"></div>
              </div>
              <button type="submit" class="btn center-block"><?php echo lang('create_account');?></button>
            </form>
            <div class="register">
              <P><?php echo lang('already_have_acc');?></p>
              <a href="<?php echo site_url($ln); ?>" class="btn btn-link center-block"><?php echo lang('enter'); ?></a>
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