<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 5px; padding-left: 1.5em; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<script>
  jQuery(function($) {
	  
    $( "#sortable" ).sortable({
		update: function( event, ui ) {
			
			var sorted = $( "#sortable" ).sortable( "toArray" );			
			console.log(sorted);
			$.post( "<?php echo site_url('admin/menu/weight'); ?>", { weight: sorted })
				.done(function( data ) {
					//alert( "Data Loaded: " + data );
			});
		}
	});
    $( "#sortable" ).disableSelection();
  });
</script>  

<div class="headerbar">
	<h1>Menu</h1>

	<div class="pull-right">
		<a class="btn btn-primary" href="<?php echo site_url('admin/menu/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
	</div>
	
	<div class="pull-right">
		<?php echo pager(site_url('admin/menu/index'), 'mdl_menu'); ?>
	</div>

</div>

<?php echo $this->layout->load_view('layout/alerts'); 
$i = 0;
?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Weight</th>
            <th>Title</th>
			<th>Url</th>
			<th><?php echo lang('options'); ?></th>
		</tr>
	</thead>
</table>

<ul id="sortable">
<?php foreach ($menus as $menu) { ?>
<li id="<?php echo $menu->mid;?>" class="ui-state-default">
	<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
	<?php echo $menu->title; ?> 
	<?php echo anchor('page/'.$menu->url, 'Link', 'title="Link"'); ?>
	
	<div class="options btn-group">
		<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog"></i> <?php echo lang('options'); ?></a>
		<ul class="dropdown-menu">
			<li>
				<a href="<?php echo site_url('admin/menu/form/' . $menu->mid); ?>">
					<i class="icon-pencil"></i> <?php echo lang('edit'); ?>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('admin/menu/delete/' . $menu->mid); ?>" onclick="return confirm('<?php echo lang('delete_record_warning'); ?>');">
					<i class="icon-trash"></i> <?php echo lang('delete'); ?>
				</a>
			</li>
		</ul>
	</div>
	
</li>
<?php $i++; } ?>

</ul>

