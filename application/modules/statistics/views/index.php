<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('statistics'); ?></h1>
		<span class="pull-right">
		<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			<span></span> <b class="caret"></b>
		</div>
		</span>
	</div>
</div>
<br/>
<?php 
echo $this->layout->load_view('layout/alerts'); 
?>
<div class="row">
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#8EC63F;">
			<div class="num statSpan" data-start="0" data-end="<?php echo $overall_total_menus; ?>" data-postfix="&nbsp;<?php echo lang('menus_cms'); ?>" data-duration="1400" data-delay="0">0</div>
			<div class="priceDiv">
			<?php 
			foreach($menus as $menu) {
			?>
			<p class="totalSpan"><?php echo $menu['total'].' '.lang('menus_cms_stat').' '.$menu['name']; ?></p>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#BA9551;">
			<div class="num" ><?php echo $total_income; ?> &euro;</div>
			
			<div class="priceDiv">
			<?php 
			foreach($total_income_by_payments as $payment) {
			?>
			<p class="totalSpan"><?php echo $payment['total_income'].' - '.lang(strtolower($payment['payment_method'])); ?></p>
			<?php } ?>
			</div>
		</div>
		
	</div>
</div>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});
</script>