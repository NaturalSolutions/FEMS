<?php

// Start with an underscore to hide fields from custom fields list
$prefix = 'museumwp_cf_';

/* ## Page Options ---------------------- */

/* - Page Description */
$cmb_page = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_page',
	'title'         => __( 'Page Options', "museumwp" ),
	'object_types'  => array( 'page' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_page->add_field( array(
	'name'             => 'Page Layout',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'page_layout',
	'type'             => 'select',
	'default'          => 'fixed',
	'options'          => array(
		'fixed' => __( 'Fixed', "museumwp" ),
		'fluid'   => __( 'Fluid', "museumwp" ),
	),
) );

$cmb_page->add_field( array(
	'name'             => 'Sidebar Position',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'sidebar_layout',
	'type'             => 'select',
	'default'          => 'primary_sidebar',
	'options'          => array(
		'right_sidebar'   => __( 'Right', "museumwp" ),
		'left_sidebar' => __( 'Left', "museumwp" ),
		'no_sidebar'   => __( 'None', "museumwp" ),
	),
) );

$cmb_page->add_field( array(
	'name'             => 'Widget Area',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'widget_area',
	'type'             => 'select',
	'default'          => 'sidebar-1',
	'options'          => array(
		'sidebar-1' => __( 'Primary Sidebar', "museumwp" ),
		'sidebar-2'   => __( 'Secondary Sidebar', "museumwp" ),
	),
) );

$cmb_page->add_field( array(
	'name'             => 'Page Header',
	'desc'             => 'Select an option',
	'id'               => $prefix . 'page_title',
	'type'             => 'select',
	'default'          => 'enable',
	'options'          => array(
		'enable' => __( 'Enable', "museumwp" ),
		'disable'   => __( 'Disable', "museumwp" ),
	),
) );

$cmb_page->add_field( array(
	'name'       => __( 'Page Sub Title', "museumwp" ),
	'id'         => $prefix . 'page_sub_title',
	'type'       => 'text',
) );

$cmb_page->add_field( array(
	'name' => __( 'Page Header Image', "museumwp" ),
	'desc' => __( 'Upload an image or enter a URL.', "museumwp" ),
	'id'   => $prefix . 'page_header_img',
	'type' => 'file',
) );
?>