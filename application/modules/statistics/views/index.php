<div class="headerbar">
	<h1><?php echo lang('statistics'); ?></h1>
</div>
<br/>
<?php 
echo $this->layout->load_view('layout/alerts'); 
?>
<div class="row">
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#8EC63F;">
			<div class="num statSpan" data-start="0" data-end="<?php echo $overall_total_menus; ?>" data-postfix="&nbsp;<?php echo lang('menus'); ?>" data-duration="1400" data-delay="0">0</div>
			<div class="priceDiv">
			<?php 
			foreach($menus as $menu) {
			?>
			<p class="totalSpan"><?php echo $menu['total'].' '.lang('menus').' '.$menu['name']; ?></p>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#BA9551;">
			<div class="num" data-start="0" data-end="<?php echo $total_income; ?>" data-postfix=" &euro;" data-duration="1400" data-delay="0">0</div>
			
			<div class="priceDiv">
			<?php 
			foreach($total_income_by_payments as $payment) {
			?>
			<p class="totalSpan"><?php echo $payment['total_income'].' - '.$payment['payment_method']; ?></p>
			<?php } ?>
			</div>
		</div>
		
	</div>
</div>	
