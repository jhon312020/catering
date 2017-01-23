<div class="headerbar">
	<h1>Node</h1>
</div>
<div class="row">
	<div class="col-md-12 ">
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/node/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
	</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-striped data_table">

	<thead>
		<tr>
			<th>Node Id</th>
            <th>Title</th>
			<th>Url</th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($nodes as $node) { ?>
		<tr>
			<td><?php echo $node->nid; ?></td>
            <td><?php echo $node->title; ?></td>
			<td><?php echo anchor('page/'.$node->url, 'Link', 'title="Link"'); ?></td>
			<td>
				<div class="options btn-group">
					<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
					<ul class="dropdown-menu">
						<li>
							<a class="btn btn-info btn-sm btn-icon icon-left" href="<?php echo site_url('admin/node/form/' . $node->nid); ?>">
								<i class="entypo-pencil"></i> <?php echo lang('edit'); ?>
							</a>
						</li>
						<li>
							<a class="btn btn-danger btn-sm btn-icon icon-left" href="<?php echo site_url('admin/node/delete/' . $node->nid); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
								<i class="entypo-trash"></i> <?php echo lang('delete'); ?>
							</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
