<?php
function museumwp_contact_map( $atts ) {

	extract( shortcode_atts(
		array(
		), $atts )
	);

	ob_start();
	?>
	<div class="ow-section shortcode-contact">
		<div class="map">
			<div class="map-canvas" id="map-canvas-contact" data-lat="<?php echo esc_attr( museumwp_options('opt_address_latitude') ); ?>" data-lng="<?php echo esc_attr( museumwp_options('opt_address_longitude') ); ?>" data-string="<?php echo esc_attr( museumwp_options('opt_contact_address') ) . "<br />" . __( "Email: ", "museumwp"); echo esc_attr( museumwp_options('opt_contact_email') ); ?>" data-marker="<?php echo esc_url( OWTH_LIB ).'images/marker.png'; ?>"  data-zoom="12"></div>
		</div><!-- Contact Map /- -->
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('museumwp_contact_map', 'museumwp_contact_map');

vc_map( array(
	"name" => __("Contact Map", "museumwp-toolkit"),
	"icon" => 'vc-site-icon',
	"base" => "museumwp_contact_map",
	"category" => __('Museum Theme', "museumwp-toolkit"),
	"params" => array(
		array(
			"type" => "label",
			"class" => "",
			"heading" => __("No Settings to save, Goto => Theme Options => Shortcodes => Contact Page", "museumwp-toolkit"),
			"param_name" => "contact_map_label",
		),
	)
) );