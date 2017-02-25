<div class="headerbar clearfix">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('statistics'); ?></h1>
		<span class="pull-right">
		<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			<span></span> <b class="caret"></b>
		</div>
		</span>
		<form method="POST" id="jStatisticsForm">
			<input type="hidden" name="from_date" >
			<input type="hidden" name="to_date" >
		</form>
	</div>
</div>
<div class="clearfix-header"></div>
<br/>
<?php 
echo $this->layout->load_view('layout/alerts');

$menu_income_html = '';
foreach($menu_income as $menu=>$income) {
	$menu_income_html .= '<p class="totalSpan">'.$income.' - '.$menu.'</p>';
}
$payment_income_html = '';
foreach($payment_income as $payment_method=>$income) {
	$payment_income_html .= '<p class="totalSpan">'.$income.' - '.lang(strtolower($payment_method)).'</p>';
}
?>
<div class="row">
	<div class="col-sm-4">	
		<div class="tile-stats tile-purple-dark" style="background-color:#8EC63F;">
			<div class="num"><?php echo array_sum($menu_income).' '.lang('menus_cms'); ?></div>
			<div class="priceDiv">
			<?php echo $menu_income_html; ?>
			</div>
		</div>
	</div>
	<div class="col-sm-3">	
		<div class="tile-stats tile-purple-dark" style="background-color:#BA9551;">
			<div class="num" ><?php echo array_sum($payment_income); ?> &euro;</div>
			<div class="priceDiv">
				<?php echo $payment_income_html; ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() {

    var start = moment('<?php echo $from_date; ?>','YYYY-MM-DD');
    var end = moment('<?php echo $to_date; ?>','YYYY-MM-DD');

    function cb(start, end) {
    	/*start.locale('es');
    	end.locale('es');*/
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('input[name=from_date]').val(start.format('YYYY-MM-DD'));
        $('input[name=to_date]').val(end.format('YYYY-MM-DD'));
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
    }, submit_form);

    function submit_form(start, end) {
    	cb(start,end);
    	$('#jStatisticsForm').submit();
    }

    cb(start, end);
    
});
</script>