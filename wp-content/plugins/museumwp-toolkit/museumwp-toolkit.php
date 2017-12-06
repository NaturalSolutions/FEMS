<?php
/**
 * Plugin Name:  Museumwp Toolkit
 * Plugin URI:   http://www.onistaweb.com/
 * Description:  An easy to use theme plugin to add custom features to WordPress Theme.
 * Version:      1.2
 * Author:       Onista Web
 * Author URI:   http://www.onistaweb.com/
 * Author Email: onistaweb@gmail.com
 *
 * @package    Museumwp_Theme_Toolkit
 * @since      1.0
 * @author     Onista Web
 * @copyright  Copyright (c) 2015-2016, Onista Web
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Museumwp_Theme_Toolkit {

	/**
	 * PHP5 constructor method.
	 *
	 * @since  1.0
	 */
	public function __construct() {

		// Set constant path to the plugin directory.
		add_action( 'plugins_loaded', array( &$this, 'museumwp_constants' ), 1 );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		// Load the plugin functions files.
		add_action( 'plugins_loaded', array( &$this, 'museumwp_includes' ), 3 );

		// Loads the admin styles and scripts.
		add_action( 'admin_enqueue_scripts', array( &$this, 'museumwp_admin_scripts' ) );

		// Loads the frontend styles and scripts.
		add_action( 'wp_enqueue_scripts', array( &$this, 'museumwp_frontend_scripts' ) ); 

	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  1.0
	 */
	public function museumwp_constants() {

		// Set constant path to the plugin directory.
		define( 'OWTH_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// Set the constant path to the plugin directory URI.
		define( 'OWTH_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		// Set the constant path to the inc directory.
		define( 'OWTH_INC', OWTH_DIR . trailingslashit( 'includes' ) );

		// Set the constant path to the shortcodes directory.
		define( 'OWTH_SC', OWTH_DIR . trailingslashit( 'shortcodes' ) );

		// Set the constant path to the assets directory.
		define( 'OWTH_LIB', OWTH_URI . trailingslashit( 'lib' ) );

	}

	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'museumwp-toolkit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1.0
	 */
	public function museumwp_includes() {

		// Load CPT, CMB, Widgets
		require_once( OWTH_INC . 'inc.php' );
		require_once( OWTH_SC . 'inc.php' );
	}

	/**
	 * Loads the admin styles and scripts.
	 *
	 * @since  0.1.0
	 */
	function museumwp_admin_scripts() {

		// Loads the popup custom style.
		wp_enqueue_style( 'museumwp-toolkit-style', trailingslashit( OWTH_LIB ) . 'css/admin.css' );
		wp_enqueue_script( 'museumwp-toolkit' , trailingslashit( OWTH_LIB ) . 'js/plugin-admin.js' );
	}

	/**
	 * Loads the frontend styles and scripts.
	 *
	 * @since  0.1.0
	 */
	function museumwp_frontend_scripts() {

		/* Google Map */
		$map_api = "";
		if( function_exists('museumwp_options') ) {
			$map_api = museumwp_options("map_api");
		}

		if( $map_api != "" ) {
			wp_enqueue_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?key='.$map_api );
		}
		else {
			wp_enqueue_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp' );
		}

		wp_enqueue_style( 'museumwp-toolkit', trailingslashit( OWTH_LIB ) . 'css/plugin.css' );
		wp_enqueue_script( 'museumwp-toolkit' , trailingslashit( OWTH_LIB ) . 'js/plugin.js' );
	}

}

new Museumwp_Theme_Toolkit;