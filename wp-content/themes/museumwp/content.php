<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Museumwp
 * @since Museumwp 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		else :
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;
		?>
	</header>

	<ul class="entry-meta blog-post-info container-fluid">
		<li>
			<i class="fa fa-user"></i>
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="url fn n"><?php echo get_the_author(); ?></a>
		</li>
		<li>
			<i class="fa fa-clock-o"></i>
			<?php
			if( is_single() ) {
				?>
				<span class="entry-date"><?php echo get_the_date( 'F jS, Y', get_the_ID() ); ?></span>
				<?php
			}
			else {
				?>
				<a href="<?php echo esc_url( get_permalink() ); ?>"><span class="entry-date"><?php echo get_the_date( 'F jS, Y', get_the_ID() ); ?></span></a>
				<?php
			} ?>
		</li>
		<?php
		if( is_single() ) {
			the_tags('<li><i class="fa fa-tags"></i>',', ','</li>');
		}
		if ( 'museumwp_gallery' != get_post_type() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			?>
			<li>
				<i class="fa fa-comment"></i>
				<?php comments_popup_link( __( '0', "museumwp" ), __( '1', "museumwp" ), __( '%', "museumwp" ) ); ?>
			</li>
			<?php
		} ?>
	</ul>

	<?php get_template_part("template-parts/post_thumbnail"); ?>

	<?php get_template_part("template-parts/format","gallery"); ?>

	<div class="entry-content">
		<?php
		if( is_single() ) {
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', "museumwp" ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', "museumwp" ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', "museumwp" ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		}
		else {
			the_excerpt();
		}
		?>
	</div>
	<?php
	if( is_single() ) {
		?>
		<ul class="social-share">
			<li><?php esc_html_e( 'Share This Post : ', "museumwp" ); ?></li>
			<li><a href="javascript: void(0)" data-action="facebook" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-facebook"></i></a>
			<li><a href="javascript: void(0)" data-action="twitter" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-twitter"></i></a>
			<li><a href="javascript: void(0)" data-action="pinterest" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-pinterest"></i></a>
			<li><a href="javascript: void(0)" data-action="google-plus" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-google-plus"></i></a>
			<li><a href="javascript: void(0)" data-action="linkedin" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-linkedin"></i></a>
			<li><a href="javascript: void(0)" data-action="digg" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-digg"></i></a>
			<li><a href="javascript: void(0)" data-action="reddit" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-reddit"></i></a>
		</ul>
		<?php
	} ?>
</article>
<div class="clearfix"></div>