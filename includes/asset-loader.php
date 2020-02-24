<?php
/**
 * Load the plugin assets.
 *
 * @package     NM\packaging;
 * @since       1.0.0
 * @author      Dan Pringle
 * @link        https://www.danielpringle.co.uk
 * @license     GNU General Public License 2.0+
 */

namespace NM\packaging;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\wpdocs_theme_name_scripts' );
/**
 * Enqueue the plugin scripts and styles
 */
function wpdocs_theme_name_scripts() {

	$plugin_main_styles = NMPP_URL . 'assets/css/add-packaging.css';
	wp_enqueue_style( NMPP_TEXT, esc_url( $plugin_main_styles ), array(), NMPP_VERSION, 'all' );
}
