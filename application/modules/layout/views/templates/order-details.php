<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container page-height">
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
									<p><b>
                    <?php 
                      $order_detail = json_decode($order['order_detail'],true);
                      unset($order_detail['order_code']);
                      $order_detail = array_values($order_detail);

                      if ($order['order_type'] == 'combine') {
                        echo lang('combine_menu');
                      } else {
                        if (count($order_detail[0][0]['order']) == 3) {
                          echo lang('medio_menu');
                        } elseif (count($order_detail[0][0]['order']) == 4) {
                          echo lang(strtolower($menu_titles[$order_detail[0]['menu_type_id']]).'_menu');  
                        }
                      }
                    ?>
                  </b></p>
                  <?php 
										/*$description = array();
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
										
										if($order['drinks_id']) {
											$drinks_array = explode(',', $order['drinks_id']);
											if($drinks_array) {
												foreach($drinks_array as $drinks) {
													if($cool_drinks[$drinks]) {
														$description[] = $cool_drinks[$drinks]->drinks_name;
													}
												}
											}
										}*/

                    $description = array();
                    foreach ($order_detail as $order_det) {
                      if (!is_array($order_det))
                        continue;
                      foreach ($order_det as $key=>$orders) {
                        if (!is_integer($key))
                          continue;
                        $order_array = $orders['order'];
                        if (!in_array($order_array['Guarnicio'], $description))
                            $description[] = $plates[$order_array['Guarnicio']];
                        if (isset($order_array['Primer'])) {
                          $description[] = $plates[$order_array['Primer']];
                        }
                        if (isset($order_array['Segon'])) {
                          $description[] = $plates[$order_array['Segon']];
                        }
                        if (!in_array($order_array['Postre'], $description))
                          $description[] = $plates[$order_array['Postre']];

                        if (isset($orders['cool_drink'])) {
                          foreach ($orders['cool_drink'] as $drinks) {
                            $description[] = $cool_drink_list[$drinks];
                          }  
                        }
                        
                      }
                    }
										echo implode(', ', $description);
									?>
									, pan, aceite, vinagre y cubietros
                </td>
                <td><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                <td><?php echo $order['price']; ?> &euro;</td>
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