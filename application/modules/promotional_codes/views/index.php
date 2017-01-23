<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('promotional_codes'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/promotional_codes/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
            <th><?php echo lang('code'); ?></th>
			<th><?php echo lang('discount_type'); ?></th>
			<th><?php echo lang('price_or_percentage'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($promotional_codes as $promotional_code) { ?>
		<tr>
			<td><?php echo $promotional_code->code; ?></td>
			<td><?php echo $promotional_code->discount_type; ?></td>
			<td><?php echo $promotional_code->price_or_percentage; ?></td>
			<td>
				<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/promotional_codes/view/' . $promotional_code->id); ?>">
					<i class="entypo-eye"></i>
				</a>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/promotional_codes/form/' . $promotional_code->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-warning btn-sm <?php echo $promotional_code->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/promotional_codes/toggle/' . $promotional_code->id . '/' . $promotional_code->is_active); ?>">
					<i class="entypo-check" title="<?php echo $promotional_code->is_active ? 'Active' : 'In Active'; ?>"></i>
				</a>
				<!-- <a class="btn btn-danger btn-sm" href="<?php //echo site_url('admin/promotional_codes/delete/' . $promotional_code->id); ?>" onclick="return confirm('<?php //echo lang('delete_record_warning'); ?>');" > -->
					<!-- <i class="entypo-trash"></i> -->
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
