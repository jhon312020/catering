<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <h3 class="head_2"><?php echo lang('orders_list'); ?></h3>
        <!-- <div class="col-sm-12">
        	<a href="<?php echo site_url(PAGE_LANGUAGE."/user-invoice"); ?>" class="btn btn-primary pull-right btn-color" style="margin-right:15px;"><?php echo lang('invoice'); ?></a>
        </div> -->
        <div class="col-sm-12 fix-left-right" style="margin-top:15px;">
          <?php $this->load->view('orders-web');?>
          <?php $this->load->view('orders-mobile');?>
        </div>
      </div>
        <div style="display:block;text-align:right;padding-right:15px;">
        <style>
          ul.pagination li.active a{
            background:#c49e56;
            color:white;
            border-color:#ddd;
          }
          ul.pagination li:hover a{
            background:#c49e56 !important;
            color:white !important;
            border-color:#ddd !important;
          }
        </style>
        <?php echo $pagination; ?>
        </div>

    </div>
  </div>
  
  <?php $this->load->view('footer_nav_bar'); ?>
</div>
<?php
$this->load->view('footer');
?>
