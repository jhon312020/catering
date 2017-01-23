<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo $this->router->method == 'schedule' ? lang('routes') . ' List' : 'Calendar ' . lang('routes') . ' List'; ?></h1>
		<?php if ($this->router->method != 'calendar') { ?>
		<a class="pull-right btn btn-primary" href="<?php echo site_url('admin/routes/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
		<?php } else { ?>
		<div style="width:25%;" class="pull-right">
			<form method="POST" action="<?php echo site_url('/admin/routes/calendar');?>" id="dateRange">
				<label class="control-label clearfix" style="display:inline;">
					Select Date or Range:
					<?php
						if(isset($_POST['from_date']) && $_POST['from_date']){
							echo '<a href="'.site_url('/admin/routes/calendar').'" class="text-danger">clear range</a>';
						}
					?>
					<div class="input-group input-daterange pull-left" style="width:83%;">
						<?php echo form_input('from_date', Date('d/m/Y', strtotime($fromDate)), 'class="form-control datepicker1"'); ?>
						<span class="input-group-addon">to</span>
						<?php echo form_input('to_date', Date('d/m/Y', strtotime($toDate)), 'class="form-control datepicker1"'); ?>
					</div>
					<button class='btn btn-sm btn-primary pull-right' style="font-size:13px;padding:5px 10px;" type="submit">Go</button>
				</label>
			</form>
		</div>
		<?php } ?>
	</div>
</div>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<?php
				if ($this->router->method == 'calendar'){
					echo "<th>".lang('date')."</th>";
				}
			?>
            <th><?php echo lang('no_route'); ?></th>
			<th><?php echo lang('from'); ?></th>
			<th><?php echo $this->router->method == 'schedule' ? lang('time_start') : lang('time_start'); ?></th>
			<th><?php echo $this->router->method == 'schedule' ? lang('to') : lang('time_end'); ?></th>
			<?php if($this->router->method == 'schedule') { ?>
			<th><?php echo lang('time_end'); ?></th>
			<?php } ?>
			<th <?php echo $this->router->method == 'schedule' ? '': 'width="5%"'; ?>><?php echo $this->router->method == 'schedule' ? lang('car') : lang('avail_seats'); ?></th>
			<?php if($this->router->method == 'calendar'){ ?>
			<th width="10%;"><?php echo lang('return_seats'); ?></th>
			<?php } ?>
			<th width="25%;"><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($routes as $route) { ?>
		<tr>
			<?php
				if ($this->router->method == 'calendar'){
					echo "<td>".date('d/m/Y', strtotime($route->service_date))."</td>";
				}
			?>
			<td style="color:#F27D00;"><?php echo $route->reference_id; ?></td>
			<td><?php echo (filter_var($route->from_zone, FILTER_VALIDATE_FLOAT) !== false) ? $bcn[$route->from_zone] : $route->from_zone; ?></td>
			<td><?php echo date('H:i', strtotime($route->from_time)).'h'; ?></td>
			<?php if($this->router->method == 'schedule') { ?>
			<td><?php echo (filter_var($route->to_zone, FILTER_VALIDATE_FLOAT) !== false) ? $bcn[$route->to_zone] : $route->to_zone; ?></td>
			<?php } ?>
			<td><?php echo date('H:i', strtotime($route->to_time)).'h'; ?></td>
			<td><?php echo $this->router->method == 'schedule' ? $route->car : $route->go_seats; ?></td>
			<?php if($this->router->method == 'calendar'){ ?>
			<td><?php echo $route->return_seats; ?></td>
			<?php } ?>
			<td>
				<?php
					$toggleAction = ($this->router->method == 'schedule') ? 'toggle' : 'calendarToggle';
					$delAction = ($this->router->method == 'schedule') ? 'delete' : 'calendarDelete';
					$formAction = ($this->router->method == 'schedule') ? 'form' : 'calendarForm';
					$viewAction = ($this->router->method == 'schedule') ? 'view' : 'calendarView';
				?>
				<a class="btn btn-info btn-sm" href="<?php echo site_url('admin/routes/'.$viewAction.'/' . $route->id); ?>">
					<i class="entypo-eye"></i>
				</a>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/routes/'.$formAction.'/' . $route->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-warning btn-sm <?php echo $route->is_active ? '' : 'inactive'; ?>" href="<?php echo site_url('admin/routes/'.$toggleAction.'/' . $route->id . '/' . $route->is_active); ?>">
					<i class="entypo-check" title="<?php echo $route->is_active ? 'Active' : 'In Active'; ?>"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/routes/'.$delAction.'/' . $route->id); ?>" onclick="return confirm('<?php echo ($this->router->method == 'calendar' && ($route->go_seats < $route->seats || $route->return_seats < $route->seats))?lang('delete_record_seat_warning'):lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
