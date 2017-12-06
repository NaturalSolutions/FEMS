<?php
/**
* The Template for displaying all single posts
*
* @package WordPress
* @subpackage Museumwp
* @since Museumwp 1.0
*/
?>

<?php get_header(); ?>

<?php
if( is_active_sidebar("sidebar-3") ) {
	$content_css = " col-md-9 col-sm-8";
}
else {
	$content_css = " col-md-12 col-sm-12";
}
?>

<main id="main" class="site-main">

	<div class="container no-padding">

		<div class="content-area woocommerce-page content-left columns-3<?php echo esc_attr( $content_css ); ?>">
			<?php woocommerce_content(); ?>
		</div>

		<?php
		if( is_active_sidebar("sidebar-3") ) {
			?>
			<div class="widget-area col-md-3 col-sm-4 col-xs-12">
				<?php dynamic_sidebar("sidebar-3"); ?>
			</div><!-- End Sidebar -->
			<?php
		} ?>

	</div><!-- content-area + page_layout_css -->

</main><!-- .site-main -->

<?php get_footer(); ?>