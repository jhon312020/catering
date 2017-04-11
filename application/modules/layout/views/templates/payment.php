<?php
$this->load->view('header');
$this->load->view('navigation_menu');
$total_price = 0.00;
$bool = false;
$price_with_menu_id = [];
// running the loop for getting the total_price and price for each menu
if($todaySelectedMenus) {
  $bool = true;
  foreach($todaySelectedMenus as $menu) {
    $price_with_menu_id[$menu['id']] = $menu['price'];
    $total_price += $menu['Total'];
  }
}
?>
<style>
  td:nth-child(2), th:nth-child(2) {
    text-align:center !important;
    width: auto;
  }
</style>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <!-- form action when set via javascript is not working so directly given -->
      <form id="bank_form" name="bank_form" action="" method="POST" style="display:none;" enctype="application/json">
        <input type="hidden" name="Ds_SignatureVersion" id="Ds_SignatureVersion" value=""/>
        <input type="hidden" name="Ds_MerchantParameters" id="Ds_MerchantParameters" value=""/>
        <input type="hidden" name="Ds_Signature" id="Ds_Signature" value="" />
      </form>
      <div class="row">
        <h3 class="head_2"><?php echo lang('orders'); ?> (<span id="order_count"><?php echo count($todaySelectedMenus); ?></span>)</h3>
        <div class="col-sm-9 fix-left-right">
          <?php 
            echo $this->load->view('payment-web', array('total_price'=>$total_price));
            echo $this->load->view('payment-mobile', array('total_price'=>$total_price));
          ?>
        </div>
        <div class="col-sm-3 col-xs-12">
          <div class="form-bottom">
            <p id='server_error_response' class="error">
              <br> 
              <br> 
              <br>
            </p>
            <div class="paysection-2">
              <h4>COMO QUIERE PAGAR?</h4>
              <br>
              <div class="row payrow">
                <div class="col-xs-10 col-sm-10">
                  <span class="paytext">Tarjeta crédito o débito</span>
                </div>
                <div class="col-xs-2 col-sm-2">
                  <span class="custom-checkbox">
                    <span class="box">
                      <input type="checkbox" id="card" class="jsPaymentType" value="Credit/Debit" name="paymenttype[]"/>
                      <span class="tick"></span>
                    </span>
                  </span>
                </div>
                <img class="img-responsive payment-img" src="<?php echo TEMPLATE_PATH; ?>payment.png">
              </div>
              <div class="row payrow">
                <div class="col-xs-10 col-sm-10">
                  <span class="paytext">Giro Bancario</span>
                </div>
                <div class="col-xs-2 col-sm-2">
                  <span class="custom-checkbox">
                    <span class="box">
                      <input type="checkbox" id="draft" class="jsPaymentType" value="Bank Draft" name="paymenttype[]"/>
                      <span class="tick"></span>
                    </span>
                  </span>
                </div>
              </div>
              <div class="row payrow">
                <div class="col-xs-10 col-sm-10">
                  <span class="paytext">Ticket Restaurante</span>
                </div>
                <div class="col-xs-2 col-sm-2">
                  <span class="custom-checkbox">
                    <span class="box">
                      <input type="checkbox" id="ticket" class="jsPaymentType" value="Ticket Restaurant" name="paymenttype[]"/>
                      <span class="tick"></span>
                    </span>
                  </span>
                </div>
              </div>
              <div class="row payrow">
                <div class="col-xs-10 col-sm-10">
                  <span class="paytext">Efectivo</span>
                </div>
                <div class="col-xs-2 col-sm-2">
                  <span class="custom-checkbox">
                    <span class="box">
                      <input type="checkbox" id="cash" class="jsPaymentType" value="Efectivo" name="paymenttype[]"/>
                      <span class="tick"></span>
                    </span>
                  </span>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <span class="error" id="jsPaymentType">Por favor, seleccionar un tipo pagar</span>
                </div>
              </div>
            </div>
            <div class="paysection-3">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-sm-offset-0 paysection3text">
                  <input type="checkbox" name="accept" id="accept" value="1"> <a href="<?php echo site_url(PAGE_LANGUAGE); ?>/terms" class="btn-link" target="_blank"> Accepto los terminos y condiciones</a>
                    <span class="error" id="jsAcceptTerms">Por favor, acepte para poder continuar.</span>
                </div>
                <div class="row">
                  <h3 class="paytotalh2">Total: <span id="total_price"><?php echo number_format($total_price, 2); ?></span> &euro;</h3>
                </div>
                <button type="button" <?php !$bool?'disabled':''; ?> class="btn center-block payButton">CONTINUAR</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('footer_nav_bar'); ?>
</div>
<script src="<?php echo base_url(); ?>assets/cc/js/catering/payment.js"></script>
<script>
var $total_price = <?php echo $total_price; ?>;
var $price_with_menu_id = <?php echo json_encode($price_with_menu_id); ?>;
</script>
<?php $this->load->view('footer'); ?>
