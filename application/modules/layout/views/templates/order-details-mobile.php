<div class="col-sm-12 fix-left-right mob-show">
  <table class="table table-striped paymentTable">
    <thead>
      <tr>
        <th style="text-align: left; width:70%; padding-left: 8% !important;""><?php echo strtoupper(lang('menu')); ?></th>
        <th style="text-align: center;"><?php echo strtoupper(lang('datos')); ?></th>
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
        <td style="text-align: left; padding-left: 8% !important;">
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
        <td style="text-align: center !important; vertical-align: middle; font-size: 17px;"><b><?php echo date('d/m/Y', strtotime($order['order_date'])); ?><br/><?php echo $order['Total']; ?> &euro; <br/><?php echo $order['payment_method']; ?></b></td>
      </tr>
      <?php
        $total_price += $order['Total'];
                }
        }
        ?>
    </tbody>
  </table>
  <div id="order_total">
    <h3 style="text-align: center;">Total : <span><?php echo number_format($total_price,2); ?> &euro;</span><br/>
    </h3>
  </div>
</div>
