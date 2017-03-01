<div class="headerbar">
	<div class="clearfix">
		<div class="row">
			<div class="col-sm-4">
				<h1 class="pull-left"><?php echo lang('orders'); ?></h1> 
				<h1>&nbsp;<span class="dateSpan"><?php echo date('d/m/Y', strtotime($order_date)); ?> </span></h1>
			</div>
			<div class="col-sm-4">
				<form method="post" class="order-form">
					<input type='hidden' class="form-control datepicker12" name="order_date" value="<?php echo $order_date; ?>" />
					<input type="hidden" id="past" name="past" value="0" />
				</form>
				<h1><span class="spancal glyphicon glyphicon-calendar" ></span></h1>
			</div>
			<div class="col-sm-2 btn btn-primary pull-right" id="jPastButton" style="margin-right:15px;">
				<i class="icon-plus icon-white"></i> <?php echo lang('past'); ?>
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
		<?php foreach ($orders as $order) { $order_details = json_decode($order->order_detail); ?>
			<tr>
				<td class=""><?php echo $order->client_code . '<br/>Order Ref : '. $order->reference_no; ?></td>
				<td class=""><?php echo date('d/m/Y', strtotime($order->order_date)); ?></td>
				<td class=""><?php echo $order->name . ' ' . $order->surname; ?></td>
				<td class=""><?php echo $order->business.' - '.$order->Centre; ?></td>
				<td class=""><?php echo lang($order->payment_method); ?></td>
				<td class=""><?php echo str_replace(',','',$order->order_code); ?></td>
				<td class=""><?php echo getDrinksInformation($order->id, $drinks_list); ?></td>
				<td class="">
					<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/orders/view/' . $order->id); ?>">
						<i class="entypo-eye"></i>
					</a>
					<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/orders/form/' . $order->id); ?>">
						<i class="entypo-pencil"></i>
					</a>
					<!-- <a class="btn btn-warning btn-sm <?php echo $order->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/orders/toggle/' . $order->id . '/' . $order->is_active); ?>">
						<i class="entypo-check" title="<?php echo $order->is_active ? 'Active' : 'In Active'; ?>"></i>
					</a> -->
					<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/orders/delete/' . $order->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
						<i class="entypo-trash"></i>
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
var excel_title = '<?php echo $export_title; ?>';
$(document).ready(function() {
	$('.datepicker12').datepicker({
		format:'yyyy-mm-dd',
		autoclose:true,
	}).on('show', function(e) {
			$('.datepicker-dropdown').css({top:$('.spancal').offset().top + $('.spancal').height(), left:$('.spancal').offset().left})
	}).on('changeDate', function(e) {
		$('form.order-form').submit();
	});
	$(document).on('click', '#jPastButton', function(){
		$('#past').val('1');
		$('form.order-form').submit();
	});
	$(document).on('click', '.spancal', function(){
		$('.datepicker12').datepicker('show');
	});
	var length = $("#jsOrders thead tr th").length-1;
	var array = new Array();
	for(var i = 0; i < length; i++){
		array.push(i);
	}
	
	$('#jsOrders').DataTable({
		"sPaginationType": "bootstrap",
		"aLengthMenu": [[25, 50, -1], [25, 50, "All"]],
		"bStateSave": false,
		"order": [[0,"desc"]],
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
					/* modifier: {
						search: 'none'
					} */
				}
			}
			//'colvis'
		],
    });
});
</script>