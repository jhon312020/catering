<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('menus'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/menus/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
	<form method="post" id="menu_clone" action="<?php echo site_url('admin/menus/clone_records'); ?>">
		<input type='hidden' name="new_clone_date" class="form-control" value="" id="new_clone_date" />
		<input type='hidden' name="clone_of_date" class="form-control" value="" id="clone_of_date" />
	</form>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<th><?php echo lang('date'); ?></th>
			<th><?php echo lang('menu_cms'); ?></th>
			<th><?php echo lang('complement'); ?></th>
			<th><?php echo lang('primary_plate'); ?></th>
			<th><?php echo lang('secondary_plate'); ?></th>
			<th><?php echo lang('postre'); ?></th>
			<th><?php echo lang('edit'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$date = '';
		$bgclass = '';
		$topClass = '';
		foreach ($menus as $menu) {
			$string_to_time = strtotime($menu->menu_date);
			if($date != '' && $date == $menu->menu_date) {
				$topClass = 'topBorder';
			} else {
				$topClass = '';
				if($bgclass == '') {
					$bgclass = 'trgreybg';
				} else {
					if($bgclass == 'trgreybg') {
						$bgclass = 'trwhitebg';
					}
					else {
						$bgclass = 'trgreybg';
					}
				}
			}
		?>
			<tr class="<?php echo $bgclass.' '.$topClass; ?>">
				<td class=""><?php echo !$topClass?date('d/m/Y', $string_to_time):''; ?></td>
				<td class=""><?php echo $menu->menu_name; ?></td>
				<td class=""><?php echo $allPlates[$menu->complement]; ?></td>
				<td class=""><?php echo $allPlates[$menu->primary_plate]; ?></td>
				<td class=""><?php echo $allPlates[$menu->secondary_plate]; ?></td>
				<td class=""><?php echo $allPlates[$menu->postre]; ?></td>
				<td class="">
					<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/menus/view/' . $menu->id); ?>">
						<i class="entypo-eye"></i>
					</a>
					<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/menus/edit/' . $menu->id); ?>">
						<i class="entypo-pencil"></i>
					</a>
					<button class="btn btn-primary btn-sm clone_record" data-button='<?php echo $string_to_time;?> ' >
						<i class="entypo-docs"></i>
					</button>
					<a class="btn btn-warning btn-sm <?php echo $menu->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/menus/toggle/' . $menu->id . '/' . $menu->is_active); ?>">
						<i class="entypo-check" title="<?php echo $menu->is_active ? 'Active' : 'In Active'; ?>"></i>
					</a>
					<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/menus/delete/' . $menu->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
						<i class="entypo-trash"></i>
					</a>
				</td>
			</tr>
		<?php 
			$date = $menu->menu_date;
			} 
		?>
	</tbody>
</table>
<script>
$(document).ready(function(){
	$('.topBorder').prev().addClass('bottomBorder');
	$('.clone_record').datepicker({
		format:'dd-mm-yyyy',
		autoclose:true,
		startDate:new Date(),
		daysOfWeekDisabled: [0, 6],
		weekStart: 1
	}).on('show', function(e) {
			$('.datepicker-dropdown').css({top:$(this).offset().top + $(this).height(), left:$(this).offset().left})
	}).on('changeDate', function(e) {
			$('#new_clone_date').val(e.format('yyyy-mm-dd'));
			$('#clone_of_date').val($(this).data('button'));
			// alert($(this).data('button'));
			$('#menu_clone').submit();
	});
	$(document).on('click', '.clone_record', function(){
		$('.menu_clone_date').datepicker('show');
	})
});
</script>