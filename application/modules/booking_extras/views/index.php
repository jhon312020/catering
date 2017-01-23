<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('booking_extras'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/booking_extras/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
            <th><?php echo lang('title'); ?></th>
			<th><?php echo lang('image'); ?></th>
			<th><?php echo lang('info'); ?></th>
			<th><?php echo lang('price'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($booking_extras as $booking_extra) { ?>
		<tr>
			<td><?php echo $booking_extra->title; ?></td>
			<td>
				<?php 
					echo "<img src ='$path$booking_extra->image'>";
				?>
			</td>
			<td><?php echo $booking_extra->subtitle; ?></td>
			<td><?php echo $booking_extra->price; ?></td>
			<td>
				<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/booking_extras/view/' . $booking_extra->id); ?>">
					<i class="entypo-eye"></i>
				</a>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/booking_extras/form/' . $booking_extra->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-warning btn-sm <?php echo $booking_extra->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/booking_extras/toggle/' . $booking_extra->id . '/' . $booking_extra->is_active); ?>">
					<i class="entypo-check" title="<?php echo $booking_extra->is_active ? 'Active' : 'In Active'; ?>"></i>
				</a>
				<!-- <a class="btn btn-danger btn-sm" href="<?php //echo site_url('admin/booking_extras/delete/' . $booking_extra->id); ?>" onclick="return confirm('<?php //echo lang('delete_record_warning'); ?>');" > -->
					<!-- <i class="entypo-trash"></i> -->
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
