(function($) {

	/* Event - Document Ready */
	$(document).on("ready",function() {

		$( "#redux_save" ).before(function() {
			return '<i class="fa fa-save"></i>';
 		});

		$( "#redux-defaults-section" ).before(function() {
			return '<i class="fa fa-undo"></i>';
 		});

		$( "#redux-defaults" ).before(function() {
			return '<i class="fa fa-refresh"></i>';
 		});

		$( "#redux-footer-sticky #redux_save" ).before(function() {
			return '<i class="fa fa-save"></i>';
 		});

		$( "#redux-footer-sticky #redux-defaults-section" ).before(function() {
			return '<i class="fa fa-undo"></i>';
 		});

		$( "#redux-footer-sticky #redux-defaults" ).before(function() {
			return '<i class="fa fa-refresh"></i>';
 		});	
		
		/* - Add Anchor link for button */
		$(".redux-action_bar").each(function() {
			$(this).find(".fa-save,#redux_save").wrapAll('<a class="control_button save" title="Save Changes"></a>');
			$(this).find(".fa-undo,#redux-defaults-section").wrapAll('<a class="control_button reset" title="Reset Section"></a>');
			$(this).find(".fa-refresh,#redux-defaults").wrapAll('<a class="control_button resetall" title="Reset All"></a>');
		});

		/* Disable : Page Editor */
		if( $('body.post-type-page #postdivrich').length ) {

			/* Sidebar Layout */
			if( $('select#page_template').val() != 'default' ) {
				$('body.post-type-page #postdivrich').slideUp(500);
			}

			$('select#page_template').live('change', function() {

				/* Sidebar Layout */
				if( $('select#page_template').val() != 'default' ) {
					$('body.post-type-page #postdivrich').slideUp(500);
				}
				else {
					$('body.post-type-page #postdivrich').slideDown(500);
					$(window).scrollTop($(window).scrollTop()+1);
				}

			});
		}

		/* Post : Metabox */
		if( $('#museumwp_cf_metabox_post_layout').length ) {

			/* Sidebar Layout */
			if( $('select#museumwp_cf_sidebar_layout_post').val() == 'no_sidebar' ) {
				$('.cmb2-id-museumwp-cf-widget-area-post').slideUp(500);
			}

			$('select#museumwp_cf_sidebar_layout_post').live('change', function() {

				/* Sidebar Layout */
				if( $('select#museumwp_cf_sidebar_layout_post').val() == 'no_sidebar' ) {
					$('.cmb2-id-museumwp-cf-widget-area-post').slideUp(500);
				}
				else {
					$('.cmb2-id-museumwp-cf-widget-area-post').slideDown(500);
				}

			});
		}

		/* Post : Formats */
		if( $('#post-formats-select').length ) {

			if( $('input[id="post-format-gallery"]').is(':checked') ) {
				$('#museumwp_cf_metabox_post_gallery').slideDown(500); /* Enable Gallery */
			}
			else {
				$('#museumwp_cf_metabox_post_gallery').slideUp(500);
			}

			/* On Change : Event */
			$('#post-formats-select').live('change', function() {
				if( $('input[id="post-format-gallery"]').is(':checked') ) {
					$('#museumwp_cf_metabox_post_gallery').slideDown(500); /* Enable Gallery */
				}
				else {
					$('#museumwp_cf_metabox_post_gallery').slideUp(500);
				}
			});
		}

		/* Page : Metabox */
		if( $('#museumwp_cf_metabox_page').length ) {

			/* Header Background Color */
			if( $('select#museumwp_cf_page_title').val() != 'enable' ) {
				$('.cmb2-id-museumwp-cf-page-sub-title').slideUp(500);
				$('.cmb2-id-museumwp-cf-page-header-img').slideUp(500);
			}

			$('#museumwp_cf_page_title').live('change', function() {

				/* Header Background Image */
				if( $('select#museumwp_cf_page_title').val() == 'disable' ) {
					$('.cmb2-id-museumwp-cf-page-sub-title').slideUp(500);
					$('.cmb2-id-museumwp-cf-page-header-img').slideUp(500);
				}
				else {
					$('.cmb2-id-museumwp-cf-page-sub-title').slideDown(500);
					$('.cmb2-id-museumwp-cf-page-header-img').slideDown(500);
				}
			});

			/* Sidebar Layout - Page */
			if( $('select#museumwp_cf_sidebar_layout').val() == 'no_sidebar' ) {
				$('.cmb2-id-museumwp-cf-widget-area').slideUp(500);
			}

			$('select#museumwp_cf_sidebar_layout').live('change', function() {

				/* Sidebar Layout - Page */
				if( $('select#museumwp_cf_sidebar_layout').val() == 'no_sidebar' ) {
					$('.cmb2-id-museumwp-cf-widget-area').slideUp(500);
				}
				else {
					$('.cmb2-id-museumwp-cf-widget-area').slideDown(500);
				}

			});
		}

		// Uploads			
		var museumwp_img_frame;

		$(document).on('click', 'input.select-img', function( event ) {

			var $this = $(this);

			event.preventDefault();

			var OWImage = wp.media.controller.Library.extend({
				defaults :  _.defaults({
						id:        'museumwp-insmuseumwp-image',
						title:      $this.data( 'uploader_title' ),
						allowLocalEdits: false,
						displaySettings: true,
						displayUserSettings: false,
						multiple : false,
						library: wp.media.query( { type: 'image' } )
				  }, wp.media.controller.Library.prototype.defaults )
			});

			// Create the media frame.
			museumwp_img_frame = wp.media.frames.museumwp_img_frame = wp.media({
			  button: {
				text: $( this ).data( 'uploader_button_text' ),
			  },
			  state : 'museumwp-insmuseumwp-image',
				  states : [
					  new OWImage()
				  ],
			  multiple: false  // Set to true to allow multiple files to be selected
			});

			// When an image is selected, run a callback.
			museumwp_img_frame.on( 'select', function() {

				var state = museumwp_img_frame.state('museumwp-insmuseumwp-image');
				var selection = state.get('selection');
				var display = state.display( selection.first() ).toJSON();
				var obj_attachment = selection.first().toJSON();

				display = wp.media.string.props( display, obj_attachment );

				var image_field = $this.siblings('.img');
				var imgurl = display.src;

				// Copy image URL
				image_field.val(imgurl);

				// Show in preview
				var image_preview_wrap = $this.siblings('.museumwp-preview-wrap');
				image_preview_wrap.show();
				image_preview_wrap.find('img').attr('src',imgurl);
			});

			// Finally, open the modal
			museumwp_img_frame.open();
		});
	});
})(jQuery);