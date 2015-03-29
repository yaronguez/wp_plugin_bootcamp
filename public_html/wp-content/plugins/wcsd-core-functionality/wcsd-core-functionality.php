<?php
/**
 * Plugin Name: WCSD Plugin Bootcamp
 * Plugin URI: https://github.com/yaronguez/wp_plugin_bootcamp/
 * Description: This is a basic plugin to register CPT's, Taxonomies, and Metaboxes. This is a demo, put together for the purpose of WordCamp San Diego 2015 by Yaron Guez and Matt Cromwell.
 * Version: 1.0
 * Author: Matt Cromwell, Yaron Guez
 * Author URI: http://mattcromwell.com
 *
 */

// Plugin Definitions 
define( 'WCSD_DIR', dirname( __FILE__ ) );
define( 'WCSD_URL', plugin_dir_url( __FILE__ ) );
define( 'WCSD_PATH', plugin_dir_path( __FILE__ ) );

// General
if ( file_exists(WCSD_DIR . '/metabox/init.php' ) ) {
	require_once( WCSD_DIR . '/metabox/init.php' );
}

// Post Types
if ( file_exists(WCSD_DIR . '/lib/functions/post-types.php' ) ) {
	require_once( WCSD_DIR . '/lib/functions/post-types.php' );
}

// CPT Templates
if ( file_exists(WCSD_DIR . '/lib/templates/template-loader.php' ) ) {
	require_once( WCSD_DIR . '/lib/templates/template-loader.php' );
}

// Taxonomies 
if ( file_exists(WCSD_DIR . '/lib/functions/taxonomies.php' ) ) {
	require_once( WCSD_DIR . '/lib/functions/taxonomies.php' );
}

// Shortcodes 
if ( file_exists(WCSD_DIR . '/lib/functions/shortcodes.php' ) ) {
	require_once( WCSD_DIR . '/lib/functions/shortcodes.php' );
}

// Metaboxes
if ( file_exists(WCSD_DIR . '/metabox/init.php' ) ) {
	require_once WCSD_DIR . '/metabox/init.php';
}
if ( file_exists(WCSD_DIR . '/lib/functions/metaboxes.php' ) ) {
	require_once( WCSD_DIR . '/lib/functions/metaboxes.php' );
}

