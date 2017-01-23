<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('list_cars'); ?></h1>		
		<a class="pull-right btn btn-primary" href="<?php echo site_url('admin/routes/carForm'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<div class="row">
	<div class="table-responsive">
		<table class="table table-bordered datatable data_table">
			<thead>
				<tr>
					<th><?php echo lang('car_name'); ?></th>
					<th><?php echo lang('email'); ?></th>
					<th width="25%;"><?php echo lang('options'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($cars as $car) { ?>
				<tr>
					<td style="color:#F27D00;"><?php echo $car->car_name; ?></td>
					<td style="color:#F27D00;"><?php echo $car->email; ?></td>
					
					<td>				
						<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/routes/carView/' . $car->id); ?>">
							<i class="entypo-eye"></i>
						</a>
						<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/routes/carForm/' . $car->id); ?>">
							<i class="entypo-pencil"></i>
						</a>
						<a class="btn btn-warning btn-sm <?php echo $car->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/routes/carToggle/' . $car->id . '/' . $car->is_active); ?>">
							<i class="entypo-check" title="<?php echo $car->is_active ? 'Active' : 'In Active'; ?>"></i>
						</a>
						<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/routes/carDelete/' . $car->id); ?>" onclick="return confirm('<?php echo lang('delete_record_cars'); ?>');">
							<i class="entypo-trash"></i>
						</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div> 
