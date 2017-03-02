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
								<?php echo str_replace(',','',$order->business); ?>
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
								$order_detail = json_decode($order->order_detail,true);
		                      	unset($order_detail['order_code']);
		                      	$order_detail = array_values($order_detail); 
		                      	$description = array();
			                    foreach ($order_detail as $order_det) {
			                      if (!is_array($order_det))
			                        continue;
			                      foreach ($order_det as $key=>$orders) {
			                        if (!is_integer($key))
			                          continue;
			                        $order_array = $orders['order'];
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

			                        if (isset($orders['cool_drink'])) {
			                          foreach ($orders['cool_drink'] as $drinks) {
			                            $description[] = $cool_drink_list[$drinks];
			                          }  
			                        }
			                        
			                      }
			                    }
									echo implode(', ', $description);
								?>
								, pan, aceite, vinagre y cubietros
								</span></p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
						<?php echo $this->layout->load_view('layout/header_buttons'); ?>
						</div>
					</div>
			</form>
			</div>
		</div>
	</div>
<script type="text/javascript">
$(document).ready(function(){
});
</script>