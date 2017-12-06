<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Museumwp
 * @since Museumwp 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_post_thumbnail(); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', "museumwp" ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', "museumwp" ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>

	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', "museumwp" ), '<div class="container"><footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer --></div>' ); ?>

</article><!-- #post-## -->