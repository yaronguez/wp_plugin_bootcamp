<?php

/**
 * Plugin Name:       WP Plugin BootCamp
 * Plugin URI:        https://github.com/yaronguez/wp_plugin_bootcamp
 * Description:       Part of the WordCamp San Diego 2015 Plugin Development BootCamp
 * Version:           1.0.0
 * Author:            Yaron Guez and Matt Cromwell
 * Author URI:        http://trestian.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-plugin-bootcamp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-plugin-bootcamp-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-bootcamp-activator.php';
	WP_Plugin_BootCamp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-plugin-bootcamp-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-bootcamp-deactivator.php';
	WP_Plugin_BootCamp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-bootcamp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new WP_Plugin_BootCamp();
	$plugin->run();

}
run_plugin_name();
