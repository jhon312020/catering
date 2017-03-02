<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container page-height">
      <div class="row">
        <h3 class="head_2">Pedido ref. <?php echo $reference_no; ?></h3>
        <div class="col-sm-12 fix-left-right">
          <table class="table table-striped paymentTable">
            <thead>
              <tr>
                <th><?php echo strtoupper(lang('menu')); ?></th>
                <th><?php echo strtoupper(lang('order_day')); ?></th>
                <th><?php echo strtoupper(lang('price')); ?></th>
								<th><?php echo strtoupper(lang('payment_method')); ?></th>
              </tr>
            </thead>
            <tbody>
							<?php
							$total_price = 0;
							$bool = false;
							if($orders) {
								$bool = true;
								foreach($orders as $order) {
							?>
							<tr>
                <td>
									<p><b>
                    <?php 
                      $order_detail = json_decode($order['order_detail'],true);
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
									?>
									, pan, aceite, vinagre y cubietros
                </td>
                <td><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                <td><?php echo $order['Total']; ?> &euro;</td>
                <td><?php echo $order['payment_method']; ?></td>
              </tr>
							<?php
								$total_price += $order['Total'];
                }
							}
							?>
            </tbody>
          </table>
          <div id="order_total">
               <h3>Total : <span><?php echo number_format($total_price,2); ?> &euro;</span><br/>
                </h3>
        </div>
        </div>
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