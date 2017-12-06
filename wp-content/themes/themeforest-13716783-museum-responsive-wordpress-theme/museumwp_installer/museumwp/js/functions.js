/*
	Project Name : Muse

	## Document Ready
		- Color Switcher
		- Scrolling Navigation
		- Responsive Caret
		- Remove p empty tag for Shortcode
		- Social Share
		- Portfolio Section
		- Detecting Mobile Devices

	## Window Resize
		- Testimonials - Flexslider
	
	## Window Load
		- Site Loader
*/

(function($) {

	"use strict"

	$(".sponsors-row").attr("data-stellar-background-ratio", "0.5");

	/* ## Document Ready - Handler for .ready() called */
	$(document).ready(function($) {

		/* - Select Box */
		$( "select:not(.wpcf7-form-control)" ).wrap( "<div class='select_box'></div>" );

		/* CLIENTS LOGO SLIDE */
		$(".client-slide").owlCarousel({ 
			autoplay:true,
			autoplayHoverPause:true,
			singleItem	: true,
			navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			lazyLoad:true,
			nav: false,
			loop:true,
			margin:30,
			animateOut: 'fadeOut',	
			responsive:{
				0:{
					items:1
				},
				600:{
					items:2
				},
				800:{
					items:3
				},
				1200:{
					items:5
				}}	
		});

		/* Pretty Photo */
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			theme: "light_square"
		});

		/* Parallax */
		$.stellar({
		   horizontalScrolling: false,
		   scrollProperty: 'scroll',
		   positionProperty: 'position'
		});

		/* - Responsive Caret */
		$('.ddl-switch').on('click', function() {

			var li = $(this).parent();

			if ( li.hasClass('ddl-active') || li.find('.ddl-active').length !== 0 || li.find('.dropdown-menu').is(':visible') ) {
				li.removeClass('ddl-active');
				li.children().find('.ddl-active').removeClass('ddl-active');
				li.children('.dropdown-menu').slideUp();	
			}
			else {
				li.addClass('ddl-active');
				li.children('.dropdown-menu').slideDown();
			}
		});

		/* - Remove p empty tag for Shortcode */
		$( 'p' ).each(function() {
			var $this = $( this );
				if( $this.html().replace(/\s|&nbsp;/g, '').length == 0) {
				$this.remove();
			}
		});

		/* - Social Share */
		if( $('.social-share').length ) {

			$('.social-share > li > a', this).bind('click', function(e) {

				e.preventDefault();
				e.stopPropagation();

				var data_action = $(this).attr('data-action');
				var data_title = $(this).attr('data-title');
				var data_url = $(this).attr('data-url');

				if( data_action == 'facebook' ) {		
					window.open('http://www.facebook.com/share.php?u='+encodeURIComponent(data_url)+'&title='+encodeURIComponent(data_title),'sharer','toolbar=0,status=0,width=580,height=325');
				}
				else if( data_action == 'twitter' ) {
					window.open('http://twitter.com/intent/tweet?status='+encodeURIComponent(data_url)+'+'+encodeURIComponent(data_title),'sharer','toolbar=0,status=0,width=580,height=325');
				}
				else if( data_action == 'pinterest' ) {
					window.open('http://pinterest.com/pin/create/button/?url='+encodeURIComponent(data_url)+'&media=http://cdn2.wpbeginner.com/wp-content/uploads/2013/12/siteground-74x74.jpg&description='+encodeURIComponent(data_title),'sharer','toolbar=0,status=0,width=580,height=325');
				}
				else if( data_action == 'google-plus' ) {
					window.open('https://plus.google.com/share?url='+encodeURIComponent(data_url),'sharer','toolbar=0,status=0,width=580,height=325');
				}
				else if( data_action == 'linkedin' ) {
					window.open('http://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(data_url)+'&title='+encodeURIComponent(data_title)+'&source='+encodeURIComponent(data_url),'sharer','toolbar=0,status=0,width=580,height=325');
				}
				else if( data_action == 'digg' ) {
					window.open('http://digg.com/submit?url='+encodeURIComponent(data_url)+'&amp;title='+encodeURIComponent(data_title),'sharer','toolbar=0,status=0,width=580,height=325');
				}
				else if( data_action == 'reddit' ) {
					window.open('http://www.reddit.com/submit?url='+encodeURIComponent(data_url)+'&amp;title='+encodeURIComponent(data_title),'sharer','toolbar=0,status=0,width=580,height=325');
				}
			});
		}

		/* - Detecting Mobile Devices */
		var isMobile = {

			/* if ( ! isMobile.Android() ) { } */ /* How to use ? */

			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
			},
			Desktop: function() {
				return window.innerWidth <= 960;
			},
			any: function() {
				return ( isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows() || isMobile.Desktop() );
			}
		};

	});

})(jQuery);