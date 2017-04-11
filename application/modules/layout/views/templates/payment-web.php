<table class="table table-striped paymentTable mob-hide">
  <thead>
    <tr>
      <th><?php echo strtoupper(lang('menu')); ?></th>
      <th><?php echo strtoupper(lang('day')); ?></th>
      <th><?php echo strtoupper(lang('price')); ?></th>
      <th><?php //echo lang('action'); ?></th>              
    </tr>
  </thead>
  <tbody>
    <?php
    $bool = false;
    $price_with_menu_id = [];
    if($todaySelectedMenus) {
      $bool = true;
      foreach($todaySelectedMenus as $menu) {
        $price_with_menu_id[$menu['id']] = $menu['price'];
        $total_price += $menu['Total'];
    ?>
    <tr class="order_<?php echo $menu['id']; ?>">
      <td style="text-align:left">
        <p><b>
          <?php 
            $order_detail = json_decode($menu['order_detail'],true);
            $order_code = $order_detail['order_code'];
            /*unset($order_detail['order_code']);
            $order_detail = array_values($order_detail);*/
            $menu_type = findOrderMenuType($order_code);
            echo $menu_type;
          ?>
        </b></p>
        <?php
          $description = getOrderDescription($order_detail, $plates, $cool_drink_list);
          echo '- '.implode('<br/> - ', $description);
        ?><br/>- pan, aceite, vinagre y Cubiertos
      </td>
      <td><?php echo date('d/m/Y', strtotime($menu['order_date'])); ?></td>
      <td><?php echo number_format($menu['Total'], 2); ?> &euro;</td>
      <td>
        <a href="javascript:;" class="removeOrder" data-id="<?php echo $menu['id']; ?>">
          <i class="fa fa-trash fa-2x eyecon"></i>
        </a>
      </td>
    </tr>
    <?php
      }
    }
    ?>
  </tbody>
</table>

