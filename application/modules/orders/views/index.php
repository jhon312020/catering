<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('orders'); ?></h1>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<th><?php echo lang('client_code'); ?></th>
			<th><?php echo lang('date'); ?></th>
			<th><?php echo lang('name'); ?></th>
			<th><?php echo lang('business'); ?></th>
			<th><?php echo lang('menu'); ?></th>
			<th><?php echo lang('edit'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($orders as $order) { ?>
			<tr>
				<td class=""><?php echo $order->client_code; ?></td>
				<td class=""><?php echo $order->order_date; ?></td>
				<td class=""><?php echo $order->name; ?></td>
				<td class=""><?php echo $order->business; ?></td>
				<td class=""><?php echo $order->menu; ?></td>
				<td class="">
					<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/clients/view/' . $order->id); ?>">
						<i class="entypo-eye"></i>
					</a>
					<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/clients/form/' . $order->id); ?>">
						<i class="entypo-pencil"></i>
					</a>
					<a class="btn btn-warning btn-sm <?php echo $order->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/clients/toggle/' . $order->id . '/' . $order->is_active); ?>">
						<i class="entypo-check" title="<?php echo $order->is_active ? 'Active' : 'In Active'; ?>"></i>
					</a>
					<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/clients/delete/' . $order->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
						<i class="entypo-trash"></i>
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('clients_list'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/clients/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>
<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<th><?php echo lang('client_code'); ?></th>
			<th><?php echo lang('name'); ?></th>
			<th><?php echo lang('surname'); ?></th>
			<th><?php echo lang('business'); ?></th>
			<th><?php echo lang('edit'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($orders_list as $order) { ?>
			<tr>
				<td class=""><?php echo $order->client_code; ?></td>
				<td class=""><?php echo $order->name; ?></td>
				<td class=""><?php echo $order->surname; ?></td>
				<td class=""><?php echo $order->business; ?></td>
				<td class="">
					<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/clients/view/' . $order->id); ?>">
						<i class="entypo-eye"></i>
					</a>
					<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/clients/form/' . $order->id); ?>">
						<i class="entypo-pencil"></i>
					</a>
					<a class="btn btn-warning btn-sm <?php echo $order->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/clients/toggle/' . $order->id . '/' . $order->is_active); ?>">
						<i class="entypo-check" title="<?php echo $order->is_active ? 'Active' : 'In Active'; ?>"></i>
					</a>
					<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/clients/delete/' . $order->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
						<i class="entypo-trash"></i>
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>