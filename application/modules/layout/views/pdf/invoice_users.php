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

	  /*if (strlen((string)$reference_no) < 9) {
	    $reference_no = sprintf("%09s", $reference_no);
	  } */
	?>
  <body style="font-family:Helvetica">
    <div style="width:100%;">
      <div class="header_background white_text" style="padding-bottom:20px;">
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
											<?php echo $orders[0]['invoice_to']; ?>
										</td>
									</tr>
								</table>
								<table style="padding:0px !important;margin-top:30px;" cellspacing="0" cellpadding="0">
									<tr>
										<td style="font-style:italic !important;width:80px;">
											Dirección:
										</td>
										<td>
											<?php echo $orders[0]['address']; ?>
										</td>
									</tr>
									<tr>
										<td style="font-style:italic !important;">
											Teléfono:
										</td>
										<td>
											<?php echo $orders[0]['phone']; ?>
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
								
							</span>
						</span>
					</div>
					<table style="padding:0px !important;margin-top:25px;font-size:13px;width:100%;" cellspacing="0" cellpadding="0">
						<tr>
							<td>
								Fecha factura:
							</td>
							<td style="text-align:right !important;">
								<?php echo date('d/m/Y'); ?>
							</td>
						</tr>
						<tr>
							<td>
								ID cliente: 
							</td>
							<td style="text-align:right !important;">
								<?php echo $orders[0]['code']; ?>
							</td>
						</tr>
					</table>
				</div>
      </div>

      <table style="width:100%;" cellspacing="0" cellpadding="0">
      	<tbody style="background:#B9996F !important;color:#fff !important;font-weight:bold;font-size:16px;">
					<tr style="background:#B9996F !important;border:none !important;">
						<td style="padding:25px;width:15px;">
						</td>
						<td style="width:250px;text-align:center !important;">
							Date
						</td>
						<td style="text-align:center !important;">
							Client code 
						</td>
						<td style="text-align:right !important;">
							Cost
						</td>
						<td style="width:55px !important;">
						</td>
					</tr>
				</tbody>
				<tbody style="font-size:13px !important;color:#000 !important;background:#fff !important;">
					<?php
          $total_price = 0;
          $bool = false;
          if($orders) {
            $bool = true;
            foreach($orders as $order) {
          ?>
          <tr class="order-row">
          	<td style="padding:15px;border-bottom:1px solid #999C9C !important;">
						</td>
            <td style="padding:15px;text-align:center !important;border-bottom:1px solid #999C9C !important;">
              	<span style="line-height:1pt;">
                  <?php echo date('d/m/Y', strtotime($order['created_at'])); ?>
              	</span>
            </td>
            <td style="padding:15px;text-align:center !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							<?php echo $order['code']; ?>
						</td>
						<td style="padding-top:15px;padding-bottom:15px;text-align:right !important;border-bottom:1px solid #999C9C !important;color:#696969 !important;">
							<?php echo $order['price']; ?> &euro;
						</td>
						<td style="padding:15px;border-bottom:1px solid #999C9C !important;width:15px !important;">
						</td>
          </tr>
          <?php
              $total_price += $order['price'];
            }
          }
          ?>
					<tr>
						<td colspan="3" style="padding-top:10px;text-align:right !important;padding-right:70px;color:#696969 !important;">Subtotal</td>
						<?php 
							$subtotal = $total_price;
							
							$iva_price = $subtotal*10/100;
							$overall_total = $subtotal;
						?>
						<td style="text-align:right !important;padding-top:15px;"><?php echo number_format($subtotal-$iva_price,2,'.',''); ?> &euro;</td>
						<td></td>
					</tr>
					
					<tr>
						<td colspan="3" style="padding-top:10px;text-align:right !important;padding-right:70px;color:#696969 !important;">IVA (10%)</td>
						<td style="text-align:right !important;padding-top:10px;"><?php echo number_format($iva_price,2,'.',''); ?> &euro;</td>
						<td></td>
					</tr>
					<?php

					?>
					<tr>
						<td colspan="2"></td>
						<td colspan="" style="padding-top:15px;text-align:right !important;padding-left:70px;">
							<div style="padding-top:20px;padding-bottom:20px;background:#B9996F !important;padding-right:70px;color:#fff !important;font-weight:bold !important;font-size:16px !important;">Total pedido</div>
						</td>
						<td style="text-align:right !important;padding-top:15px;">
							<div style="padding-top:20px;padding-bottom:20px;background:#B9996F !important;color:#fff !important;font-weight:bold !important;font-size:16px !important;"><?php echo number_format($overall_total,2,'.',''); ?> &euro;</div>
						</td>
						<td style="padding-top:15px;">
							<div style="padding-top:20px;padding-bottom:20px;background:#B9996F !important;font-weight:bold !important;font-size:16px !important;">&nbsp;</div>
						</td>
					</tr>
					<tr>
						<td style="padding-top:80px;"></td>
						<td colspan="4" style="padding-top:80px;">
							<p style="font-size:16px !important;font-style:italic !important;">Gracias por su pedido!</p>
						</td>
					</tr>
					<tr>
						<td style="padding-top:10px !important;"></td>
						<td colspan="4">
							<p style="font-size:10px !important;color:#696969 !important;">Cumplimos la ley de protección de datos 37738:9/9, para cualquier consulta, pueden ejercer sus derechos notificándolo a Gumen Càtering S.L.<br> Ins. Reg. Mercantil de Barcelona, Tomo 35808, Folio 141, Hoja B266855, Inscrip. 1ª B63264915</p>
						</td>
					</tr>
					<tr>
						<td colspan="5">
			        <div class="bg-img" style="background-image: url('assets/cc/img/footer.jpg');background-repeat: no-repeat !important;background-position: center left !important;background-color: #ccc !important;border: 1px solid !important;background-size: cover !important;height: 130px !important;">
			        </div>
						</td>
					</tr>
				</tbody>
			</table>
    </div>
  </body>
</html>