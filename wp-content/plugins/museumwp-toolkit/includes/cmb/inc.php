<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

add_action( 'cmb2_init', 'museumwp_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function museumwp_register_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'museumwp_cf_';

	$prefix_cmb = "cmb_";

	/* ## Page Options ---------------------- */
	require_once( $prefix_cmb . "page.php");

	/* ## Post Options ---------------------- */
	require_once( $prefix_cmb . "post.php");

	/* ## Gallery Options ---------------------- */
	require_once( $prefix_cmb . "gallery.php");

	/* ## Clients Options ---------------------- */
	require_once( $prefix_cmb . "clients.php");
}
?>