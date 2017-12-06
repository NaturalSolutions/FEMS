<?php
if( has_post_thumbnail() ) {
	?>
	<div class="entry-cover">
		<?php
		if( is_single() ) {
			?>
			<?php the_post_thumbnail(); ?>
			<?php
		}
		else {
			?>
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
			<?php					
		} ?>
	</div>
	<?php
}