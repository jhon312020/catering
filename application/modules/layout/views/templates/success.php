<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<div class="top-content">
  <div class="inner-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-md-12">
            <div class="form-bottom ribbon-down">
              <div id="ribbon-container-green" style="width:30%">
                <a href="javascript:;" id="ribbon"><?php echo strtoupper(lang('order_placed')); ?></a>
              </div>
              <table class="table table-striped paymentTable">
                <thead>
                  <tr>
                    <th><?php echo lang('menu'); ?></th>
                    <th><?php echo lang('date'); ?></th>
                    <th><?php echo lang('price'); ?></th>
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
                      </b></p>
                      <?php
                        $description = getOrderDiscription($order_detail, $plates);
                        echo implode(', ', $description);
                      ?>
                      , pan, aceite, vinagre y cubietros
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                    <td><?php echo $order['price']; ?> &euro;</td>
                  </tr>
                  <?php
                      $total_price += $order['price'];
                    }
                  }
                  ?>
                </tbody>
              </table>
              <div style="padding-top:10px;text-align:right;width:100%;">
               <strong>Total : <span style="color:#8DC73F;"><?php echo number_format($total_price,2); ?> &euro;</span><br/>
                <?php echo lang('payment_method'); ?> : <span style="color:#8DC73F;"><?php echo $orders[0]['payment_method']; ?></span></strong>
              </div>
              <a href="<?php echo base_url() . '/es/menus' ?>" >Return to menus</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $this->load->view('footer_nav_bar', array('class'=>'')); ?>
</div>
<?php
$this->load->view('footer');
?>
