<?php
/* CPT Clients */
function museumwp_cpt_clients() {

	$labels = array( 
		'name' => _x( 'Client', 'client', "museumwp" ),
		'singular_name' => _x( 'Client', 'client', "museumwp" ),
		'add_new' => __( 'Add New', 'Client', "museumwp" ),
		'add_new_item' => __( 'Add New Client', 'client', "museumwp" ),
		'edit_item' => __( 'Edit Client', 'client', "museumwp" ),
		'new_item' => __( 'New Client', 'client', "museumwp" ),
		'view_item' => __( 'View Client', 'client', "museumwp" ),
		'search_items' => __( 'Search Client', 'client', "museumwp" ),
		'not_found' => __( 'No Clients found', 'client', "museumwp" ),
		'not_found_in_trash' => __( 'No Client found in Trash', 'client', "museumwp" ),
		'parent_item_colon' => __( 'Parent client', 'client', "museumwp" ),
		'menu_name' => __( 'Clients', 'client', "museumwp" ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array( 'title', 'thumbnail' ),
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 101,
		'menu_icon' => 'dashicons-admin-comments',
		'show_in_nav_menus' => true,
		'publicly_queryable' => false,
		'exclude_from_search' => false,
		'has_archive' => false,
		'query_var' => true,
		'can_export' => true,
		'capability_type' => 'post'
	);

	register_post_type( 'museumwp_clients', $args );

}
add_action( 'init', 'museumwp_cpt_clients', 0 );