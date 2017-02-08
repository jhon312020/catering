<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('cool_drinks'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/drinks/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<th><?php echo lang('id'); ?></th>
			<th><?php echo lang('drinks_name'); ?></th>
			<th><?php echo lang('price'); ?></th>
			<th><?php echo lang('edit'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($cool_drinks as $drink) { ?>
		<tr>
			<td><?php echo $drink->id; ?></td>
			<td><?php echo $drink->drinks_name; ?></td>
			<td><?php echo $drink->price; ?></td>
			<td>
				<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/drinks/view/' . $drink->id); ?>">
					<i class="entypo-eye"></i>
				</a>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/drinks/form/' . $drink->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-warning btn-sm <?php echo $drink->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/drinks/toggle/' . $drink->id . '/' . $drink->is_active); ?>">
					<i class="entypo-check" title="<?php echo $drink->is_active ? 'Active' : 'In Active'; ?>"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/drinks/delete/' . $drink->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>