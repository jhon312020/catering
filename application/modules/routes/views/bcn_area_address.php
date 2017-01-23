<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('bcn_area_address'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/routes/bcn_address_form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<th><?php echo lang('postal_code'); ?></th>
            <th width="100px;"><?php echo 'Zone'; ?></th>
			<th width="200px;"><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($places as $place) { ?>
		<tr>
			<td><?php echo $place->postal_code; ?></td>
			<td><?php echo $place->name; ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/routes/bcn_address_form/' . $place->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-warning btn-sm <?php echo $place->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/routes/bcn_addresstoggle/' . $place->id . '/' . $place->is_active); ?>">
					<i class="entypo-check" title="<?php echo $place->is_active ? 'Active' : 'In Active'; ?>"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/routes/delete_bcn/' . $place->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>