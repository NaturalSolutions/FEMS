<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Museumwp
 * @since Museumwp 1.0
 */
	if( has_nav_menu('footer') ) {
		$footer_menu_css = "";
	}
	else {
		$footer_menu_css = " menu-disabled";
	}
?>
		<!--======= Footer =========-->
		<footer class="site-footer<?php echo esc_attr( $footer_menu_css ); ?>">
			<div class="container">
				<?php
				if( has_nav_menu('footer') ) :
					?>
					<nav class="navbar navbar-default ow-navigation">
						<div class="navbar-collapse-footer pull-left">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'footer',
								'container' => false,
								'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth' => 10,
								'menu_class' => 'nav navbar-nav',
								'depth' => 10 ,
								'walker' => new museumwp_nav_walker
							));
							?>
						</div>
						<!--/.nav-collapse -->
					</nav>

					<div class="foot-logo"> <img src="<?php echo esc_url( museumwp_options('opt_footer_logo','url') ); ?>" alt=""> </div>
					<?php
				endif;
				?>

				<!-- Footer Logo -->
				<div class="under-footer">
					<ul class="con-info col-md-8 col-sm-6">
						<li><p><i class="fa fa-map-marker"></i><?php echo esc_attr( museumwp_options('opt_contact_address_ft') ); ?></p></li>
						<li><p><i class="fa fa-phone"></i><?php echo esc_attr( museumwp_options('opt_contact_no_ft') ); ?></p></li>
						<li><p><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr( museumwp_options('opt_contact_email_ft') ); ?>"><?php echo esc_attr( museumwp_options('opt_contact_email_ft') ); ?></a></p></li>
					</ul>
					<ul class="social-icons col-md-4 col-sm-6">
						<?php
						if( is_array( museumwp_options('opt_social_icons') ) && count( museumwp_options('opt_social_icons') ) > 0 ) :
							foreach( museumwp_options('opt_social_icons') as $single_item ) {
								?>
								<li><a target="_blank" href="<?php echo esc_url( $single_item['url'] ); ?>"><?php echo esc_attr( $single_item['title'] ); ?></a></li>
								<?php
							}
						endif;
						?>
					</ul>
				</div>

			</div>

		</footer>

	</div>
	<?php wp_footer(); ?>
</body>
</html>