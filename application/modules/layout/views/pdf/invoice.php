<html>
  <head>
    <meta charset="UTF-8">
    <style>
      #order-table tr td {
        padding:5px;
      }
      #order-table tr td {
        border-bottom:2px solid #fff;
        border-top:2px solid #fff;
      }
      #order-table tr td:first-child {
        border-right:2px solid #fff;
      }
      .order-row {
        padding: 5px;
      }
      .order-row td {
        border-bottom:none !important;
        border-top:none !important;
        padding-left:10px !important;
      }
      .white_text {
        color:#fff;
      }
      .header_background {
        background-color: #414042;
      }
      .header_title {
        color:#c49e56;
      }
    </style>
  </head>
  <?php
    $background_color = '#dfe7ec';
    $color1 = '#9A9A9A';
    $color2 = '#B3B3B3';
    $color3 = '#E6E6E6';
  ?>
  <body style="font-family:Helvetica">
    <div style="width:100%;">
      <div class="header_background white_text">
        <div class="logo" style="width:100%;background-color:#414042;text-align:right;">
          <img src="./assets/cc/img/gumen-logo.png" alt="Gumen-Catering">
        </div>
        <!-- Header section -->
        <div style="padding-left:10px;" class="header_background white_text">
        <b>GUMEN CATERING S.L.</b><br/>
        <span>Calle cato, 6 bajos 08206 Sabadell<br/>Barcelona<br/>Tel i fax. 93 717 83 35 <br/></span>
        </div>
        <!-- End Header section -->
        
        <br/><br/>
        <!--billing section -->
        <table style="width:100%;padding-left:10px;" class="header_background white_text">
          <tbody>
            <tr>
              <td style="vertical-align:top;" rowspan="2">
                <b class="header_title">Cliente:</b><br/>
                <b><?=$user_name?>,</b><br/>
                <?=$businessInfo->name?><br/>
                <?php echo $client[0]['billing_data']; ?>
              </td>
              <td style="width:200px;">
                <table style="width:100%;text-align:left;float:right;" class="header_background white_text">
                  <tbody>
                  <tr>
                    <td style="padding:2px;padding-bottom:15px;font-weight:bold;">
                    <b class="header_title">Factura Nº:</b><br/>
                    <?php
                      if (strlen((string)$reference_no) < 9) {
                        $reference_no = sprintf("%09s", $reference_no);
                      } 
                      echo $reference_no;
                    ?>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:2px;font-weight:bold;">
                    <b class="header_title">Fecha:</b><br/>
                    <?=date('d/m/Y',strtotime($orders[0]['created_at']))?>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- end billing section -->
        <br/><br/><br/><br/>
      </div>
      <!-- Order section -->
      <table style="width:100%;margin:0px;border-collapse:collapse;background-color:<?=$color3?>;" id="order-table">
        <thead>
          <tr style="background-color:#c49e56;">
            <th style="padding:5px;padding-left:10px;text-align:left;border-right:2px solid #fff;color:white;">CONCEPTO</th>
            <th style="padding:5px;color:white;">IMPORTE</th>
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
          <tr class="order-row">
            <td width="70%" style="text-align:left">
              <b>
                <?php 
                  $order_detail = json_decode($order['order_detail'],true);
                  $order_code = $order_detail['order_code'];
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
                  echo date('d/m/Y', strtotime($order['order_date'])).' - '.$menu_type ;
                ?>
              </b>
            </td>
            <td style="text-align:right;padding-right:10px;"><?php echo $order['price']; ?> &euro;</td>
          </tr>
          <?php
              $total_price += $order['price'];
            }
          }
          ?>
          <tr class="order-row"><td><p></p></td><td></td></tr>
          <tr class="order-row"><td><p></p></td><td></td></tr>
          <tr class="order-row"><td><p></p></td><td></td></tr>
          <tr style="color:white;background-color:<?=$color2?>;border:1px solid #fff;">
            <td style="padding-left:10px;">BASE IMPONIBLE</td>
            <td style="text-align:right;padding-right:10px;"><?php echo number_format($total_price-($total_price*10/100),2,'.',''); ?> &euro;</td>
          </tr>
          <tr style="color:white;background-color:<?=$color2?>;border:1px solid #fff;">
            <td style="padding-left:10px;">TAX: 10% I.V.A.</td>
            <td style="text-align:right;padding-right:10px;"><?php echo number_format($total_price*10/100,2,'.',''); ?> &euro;</td>
          </tr>
          <tr style="color:white;border:1px solid #fff;">
            <td style="padding-left:10px;background-color:<?=$color1?>;"><b>TOTAL</b> </td>
            <td style="text-align:right;background:#414042;padding-right:10px;"><?php echo number_format($total_price,2,'.',''); ?> &euro;</td>
          </tr>
          <?php if (isset($discount) && $discount) {  ?>
            <tr style="color:white;background-color:<?=$color2?>;border:1px solid #fff;">
              <td style="padding-left:10px;">DESCUENTO</td>
              <td style="text-align:right;padding-right:10px;"><?php echo $discount['discount']; ?> &euro;</td>
            </tr>
            <tr style="color:white;border:1px solid #fff;">
              <td style="padding-left:10px;background-color:<?=$color1?>;"><b>TOTAL A PAGAR</b> </td>
              <td style="text-align:right;background:#414042;padding-right:10px;"><?php echo $discount['total_price']; ?> &euro;</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <!-- end order section -->
    </div>
  </body>
</html>