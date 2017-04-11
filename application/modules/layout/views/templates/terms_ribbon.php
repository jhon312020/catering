<?php
$this->load->view('header');
$this->load->view('navigation_menu');
$password = $this->mdl_clients->form_value('password');
if($this->mdl_clients->form_value('password') && !$this->input->post()) {
	$password = base64_decode($this->mdl_clients->form_value('password_key'));
	$password = substr($password, 0, -9);
}
//echo $password.'----------';die;
?>    
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
			<div class="row">
				<?php echo $this->layout->load_view('layout/alerts'); ?>
			</div>
      <div class="row">
        <h2 class="head_2"><?php echo lang('terms_and_conditions'); ?></h2>
        <div class="col-sm-12">
          <div class="col-sm-12 pad-R">
            <div class="form-bottom ribbon-down">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  $this->load->view('footer_nav_bar');
  $this->load->view('footer');
?>
