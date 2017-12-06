<?php
/* CPT : Gallery */
function museumwp_cpt_gallery() {

	$gallery_labels = array(
		'name' =>  __('Gallery', "museumwp" ),
		'singular_name' => __('Gallery', "museumwp" ),
		'add_new' => __('Add New', "museumwp" ),
		'add_new_item' => __('Add New Gallery', "museumwp" ),
		'edit_item' => __('Edit Gallery', "museumwp" ),
		'new_item' => __('New Gallery', "museumwp" ),
		'all_items' => __('All Gallery', "museumwp" ),
		'view_item' => __('View Service', "museumwp" ),
		'search_items' => __('Search Gallery', "museumwp" ),
		'not_found' =>  __('No Gallery found', "museumwp" ),
		'not_found_in_trash' => __('No Gallery found in Trash', "museumwp" ),
		'parent_item_colon' => '',
		'menu_name' => __('Gallery', "museumwp" )
	);

	$gallery_args = array(
		'labels' => $gallery_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite'  => array( 'slug' => 'gallery-item' ),
		'has_archive' => true, 
		'capability_type' => 'post', 
		'hierarchical' => true,
		'menu_position' => 106,
		'menu_icon' => 'dashicons-schedule',
		'supports' => array( 'title', 'thumbnail', 'editor' ),
	);

	// Initialize Taxonomy Labels
	$gallery_tag_labels = array(
		'name'                       => 'Gallery Tag',
		'singular_name'              => 'Gallery Tag',
		'menu_name'                  => 'Gallery Tags',
		'all_items'                  => 'All Gallery Tags',
		'parent_item'                => 'Parent Gallery Tag',
		'parent_item_colon'          => 'Parent Gallery Tag:',
		'new_item_name'              => 'New Gallery Tag',
		'add_new_item'               => 'Add New Gallery Tag',
		'edit_item'                  => 'Edit Gallery Tag',
		'update_item'                => 'Update Gallery Tag',
		'separate_items_with_commas' => 'Separate Gallery Tags with commas',
		'search_items'               => 'Search Gallery Tags',
		'add_or_remove_items'        => 'Add or remove Gallery Tags',
		'choose_from_most_used'      => 'Choose from the most used Gallery Tags',
		'not_found'                  => 'Not Found',
	);

	$gallery_tag_args = array(
		'labels'                     => $gallery_tag_labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

	register_taxonomy( 'gallery-tags', array( 'museumwp_gallery' ), $gallery_tag_args );

	register_post_type( 'museumwp_gallery', $gallery_args );
}
add_action( 'init', 'museumwp_cpt_gallery', 0 );