<?php
function museumwp_events( $atts ) {

	extract( shortcode_atts(
		array(
			"title" => "",
			"desc" => "",
			"columns" => "",
			"num_of_posts" => "",
		), $atts )
	);

	if( '' === $columns ) :
		$columns = "one";
	endif;

	if( '' === $num_of_posts ) :
		$num_of_posts = -1;
	endif;

	ob_start();

	if( $columns == "one" ) {
		?>
		<div class="event event-page shortcode-onecolumn">

			<div class="container no-padding"> 

				<div class="row">

					<?php
					if( museumwp_checkstring( $title ) || museumwp_checkstring( $desc ) ) {
						?>
						<!-- Tittle -->
						<div class="tittle">
							<?php
							echo museumwp_content("<h2>","</h2><hr>", $title );
							echo wpautop( $desc );
							?>
						</div>
						<?php
					}

					$qry_args = array(
						'post_type'	=>	"tribe_events",
						'posts_per_page'	=>	$num_of_posts,
					);

					// The Query
					$qry = new WP_Query( $qry_args );

					if ( $qry->have_posts() ) :

						while( $qry->have_posts() ) : $qry->the_post();
							?>
							<div class="col-md-12">
								<ul>
									<li class="col-sm-5 no-padding eve-img">
										<?php the_post_thumbnail('museumwp-311-667'); ?>
										<div class="date"><?php echo get_the_date( 'd <p>M, y</p>', get_the_ID() ); ?></div>
									</li>
									<li class="col-sm-7 no-padding">
										<div class="event-detail">
											<?php
											the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

											if( function_exists('tribe_events_event_schedule_details') ){

												if( museumwp_checkstring( tribe_get_address() ) ) {
													?>
													<span><i class="ion-ios-location-outline"></i> <?php echo tribe_get_address(); ?> </span>
													<?php
												} ?>

												<div class="tribe-events-schedule updated published tribe-clearfix">
													<span>
														<i class="ion-ios-clock-outline"></i> <?php echo tribe_events_event_schedule_details( get_the_ID(), '<h3>', '</h3>' ); ?>
													</span>
												</div>											
												<?php
											}

											the_excerpt();
											?>

											<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn"><?php esc_html_e("View Event", "museumwp-toolkit"); ?></a>

										</div>
									</li>
								</ul>

							</div>

							<div class="clearfix"></div>

							<?php
						endwhile;

						// Restore original Post Data
						wp_reset_postdata();

					endif;
					?>

				</div>
			
			</div>

		</div>
		<?php
	}
	if( $columns == "two" ) {
		?>
		<div class="sec-100px event shortcode-twocolumn">

			<div class="container"> 

				<?php
				if( museumwp_checkstring( $title ) || museumwp_checkstring( $desc ) ) {
					?>
					<!-- Tittle -->
					<div class="tittle">
						<?php
						echo museumwp_content("<h2>","</h2><hr>", $title );
						echo wpautop( $desc );
						?>
					</div>
					<?php
				}
				?>

				<!-- Event -->
				<div class="row">

					<?php
					$qry_args = array(
						'post_type'	=>	"tribe_events",
						'posts_per_page'	=>	$num_of_posts,
					);

					// The Query
					$qry = new WP_Query( $qry_args );

					if ( $qry->have_posts() ) :

						$cnt = 1;

						while( $qry->have_posts() ) : $qry->the_post();
							?>
							<div class="col-md-6">
								<ul class="no-padding">
									<li class="col-sm-6 col-xs-4 no-padding">
										<?php the_post_thumbnail(); ?>
										<div class="date"><?php echo get_the_date( 'd <p>M, y</p>', get_the_ID() ); ?></div>
									</li>

									<li class="col-sm-6 col-xs-8 no-padding">

										<div class="event-detail">

											<?php

											the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

											if( function_exists('tribe_events_event_schedule_details') ){

												if( museumwp_checkstring( tribe_get_address() ) ) {
													?>
													<span><i class="ion-ios-location-outline"></i> <?php echo tribe_get_address(); ?> </span>
													<?php
												} ?>

												<div class="tribe-events-schedule updated published tribe-clearfix">
													<span>
														<i class="ion-ios-clock-outline"></i> <?php echo tribe_events_event_schedule_details( get_the_ID(), '<h3>', '</h3>' ); ?>
													</span>
												</div>											
												<?php
											}

											?>
											<p><?php echo museumwp_custom_excerpts(22); ?></p>

											<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn"><?php esc_html_e("View Event", "museumwp-toolkit"); ?></a>

										</div>

									</li>
								</ul>
							</div>
							<?php
							if( $cnt % 2 == 0 ) {
								?>
								<div class="clearfix"></div>
								<?php
							}
							$cnt++;
						endwhile;

						// Restore original Post Data
						wp_reset_postdata();

					endif;
					?>

				</div>

			</div>

		</div>
		<?php
	}
	return ob_get_clean();
}
add_shortcode('museumwp_events', 'museumwp_events');

vc_map( array(
	"name" => __("Events", "museumwp-toolkit"),
	"icon" => 'vc-site-icon',
	"base" => "museumwp_events",
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
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Display Columns", "museumwp-toolkit"),
			"param_name" => "columns",
			"value" => array(
				"Select an Option" => "",
				"One" => "one",
				"Two" => "two",
			)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("No of Events", "museumwp-toolkit"),
			"param_name" => "num_of_posts",
			"value" => array(
				"Select an Option" => "",
				"All" => "-1",
				"Two" => "2",
				"Four" => "4",
				"Six" => "6",
				"Eight" => "8",
				"Ten" => "10",
			)
		),				
	)
) );