<?php
/* Include all components. */
require_once( "functions.php" );

if ( class_exists( 'ReduxFramework' ) ) {

	require_once( "redux/extensions/wbc_importer/example-functions.php" );

	/* Loads the Redux Extension Loader */
	require_once( "redux/extension-loader.php" );
}

// Loads the Custom Post Types
require_once( "cpt/inc.php" );

// Loads the Custom Metaboxes
require_once( "cmb/inc.php" );

// Loads the Widgets
require_once( "widgets/inc.php" );
?>