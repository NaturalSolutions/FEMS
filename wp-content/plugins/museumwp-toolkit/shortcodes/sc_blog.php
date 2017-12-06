<?php
function museumwp_blog( $atts ) {

	extract( shortcode_atts(
		array(
			'title' => '',
			'btntxt' => '',
			'btnurl' => '',
		), $atts )
	);

	/* Post Arguments */
	$qry_args = array(
		'posts_per_page' => 2,
		'ignore_sticky_posts' => 1
	);

	$qry = new WP_Query( $qry_args );

	ob_start();

	?>

	<div id="blog-section" class="blog-section ow-section">

		<div class="container">

			<?php
			echo museumwp_content('<div class="section-header"><h3><img src="'. esc_url( OWTH_LIB ) . '/images/sep-icon.png" alt="">', '</h3></div>', esc_attr( $title ) );

			if( $qry->have_posts() ) {

				while ( $qry->have_posts() ) : $qry->the_post();

					if( ! has_post_thumbnail() ) {
						$thumb_css = "not-hasthumbnail ";
					}
					else {
						$thumb_css = "";
					}

					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( $thumb_css . 'col-md-6 col-sm-12'); ?>>
						<div class="blog-box">
							<div class="blog-box-inner">
								<header class="entry-header">
									<h3><a title="Blog Title" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
								</header>
								<footer class="entry-meta">

									<div class="byline">
										<span class="author">
											<?php esc_html_e("BY ", 'museumwp-toolkit'); ?>
											<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="url fn n">
												<?php echo get_the_author(); ?><?php esc_html_e(",", "museumwp-toolkit"); ?>
											</a>
										</span>
									</div>

									<div class="postlike">
										<div class="like"><?php echo get_simple_likes_button( get_the_ID() ); ?></div>
									</div>

								</footer>
								
								<div class="entry-content">
									<p><?php echo museumwp_custom_excerpts(12); ?></p>
								</div>
								<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html_e( 'Read More...', 'museumwp-toolkit' ); ?></a>
							</div>
							<div class="entry-cover pull-right">
								<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('museumwp_278_298'); ?></a>
								<div class="posted-on">
									<div class="like"><?php echo get_simple_likes_button( get_the_ID() ); ?></div>
									<span class="date"><?php echo get_the_date( 'n M', get_the_ID() ); ?></span>
								</div>
							</div>
						</div>
					</article>
					<?php
				endwhile;
				
				//Reset Post Data
				wp_reset_postdata();
			}

			echo museumwp_content('<a href="'.esc_url( $btnurl ).'" class="btn" title="">','</a>', esc_attr( $btntxt ) ); ?>

		</div>
	</div>
	
	<?php
	return ob_get_clean();
}
add_shortcode('museumwp_blog', 'museumwp_blog');