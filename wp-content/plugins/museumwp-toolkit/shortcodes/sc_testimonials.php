<?php
function museumwp_testimonials( $atts ) {

	extract( shortcode_atts(
		array(
			"desc" => ""
		), $atts )
	);

	ob_start();

	if( museumwp_checkstring( $desc ) ) {
		?>
		<section class="sec-100px testimonial">

			<div class="container">

				<div class="qou"> <i class="fa fa-quote-right"></i> </div>
		
				<div class="testi">
					<?php echo wpautop( $desc ); ?>
				</div>

			</div>

		</section>
		<?php
	}
	return ob_get_clean();
}
add_shortcode('museumwp_testimonials', 'museumwp_testimonials');

vc_map( array(
	"name" => __("Testimonial", "museumwp-toolkit"),
	"icon" => 'vc-site-icon',
	"base" => "museumwp_testimonials",
	"category" => __('Museum Theme', "museumwp-toolkit"),
	"params" => array(
		array(
			"type" => "textarea",
			"class" => "",
			"heading" => __("Description", "museumwp-toolkit"),
			"param_name" => "desc",
		),
	)
) );