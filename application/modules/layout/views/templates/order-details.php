<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container page-height">
      <div class="row">
        <h3 class="head_2">Pedido ref. <?php echo $reference_no; ?></h3>
        <?php $this->load->view('order-details-web');?>
        <?php $this->load->view('order-details-mobile');?>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="copyright">
            Gumen Catering | Calle cato, 6 bajos. 08206 Sabadell | Tel/Fax. 93 717 8335
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="design">
            <a href="#" class="btn-link">Condiciones legales</a> <i class="fa fa-lg fa-twitter-square"></i> <i class="fa fa-lg fa-facebook-square"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/cc/js/catering/payment.js"></script>
<?php
$this->load->view('footer');
?>