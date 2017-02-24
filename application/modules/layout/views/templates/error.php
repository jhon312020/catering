<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-md-6 col-md-offset-3">
            <div class="form-bottom ribbon-down">
              <div id="ribbon-container">
                <a href="javascript:;" id="ribbon"><?php echo strtoupper(lang('payment_error')); ?></a>
              </div>
              <div class="alert alert-danger">Your Payment transaction has been canceled.</div>
                  <a href="<?php echo base_url() . '/es/menus' ?>" >Return to menus</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->load->view('footer_nav_bar',['class'=>'footer-fixed']); ?>
</div>
<?php
$this->load->view('footer');
?>
