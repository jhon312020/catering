<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <h3 class="head_2">Pedidos(<?php echo count($todaySelectedMenus); ?>)</h3>
        <div class="col-sm-9 fix-left-right">
          <table class="table table-striped paymentTable">
            <thead>
              <tr>
								<th><?php echo lang('menu'); ?></th>
                <th><?php echo lang('date'); ?></th>
                <th><?php echo lang('price'); ?></th>
                <th><?php echo lang('action'); ?></th>              
							</tr>
            </thead>
            <tbody>
							<?php
							$total_price = 0;
							$bool = false;
							if($todaySelectedMenus) {
								$bool = true;
								foreach($todaySelectedMenus as $menu) {
							?>
							<tr>
                <td>
									<p><b>Menu <?php echo $menu['menu_name']; ?></b></p>
                  <?php 
										$description = array();
										$description[] =  $menu['complement'];
										$price = $menu['half_price'];
										
										switch($menu['order_type']) {
											case 'primary':
												$description[] = $menu['primary_plate'];
											case 'secondary':
												$description[] = $menu['secondary_plate'];
											case 'both':
												$price = $menu['full_price'];
												$description[] = $menu['primary_plate'];
												$description[] = $menu['secondary_plate'];
										}
										$total_price += $price;
										
										$description[] = $menu['postre'];
										
										echo implode(', ', $description);
									?>
									, pan, aceite, vinagre y cubietros
                </td>
                <td><?php echo date('d/m/Y', strtotime($menu['menu_date'])); ?></td>
                <td><?php echo $price; ?></td>
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
                  <input type="checkbox"/>
                  <span class="box"><span class="tick"></span></span>
                  </span>
                </div>
              </div>
              <div class="row payrow">
                <div class="col-sm-10">
                  <span class="paytext">Giro bancario</span>
                </div>
                <div class="col-sm-2">
                  <span class="custom-checkbox">
                  <input type="checkbox"/>
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
                  <input type="checkbox"/>
                  <span class="box"><span class="tick"></span></span>
                  </span>
                </div>
              </div>
            </div>
            <div class="paysection-3">
              <div class="row">
                <div class="paysection3text">
									<form method="post" action="<?php echo site_url('node/clientPayment'); ?>" id="paymentForm">
										<input type="checkbox" name="accept" id="accept" value="1"> <a href="" class="btn-link"> Accepto los terminos y condiciones</a>
									</form>
                </div>
                <div class="row">
                  <h3 class="paytotalh2">Total: <?php echo $total_price; ?>&euro;</h3>
                </div>
                <button type="button" <?php !$bool?'disabled':''; ?> class="btn center-block payButton">CONTINUAR</button>
              </div>
            </div>
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