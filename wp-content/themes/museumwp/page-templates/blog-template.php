<?php
/*
*	Template Name: Blog Page
*/

get_header();

/* Page Layout */
if( museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_page_layout', true ) ) ) {
	$page_layout = get_post_meta( get_the_ID(), 'museumwp_cf_page_layout', true );
}
else {
	$page_layout = "";
}

if( $page_layout == "fluid" ) {
	$page_layout_css = "container-fluid no-padding";
}
else {
	$page_layout_css = "container no-padding";
}

/* Widget Area */
if( museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_sidebar_layout', true ) ) ) {
	$sidebar_layout = get_post_meta( get_the_ID(), 'museumwp_cf_sidebar_layout', true );
}
else {
	$sidebar_layout = "";
}

if( $sidebar_layout == "right_sidebar" ) {
	$sidebar_css = "sidebar-right";
}
elseif( $sidebar_layout == "left_sidebar" ) {
	$sidebar_css = "sidebar-left";
}
elseif( $sidebar_layout == "no_sidebar" ) {
	$sidebar_css = "no-sidebar";
}
else {
	$sidebar_css = "sidebar-right";
}

/* Content Area */
if( $sidebar_layout == "right_sidebar" ) {
	$content_area_css = "content-left col-md-8 col-sm-8";
}
elseif( $sidebar_layout == "left_sidebar" ) {
	$content_area_css = "content-right col-md-8 col-sm-8";
}
elseif( $sidebar_layout == "no_sidebar" ) {
	$content_area_css = "full-content col-md-12";
}
else {
	$content_area_css = "col-md-8 col-sm-8";
}

if( museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_widget_area', true ) ) ) {
	$widget_area = get_post_meta( get_the_ID(), 'museumwp_cf_widget_area', true );
}
else {
	$widget_area = "sidebar-1";
}
?>
<main id="main" class="site-main" role="main">

	<div class="page-content">

		<div class="<?php echo esc_attr( $page_layout_css ); ?>">

			<div class="content-area <?php echo esc_attr( $content_area_css ); ?>">
				<?php
				query_posts('posts_per_page='.get_option('posts_per_page').'&paged='. get_query_var('paged'));

				if ( have_posts() ) :

					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'content', get_post_format() );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					// End the loop.
					endwhile;

					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => __( '<i class="fa fa-angle-left"></i> Previous', "museumwp" ),
						'next_text'          => __( 'Next <i class="fa fa-angle-right"></i>', "museumwp" ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', "museumwp" ) . ' </span>',
					) );

				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );
				endif;
				?>
			</div>

			<!-- Sidebar -->
			<?php
			if( $sidebar_layout != "no_sidebar" && is_active_sidebar( $widget_area ) ) {
				?>
				<div class="widget-area col-md-4 col-sm-4 <?php echo esc_attr( $sidebar_css ); ?>">
					<div class="widgetarea-inner">
						<?php dynamic_sidebar( $widget_area ); ?>
					</div>
				</div><!-- End Sidebar -->
				<?php
			}
			?>

		</div><!-- .container /- -->

	</div><!-- Page Content /- -->

</main><!-- .site-main -->

<?php get_footer(); ?>