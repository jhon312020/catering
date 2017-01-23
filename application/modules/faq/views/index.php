<div class="headerbar">
	<div class="clearfix">
	<h1 class="pull-left"><?php echo lang('banner'); ?></h1>
		<?php
		if(count($banner) == 0){
		?>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/captions/form/faq'); ?>">
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
			<th><?php echo lang('title') . ' (EN)'; ?></th>
            <th><?php echo lang('title') . ' (ES)'; ?></th>
            <th><?php echo lang('content') . ' (EN)'; ?></th>
            <th><?php echo lang('content') . ' (ES)'; ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($banner as $q) { ?>
		<tr>
			<td><?php echo $q->id; ?></td>
			<td><?php echo $q->content_en; ?></td>
			<td><?php echo $q->content_es; ?></td>
			<td><?php echo word_limiter($q->subcontent_en, 10); ?></td>
			<td><?php echo word_limiter($q->subcontent_es, 10); ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/captions/form/' . $q->id.'/faq'); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/captions/delete/' . $q->id.'/faq'); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>


<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo lang('faq'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/faq/form'); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>


<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
            <th><?php echo lang('id'); ?></th>
            <th><?php echo lang('question') . ' (EN)'; ?></th>
            <th><?php echo lang('question') . ' (ES)'; ?></th>
            <th><?php echo lang('answer') . ' (EN)'; ?></th>
            <th><?php echo lang('answer') . ' (ES)'; ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($faq as $q) { ?>
		<tr>
			<td><?php echo $q->id; ?></td>
			<td><?php echo $q->question; ?></td>
			<td><?php echo $q->question_es; ?></td>
			<td><?php echo word_limiter($q->answer, 10); ?></td>
			<td><?php echo word_limiter($q->answer_es, 10); ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/faq/form/' . $q->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/faq/delete/' . $q->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
