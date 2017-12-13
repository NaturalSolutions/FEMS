<?php /* Template Name: CustomPage*/
get_header();

/* Page Layout */
if( museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_page_layout', true ) ) ) {
	$page_layout = get_post_meta( get_the_ID(), 'museumwp_cf_page_layout', true );
}
else {
	$page_layout = "";
}

if( $page_layout == "fluid" ) {
	$page_layout_css = "container-fluid no-padding";
}
else {
	$page_layout_css = "container no-padding";
}

/* Widget Area */
if( museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_sidebar_layout', true ) ) ) {
	$sidebar_layout = get_post_meta( get_the_ID(), 'museumwp_cf_sidebar_layout', true );
}
else {
	$sidebar_layout = "";
}

if( $sidebar_layout == "right_sidebar" ) {
	$sidebar_css = "sidebar-right";
}
elseif( $sidebar_layout == "left_sidebar" ) {
	$sidebar_css = "sidebar-left";
}
elseif( $sidebar_layout == "no_sidebar" ) {
	$sidebar_css = "no-sidebar";
}
else {
	$sidebar_css = "sidebar-right";
}

if( museumwp_checkstring( get_post_meta( get_the_ID(), 'museumwp_cf_widget_area', true ) ) ) {
	$widget_area = get_post_meta( get_the_ID(), 'museumwp_cf_widget_area', true );
}
else {
	$widget_area = "sidebar-1";
}
?>
<main id="main" class="site-main" role="main">

	<div class="page-content">

		<div class="<?php echo esc_attr( $page_layout_css ); ?>">

			<div class="content-area <?php echo esc_attr( $content_area_css ); ?>">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						?>
						<div class="container no-padding comment-area-page">
							<?php comments_template(); ?>
						</div>
						<?php
					endif;

				// End the loop.
				endwhile;
				?>
			</div>

		</div><!-- .container /- -->

	</div><!-- Page Content /- -->

</main><!-- .site-main -->

<?php get_footer(); ?>
















<script type="text/javascript">

var ctx2 = document.getElementById("myChart2");
var myChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ["Fiches experiences", "administratives", "scientifiques", "muséographiques"],
        datasets: [{
            label: '# of Votes',
            data: [25, 25,25,25],
            backgroundColor: [
                'rgba(164, 70, 146, 1)',
                'rgba(114, 33, 99, 1)',
                'rgba(97, 0, 77, 1)',
                'rgba(125, 227, 21, 1)'
            ],
            borderColor: [
                'rgba(255, 255, 255, 1)',
                'rgba(255, 255, 255, 1)',
                'rgba(255,255, 255, 1)',
                'rgba(255, 255, 255, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
		responsive: true,
		legend: {
			position: 'top',
		},
		title: {
			display: true,
			position: 'top'
		},
		animation: {
			animateScale: true,
			animateRotate: true
		},
		tooltips:{
			mode: 'nearest'
		}
    }
});



var ctx1 = document.getElementById("myChart1");
var myChart = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ["0 à 5 000", "5 001 à 1 0000", "10 001 à 30 000", "30 001 à 50 000","50 001 à 100 000","+ de 100 000"],
        datasets: [{
            label: '# of Votes',
            data: [25,24,25,9,10,7],
            backgroundColor: [
                'rgba(164, 70, 146, 1)',
                'rgba(114, 33, 99, 1)',
                'rgba(97, 0, 77, 1)',
                'rgba(125, 227, 21, 1)',
                'rgba(81, 89, 172, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderColor: [
                'rgba(255,255, 255, 1)',
                'rgba(255,255, 255, 1)',
                'rgba(255,255, 255, 1)',
                'rgba(255,255, 255, 1)',
                'rgba(255,255, 255, 1)',
                'rgba(255,255, 255, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
		responsive: true,
		legend: {
			position: 'top',
		},
		title: {
			display: true,
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
    }
});
</script>

