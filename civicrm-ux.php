<?php

/**
 * @link              https://github.com/agileware/wp-civicrm-ux
 * @since             1.0.0
 * @package           Civicrm_Ux
 *
 * @wordpress-plugin
 * Plugin Name:       WP CiviCRM UX
 * Plugin URI:        https://github.com/agileware/wp-civicrm-ux
 * Description:       A better user experience for integrating WordPress and CiviCRM
 * Version:           1.1.5
 * Author:            Agileware
 * Author URI:        https://agileware.com.au/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       civicrm-ux
 * Domain Path:       /languages
 * GitHub Plugin URI: agileware/wp-civicrm-ux
 */

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CIVICRM_UXVERSION', '1.1.5' );

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// check CiviCRM activated
$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
if ( ! in_array( 'civicrm/civicrm.php', $active_plugins ) ) {
	deactivate_plugins( plugin_basename( __FILE__ ) );
	add_action( 'admin_notices', 'agileware_caldera_forms_magic_tags_child_plugin_notice' );
}

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

function fail_check_dependency_civicrm_ux() {
	?>
	<div class="error"><p>Sorry, plugin CiviCRM UX requires the CiviCRM plugin to be installed and active.</p></div><?php
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-civicrm-ux-activator.php
 */
function activate_civicrm_ux() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-civicrm-ux-activator.php';
	Civicrm_Ux_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-civicrm-ux-deactivator.php
 */
function deactivate_civicrm_ux() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-civicrm-ux-deactivator.php';
	Civicrm_Ux_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_civicrm_ux' );
register_deactivation_hook( __FILE__, 'deactivate_civicrm_ux' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-civicrm-ux.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_civicrm_ux() {

	$plugin = Civicrm_Ux::getInstance();
	$plugin->run();

}

run_civicrm_ux();
