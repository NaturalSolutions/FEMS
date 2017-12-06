<?php
function museumwp_gallery( $atts ) {

	extract( shortcode_atts(
		array(
			"title" => "",
			"desc" => "",
			"num_of_posts" => "",
		), $atts )
	);

	if( '' === $num_of_posts ) :
		$num_of_posts = 3;
	endif;

	ob_start();

	$qry_args = array(
		'post_type'	=>	'museumwp_gallery',
		'posts_per_page'	=>	$num_of_posts,
	);

	// The Query
	$qry = new WP_Query( $qry_args );
	?>

	<section class="sec-100px gallery">

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

			if ( $qry->have_posts() ) :
				?>
				<ul class="row">
					<?php
					$i = 1;
					while( $qry->have_posts() ) : $qry->the_post();
						?>
						<li class="col-sm-4">
							<div class="inn-sec">

								<?php echo get_the_term_list( get_the_ID(), 'gallery-tags' ); ?>

								<div class="hover-info">
									<div class="position-center-center">
										<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>" data-rel="prettyPhoto" class="prettyPhoto lightzoom zoom">
											<i class="fa fa-image"></i>
										</a>
									</div>
								</div>
								<?php the_post_thumbnail("museumwp-360-278"); ?>
								<div class="detail">
									<a href="<?php echo esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
									<p><span><?php esc_html_e("Origin: ", "museumwp-toolkit"); ?></span><?php echo esc_attr( get_post_meta( get_the_ID(), 'museumwp_cf_gallery_orgin', true ) ); ?></p>
								</div>
							</div>
						</li>
						<?php
						if( $i % 3 == 0 ) {
							?>
							<li class="clearfix"></li>
							<?php
						}
						$i++;
					endwhile;

					// Restore original Post Data
					wp_reset_postdata();
					?>
				</ul>
				<?php
			endif;
			?>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode('museumwp_gallery', 'museumwp_gallery');

vc_map( array(
	"name" => __("Gallery", "museumwp-toolkit"),
	"icon" => 'vc-site-icon',
	"base" => "museumwp_gallery",
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
			"heading" => __("No of Items", "museumwp-toolkit"),
			"param_name" => "num_of_posts",
			"value" => array(
				"Select an Option" => "",
				"All" => "-1",
				"3" => "3",
				"6" => "6",
				"9" => "9",
				"12" => "12",
			)
		),				
	)
) );