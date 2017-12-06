<?php
/**
 * Theme functions and definitions
*/

/* Define Constants */
define( 'MUSEUMWP_IMGURI', get_template_directory_uri() . '/images' );

/* Include Admin */
require get_template_directory() . '/admin/inc.php';

/**
 * Set up the content width value based on the theme's design.
 *
 * @see museumwp_width()
 *
 * @since Museumwp 1.0
 */
if ( ! isset( $content_width ) ) { $content_width = 474; }

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Museumwp 1.0
 */
if( !function_exists('museumwp_width') ) :
	function museumwp_width() {
		if ( is_attachment() && wp_attachment_is_image() ) { $GLOBALS['content_width'] = 810; }
	}
	add_action( 'template_redirect', 'museumwp_width' );
endif;

/* --------------------------------------------- */

if( !function_exists('museumwp_get_the_ID') ) :

	function museumwp_get_the_ID() {

		if( class_exists( 'WooCommerce' ) && wc_get_page_id('shop') != "-1" && is_shop() ) {
			$post_id = wc_get_page_id('shop');
		}
		else {
			$post_id = get_the_ID();
		}

		return ! empty( $post_id ) ? $post_id : false;
	}
endif;

/* --------------------------------------------- */

/* Redux Options */
if( !function_exists('museumwp_options') ) :

	function museumwp_options( $option, $arr = null ) {

		global $museumwp_option;

		if( $arr ) {

			if( isset( $museumwp_option[$option][$arr] ) ) {
				return $museumwp_option[$option][$arr];
			}
		}
		else {
			if( isset( $museumwp_option[$option] ) ) {
				return $museumwp_option[$option];
			}
		}
	}

endif;

/* --------------------------------------------- */

/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Museumwp 1.0
 */
if( !function_exists('museumwp_theme_setup') ) :

	function museumwp_theme_setup() {

		/* load theme languages */
		load_theme_textdomain( 'museumwp', get_template_directory() . '/languages' );

		/* Muse Image Sizes */
		add_image_size( 'museumwp-360-278', 360, 278, true );
		add_image_size( 'museumwp-311-667', 311, 667, true );

		set_post_thumbnail_size( 823, 365, true ); /* Default Featured Image */

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary'   => __( 'Primary menu', "museumwp" ),
			'footer'   => __( 'Footer menu', "museumwp" ),
		) );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		/* WooCommerce Theme Support */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array( 'gallery' ) );
	}
	add_action( 'after_setup_theme', 'museumwp_theme_setup' );
endif;

/* --------------------------------------------- */

/* Google Font */
if( !function_exists('museumwp_fonts_url') ) :

	function museumwp_fonts_url() {

		$fonts_url = '';
		
		$montserrat = _x( 'on', 'Montserrat font: on or off', "museumwp" );
		$raleway = _x( 'on', 'Raleway font: on or off', "museumwp" );
		$open_sans = _x( 'on', 'Open Sans font: on or off', "museumwp" );

		if ( 'off' !== $raleway || 'off' !== $montserrat || 'off' !== $open_sans ) {

			$font_families = array(); 
			if ( 'off' !== $raleway ) {
				$font_families[] = 'Raleway:500,600,700,100,800,900,400,200,300';
			}
			
			if ( 'off' !== $montserrat ) {
				$font_families[] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
			}
			
			if ( 'off' !== $open_sans ) {
				$font_families[] = 'Open Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/* --------------------------------------------- */

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Museumwp 1.0
 */
if( !function_exists('museumwp_enqueue_scripts') ) :

	function museumwp_enqueue_scripts() {

		// Load the html5 shiv.
		wp_enqueue_script( 'respond.min', get_template_directory_uri() . '/js/html5/respond.min.js' );
		wp_script_add_data( 'respond.min', 'conditional', 'lt IE 9' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/* Lib */
		wp_enqueue_style( 'museumwp-lib', get_template_directory_uri() . '/css/lib.css');
		wp_enqueue_script( 'museumwp-lib', get_template_directory_uri() . '/js/lib.js', array( 'jquery' ) );

		wp_add_inline_script( 'museumwp-lib', '
			var templateUrl = "'.esc_url( get_template_directory_uri() ).'";
			var WPAjaxUrl = "'.esc_url( admin_url( 'admin-ajax.php' ) ).'";
		');
		
		/* Google Font */
		if( function_exists('museumwp_fonts_url') ) :
			wp_enqueue_style( 'museumwp-fonts', museumwp_fonts_url() );
		endif;

		wp_enqueue_style( 'dashicons' );

		/* Main Stylesheet */
		wp_enqueue_style( 'museumwp-stylesheet', get_template_directory_uri() . '/style.css' );

		/* Custom Functions JS */
		wp_enqueue_script( 'museumwp-functions', get_template_directory_uri() . '/js/functions.js' );
	}
	add_action( 'wp_enqueue_scripts', 'museumwp_enqueue_scripts' );
endif;

/* --------------------------------------------- */

/**
 * Extend the default WordPress body classes.
 *
 * @since Museumwp 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
if( !function_exists('museumwp_body_classes') ) :

	function museumwp_body_classes( $classes ) {

		if ( is_singular() && ! is_front_page() ) {
			$classes[] = 'singular';
		}

		if( is_front_page() && !is_home() ) {
			$classes[] = 'front-page';
		}

		return $classes;
	}
	add_filter( 'body_class', 'museumwp_body_classes' );
endif;

/* --------------------------------------------- */

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Museumwp 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
if( !function_exists('museumwp_post_classes') ) :
	function museumwp_post_classes( $classes ) {
		if ( ! is_attachment() && has_post_thumbnail() ) { $classes[] = 'has-post-thumbnail'; }
		return $classes;
	}
	add_filter( 'post_class', 'museumwp_post_classes' );
endif;

/* --------------------------------------------- */

/**
 * Register three widget areas.
 *
 * @since Museumwp 1.0
 */
if ( ! function_exists( 'museumwp_widgets_init' ) ) {
	
	function museumwp_widgets_init() {

		register_sidebar( array(
			'name'          => __( 'Right Sidebar', "museumwp" ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Appears in the Content section of the site.', "museumwp" ),
			'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		));
		register_sidebar( array(
			'name'          => __( 'Left Sidebar', "museumwp" ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears in the Content section of the site.', "museumwp" ),
			'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		));
		register_sidebar( array(
			'name'          => __( 'WooCommerce Sidebar', "museumwp" ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears in the Content section of the site.', "museumwp" ),
			'before_widget' => '<aside id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		));
	}
	add_action( 'widgets_init', 'museumwp_widgets_init' );
}

/* Check string for Null or Empty */
if ( ! function_exists( 'museumwp_checkstring' ) ) :
	function museumwp_checkstring( $strValue ) {
		if ( !isset( $strValue ) || trim( $strValue ) === '' ) :
			return false;
		else :
			return true;
		endif;
	}
endif;

/* Check string for Null or Empty & Print It */
if ( ! function_exists( 'museumwp_content' ) ) :
	function museumwp_content( $before_val, $after_val, $val ) {

		if( $val != "" ) {
			return $before_val.$val.$after_val;
		}
		else {
			return "";
		}
	}
endif;

/* Add Admin Column - Gallery */
add_filter('manage_museumwp_gallery_posts_columns', 'museumwp_gallery_columns', 10);
function museumwp_gallery_columns( $defaults ) {

	$defaults['muse_post_thumbs'] = esc_html__("Image", "museumwp");
	return $defaults;
}

add_action('manage_museumwp_gallery_posts_custom_column', 'museumwp_gallery_custom_columns', 10, 2);
function museumwp_gallery_custom_columns( $column_name, $id ) {

	if( $column_name === 'muse_post_thumbs' ){
		echo the_post_thumbnail( array( 50,50 ) );
	}
}

/* Add Admin Column - Clients */
add_filter('manage_client_posts_columns', 'client_columns', 10);
function client_columns( $defaults ) {

	$defaults['muse_post_thumbs'] = esc_html__("Image", "museumwp");
	return $defaults;
}

add_action('manage_client_posts_custom_column', 'client_custom_columns', 10, 2);
function client_custom_columns( $column_name, $id ) {

	if( $column_name === 'muse_post_thumbs' ){
		echo the_post_thumbnail( array( 50,50 ) );
	}
}

/* Add Admin Column - Events */
add_filter('manage_tribe_events_posts_columns', 'tribe_events_columns', 10);
function tribe_events_columns( $defaults ) {

	$defaults['muse_post_thumbs'] = esc_html__("Image", "museumwp");
	return $defaults;
}

add_action('manage_tribe_events_posts_custom_column', 'tribe_events_custom_columns', 10, 2);
function tribe_events_custom_columns( $column_name, $id ) {

	if( $column_name === 'muse_post_thumbs' ){
		echo the_post_thumbnail( array( 50,50 ) );
	}
}

// OW Front-end Nav Walker
class museumwp_nav_walker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= $item->url;
				//$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			else
				$item_output .= '<a'. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		if ( $args->has_children ) {
			$output .= "<i class='ddl-switch fa fa-angle-down'></i>\n";
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo html_entity_decode( $fb_output );
		}
	}
}

/* ************************************************************************ */

if( class_exists("woocommerce") ) {

	/* Change number or products per row to 3 */
	if ( !function_exists('museumwp_loop_columns') ) :

		add_filter('loop_shop_columns', 'museumwp_loop_columns');

		function museumwp_loop_columns() {
			$wccolumn = 3;
			return $wccolumn; // products per row
		}
	endif;
	
	if ( !function_exists('museumwp_related_products_args') ) :

		add_filter( 'woocommerce_output_related_products_args', 'museumwp_related_products_args' );

		function museumwp_related_products_args( $args ) {

			$args['posts_per_page'] = 3; // 4 related products
			$args['columns'] = 3; // arranged in 3 columns
			return $args;
			
		}
	endif;
}