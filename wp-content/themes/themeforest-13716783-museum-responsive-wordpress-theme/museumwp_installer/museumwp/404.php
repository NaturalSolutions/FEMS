<?php
/**
* The Template for displaying all single posts
*
* @package WordPress
* @subpackage Museumwp
* @since Museumwp 1.0
*/
get_header(); ?>

<main id="main" class="site-main" role="main">

	<div class="content">
    <div class="container"> 
      <!--======= 404-page =========-->
      <div class="error-page text-center"> <img alt="" src="<?php echo esc_url( MUSEUMWP_IMGURI ); ?>/404-page.jpg">
        <h1><?php esc_html_e("404", "museumwp"); ?></h1>
        <h2><?php esc_html_e("Sorry, this page isn't available", "museumwp"); ?></h2>
        <h3><?php esc_html_e("The link you followed is probably broken or the page has been removed.", "museumwp"); ?></h3>
      </div>
    </div>
  </div>

</main><!-- .site-main -->

<?php get_footer(); ?>