<div class="headerbar">
	<div class="clearfix">
	<h1 class="pull-left"><?php echo lang('franchises'); ?></h1>
		<?php
		if(count($franchises) == 0){
		?>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/captions/form/franchises'); ?>">
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
            <th><?php echo lang('title') . ' (EN)'; ?></th>
            <th><?php echo lang('title') . ' (ES)'; ?></th>
            <th><?php echo lang('content') . ' (EN)'; ?></th>
            <th><?php echo lang('content') . ' (ES)'; ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($franchises as $q) { ?>
		<tr>
			<td><?php echo $q->id; ?></td>
			<td><?php echo ($q->image != '')?'<img src="'.$caption_path . $q->image.'" width="150">':''; ?></td>
			<td><?php echo $q->title_en; ?></td>
			<td><?php echo $q->title_es; ?></td>
			<td><?php echo $q->subtitle_en; ?></td>
			<td><?php echo $q->subtitle_es; ?></td>
			<td><?php echo word_limiter($q->content_en, 10); ?></td>
			<td><?php echo word_limiter($q->content_es, 10); ?></td>
			<td><?php echo word_limiter($q->subcontent_en, 10); ?></td>
			<td><?php echo word_limiter($q->subcontent_es, 10); ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/captions/form/' . $q->id.'/franchises'); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/captions/delete/' . $q->id.'/franchises'); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>
