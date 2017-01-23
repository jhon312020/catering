<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('collaborators'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/collaborators/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
            <th width="20%"><?php echo lang('name'); ?></th>
			<th width="25%"><?php echo lang('bcn_area'); ?></th>
			<th><?php echo lang('rate'); ?></th>
			<th><?php echo lang('no_of_available_seats'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($collaborators as $collaborator) { ?>
		<tr>
			<td><?php echo ucfirst($collaborator->name); ?></td>
			<td><?php echo $collaborator->bcnarea != ''?$collaborator->bcnarea : $bcn[$collaborator->zone]; ?></td>
			<td><?php echo $collaborator->price; ?></td>
			<td><?php echo $collaborator->available_seats == 'activate' ? $collaborator->no_of_available_seats : 'Not activated'; ?></td>
			<td>
				<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/collaborators/view/' . $collaborator->id); ?>">
					<i class="entypo-eye"></i>
				</a>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/collaborators/form/' . $collaborator->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-warning btn-sm <?php echo $collaborator->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/collaborators/toggle/' . $collaborator->id . '/' . $collaborator->is_active); ?>">
					<i class="entypo-check" title="<?php echo $collaborator->is_active ? 'Active' : 'In Active'; ?>"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/collaborators/delete/' . $collaborator->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
