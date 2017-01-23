<!-- <ol class="breadcrumb bc-3">
	<li>
		<a href="<?php echo site_url('admin/dashboard'); ?>"><i class="entypo-home"></i><?php echo lang('home'); ?></a>
	</li>
	<li class="active">
		<strong>News</strong>
	</li>
</ol> -->
<div class="headerbar">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo ($type == 'banner') ? lang('banner') : lang('news'); ?></h1>
		<a class="btn btn-primary pull-right" href="<?php echo site_url('admin/homepage/form/'.$type); ?>">
			<i class="icon-plus icon-white"></i> <?php echo lang('new'); ?>
		</a>
	</div>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>

<table class="table table-bordered datatable data_table">

	<thead>
		<tr>
            <th><?php echo lang('id'); ?></th>
            <?php if ($type !== 'banner'){ ?>
            <th><?php echo lang('title') . ' (EN)'; ?></th>
            <th><?php echo lang('title') . ' (ES)'; ?></th>
            <?php } ?>
			<th><?php echo lang('image'). ' (EN)'; ?></th>
			<th><?php echo lang('image'). " (ES)"; ?></th>
			<th><?php echo lang('url'); ?></th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($boxes as $box) { ?>
		<tr>
			<td><?php echo $box->id; ?></td>
			<?php if ($type !== 'banner'){ ?>
			<td><?php echo $box->title; ?></td>
			<td><?php echo $box->title_es; ?></td>
			<?php } ?>
			<td><img src ="<?php echo $path . ($type == 'banner' ? 'banner/' : 'boxes/') .$box->image; ?>" width='150'/></td>
			<td>
				<?php if($box->image_es != ''){ ?>
					<img src ="<?php echo $path . ($type == 'banner' ? 'banner/' : 'boxes/') .$box->image_es; ?>" width='150'/>
				<?php } ?>
			</td>
			<td><?php echo $box->link; ?></td>
			<td>
				<a class="btn btn-primary edit btn-sm" href="<?php echo site_url('admin/homepage/form/'.$type.'/' . $box->id); ?>">
					<i class="entypo-pencil"></i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?php echo site_url('admin/homepage/delete/'.$type.'/' . $box->id); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');" >
					<i class="entypo-trash"></i>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

</table>