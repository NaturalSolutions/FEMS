<?php
require_once( trailingslashit( get_template_directory() ) . 'admin/tgm/tgm.php' );

if ( class_exists( 'ReduxFramework' ) ) {
	require_once( trailingslashit( get_template_directory() ) . 'admin/redux.php' );
}

function museumwp_admin_enqueue() {

	wp_enqueue_media();

	wp_enqueue_script( 'museumwp-adminfn', get_template_directory_uri() . '/admin/js/functions.js', array( 'jquery' ) );
	wp_enqueue_style( 'museumwp-admincss', get_template_directory_uri() . '/admin/css/style.css' );
}
add_action( 'admin_enqueue_scripts', 'museumwp_admin_enqueue' );
?>