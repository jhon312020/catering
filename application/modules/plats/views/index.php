<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('platos'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/plats/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<th><?php echo lang('name_of_the_plate'); ?></th>
			<th><?php echo lang('edit'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$date = '';
		$bgclass = '';
		$topClass = '';
		foreach ($plats as $plat) {
			if($bgclass == '') {
					$bgclass = 'trgreybg';
				} else {
				if($bgclass == 'trgreybg') {
						$bgclass = 'trwhitebg';
					} else {
						$bgclass = 'trgreybg';
					}
				}
		?>
			<tr class="<?php echo $bgclass.' '.$topClass; ?>">
				<td class=""><?php echo $plat->Plat; ?></td>
				<td class="">
					<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/plats/view/' . $plat->Id); ?>">
						<i class="entypo-eye"></i>
					</a>
					<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/plats/edit/' . $plat->Id); ?>">
						<i class="entypo-pencil"></i>
					</a>
					<a class="btn btn-warning btn-sm <?php echo $plat->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/plats/toggle/' . $plat->Id . '/' . $plat->is_active); ?>">
						<i class="entypo-check" title="<?php echo $plat->is_active ? 'Active' : 'In Active'; ?>"></i>
					</a>
					<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/plats/delete/' . $plat->Id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
						<i class="entypo-trash"></i>
					</a>
				</td>
			</tr>
		<?php 
			
			}
		?>
	</tbody>
</table>