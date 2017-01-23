<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('clients'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/clients/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">
	<thead>
		<tr>
			<th>Register</th>
            <th><?php echo lang('name'); ?></th>
			<th><?php echo lang('surname'); ?></th>
			<th><?php echo lang('email'); ?></th>
			<th><?php echo lang('phone'); ?></th>
			<th><?php echo lang('country'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($clients as $client) {
				$color = 'color:gold;';
				printf("<tr><td align='center' width=80><i class='entypo-star' style='font-size:24px;%s'></i></td>",$color);
				printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>", $client->name, $client->surname, $client->email, $client->phone, $client->country);
				printf("<td>");
				printf("<a class='btn btn-info btn-sm' href='".site_url('admin/clients/view/'.$client->id)."'><i class='entypo-eye'></i></a>", '#');
				printf("&nbsp;<a class='btn btn-primary edit btn-sm' href='".site_url('admin/clients/form/'.$client->id)."'><i class='entypo-pencil'></i></a>", '#');
				printf("&nbsp;<a class='btn btn-warning btn-sm ".($client->is_active ? '' : 'inactive')."' href='".site_url('admin/clients/toggle/'.$client->id.'/'.$client->is_active)."'><i class='entypo-check' title='".($client->is_active ? 'Active' : 'In Active')."'></i></a>", '#','status');
				printf("&nbsp;<a class='btn btn-danger btn-sm' onclick=\"return confirm('".lang('delete_record_warning')."');\" href='".site_url('admin/clients/delete/'.$client->id)."'><i class='entypo-trash'></i></a>", '#');
				printf("</td></tr>");
			}
		?>
	</tbody>
</table>