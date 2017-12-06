<?php
/**
 * The Header for our theme
 *
 *
 * @package WordPress
 * @subpackage Museumwp
 * @since Museumwp 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Page Wrap -->
<div id="wrap"> 

	<header class="site-header">

		<div class="container">
			<div class="top-bar">
				<div class="open-time">
					<p><i class="ion-ios-clock-outline"></i> <?php echo esc_attr( museumwp_options('opt_openinghours') ); ?></p>
				</div>
				<div class="call">
					<p><i class="ion-headphone"></i> <?php echo esc_attr( museumwp_options('opt_contactno') ); ?></p>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-default ow-navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php
					if( museumwp_checkstring( museumwp_options('opt_site_logo','url') ) && museumwp_options('opt_logo_select') == '2' ):
						?>
						<a class="logo image-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( museumwp_options('opt_site_logo','url') ); ?>" alt=""/></a>
						<?php
					else:
						?>
						<a class="logo text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo('title'); ?></a>
						<?php
					endif;
					?>
				</div>
				<div class="navbar-collapse collapse pull-right">
					<?php
					if( has_nav_menu('primary') ) :
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container' => false,
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth' => 10,
							'menu_class' => 'nav navbar-nav',
							'walker' => new museumwp_nav_walker
						));
					endif;
					?>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>
	</header>

	<?php
	if( is_page() && museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_page_header_img', true ) ) ) {
		$header_style = get_post_meta( get_the_ID(), 'museumwp_cf_page_header_img', true );
	}
	elseif( ( is_single() || is_singular('tribe_events') ) && museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_post_header_img', true ) ) ) {
		$header_style = get_post_meta( get_the_ID(), 'museumwp_cf_post_header_img', true );
	}
	else {
		$header_style = "";
	}

	if( get_post_meta( get_the_ID(), 'museumwp_cf_sidebar_layout', true ) == "no_sidebar" ) {
		$header_css = " full-page-header";
	}
	else {
		$header_css = "";
	}

	if( !is_single() && get_post_meta( get_the_ID(), 'museumwp_cf_page_title', true ) != "disable" && !is_home() ) :
		?>
		<div data-stellar-background-ratio="0.3" class="page-header<?php echo esc_attr( $header_css ); ?>"<?php if( museumwp_checkstring( $header_style ) ) { ?> style="background-image: url(<?php echo esc_attr( $header_style ); ?>);"<?php } ?>>

			<div class="overlay-gr">
				<?php
				if( is_404() ) {
					?>
					<h1 class="page-title"><?php esc_html_e( 'Error Page', "museumwp" ); ?></h1>
					<?php
				}
				elseif( is_search() ) {
					?>
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', "museumwp" ), get_search_query() ); ?></h1>
					<?php
				}
				elseif ( is_post_type_archive('tribe_events') ) {
					?>
					<h1 class="page-title"><?php esc_html_e("Calendar of Events", "museumwp"); ?></h1>
					<?php
				}
				elseif( is_archive() ) {
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				}
				else {
					the_title('<h1 class="page-title">','</h1>' );
				}
				if( museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_page_sub_title', true ) ) ) {
					?>
					<h4 class="page-subtitle">
						<?php echo esc_attr( get_post_meta( get_the_ID(), 'museumwp_cf_page_sub_title', true ) ); ?>
					</h4>
					<?php
				}
				?>
			</div>
		</div>

		<div class="breadcrumb">
			<?php
			if( function_exists( 'bcn_display' ) ) {
				bcn_display();
			}
			?>
		</div>

		<?php
	endif;

	if( is_single() || is_singular('tribe_events') && ( museumwp_checkstring( $header_style ) ) ) :
		?>
		<div data-stellar-background-ratio="0.3" class="page-header"<?php if( museumwp_checkstring( $header_style ) ) { ?> style="background-image: url(<?php echo esc_attr( $header_style ); ?>);"<?php } ?>>

			<div class="overlay-gr">

				<h1 class="page-title">
					<?php echo get_the_title( get_the_ID() ); ?>
				</h1>

				<?php
				if( museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_post_sub_title', true ) ) ) {
					?>
					<h4 class="post-subtitle">
						<?php echo esc_attr( get_post_meta( get_the_ID(), 'museumwp_cf_post_sub_title', true ) ); ?>
					</h4>
					<?php
				}
				?>
			</div>

		</div>

		<div class="breadcrumb">
			<?php
			if( function_exists( 'bcn_display' ) ) {
				bcn_display();
			}
			?>
		</div>

		<?php
	endif;
	?>