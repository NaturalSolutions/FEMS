<?php
function museumwp_clients( $atts ) {

	extract( shortcode_atts(
		array(
			"bg_url" => "",
			"display_style" => "",
		), $atts )
	);

	$qry_args = array(
		'post_type'	=>	"museumwp_clients",
		'posts_per_page'	=>	-1,
	);

	// The Query
	$qry = new WP_Query( $qry_args );

	ob_start();

	if ( $qry->have_posts() ) :

		if( $display_style == "list" ) {
			?>
			<div class="sponser-page">
				<ul class="row">
					<?php
					$cnt = 1;
					while( $qry->have_posts() ) : $qry->the_post();
						?>
						<li class="col-sm-3">
							<a href="<?php echo esc_url( get_post_meta( get_the_ID(), "museumwp_cf_client_website", true ) ); ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail(); ?>
							</a>
						</li>
						<?php
						if( $cnt % 4 == 0 ) {
							?>
							<li class="clearfix"></li>
							<?php
						}
						$cnt++;
					endwhile;

					// Restore original Post Data
					wp_reset_postdata();
					?>
				</ul>
			</div>
			<?php
		}
		else {
			?>
			<!--======= sponsors =========-->
			<section class="sponsors">
				<div class="overlay">
					<div class="container">
						<div class="client-slide">
							<?php
							while( $qry->have_posts() ) : $qry->the_post();
								?>
								<div>
									<a href="<?php echo esc_url( get_post_meta( get_the_ID(), "museumwp_cf_client_website", true ) ); ?>" title="<?php the_title(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
								</div>
								<?php
							endwhile;

							// Restore original Post Data
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</section>
			<?php
		}

	endif;

	return ob_get_clean();
}
add_shortcode('museumwp_clients', 'museumwp_clients');

vc_map( array(
	"name" => __("Clients", "museumwp-toolkit"),
	"icon" => 'vc-site-icon',
	"base" => "museumwp_clients",
	"category" => __('Museum Theme', "museumwp-toolkit"),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Display Style", "museumwp-toolkit"),
			"param_name" => "display_style",
			"value" => array(
				"Select an Option" => "",
				"Grid" => "grid",
				"List" => "list",
			)
		),
	)
) );