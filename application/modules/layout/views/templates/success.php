<?php
$this->load->view('header');
$this->load->view('navigation_menu');
//echo '<pre>'; print_r($orders); echo '</pre>';
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <h3 class="head_2"><?php echo lang('order_placed'); ?>: <?php echo $orders[0]['reference_no']; ?></h3>
        <div class="col-sm-12">
          <?php $this->load->view('success-web');?>
          <?php $this->load->view('success-mobile');?>
        </div>
      </div>
    </div>
  </div>
<?php $this->load->view('footer_nav_bar', array('class'=>'')); ?>
</div>
<?php
$this->load->view('footer');
?>


