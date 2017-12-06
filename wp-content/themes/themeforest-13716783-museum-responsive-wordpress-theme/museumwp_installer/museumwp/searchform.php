<?php $sfid = rand(0,999); ?>
<form role="search" method="get" id="searchform-<?php echo esc_attr( $sfid ); ?>" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="text" name="s" id="s-<?php echo esc_attr( $sfid ); ?>" placeholder="<?php esc_html_e("Type Your Query Here...","museumwp"); ?>" class="form-control" required>
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
		</span>
	</div><!-- /input-group -->
</form>