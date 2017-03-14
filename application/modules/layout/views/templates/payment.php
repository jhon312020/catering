<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
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
          <table class="table table-striped paymentTable">
            <thead>
              <tr>
								<th><?php echo strtoupper(lang('menu')); ?></th>
                <th><?php echo strtoupper(lang('day')); ?></th>
                <th><?php echo strtoupper(lang('price')); ?></th>
                <th><?php //echo lang('action'); ?></th>              
							</tr>
            </thead>
            <tbody>
							<?php
							$total_price = 0;
							$bool = false;
							$price_with_menu_id = [];
             	if($todaySelectedMenus) {
								$bool = true;
								foreach($todaySelectedMenus as $menu) {
                  $price_with_menu_id[$menu['id']] = $menu['price'];
                  $total_price += $menu['Total'];
							?>
							<tr class="order_<?php echo $menu['id']; ?>">
                <td>
									<p><b>
                    <?php 
                      $order_detail = json_decode($menu['order_detail'],true);
                      $order_code = $order_detail['order_code'];
                      unset($order_detail['order_code']);
                      $order_detail = array_values($order_detail);
                      $menu_type = findOrderMenuType($order_code);
                      echo $menu_type;
                    ?>
                  </b></p>
                  <?php
                    $description = getOrderDescription($order_detail, $plates, $cool_drink_list);
                    echo implode(', ', $description);
									?>, pan, aceite, vinagre y cubietros
                </td>
                <td><?php echo date('d/m/Y', strtotime($menu['order_date'])); ?></td>
                <td><?php echo number_format($menu['Total'], 2); ?> &euro;</td>
                <td>
									<a href="javascript:;" class="removeOrder" data-id="<?php echo $menu['id']; ?>">
										<i class="fa fa-trash fa-2x eyecon"></i>
									</a>
								</td>
              </tr>
							<?php
								}
							}
							?>
            </tbody>
          </table>
        </div>
        <div class="col-sm-3">
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

              <div class="row payrow">
                <div class="col-sm-12">
                  <span class="error" id="jsPaymentType">Kindly select credito/debito</span>
                </div>
              </div>
            </div>
            <div class="paysection-3">
              <div class="row">
                <div class="col-xs-12 col-xs-offset-2 col-sm-12 col-sm-offset-0 paysection3text">
                  <input type="checkbox" name="accept" id="accept" value="1"> <a href="<?php echo site_url(PAGE_LANGUAGE); ?>/terms" class="btn-link" target="_blank"> Accepto los terminos y condiciones</a>
                    <span class="error" id="jsAcceptTerms">Kindly select terminos y condiciones</span>
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
