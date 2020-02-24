<?php
/**
 * NM Packaging
 *
 * @category  Plugin
 * @package   NM\packaging
 * @author    Dan Pringle <dan@danielpringle.co.uk>
 * @copyright 2019 Dan Pringle
 * @license   GPL-2.0+
 * @link      danielpringle.co.uk/plugins
 *
 * @wordpress-plugin
 * Plugin Name:       NM Packaging
 * Plugin URI:        https://www.danielpringle.co.uk
 * Description:       Adds as a custom packaging option to the site.
 * Version:           1.0.1
 * Author:            Dan Pringle
 * Author URI:        https://www.danielpringle.co.uk
 * Text Domain:       nm-packaging
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://www.danielpringle.co.uk
 * Requires PHP:      5.6
 * Requires WP:       4.9
 *
 * WC requires at least: 3.3.0
 * WC tested up to: 3.6.4
 **/

namespace NM\packaging;

if ( ! defined( 'ABSPATH' ) ) {
		exit( 'Cheatin&#8217; uh?' );
}
/**
 * Define the plugin's global constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_constants() {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}
	$constant_name_prefix = 'NMPP_';
	$plugin_prefix        = 'NMPP';
	$plugin_data          = get_file_data(
		__FILE__,
		array(
			'name'    => 'Plugin Name',
			'version' => 'Version',
			'text'    => 'Text Domain',
		)
	);

	defined( $constant_name_prefix . 'DIR' ) || define( $constant_name_prefix . 'DIR', dirname( plugin_basename( __FILE__ ) ) );
	defined( $constant_name_prefix . 'BASE' ) || define( $constant_name_prefix . 'BASE', plugin_basename( __FILE__ ) );
	defined( $constant_name_prefix . 'URL' ) || define( $constant_name_prefix . 'URL', $plugin_url );
	defined( $constant_name_prefix . 'PATH' ) || define( $constant_name_prefix . 'PATH', plugin_dir_path( __FILE__ ) );
	defined( $constant_name_prefix . 'SLUG' ) || define( $constant_name_prefix . 'SLUG', dirname( plugin_basename( __FILE__ ) ) );
	defined( $constant_name_prefix . 'NAME' ) || define( $constant_name_prefix . 'NAME', $plugin_data['name'] );
	defined( $constant_name_prefix . 'VERSION' ) || define( $constant_name_prefix . 'VERSION', $plugin_data['version'] );
	defined( $constant_name_prefix . 'TEXT' ) || define( $constant_name_prefix . 'TEXT', $plugin_data['text'] );
	defined( $constant_name_prefix . 'PREFIX' ) || define( $constant_name_prefix . 'PREFIX', $constant_name_prefix );
	defined( $constant_name_prefix . 'SETTINGS' ) || define( $constant_name_prefix . 'SETTINGS', $plugin_data['text'] );
}
/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_files() {
	$files = array(// add the list of files to load here.
		'plugin-loader.php',
		'cart-view.php',
		'asset-loader.php',
		'add-packaging.php',
		'helper-functions.php',
	);
	foreach ( $files as $file ) {
		require __DIR__ . '/includes/' . $file;
	}
}
register_activation_hook( __FILE__, __NAMESPACE__ . '\packaging_plugin_activation' );
/**
 * The code that runs during plugin activation.
 *
 * This action is documented in includes/plugin-activation.php
 */
function packaging_plugin_activation() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-activation.php';
	activation();
}
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\packaging_plugin_de_activation' );
/**
 * The code that runs during plugin de-activation.
 *
 * This action is documented in includes/plugin-de-activation.php
 */
function packaging_plugin_de_activation() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/plugin-de-activation.php';
	de_activation();
}
/**
 * Launch the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	init_constants();
	autoload_files();
}

launch();
