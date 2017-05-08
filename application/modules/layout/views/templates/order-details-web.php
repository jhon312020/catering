<style>
  td:nth-child(2), th:nth-child(2) {
    text-align:center !important;
    width: auto;
  }
</style>
<div class="col-sm-12 fix-left-right mob-hide">
  <table class="table table-striped paymentTable">
    <thead>
      <tr>
        <th width="50%"><?php echo strtoupper(lang('menu')); ?></th>
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
        <td style="text-align:left">
          <p><b>
            <?php 
              $order_detail = json_decode($order['order_detail'],true);
              $order_code = $order_detail['order_code'];
              //echo '<pre>'; print_r($order); echo '</pre>';
              //unset($order_detail['order_code']);
              //$order_detail = array_values($order_detail);
              $menu_type = findOrderMenuType($order_code);
              echo $menu_type;
              ?>
            </b>
          </p>
          <?php
            $description = getOrderDescription($order_detail, $plates, $cool_drink_list, $order['order_date']);
            echo '- '.implode('<br/> - ', $description);
            ?>
            <br/>
          - pan, aceite, vinagre y Cubiertos
        </td>
        <td style="text-align:center;"><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
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
  <a href="<?php echo site_url(PAGE_LANGUAGE.'/orders/'); ?>" class="btn btn-menu pull-left cus-button" role="button"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> VOLVER</a>
    <h3>Total : <span><?php echo number_format($total_price,2); ?> &euro;</span><br/>
    </h3>
  </div>
</div>
