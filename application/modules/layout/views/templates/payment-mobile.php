<style>
.clear {
  clear: both;
  margin-top:15px; 
}
.align-left {
  text-align: left;
}
.pull-right { line-height: inherit; padding-right: 10px; color:#fff; font-size: 20px;}
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
.mob-div {
  padding-bottom: 30px;
  text-align: left;
}
</style>
<div class='col-xs-12 mob-show mob-div'>
<?php
    $bool = false;
    $price_with_menu_id = [];
    if($todaySelectedMenus) {
      $bool = true;
      foreach($todaySelectedMenus as $menu) {
        $price_with_menu_id[$menu['id']] = $menu['price'];
        $total_price += $menu['Total'];
        $order_detail = json_decode($menu['order_detail'],true);
        $order_code = $order_detail['order_code'];
        /*unset($order_detail['order_code']);
        $order_detail = array_values($order_detail);*/
        $menu_type = findOrderMenuType($order_code);
        
    ?>
 <div class="mobile-ribbon clear order_<?php echo $menu['id']; ?>">
  
     <a href="javascript:;" class="margin-left removeOrder" data-id="<?php echo $menu['id']; ?>">
     <?php echo $menu_type; ?> 
          <span class="fa fa-trash eyecon pull-right"></span>
    </a>
 </div>
 <div class="col-x2-12 color order_<?php echo $menu['id']; ?>">
    <p> <?php
          $description = getOrderDescription($order_detail, $plates, $cool_drink_list, $menu['order_date']);
          echo '- '.implode('<br/> - ', $description);
        ?><br/>- pan, aceite, vinagre y Cubiertos</p>
    <p>
    <b class='bold'>Fecha: </b> <?php echo date('d/m/Y', strtotime($menu['order_date'])); ?><br/>
    <b class='bold'>Precio: </b> <?php echo number_format($menu['Total'], 2); ?> &euro;</p>
 </div>
<?php
    }}
    ?>
</div>