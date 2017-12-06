<?php

// Start with an underscore to hide fields from custom fields list
$prefix = 'museumwp_cf_';

/* ## Clients Metaboxes ---------------------- */

/* - Clients Options */
$cmb_clients = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_clients',
	'title'         => __( 'Clients Options', "museumwp" ),
	'object_types'  => array( 'museumwp_clients' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

$cmb_clients->add_field( array(
	'name'         => __( 'Website', "museumwp" ),
	'id'           => $prefix . 'client_website',
	'type'         => 'text',
) );
?>