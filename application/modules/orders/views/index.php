<style>
#jsOrders_filter label {
	display: none;
}
</style>
<div class="headerbar">
	<div class="clearfix">
		<div class="row">
			<div class="col-sm-5">
				<h1 class="pull-left"><?php echo lang('orders'); ?>
				&nbsp;<span class="dateSpan"><?php echo date('d/m/Y', strtotime($order_date)); ?> </span> <span class="spancal glyphicon glyphicon-calendar" ></span></h1>
				<form method="post" class="order-form">
					<input type='hidden' class="form-control datepicker12" name="order_date" value="<?php echo $order_date; ?>" />
					<input type="hidden" id="past" name="past" value="0" />
				</form>
			</div>
			<div class="col-sm-7">
			<!-- <button class="btn btn-primary pull-right" id="jPastButton" style="float:right;">
			 <?php //echo lang('archive'); ?></button> -->
			 <a class="btn btn-primary pull-right" style="float:right;" href="<?php echo site_url('admin/orders/past'); ?>" >
			 <?php echo lang('archive'); ?></a>
			</div>
		</div>
		<?php /* <a class="btn btn-primary pull-right" href="<?php echo site_url('admin/orders/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a> */ ?>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<table class="table table-bordered datatable" id ="jsOrders">
	<thead>
		<tr>
			<th><?php echo lang('client_code'); ?></th>
			<th><?php echo lang('date'); ?></th>
			<th><?php echo lang('name'); ?></th>
			<th><?php echo lang('business_title'); ?></th>
			<th><?php echo lang('payment_method'); ?></th>
			<th><?php echo lang('menu_cms'); ?></th>
			<th><?php echo lang('cool_drinks'); ?></th>
			<th><?php echo lang('edit'); ?></th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<script type="text/javascript">
var excel_title = '<?php echo $export_title; ?>';
$(document).ready(function() {
	$('.datepicker12').datepicker({
		format:'yyyy-mm-dd',
		autoclose:true,
		weekStart: 1
	}).on('show', function(e) {
			$('.datepicker-dropdown').css({top:$('.spancal').offset().top + $('.spancal').height(), left:$('.spancal').offset().left})
	}).on('changeDate', function(e) {
		$('form.order-form').submit();
	});
	/*$(document).on('click', '#jPastButton', function(){
		$('#past').val('1');
		$('form.order-form').submit();
	});*/
	$(document).on('click', '.spancal', function(){
		$('.datepicker12').datepicker('show');
	});
	var length = $("#jsOrders thead tr th").length-1;
	var array = new Array();
	for(var i = 0; i < length; i++){
		array.push(i);
	}

	var past = "<?php echo $past; ?>";
	
	$('#jsOrders').DataTable({
		"sPaginationType": "bootstrap",
		"aLengthMenu": [[25, 50, -1], [25, 50, "All"]],
		"bStateSave": true,
		"bSort":false,
		//"order": [[0,"desc"]],
		"oLanguage": {
				"sUrl": "http://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json"
		},
		"dom": 'lBfrtip',
		"buttons": [
			{
				extend: 'excel',
				text: 'Export Excel',
				title: excel_title,
				exportOptions: {
					columns:array
				}
			}
		],
		"bProcessing": true,
        "serverSide": true,
        "ajax":{
            url :"<?php echo site_url('admin/orders/datasource'); ?>", // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            data: {"order_date":"<?php echo $order_date; ?>","past":<?php echo $past; ?>},
            error: function(){
              //$("#employee_grid_processing").css("display","none");
            }
        },
        bAutoWidth: false
    });

});
</script>