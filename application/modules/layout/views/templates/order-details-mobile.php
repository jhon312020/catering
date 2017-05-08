<style>
.clear {
  clear: both;
  margin-top:15px; 
}
.align-left {
  text-align: left;
}
.pull-right { line-height: inherit; padding-right: 10px; color:#fff; }
.margin-left {
  margin-left: 15px;
}
.color {
background: #f3f3f3;
padding:10px 25px;
}
.bold {
  font-size: 17px;
}
p {
  margin: 0 0 15px;
}
</style>
<div class='col-xs-12 align-left mob-show'>
<?php
    if($orders) {
      $total_price = 0;
      foreach($orders as $order) {
        $order_detail = json_decode($order['order_detail'],true);
        $order_code = $order_detail['order_code'];
        /*unset($order_detail['order_code']);
        $order_detail = array_values($order_detail);*/
        $menu_type = findOrderMenuType($order_code);
        $total_price += $order['Total'];
        
    ?>
 <div class="mobile-ribbon clear">
    <a href="#" class="margin-left"><?php echo $menu_type; ?> 
      <span class="pull-right"><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></span>
    </a>   
 </div>
 <div class="col-x2-12 color">
    <p><?php $description = getOrderDescription($order_detail, $plates, $cool_drink_list, $order['order_date']);
            echo '- '.implode('<br/> - ', $description);
            ?>
          <br/>- pan, aceite, vinagre y Cubiertos</p>
    <p><b class='bold'>Precio: </b><?php echo $order['Total'];?> &euro;</p>
 </div>
<?php
    }}
    ?>
    <div id="order_total">
    <h3 style="text-align: center;"><div style="margin-bottom: 15px;">Total : <?php echo number_format($total_price,2); ?> &euro;</div>
    <a href="<?php echo site_url(PAGE_LANGUAGE.'/orders/'); ?>" class="btn btn-menu cus-button" role="button"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> VOLVER</a>
    </h3>

  </div>
</div>