<table class="table table-striped datatable mob-hide">
  <thead>
    <tr>
      <th><?php echo strtoupper(lang('reference_no')); ?></th>
      <th><?php echo strtoupper(lang('order_date')); ?></th>
      <th><?php echo strtoupper(lang('price')); ?></th>
      <th><?php echo strtoupper(lang('payment_method')); ?></th>
			<th>DETALLE</th>
    </tr>
  </thead>
  <tbody>
		<?php
		if($orders) {
			foreach($orders as $order) {
		?>
		<tr>
      <td><?php echo $order['reference_no']; ?></td>
      <td><?php echo date('d/m/Y', strtotime($order['ordered_date'])); ?></td>
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
