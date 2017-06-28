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
      .bg-img:before {
			  
			  background: linear-gradient(to right, red , yellow); /* Standard syntax */
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
      <div class="header_background white_text" style="padding-bottom:20px;">
        <!-- <div class="logo" style="width:100%;background-color:#414042;text-align:right;">
          <img src="./assets/cc/img/gumen-logo.png" alt="Gumen-Catering">
        </div> -->
        <!-- Header section -->
				<table style="font-size:13px !important;margin-top:80px;margin-left:40px;width:100%;padding:0px;" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
							<td>
								<table style="padding:0px !important;" cellspacing="0" cellpadding="0">
									<tr>
										<td colspan="2" style="font-style:italic !important;">
											GUMEN CATERING, S.L.
										</td>
									</tr>
									<tr>
										<td style="font-style:italic !important;">
											Dirección: 
										</td>
										<td>
											Tamarit 10 | 08205 Sabadell (BCN)
										</td>
									</tr>
									<tr>
										<td style="font-style:italic !important;">
											NIF: 
										</td>
										<td>
											B63264915
										</td>
									</tr>
									<tr>
										<td style="font-style:italic !important;">
											Teléfono:
										</td>
										<td>
											93 717 83 35 | Móbil: 687 863 714
										</td>
									</tr>
									<tr>
										<td style="font-style:italic !important;color:#B9996F;">
											Web: 
										</td>
										<td style="font-style:italic !important;color:#B9996F;">
											www.gumen-catering.com
										</td>
									</tr>
								</table>
								<table style="padding:0px !important;margin-top:30px;" cellspacing="0" cellpadding="0">
									<tr>
										<td>
											Factura para:
										</td>
									</tr>
									<tr>
										<td style="font-size:17px !important;color:#B9996F;font-weight:bold !important;">
											XXXX XXXX
										</td>
									</tr>
								</table>
								<table style="padding:0px !important;margin-top:30px;" cellspacing="0" cellpadding="0">
									<tr>
										<td style="font-style:italic !important;width:80px;">
											Dirección:
										</td>
										<td>
											xxxxxxxxxxx
										</td>
									</tr>
									<tr>
										<td style="font-style:italic !important;">
											Teléfono:
										</td>
										<td>
											(+34) xxx.xx.xx
										</td>
									</tr>
									<tr>
										<td style="font-style:italic !important;">
											NIF:
										</td>
										<td>
											xxxxxxxx-X
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<div style="position:absolute;top:50px;right:60px;width:200px !important;">
					<span style="font-size:60px !important;color:#B9996F;vertical-align:top !important;">
						Factura
					</span>
					<div style="position:relative !important;top:-15px;left:5px;width:200px;">
						<span>
							<span style="text-align:left !important;">
								n º
							</span>
							<span style="text-align:right !important;letter-spacing: 5px;">
								XXXXXXXXX
							</span>
						</span>
					</div>
					<table style="padding:0px !important;margin-top:25px;font-size:13px;width:100%;" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								Fecha factura:
							</td>
							<td style="text-align:right !important;">
								30/05/2017
							</td>
						</tr>
						<tr>
							<td>
								ID cliente: 
							</td>
							<td style="text-align:right !important;">
								XXXXXXXX
							</td>
						</tr>
					</table>
				</div>
				


        <!-- End Header section -->
        
        <!--billing section -->
        <!-- <table style="width:100%;padding-left:10px;" class="header_background white_text">
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
        </table> -->
        <!-- end billing section -->
        
      </div>

      <table style="width:100%;" cellspacing="0" cellpadding="0">
      	<tbody style="background:#B9996F !important;color:#fff !important;font-weight:bold;font-size:16px;">
					<tr style="background:#B9996F !important;border:none !important;">
						<td style="padding:25px;width:15px;">
						</td>
						<td style="width:250px;text-align:left !important;">
							Descripción
						</td>
						<td style="text-align:center !important;">
							Precio unitario 
						</td>
						<td style="text-align:center !important;">
							Cantidad
						</td>
						<td style="text-align:right !important;">
							Total
						</td>
						<td style="width:55px !important;">
						</td>
					</tr>
				</tbody>
				<tbody style="font-size:13px !important;color:#000 !important;background:#fff !important;">
					<tr style="border:none !important;">
						<td style="padding:30px;border-bottom:1px solid #999C9C !important;">
						</td>
						<td style="text-align:left !important;border-bottom:1px solid #999C9C !important;">
							<span style="line-height:1pt;">Menú diario</span><br>
							<span style="color:#696969 !important;">Primer plato + Segundo plato + Postre</span>
						</td>
						<td style="text-align:center !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							5,99 €							
						</td>
						<td style="text-align:center !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							2
						</td>
						<td style="text-align:right !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							11,98 €
						</td>
						<td style="border-bottom:1px solid #999C9C !important;width:15px !important;">
						</td>
					</tr>
					<tr style="border:none !important;">
						<td style="padding:30px;border-bottom:1px solid #999C9C !important;">
						</td>
						<td style="text-align:left !important;border-bottom:1px solid #999C9C !important;">
							<span style="line-height:1pt;">Menú diario</span><br>
							<span style="color:#696969 !important;">Primer plato + Segundo plato + Postre</span>
						</td>
						<td style="text-align:center !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							5,99 €							
						</td>
						<td style="text-align:center !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							2
						</td>
						<td style="text-align:right !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							11,98 €
						</td>
						<td style="border-bottom:1px solid #999C9C !important;">
						</td>
					</tr>
					<tr style="border:none !important;">
						<td style="padding:30px;border-bottom:1px solid #999C9C !important;">
						</td>
						<td style="text-align:left !important;border-bottom:1px solid #999C9C !important;">
							<span style="line-height:1pt;">Menú diario</span><br>
							<span style="color:#696969 !important;">Primer plato + Segundo plato + Postre</span>
						</td>
						<td style="text-align:center !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							5,99 €							
						</td>
						<td style="text-align:center !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							2
						</td>
						<td style="text-align:right !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							11,98 €
						</td>
						<td style="border-bottom:1px solid #999C9C !important;">
						</td>
					</tr>
					<tr>
						<td colspan="4" style="padding-top:10px;text-align:right !important;padding-right:70px;color:#696969 !important;">Subtotal</td>
						<td style="text-align:right !important;padding-top:15px;">71,98 €</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="4" style="padding-top:10px;text-align:right !important;padding-right:70px;color:#696969 !important;">Descuento</td>
						<td style="text-align:right !important;padding-top:10px;">6,98 €</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="4" style="padding-top:10px;text-align:right !important;padding-right:70px;color:#696969 !important;">IVA (21%)</td>
						<td style="text-align:right !important;padding-top:10px;">15,11 €</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td colspan="2" style="padding-top:15px;text-align:right !important;padding-left:70px;">
							<div style="padding-top:20px;padding-bottom:20px;background:#B9996F !important;padding-right:70px;color:#fff !important;font-weight:bold !important;font-size:16px !important;">Total pedido</div>
						</td>
						<td style="text-align:right !important;padding-top:15px;">
							<div style="padding-top:20px;padding-bottom:20px;background:#B9996F !important;color:#fff !important;font-weight:bold !important;font-size:16px !important;">80,99 €</div>
						</td>
						<td style="padding-top:15px;">
							<div style="padding-top:20px;padding-bottom:20px;background:#B9996F !important;font-weight:bold !important;font-size:16px !important;">&nbsp;</div>
						</td>
					</tr>
					<tr>
						<td style="padding-top:80px;"></td>
						<td colspan="5" style="padding-top:80px;">
							<p style="font-size:16px !important;font-style:italic !important;">Gracias por su pedido!</p>
						</td>
					</tr>
					<tr>
						<td style="padding-top:10px !important;"></td>
						<td colspan="5">
							<p style="font-size:10px !important;color:#696969 !important;">Cumplimos la ley de protección de datos 37738:9/9, para cualquier consulta, pueden ejercer sus derechos notificándolo a Gumen Càtering S.L.<br> Ins. Reg. Mercantil de Barcelona, Tomo 35808, Folio 141, Hoja B266855, Inscrip. 1ª B63264915</p>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<!-- <div class="bg-img" style="background-image: url('assets/cc/img/footer.png');background-repeat: no-repeat !important;background-position: center right !important;background-color: #ccc !important;border: 1px solid !important;width: 100% !important;background-size: cover !important;height: 10em !important;">
								<div>
								<div style="width:300px !important;height:10em;background:#353C36;">
				          <img src="./assets/cc/img/gumen-logo.png" alt="Gumen-Catering" style="text-align:center;margin-top:30px;margin-left:40px;">
				        </div>
			        </div> -->
			        <div class="bg-img" style="background-image: url('assets/cc/img/footer.jpg');background-repeat: no-repeat !important;background-position: center left !important;background-color: #ccc !important;border: 1px solid !important;background-size: cover !important;height: 130px !important;">
			        </div>
						</td>
					</tr>
				</tbody>
			</table>

      <!-- Order section -->
      <!-- <table style="width:100%;margin:0px;border-collapse:collapse;background-color:<?=$color3?>;" id="order-table">
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
      </table> -->
      <!-- end order section -->
    </div>
  </body>
</html>