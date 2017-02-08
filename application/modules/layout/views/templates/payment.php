<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <!-- form action when set via javascript is not working so directly given -->
      <form id="bank_form" name="bank_form" action="" method="POST" style="display:none;" enctype="multipart/form-data">
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
							?>
							<tr>
                <td>
									<p><b> <?php $menu_name = strtolower($menu['menu_name']).'_menu'; echo lang($menu_name); ?></b></p>
                  <?php 
										$description = array();
										$description[] =  $menu['complement'];
										
										$price = $menu['price'];
										$price_with_menu_id[$menu['id']] = $price;
										switch($menu['order_type']) {
											case 'primary':
												$description[] = $menu['primary_plate'];
                      break;
											case 'secondary':
												$description[] = $menu['secondary_plate'];
                      break;
											case 'both':
												$description[] = $menu['primary_plate'];
												$description[] = $menu['secondary_plate'];
                      break;
										}
										$description[] = $menu['postre'];
										$total_price += $price;
										echo implode(', ', $description);
									?>
									, pan, aceite, vinagre y cubietros
                </td>
                <td><?php echo date('d/m/Y', strtotime($menu['menu_date'])); ?></td>
                <td><?php echo number_format($price, 2); ?> &euro;</td>
                <td>
									<a href="javascript:;" class="removeOrder" data-id="<?php echo $menu['id']; ?>">
										<i class="fa fa-trash fa-2x"></i>
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
            <p>Lorem ipsum
              <br> loremipsum@gmail.com
              <br> consectur
              <br>
            <div class="paysection-2">
              <h4>COMO QUIERE PAGAR?</h4>
              <br>
              <div class="row payrow">
                <div class="col-sm-10">
                  <span class="paytext">Targeta da credito/debito</span> <br> Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet,
                </div>
                <div class="col-sm-2">
                  <span class="custom-checkbox">
                  <input type="checkbox" id="card"/>
                  <span class="box"><span class="tick"></span></span>
                  </span>
                </div>
				<img class="img-responsive payment-img" src="<?php echo TEMPLATE_PATH; ?>payment.png">
              </div>
              <div class="row payrow">
                <div class="col-sm-10">
                  <span class="paytext">Giro bancario</span>
                </div>
                <div class="col-sm-2">
                  <span class="custom-checkbox">
                  <input type="checkbox" id="draft"/>
                  <span class="box"><span class="tick"></span></span>
                  </span>
                </div>
              </div>
              <div class="row payrow">
                <div class="col-sm-10">
                  <span class="paytext">Ticket restaurante</span>
                </div>
                <div class="col-sm-2">
                  <span class="custom-checkbox">
                  <input type="checkbox" id="ticket"/>
                  <span class="box"><span class="tick"></span></span>
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
                <div class="paysection3text">
                  <input type="checkbox" name="accept" id="accept" value="1"> <a href="" class="btn-link"> Accepto los terminos y condiciones</a>
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
