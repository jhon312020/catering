<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('business'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/business/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<th><?php echo lang('business_id'); ?></th>
			<th><?php echo lang('business_title'); ?></th>
			<th><?php echo lang('email'); ?></th>
			<th><?php echo lang('telephone'); ?></th>
			<th><?php echo lang('edit'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($business_list as $business) { ?>
		<tr>
			<td><?php echo $business->id; ?></td>
			<td><?php echo $business->name; ?></td>
			<td><?php echo $business->email; ?></td>
			<td><?php echo $business->telephone; ?></td>
			<td>
				<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/business/view/' . $business->id); ?>">
					<i class="entypo-eye"></i>
				</a>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/business/form/' . $business->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-warning btn-sm <?php echo $business->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/business/toggle/' . $business->id . '/' . $business->is_active); ?>">
					<i class="entypo-check" title="<?php echo $business->is_active ? 'Active' : 'In Active'; ?>"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/business/delete/' . $business->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>