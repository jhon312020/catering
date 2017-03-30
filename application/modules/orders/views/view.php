<?php
$readonly = ($readonly)?'readonly':'';
$order_date = date('d/m/Y', strtotime($order->order_date));
$disabled = ($readonly)?'disabled':'';
?>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('menu'); ?> 
			<span class="dateSpan"><?php echo $order_date; ?> </span>
		</h1>
	</div>
</div>
	<div class="row">
		<?php 
		echo $this->layout->load_view('layout/alerts'); 
		foreach($error as $er) {
		?>	
		<div class="alert alert-danger"><?php echo $er; ?></div>
		<?php	} ?>
	</div>	
	<div class="row" id="business">
		<div class="col-md-12 martop menuList">
			<div class="form-content">
				<form method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('menu_type'); ?>:</label>
						<div class="col-sm-10">
							<span class="highlight">
								<?php echo str_replace(',','',$order->order_code); ?>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('client_code'); ?>:</label>
						<div class="col-sm-10">
							<span class="highlight">
								<?php echo str_replace(',','',$order->client_code); ?>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('name'); ?>:</label>
						<div class="col-sm-10">
							<span class="highlight">
								<?php echo str_replace(',','',$order->name); ?>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('business'); ?>:</label>
						<div class="col-sm-10">
							<span class="highlight">
								<?php //echo str_replace(',','',$order->business); 
									echo $order->business.' - '.$order->Centre;
								?>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('telephone'); ?>:</label>
						<div class="col-sm-10">
							<span class="highlight">
								<?php echo str_replace(',','',$order->telephone); ?>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('price'); ?>:</label>
						<div class="col-sm-10">
							<span class="highlight">
								<?php echo str_replace(',','',$order->Total); ?>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left"><?php echo lang('platos');?>: </label>
						<div class="col-sm-10">
								<p><span class="highlight">

									<?php
										if ($order->order_detail != '') {
											$order_detail = json_decode($order->order_detail,true);
					                      	/*unset($order_detail['order_code']);
					                      	$order_detail = array_values($order_detail);*/
								            $description = getOrderDescription($order_detail, $plates, $cool_drink_list);
								            echo '- '.implode('<br/> - ', $description);
								            echo '<br/>- pan, aceite, vinagre y Cubiertos';
							        	} else {
							        		echo 'Imported via MS-Access';
							        	}
						            ?>
								</span></p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
						<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
						<button type="button" formnovalidate class="btn btn-danger jsBtnCancel" name="btn_cancel" value="1"><i class="icon-remove icon-white"></i> <?php echo lang('close'); ?></button>
						</a>
						
						</div>
					</div>
			</form>
			</div>
		</div>
	</div>