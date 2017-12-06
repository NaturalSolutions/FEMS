<?php
/**
 * Child theme functions
 *
 * Functions file for child theme, enqueues parent and child stylesheets by default.
 *
 * @since	1.0.0
 * @package Museumwp
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'museumwp_child_enqueue_styles' ) ) {

	// Add enqueue function to the desired action.
	add_action( 'wp_enqueue_scripts', 'museumwp_child_enqueue_styles', 11 );

	/**
	 * Enqueue Styles.
	 *
	 * Enqueue parent style and child styles where parent are the dependency
	 * for child styles so that parent styles always get enqueued first.
	 *
	 * @since 1.0.0
	 */
	function museumwp_child_enqueue_styles() {

		// Parent style variable.
		$parent_style = 'museumwp-stylesheet';

		// Enqueue Parent theme's stylesheet.
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

		// Enqueue Child theme's stylesheet.
		// Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
}

//------------------------------------------------------------------------------------------------------------------------------

function chart_scripts_init(){
    wp_register_script('chart', get_template_directory_uri() . '/../museumwp-child/node_modules/chart.js/dist/Chart.min.js', array('jquery'),'1.1', true);
    wp_enqueue_script('chart');
}
add_action('wp_enqueue_scripts', 'chart_scripts_init');