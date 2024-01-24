<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://5
 * @since             1.0.0
 * @package           Competitions_Entries
 *
 * @wordpress-plugin
 * Plugin Name:       Competitions Entries
 * Plugin URI:        https://5
 * Description:       “Competitions” And “Entries” Post Type.
 * Version:           1.0.0
 * Author:            S.M Golam Zilani
 * Author URI:        https://5/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       competitions-entries
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'COMPETITIONS_ENTRIES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-competitions-entries-activator.php
 */
function activate_competitions_entries() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-competitions-entries-activator.php';
	Competitions_Entries_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-competitions-entries-deactivator.php
 */
function deactivate_competitions_entries() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-competitions-entries-deactivator.php';
	Competitions_Entries_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_competitions_entries' );
register_deactivation_hook( __FILE__, 'deactivate_competitions_entries' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-competitions-entries.php';

function run_competitions_entries() {

	$plugin = new Competitions_Entries();
	$plugin->run();

}
run_competitions_entries();