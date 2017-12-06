<?php
function museumwp_currentYear() {
    return date('Y');
}
add_shortcode( 'year', 'museumwp_currentYear' );

if( function_exists('vc_map') ) {

	/* - Default for vc_row */
	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"group" => "Page Layout",
		"class" => "",
		"heading" => "Type",
		"param_name" => "type",
		"value" => array(
			"Default" => "default-layout",
			"Fixed" => "container",
		)
	));

	/* Include all individual shortcodes. */

	$prefix_sc = "sc_";

	require_once( $prefix_sc . "about.php" );

	require_once( $prefix_sc . "blog.php" );

	require_once( $prefix_sc . "clients.php" );

	require_once( $prefix_sc . "contact_block.php" );

	require_once( $prefix_sc . "contact_map.php" );

	require_once( $prefix_sc . "events.php" );

	require_once( $prefix_sc . "gallery.php" );

	require_once( $prefix_sc . "history.php" );

	require_once( $prefix_sc . "testimonials.php" );
}