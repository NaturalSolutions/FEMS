<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
*/

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "museumwp_option";

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'museumwp_remove_demo' );

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => __( 'Theme Options', "museumwp" ),
	'page_title'           => __( 'Theme Options', "museumwp" ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => false,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => false,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => '_options',
	// Page slug used to denote the panel
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'system_info'          => false,
	// REMOVE

	//'compiler'             => true,

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'light',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);

Redux::setArgs( $opt_name, $args );

/* Header Settings */
Redux::setSection( $opt_name, array(
	'title'  => __( 'Header', "museumwp" ),
	'id'    => 'header_settings',
	'icon'  => 'el el-credit-card',
	'subsection' => false,
	'fields'     => array(
		/* Fields */
		array(
			'id'=>'info_logo',
			'type' => 'info',
			'title' => 'Logo',
		),
		array(
			'id'       => 'opt_logo_select',
			'type'     => 'select',
			'title'    => __( 'Logo Type', "museumwp" ),
			'options'  => array(
				'1' => 'Text Logo',
				'2' => 'Image Logo',
			),
			'default'  => '2',
		),
		array(
			'id'=>'opt_site_logo',
			'type' => 'media',
			'title' => __('Logo Upload', "museumwp" ),
			'required' => array( 'opt_logo_select', '=', '2' ),
			'default'  => array( 'url' => esc_url( MUSEUMWP_IMGURI ) . '/common/logo.png' ),
		),
		array(
			'id'=>'info_headerinfo',
			'type' => 'info',
			'title' => 'Contact Details',
		),
		array(
			'id'=>'opt_contactno',
			'type' => 'text',
			'title' => 'Contact No',
			'default' => '1800 123  4659',
		),
		array(
			'id'=>'opt_openinghours',
			'type' => 'text',
			'title' => 'Opening Hours',
			'default' => 'Museum opening hours: 8AM to 7PM. Open all days',
		),
		/* Fields /- */
	)		
) );
/* Header Settings /- */

/* Shortcode Sections */ 
Redux::setSection( $opt_name, array(
	'title'  => __( 'Shortcodes', "museumwp" ),
	'id'    => 'shortcodes',
	'icon'  => 'el el-tasks',
) );

/* Call to Action */
Redux::setSection( $opt_name, array(
	'title'      => __( 'Call to Action', "museumwp" ),
	'id'         => 'call_to_action',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'info_callto_content',
			'type'     => 'info',
			'title'     => __( "Content Part","museumwp" ),
		),
		array(
			'id'       => 'opt_callto_title1',
			'type'     => 'text',
			'title'     => __( "Title","museumwp" ),
			'default'     => __( "National Museum is a largest research and museum. more than 197 countries objects in history ","museumwp" ),
		),
		array(
			'id'       => 'opt_callto_desc',
			'type'     => 'textarea',
			'title'     => __( "Description","museumwp" ),
			'default'     => __( "Scelerisque, felis eget Auctor dictum tempus molestie auctor consectetuer sit nisl, tempor, ultrices velit nascetur ullamcorper torquent adipiscing felis interdum. Vel nibh. Eget maecenas gravida urna nascetur sit. Taciti at suspendisse rutrum. ","museumwp" ),
		),
		array(
			'id'       => 'opt_callto_btn',
			'type'     => 'text',
			'title'     => __( "Button Text","museumwp" ),
			'default'     => __( "Buy Tickets","museumwp" ),
		),
		array(
			'id'       => 'opt_callto_btn_url',
			'type'     => 'text',
			'title'     => __("Button Link","museumwp" ),
			'default'     => __( "#","museumwp" ),
		),
		array(
			'id'       => 'info_callto_content',
			'type'     => 'info',
			'title'     => __("Hours of visiting","museumwp" ),
		),
		array(
			'id'       => 'opt_callto_title2',
			'type'     => 'text',
			'title'     => __("Hours of visiting","museumwp" ),
			'default'     => __("Hours of visiting","museumwp" ),
		),
		array(
			'id'       => 'opt_visiting_hours',
			'type'     => 'ow_repeater', 
			'url'      => true,
			'title'    => __('Visiting Hours', "museumwp" ),
			'url'    => false,
			'image'      => false,
			'textOne'    => true,
			'textTwo'    => true,
			'placeholder'	=> array(
				'title' => __('Day', "museumwp" ),
				'textOne'    => __('Time', "museumwp" ),
				'textTwo'    => __('Appoinments', "museumwp" ),
			),
		),
	),
));
/* Call to Action /- */

/* Our History */
Redux::setSection( $opt_name, array(
	'title'      => __( 'Our History', "museumwp" ),
	'id'         => 'our_history',
	'subsection' => true,
	'fields'     => array(
		array(
			'id' => 'opt_block_image',
			'type' => 'media',
			'title' => __('Block Image', "museumwp" ),
			'default'  => array( 'url' => esc_url( MUSEUMWP_IMGURI ) . '/theme-options/museum-img.jpg' ),
		),
		array(
			'id' => 'info_content_block1',
			'type' => 'info',
			'title' => __('Content Block 1', "museumwp" ),
		),
		array(
			'id' => 'opt_content_block1_title',
			'type' => 'text',
			'title' => __('Title', "museumwp" ),
			'default' => __('Our history', "museumwp" ),
		),
		array(
			'id' => 'opt_content_block1_desc',
			'type' => 'editor',
			'title' => __('Description', "museumwp" ),
			'default' => __('<p>Scelerisque, felis eget Auctor dictum tempus molestie auctor consectetuer sit nisl, tempor, ultrices velit nascetur ullamcorper torquent adipiscing felis interdum. Vel nibh. Eget maecenas gravida urna nascetur sit. Taciti at suspendisse rutrum.</p><p>Donec quis tortor tempus, lacinia sem nec, accumsan diam. Ut condimentum eget risus at ultrices. Integer molestie augue eros, ac dignissim velit placerat ut. Sed vel leo ac eros tincidunt porttitor. Aliquam erat volutpat. </p>', "museumwp" ),
		),
		array(
			'id' => 'info_content_block2',
			'type' => 'info',
			'title' => __('Content Block 2', "museumwp" ),
		),
		array(
			'id' => 'opt_content_block2_title',
			'type' => 'text',
			'title' => __('Title', "museumwp" ),
			'default' => __('on view', "museumwp" ),
		),
		array(
			'id' => 'opt_content_block2_list',
			'type' => 'multi_text',
			'title' => __('List', "museumwp" ),
			'default' => array(
				"Arts of Global Africa",
				"Decorative Art",
				"Decorative Art",
				"American Art",
				"Gardens",
				"Gardens",
				"Arts of Canada Arts of Asia",
				"War History",
				"War History",
				"Classical Art",
				"Kings of History",
				"Kings of History",
				"German Arts",
				"German Arts"
			),
		),
	),
));
/* Our History /- */

/* Contact Page */
Redux::setSection( $opt_name, array(
	'title'      => __( 'Contact Page', "museumwp" ),
	'id'         => 'contact_page',
	'subsection' => true,
	'fields'     => array(
		/* Fields */
		array(
			'id'       => 'opt_contact_form',
			'type'     => 'info',
			'title'    => __('Contact Form', "museumwp" ),
		),
		array(
			'id'=>'opt_contact_shortcode',
			'type' => 'text',
			'title' => __('Contact Form 7 Shortcode', "museumwp" ),
			'subtitle' => __('Here Add Contact Form 7 Shortcode, e.g : [contact-form-7 id="266" title="Contact form 1"]', "museumwp" ),
		),
		array(
			'id'       => 'opt_contact_map',
			'type'     => 'info',
			'title'    => __('Contact Map', "museumwp" ),
		),
		array(
			'id'=>'opt_address_latitude',
			'type' => 'text',
			'title' => __('Latitude', "museumwp" ),
			'default' => __('-37.814107', "museumwp" ),
		),
		array(
			'id'=>'opt_address_longitude',
			'type' => 'text',
			'title' => __('Longitude', "museumwp" ),
			'default' => __('144.963280', "museumwp" ),
		),
		array(
			'id'       => 'opt_contact_info',
			'type'     => 'info',
			'title'    => __('Contact Info', "museumwp" ),
		),
		array(
			'id'=>'opt_contact_address',
			'type' => 'text',
			'title' => __('Contact Address', "museumwp" ),
			'default' => __('44 new Design Street, Melbourne 005 Australia 300', "museumwp" ),
		),
		array(
			'id'       => 'opt_contact_email',
			'type'     => 'text',
			'title'    => __('Email', "museumwp" ),
			'subtitle' => __('Receive contact form email.', "museumwp" ),
			'validate' => 'email',
			'msg'      => 'Please enter valid email address.',
			'default'  => 'email@example.com'
		),
		array(
			'id'=>'opt_contact_no',
			'type' => 'text',
			'title' => __('Contact No', "museumwp" ),
			'default' => __('01 (800) 433 633', "museumwp" ),
		),
		array(
			'id'=>'opt_contact_working_hours',
			'type' => 'text',
			'title' => __('Working Hours', "museumwp" ),
			'default' => __('Daily 10.00 to 22.00 ( Sunday Avilable ) ', "museumwp" ),
		),
		/* Fields /- */
	),
));
/* Contact Page /- */

/* Google Map */
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Google Map', "museumwp" ),
	'icon' => 'fa fa-map',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'=>'map_api',
			'type' => 'text',
			'title' => esc_html__( 'API Key', "museumwp" ),
			'desc' => wp_kses( __( '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get Api Key</a>', "museumwp" ), array( 'a' => array( 'target' => array(), 'href' => array() ) ) ),
		),
	),
) );

/* Footer Settings */
Redux::setSection( $opt_name, array(
	'title'  => __( 'Footer', "museumwp" ),
	'icon' => 'el el-website',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'=>'info_foo_contact_detail',
			'type' => 'info',
			'title' => __('Contact Details', "museumwp" ),
		),
		array(
			'id'=>'opt_contact_address_ft',
			'type' => 'text',
			'title' => __('Contact Address', "museumwp" ),
			'default' => __('345 National Museum, Melbourne PO 6570', "museumwp" ),
		),
		array(
			'id'=>'opt_contact_no_ft',
			'type' => 'text',
			'title' => __('Contact No', "museumwp" ),
			'default' => __('(123) 456-7890', "museumwp" ),
		),
		array(
			'id'=>'opt_contact_email_ft',
			'type' => 'text',
			'title' => __('Contact Email', "museumwp" ),
			'default'  => 'email@example.com'
		),
		array(
			'id'=>'opt_footer_logo',
			'type' => 'media',
			'title' => __('Footer Logo', "museumwp" ),
			'default'  => array( 'url' => esc_url( MUSEUMWP_IMGURI ) . '/common/logo-footer.png' ),
		),
		array(
			'id'=>'info_social',
			'type' => 'info',
			'title' => __('Social Icons', "museumwp" ),
		),
		array(
			'id'       => 'opt_social_icons',
			'type'     => 'ow_repeater',
			'image'      => false,
			'url'      => true,
			'title'    => __('Social Icons', "museumwp" ),
		),
		/* Fields /- */	
	)
));

// Remove the demo link and the notice of integrated demo from the redux-framework plugin
if ( ! function_exists('museumwp_remove_demo') ) {
	function museumwp_remove_demo() {

		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', array(
				ReduxFrameworkPlugin::instance(),
				'plugin_metalinks'
			), null, 2 );

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}
}