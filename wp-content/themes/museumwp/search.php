<?php
/**
* The Template for displaying all single posts
*
* @package WordPress
* @subpackage Museumwp
* @since Museumwp 1.0
*/
get_header(); ?>

<main id="main" class="site-main" role="main">

	<div class="post-content">

		<div class="container no-padding">

			<div class="content-area col-md-8 col-sm-8">
				<?php
				if ( have_posts() ) :
				
					// Start the loop.
					while ( have_posts() ) : the_post(); ?>

						<?php
						/*
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content.php and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					// End the loop.
					endwhile;

					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => __( '<i class="fa fa-angle-left"></i> Previous', "museumwp" ),
						'next_text'          => __( 'Next <i class="fa fa-angle-right"></i>', "museumwp" ),
						//'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', "museumwp" ) . ' </span>',
					) );

				// If no content, include the "No posts found" template.
				else :

					get_template_part( 'content', 'none' );

				endif;
				?>
			</div>

			<!-- Sidebar -->
			<div class="widget-area col-md-4 col-sm-4 sidebar primary-sidebar">
				<div class="widgetarea-inner">
					<?php dynamic_sidebar('sidebar-1'); ?>
				</div>
			</div><!-- End Sidebar -->

		</div><!-- .container /- -->

	</div><!-- Page Content /- -->

</main><!-- .site-main -->

<?php get_footer(); ?>