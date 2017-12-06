<?php

/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Makeclean 1.0
 */

if( !function_exists('museumwp_widget_setup') ) :

	function museumwp_widget_setup() {

		/* Script For Widget */
		add_image_size( 'museumwp-90-90', 90, 90, true ); /* Upcoming Widget */
		add_image_size( 'museumwp-59-59', 59, 59, true ); /* Recent Post Widget */
	}
	add_action( 'after_setup_theme', 'museumwp_widget_setup' );
endif;

/* Widget Register / UN-register */
function museumwp_manage_widgets() {

	/* Recent Posts */
	require_once("recent_posts.php");
	register_widget( 'Museumwp_Widget_RecentPosts' );

	/* Upcoming Events */
	require_once("upcoming_events.php");
	register_widget( 'Museumwp_Widget_UpcomingEvents' );
}
add_action( 'widgets_init', 'museumwp_manage_widgets' );