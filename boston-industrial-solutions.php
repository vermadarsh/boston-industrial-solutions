<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/vermadarsh/
 * @since             1.0.0
 * @package           Boston_Industrial_Solutions
 *
 * @wordpress-plugin
 * Plugin Name:       Boston Industrial Solutions Core
 * Plugin URI:        https://github.com/vermadarsh/boston-industrial-solutions
 * Description:       This plugin holds all the core functionalities related to the project, Boston Industrial Solutions.
 * Version:           1.0.0
 * Author:            Adarsh Verma (Concatstring New)
 * Author URI:        https://github.com/vermadarsh/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       boston-industrial-solutions
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BOSTON_INDUSTRIAL_SOLUTIONS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-boston-industrial-solutions-activator.php
 */
function activate_boston_industrial_solutions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boston-industrial-solutions-activator.php';
	Boston_Industrial_Solutions_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-boston-industrial-solutions-deactivator.php
 */
function deactivate_boston_industrial_solutions() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boston-industrial-solutions-deactivator.php';
	Boston_Industrial_Solutions_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_boston_industrial_solutions' );
register_deactivation_hook( __FILE__, 'deactivate_boston_industrial_solutions' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-boston-industrial-solutions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_boston_industrial_solutions() {

	$plugin = new Boston_Industrial_Solutions();
	$plugin->run();

}
run_boston_industrial_solutions();
