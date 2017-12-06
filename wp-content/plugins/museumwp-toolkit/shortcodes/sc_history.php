<?php
function museumwp_history( $atts ) {

	extract( shortcode_atts(
		array(
		), $atts )
	);

	ob_start();
	?>

	<section class="history">

		<div class="row"> 

			<!-- IMAGE -->
			<div class="col-md-4 no-padding">
				<div class="museum-img" style="background-image: url(<?php echo esc_url( museumwp_options('opt_block_image','url') ); ?>);"> </div>
			</div>

			<!-- History Content -->
			<div class="col-md-8 no-padding">

				<div class="history-detail">

					<ul class="row">
						<li class="col-md-3">
							<?php echo museumwp_content("<h4>","</h4><hr>", museumwp_options('opt_content_block1_title') ); ?>
						</li>
						<li class="col-md-9">
							<?php echo wpautop( museumwp_options('opt_content_block1_desc') ); ?>
						</li>
					</ul>

					<!-- On View -->
					<ul class="row on-view">
						<li class="col-md-3">
							<?php echo museumwp_content("<h4>","</h4><hr>", museumwp_options('opt_content_block2_title') ); ?>
						</li>
						<li class="col-md-9">
							<?php
							if( is_array( museumwp_options('opt_content_block2_list') ) && count( museumwp_options('opt_content_block2_list') ) > 0 ) {
								?>
								<ul class="row">
									<?php
									foreach( museumwp_options('opt_content_block2_list') as $list_item ) {
										?>
										<li class="col-md-4 col-sm-6"><p><?php echo esc_attr( $list_item ); ?></p></li>
										<?php
									}
									?>
								</ul>
								<?php
							}
							?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode('museumwp_history', 'museumwp_history');

vc_map( array(
	"name" => __("History", "museumwp-toolkit"),
	"icon" => 'vc-site-icon',
	"base" => "museumwp_history",
	"category" => __('Museum Theme', "museumwp-toolkit"),
	"params" => array(
		array(
			"type" => "label",
			"class" => "",
			"heading" => __("No Settings to save, Goto => Theme Options => Shortcodes => Our History", "museumwp-toolkit"),
			"param_name" => "history_label",
		),
	)
) );