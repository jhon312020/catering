<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <h3 class="head_2">Pedidos ref. <?php echo $reference_no; ?></h3>
        <div class="col-sm-912fix-left-right">
          <table class="table table-striped paymentTable">
            <thead>
              <tr>
                <th><?php echo lang('menu'); ?></th>
                <th><?php echo lang('date'); ?></th>
                <th><?php echo lang('price'); ?></th>
								<th><?php echo lang('payment_method'); ?></th>
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
									<p><b>Menu <?php echo $order['menu_name']; ?></b></p>
                  <?php 
										$description = array();
										$description[] =  $order['complement'];
										
										switch($order['order_type']) {
											case 'primary':
												$description[] = $order['primary_plate'];
											case 'secondary':
												$description[] = $order['secondary_plate'];
											case 'both':
												$description[] = $order['primary_plate'];
												$description[] = $order['secondary_plate'];
										}
										
										$description[] = $order['postre'];
										
										echo implode(', ', $description);
									?>
									, pan, aceite, vinagre y cubietros
                </td>
                <td><?php echo date('d/m/Y', strtotime($order['menu_date'])); ?></td>
                <td><?php echo $order['price']; ?></td>
                <td><?php echo $order['payment_method']; ?></td>
              </tr>
							<?php
								}
							}
							?>
            </tbody>
          </table>
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