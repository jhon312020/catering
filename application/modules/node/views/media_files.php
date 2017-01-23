
<div class="gallery-env">

	<div class="row">
		<?php foreach ($medias as $media) { ?>
		<div class="col-sm-4">
					
			<article class="album">
				
				<header>
					
					<a href="#">
						<img src="<?php echo $media->file_url; ?>" />
					</a>
					
				</header>
				
				<section class="album-info">
					<h3><a href="#"><?php echo $media->file_name; ?></a></h3>
					
					<p>url : <input type="text" value="<?php echo $media->file_url; ?>"> </p>
				</section>
				

				
			</article>
			
		</div>
		<?php } ?>
	</div>
</div>
