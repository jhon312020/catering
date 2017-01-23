<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('banner'); ?></h1>
		<?php
		if(count($banner) == 0){
		?>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/captions/form/partners'); ?>">
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
			<th><?php echo lang('content') . ' (EN)'; ?></th>
			<th><?php echo lang('content') . ' (ES)'; ?></th>
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
			<td><?php echo $q->content_en; ?></td>
			<td><?php echo $q->content_es; ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/captions/form/' . $q->id.'/partners'); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/captions/delete/' . $q->id.'/partners'); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>



<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('partners'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/partners/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>


<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
            <th><?php echo lang('id'); ?></th>
            <th><?php echo lang('name'); ?></th>
			<th><?php echo lang('logo'); ?></th>
			<th><?php echo lang('url'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($partners as $partner) { ?>
		<tr>
			<td><?php echo $partner->id; ?></td>
			<td><?php echo ucfirst($partner->name); ?></td>
			<td><img src="<?php echo $path . $partner->logo; ?>" width="150"></td>
			<td><?php echo $partner->url; ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/partners/form/' . $partner->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/partners/delete/' . $partner->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
