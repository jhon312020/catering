<style>
.clear {
  clear: both;
  margin-top:15px; 
}
.align-left {
  text-align: left;
}
.fa.pull-right { line-height: inherit; padding-right: 10px; color:#fff; font-size: 20px; }
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
  margin: 0 0 5px;
}
</style>
<div class='col-xs-12 align-left mob-show'>
<?php
    if($orders) {
      foreach($orders as $order) {
    ?>
 <div class="mobile-ribbon clear">
 
    <a href="<?php echo site_url(PAGE_LANGUAGE.'/order-details/'.$order['reference_no']); ?>" class="margin-left">FECHA PEDIDO: <?php echo date('d/m/Y', strtotime($order['ordered_date'])); ?>
          <span class="fa fa-eye eyecon pull-right"></span>
    </a>   
 </div>
 <div class="col-x2-12 color">
    <p><b class='bold'>PRECIO: </b> <?php echo $order['total_price']; ?> &euro;</p>
    <p><b class='bold'>FORMA DE PAGO: </b><?php echo $order['payment_method']; ?></p>
 </div>
<?php
    }}
    ?>
</div>