<?php
function museumwp_contact_block( $atts ) {

	extract( shortcode_atts(
		array(
			"title" => "",
			"desc" => "",
		), $atts )
	);

	ob_start();
	?>
	<section class="ow-section shortcode-contact">
		<div class="container">
			<div class="section-header">
				<h1><?php echo esc_attr( $title ); ?></h1>
				<?php echo wpautop( $desc ); ?>
			</div>

			<div class="col-md-7">
				<div class="contact-form">
					<?php echo do_shortcode( museumwp_options('opt_contact_shortcode') ); ?>
				</div>
			</div>

			<!-- TIMING -->
			<div class="col-md-5 about">
				<div class="hrs">
					<?php
					echo museumwp_content("<h3><i class='fa fa-clock-o'></i>","</h3>", museumwp_options('opt_callto_title2') );

					if( is_array( museumwp_options('opt_visiting_hours') ) && count( museumwp_options('opt_visiting_hours') ) > 0 ) :
						foreach( museumwp_options('opt_visiting_hours') as $single_item ) {
							?>
							<ul>
								<li class="col-md-5 no-padding">
									<h5><?php echo esc_attr( $single_item['title'] ); ?></h5>
									<p><?php echo esc_attr( $single_item['textOne'] ); ?></p>
								</li>
								<li class="col-md-7 no-padding">
									<span class="appoiment"><?php echo esc_attr( $single_item['textTwo'] ); ?></span>
								</li>
							</ul>
							<?php
						}
					endif;
					?>
				</div>
			</div>
		</div>

	</section>
	<?php
	return ob_get_clean();
}
add_shortcode('museumwp_contact_block', 'museumwp_contact_block');

vc_map( array(
	"name" => __("Contact", "museumwp-toolkit"),
	"icon" => 'vc-site-icon',
	"base" => "museumwp_contact_block",
	"category" => __('Museum Theme', "museumwp-toolkit"),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", "museumwp-toolkit"),
			"param_name" => "title",
		),
		array(
			"type" => "textarea",
			"class" => "",
			"heading" => __("Description", "museumwp-toolkit"),
			"param_name" => "desc",
		),
	)
) );