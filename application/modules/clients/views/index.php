<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('validation_pending'); ?></h1>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
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
		<?php foreach ($pending_clients as $client) { ?>
			<tr>
				<td class=""><?php echo $client->client_code; ?></td>
				<td class=""><?php echo $client->name; ?></td>
				<td class=""><?php echo $client->surname; ?></td>
				<td class=""><?php echo $client->business; ?></td>
				<td class="">
					<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/clients/view/' . $client->id); ?>">
						<i class="entypo-eye"></i>
					</a>
					<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/clients/form/' . $client->id); ?>">
						<i class="entypo-pencil"></i>
					</a>
					<a class="btn btn-warning btn-sm <?php echo $client->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/clients/toggle/' . $client->id . '/' . $client->is_active); ?>">
						<i class="entypo-check" title="<?php echo $client->is_active ? 'Active' : 'In Active'; ?>"></i>
					</a>
					<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/clients/delete/' . $client->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
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
		<?php foreach ($clients_list as $client) { ?>
			<tr>
				<td class=""><?php echo $client->client_code; ?></td>
				<td class=""><?php echo $client->name; ?></td>
				<td class=""><?php echo $client->surname; ?></td>
				<td class=""><?php echo $client->business; ?></td>
				<td class="">
					<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/clients/view/' . $client->id); ?>">
						<i class="entypo-eye"></i>
					</a>
					<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/clients/form/' . $client->id); ?>">
						<i class="entypo-pencil"></i>
					</a>
					<a class="btn btn-warning btn-sm <?php echo $client->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/clients/toggle/' . $client->id . '/' . $client->is_active); ?>">
						<i class="entypo-check" title="<?php echo $client->is_active ? 'Active' : 'In Active'; ?>"></i>
					</a>
					<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/clients/delete/' . $client->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
						<i class="entypo-trash"></i>
					</a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>