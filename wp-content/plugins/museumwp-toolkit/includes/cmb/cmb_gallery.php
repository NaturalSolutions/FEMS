<?php

// Start with an underscore to hide fields from custom fields list
$prefix = 'museumwp_cf_';

/* ## Gallery Metaboxes ---------------------- */

/* - Gallery Options */
$cmb_gallery = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_gallery',
	'title'         => __( 'Gallery Options', "museumwp" ),
	'object_types'  => array( 'museumwp_gallery' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_gallery->add_field( array(
	'name'         => __( 'Origin: ', "museumwp" ),
	'id'           => $prefix . 'gallery_orgin',
	'type'         => 'text',
) );
?>