<div class="col-sm-12 fix-left-right mob-hide">
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
            </b>
          </p>
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
