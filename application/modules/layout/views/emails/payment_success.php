<html>
<head>
  <style type='text/css'>
   @media only screen and (max-width:480px){
        .class="nopadding"{
            padding:0px;
        }
    }
  </style>
</head>
<body>
<div style="background-color:#FAFAFA;padding:5px;" class="nopadding">
  <div style="background-color:#8DC73F;padding:5px;" class="nopadding">
  <img src="http://www.gumen-catering.com/Delivery/assets/cc/img/gumen-logo.png" style="display:block;margin-left:auto;width:180px;"/>
  </div>
  <div style="background-color:#FFFFFF;color:#5a5b5f;padding:5px;line-height:30px;font-size:16px;">
    <?php echo lang("hello"); ?> <?php echo $user_name; ?>
    <div class="top-content">
      <div class="inner-bg">
        <div class="container page-height">
          <div class="row">
            <h3 class="head_2">Pedidos ref. <?php echo $reference_no; ?></h3>
            <div class="col-sm-912fix-left-right" style="text-align:center;width:100%;background-color:#eee;margin-right:25px;">
              <table class="table table-striped paymentTable" style="width:100%;margin:auto;padding:10px;line-height:1.2; overflow: scroll;">
                <thead>
                  <tr>
                    <th style="text-align:left;"><?php echo lang('menu'); ?></th>
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
                    /*echo '<pre>';
                    print_r($orders); exit;*/
                    foreach($orders as $order) {
                  ?>
                  <tr>
                    <td width="40%" style="padding:5px;text-align:left">
                      <p><b>
                        <?php 
                          $order_detail = json_decode($order['order_detail'],true);
                          $order_code = $order_detail['order_code'];
                          unset($order_detail['order_code']);
                          $order_detail = array_values($order_detail);
                          $menu_type = '';
                          switch (count($order_code)) {
                            case 0:
                              break;
                            case 1:
                              switch ($order_code[0]) {
                                case 'N':
                                  $menu_type = lang('basic_menu');
                                  break;
                                case 'R':
                                  $menu_type = lang('diet_menu');
                                  break;
                                default:
                                  $menu_type = lang('medio_menu');
                              }
                              break;
                            default:
                              $order_code = array_unique($order_code);
                              if (!in_array('N1', $order_code) && !in_array('N2', $order_code)) {
                                $menu_type = lang('diet_menu');
                              } elseif (!in_array('R1', $order_code) && !in_array('R2', $order_code)) {
                                $menu_type = lang('basic_menu');
                              } else {
                                $menu_type = lang('combine_menu');
                              }
                          }
                          echo $menu_type;
                        ?>
                      </b></p>
                      <?php 
                        $description = array();
                        foreach ($order_detail as $order_det) {
                          if (!is_array($order_det))
                            continue;
                          foreach ($order_det as $key=>$sub_orders) {
                            if (!is_integer($key))
                              continue;
                            $order_array = $sub_orders['order'];
                            if (!in_array($order_array['Guarnicio'], $description))
                                $description[] = $plates[$order_array['Guarnicio']];
                            if (isset($order_array['Primer'])) {
                              $description[] = $plates[$order_array['Primer']];
                            }
                            if (isset($order_array['Segon'])) {
                              $description[] = $plates[$order_array['Segon']];
                            }
                            if (!in_array($order_array['Postre'], $description))
                              $description[] = $plates[$order_array['Postre']];

                            if (isset($sub_orders['cool_drink'])) {
                              foreach ($sub_orders['cool_drink'] as $drinks) {
                                $description[] = $cool_drink_list[$drinks];
                              }  
                            }
                            
                          }
                        }
                        echo implode(', ', $description);
                      ?>
                      , pan, aceite, vinagre y cubietros
                    </td>
                    <td style="text-align:center"><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                    <td style="text-align:center"><?php echo $order['price']; ?> &euro;</td>
                  </tr>
                  <?php
                      $total_price += $order['price'];
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="padding-top:10px;text-align:right;width:100%;">
      <strong>Total : <span style="color:#8DC73F;"><?php echo number_format($total_price,2); ?> &euro;</span><br/>
      <?php echo lang('payment_method'); ?> : <span style="color:#8DC73F;"><?php echo $orders[0]['payment_method']; ?></span></strong>
    </div>
  <div style="margin-top:30px;color:#999999;line-height:20px;font-size:13px;">
    <p>Un saludo y gracias <br/><b>Gumen Catering</b><br/><a href="http://www.gumen-catering.com">www.gumen-catering.com</a></p>
  </div>
  </div>
</div>
</body>
</html>