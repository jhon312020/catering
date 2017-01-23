<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 5px; padding-left: 1.5em; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('banner'); ?></h1>
		<?php
		if(count($banner) == 0){
		?>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/captions/form/contacts'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
		<?php
		}
		?>
	</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
            <th><?php echo lang('id'); ?></th>
            <th><?php echo lang('image'); ?></th>
			<th><?php echo lang('banner_title') . ' (EN)'; ?></th>
			<th><?php echo lang('banner_title') . ' (ES)'; ?></th>
			<th><?php echo lang('banner_content') . ' (EN)'; ?></th>
			<th><?php echo lang('banner_content') . ' (ES)'; ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($banner as $q) { ?>
		<tr>
			<td><?php echo $q->id; ?></td>
			<td><?php echo ($q->image != '')?'<img src="'.$caption_path . $q->image.'" width="150">':''; ?></td>
			<td><?php echo $q->title_en; ?></td>
			<td><?php echo $q->title_es; ?></td>
			<td><?php echo $q->subtitle_en; ?></td>
			<td><?php echo $q->subtitle_es; ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/captions/form/' . $q->id.'/contacts'); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/captions/delete/' . $q->id.'/contacts'); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>

<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('contacts'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/contacts/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>

<div class="row" id="row_view">
	<div class="col-md-12 ">
<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
			<th><?php echo lang('id'); ?></th>
			<!--<th><?php echo lang('city'); ?></th>
			<th><?php echo lang('country'); ?></th>
			<th><?php echo lang('phone'); ?></th>-->
			<th><?php echo lang('email'); ?></th>
			<th><?php echo lang('name'); ?></th>
			<th><?php echo lang('description'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($contactss as $contacts) { ?>
		<tr>
			<td><?php echo $contacts->id; ?></td>
			<!--<td><?php echo $contacts->city; ?></td>
			<td><?php echo $contacts->country; ?></td>
			<td><?php echo $contacts->phone_1; ?></td>-->
			<td><?php echo $contacts->email; ?></td>
			<td><?php echo $contacts->name; ?></td>
			<td><?php echo $contacts->description; ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/contacts/form/' . $contacts->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/contacts/delete/' . $contacts->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
	</div>
</div>