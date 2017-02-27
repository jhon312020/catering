<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <h3 class="head_2"><?php echo lang('orders_list'); ?></h3>
        <div class="col-sm-12 fix-left-right">
          <table class="table table-striped datatable">
            <thead>
              <tr>
                <th><?php echo strtoupper(lang('reference_no')); ?></th>
                <th><?php echo strtoupper(lang('order_date')); ?></th>
                <th><?php echo strtoupper(lang('price')); ?></th>
                <th><?php echo strtoupper(lang('payment_method')); ?></th>
								<th></th>
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
                <td><?php echo $order['total_price']; ?> &euro;</td>
								<td><?php echo $order['payment_method']; ?></td>
                <td>
									<a href="<?php echo site_url(PAGE_LANGUAGE.'/order-details/'.$order['reference_no']); ?>">
										<i class="fa fa-eye fa-2x eyecon"></i>
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
  <?php $this->load->view('footer_nav_bar'); ?>
</div>
<?php
$this->load->view('footer');
?>
