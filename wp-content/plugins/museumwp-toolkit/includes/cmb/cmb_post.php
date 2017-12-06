<?php

// Start with an underscore to hide fields from custom fields list
$prefix = 'museumwp_cf_';

/* ## Post Options ---------------------- */

/* Post : Header */
$cmb_post_header = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_post_header',
	'title'         => __( 'Post Header', "museumwp" ),
	'object_types'  => array( 'post', 'tribe_events' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_post_header->add_field( array(
	'name'       => __( 'Post Sub Title', "museumwp" ),
	'id'         => $prefix . 'post_sub_title',
	'type'       => 'text',
) );

$cmb_post_header->add_field( array(
	'name' => __( 'Post Header Image', "museumwp" ),
	'desc' => __( 'Upload an image or enter a URL.', "museumwp" ),
	'id'   => $prefix . 'post_header_img',
	'type' => 'file',
) );

/* Post : Layout */
$cmb_post_layout = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_post_layout',
	'title'         => __( 'Layout Options', "museumwp" ),
	'object_types'  => array( 'post' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_post_layout->add_field( array(
	'name'             => 'Post Layout',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'post_layout',
	'type'             => 'select',
	'default'          => 'fixed',
	'options'          => array(
		'fixed' => __( 'Fixed', "museumwp" ),
		'fluid'   => __( 'Fluid', "museumwp" ),
	),
) );

$cmb_post_layout->add_field( array(
	'name'             => 'Sidebar Position',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'sidebar_layout_post',
	'type'             => 'select',
	'default'          => 'primary_sidebar',
	'options'          => array(
		'right_sidebar'   => __( 'Right', "museumwp" ),
		'left_sidebar' => __( 'Left', "museumwp" ),
		'no_sidebar'   => __( 'None', "museumwp" ),
	),
) );

$cmb_post_layout->add_field( array(
	'name'             => 'Widget Area',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'widget_area_post',
	'type'             => 'select',
	'default'          => 'sidebar-1',
	'options'          => array(
		'sidebar-1' => __( 'Primary Sidebar', "museumwp" ),
		'sidebar-2'   => __( 'Secondary Sidebar', "museumwp" ),
	),
) );

/* Post : Gallery */
$cmb_post_gallery = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_post_gallery',
	'title'         => __( 'Gallery Post Options', "museumwp" ),
	'object_types'  => array( 'post' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_post_gallery->add_field( array(
	'name' => __( 'Post Gallery', 'cmb2' ),
	'id'   => $prefix . 'post_gallery',
	'type' => 'file_list',
) );
?>