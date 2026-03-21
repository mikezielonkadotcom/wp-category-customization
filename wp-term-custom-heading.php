<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mikezielonka.com
 * @since             1.0.0
 * @package           Wp_Term_Custom_Heading
 *
 * @wordpress-plugin
 * Plugin Name:       WP Term Custom Heading
 * Plugin URI:        https://mikezielonka.com
 * Description:       Plugin used to override category page title on archive page.
 * Version:           1.4.0
 * Author:            Michael Zielonka
 * Author URI:        https://mikezielonka.com
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-term-custom-heading
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
define( 'WP_TERM_CUSTOM_HEADING_VERSION', '1.4.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-term-custom-heading-activator.php
 */
function activate_wp_term_custom_heading() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-term-custom-heading-activator.php';
	Wp_Term_Custom_Heading_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-term-custom-heading-deactivator.php
 */
function deactivate_wp_term_custom_heading() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-term-custom-heading-deactivator.php';
	Wp_Term_Custom_Heading_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_term_custom_heading' );
register_deactivation_hook( __FILE__, 'deactivate_wp_term_custom_heading' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-term-custom-heading.php';

/**
 * Plugin update checker - checks GitHub for new releases.
 */
require plugin_dir_path( __FILE__ ) . 'vendor/plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$wp_tch_update_checker = PucFactory::buildUpdateChecker(
	'https://github.com/mikezielonkadotcom/wp-category-customization/',
	__FILE__,
	'wp-term-custom-heading'
);
$wp_tch_update_checker->getVcsApi()->enableReleaseAssets();

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_term_custom_heading() {

	$plugin = new Wp_Term_Custom_Heading();
	$plugin->run();

}
run_wp_term_custom_heading();
