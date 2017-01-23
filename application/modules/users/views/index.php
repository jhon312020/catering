<div class="headerbar">
	<h1><?php echo lang('users'); ?></h1>
	

</div>
<div class="row">
	<div class="col-md-12">
	<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/users/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a></div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
			<th><?php echo lang('name'); ?></th>
            <th><?php echo lang('user_type'); ?></th>
			<th><?php echo lang('email_address'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($users as $user) { ?>
		<tr>
			<td><?php echo $user->first_name . ' ' . $user->last_name; ?></td>
            <td><?php echo $user_types[$user->role]; ?></td>
			<td><?php echo $user->email; ?></td>
			<td>
				<a class="btn btn-default btn-sm btn-icon icon-left" href="<?php echo site_url('admin/users/form/' . $user->id); ?>">
					<i class="entypo-pencil"></i> <?php echo lang('edit'); ?>
				</a>
				<a class="btn btn-danger btn-sm btn-icon icon-left" href="<?php echo site_url('admin/users/delete/' . $user->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
					<i class="entypo-trash"></i> <?php echo lang('delete'); ?>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
