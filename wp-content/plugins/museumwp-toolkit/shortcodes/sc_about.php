<?php
function museumwp_about( $atts ) {

	extract( shortcode_atts(
		array(
		), $atts )
	);

	ob_start();
	?>
	<!--======= ABOUT US =========-->
	<section class="sec-100px about">

		<div class="container">

			<div class="row"> 

				<!-- INTRO -->
				<div class="col-md-7">
					<?php echo museumwp_content("<h4>","</h4><hr>", museumwp_options('opt_callto_title1') ); ?>
					<?php echo museumwp_content("<p>","</p>", museumwp_options('opt_callto_desc') ); ?>
					<?php echo museumwp_content("<a href=".esc_url( museumwp_options('opt_callto_btn_url') ).">"," <i class='fa fa-angle-right'></i></a>", museumwp_options('opt_callto_btn') ); ?>
				</div>

				<!-- TIMING -->
				<div class="col-md-5">
					<div class="hrs">
						<?php
						echo museumwp_content("<h3><i class='ion-ios-clock-outline'></i>","</h3>", museumwp_options('opt_callto_title2') );

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
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode('museumwp_about', 'museumwp_about');

/* - About */
vc_map( array(
	"name" => __("About Us", "museumwp-toolkit"),
	"icon" => 'vc-site-icon',
	"base" => "museumwp_about",
	"category" => __('Museum Theme', "museumwp-toolkit"),
	"params" => array(
		array(
			"type" => "label",
			"class" => "",
			"heading" => __("No Settings to save, Goto => Theme Options => Shortcodes => Call to Action", "museumwp-toolkit"),
			"param_name" => "about_label",
		),
	)
) );