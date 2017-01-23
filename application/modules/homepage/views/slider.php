<!-- <ol class="breadcrumb bc-3">
	<li>
		<a href="<?php echo site_url('admin/dashboard'); ?>"><i class="entypo-home"></i><?php echo lang('home'); ?></a>
	</li>
	<li class="active">
		<strong><?php echo lang('slider'); ?></strong>
	</li>
</ol> -->
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('slider'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/homepage/form/slider'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
            <th><?php echo lang('id'); ?></th>
            <th><?php echo lang('slogan') . ' (EN)'; ?></th>
            <th><?php echo lang('slogan') . ' (ES)'; ?></th>
			<th><?php echo lang('images'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($sliders as $slider) { ?>
		<tr>
			<td><?php echo $slider->id; ?></td>
			<td><?php echo $slider->slogan_en; ?></td>
			<td><?php echo $slider->slogan_es; ?></td>
			<td><img src ="<?php echo $path . '/slider/' .$slider->image; ?>" width='150'/></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/homepage/form/slider/' . $slider->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-warning btn-sm <?php echo $slider->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/homepage/slidtoggle/' . $slider->id . '/' . $slider->is_active); ?>">
					<i class="entypo-check" title="<?php echo $slider->is_active ? 'Active' : 'In Active'; ?>"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/homepage/delete/slider/' . $slider->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
