<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <h3 class="head_2">Pedidos</h3>
        <div class="col-sm-12 fix-left-right">
          <table class="table table-striped datatable">
            <thead>
              <tr>
                <th><?php echo lang('reference_no'); ?></th>
                <th><?php echo lang('order_date'); ?></th>
                <th><?php echo lang('price'); ?></th>
                <th><?php echo lang('payment_method'); ?></th>
								<th><?php echo lang('action'); ?></th>
              </tr>
            </thead>
            <tbody>
							<?php
							if($orders) {
								foreach($orders as $order) {
							?>
							<tr>
                <td><?php echo $order['reference_no']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                <td><?php echo $order['total_price']; ?>&euro;</td>
								<td><?php echo $order['payment_method']; ?></td>
                <td>
									<a href="<?php echo site_url(PAGE_LANGUAGE.'/order-details/'.$order['reference_no']); ?>">
										<i class="fa fa-eye fa-2x"></i>
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
<?php
$this->load->view('footer');
?>