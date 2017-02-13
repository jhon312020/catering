<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 5px; padding-left: 1.5em; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('Contacts'); ?></h1>
		</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
      <th><?php echo lang('id'); ?></th>
      <th><?php echo lang('name'); ?></th>
      <th><?php echo lang('email'); ?></th>
      <th><?php echo lang('address'); ?></th>
      <th><?php echo lang('telephone'); ?></th>
      <th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td><?php echo $contact->id; ?></td>
			<td><?php echo $contact->name; ?></td>
			<td><?php echo $contact->email; ?></td>
			<td><?php echo $contact->address; ?></td>
			<td><?php echo $contact->telephone; ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/contacts/form/' . $contact->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
			</td>
		</tr>
	</tbody>

</table>



