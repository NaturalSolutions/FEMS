<?php
/* Post Format : Gallery */
if( get_post_format() == "gallery" && count( get_post_meta( get_the_ID(), 'museumwp_cf_post_gallery', 1 ) ) > 0 && is_array( get_post_meta( get_the_ID(), 'museumwp_cf_post_gallery', 1 ) ) ) {
	?>
	<!-- Carousel -->
	<div id="blog-carousel-<?php echo the_ID(); ?>" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<?php
			$active=1;
			foreach ( (array) get_post_meta( get_the_ID(), 'museumwp_cf_post_gallery', 1 ) as $attachment_id => $attachment_url ) {
				?>
				<div class="item<?php if( $active == 1 ) { echo ' active'; } ?>">
					<?php echo wp_get_attachment_image( $attachment_id, 'thumb-720-285' ); ?>
				</div>
				<?php
				$active++;
			} ?>
		</div>
		<a title="Previous" class="left carousel-control" href="#blog-carousel-<?php echo the_ID(); ?>" role="button" data-slide="prev">
			<span class="fa fa-chevron-left" aria-hidden="true"></span>
		</a>
		<a title="Next" class="right carousel-control" href="#blog-carousel-<?php echo the_ID(); ?>" role="button" data-slide="next">
			<span class="fa fa-chevron-right" aria-hidden="true"></span>
		</a>
	</div><!-- /.carousel -->
	<?php
} ?>