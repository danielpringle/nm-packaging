<?php
/**
 *  Plugin activation
 *
 * @package   NM\packaging
 * @since     1.0.0
 * @author    Dan Pringle <dan@danielpringle.co.uk>
 * @license   GPL-2.0+
 * @link      https://www.danielpringle.co.uk/
 */

namespace NM\packaging;

/**
 * Plugin activation.
 *
 * @since 1.0.0
 */
function activation() {

	global $wp_version;

	$php = esc_html__( '7.0', 'nm-packaging' );
	$wp  = esc_html__( '3.8', 'nm-packaging' );

	if ( version_compare( PHP_VERSION, $php, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				/* translators: %s: search term */
				esc_html__( 'This plugin can not be activated because it requires a PHP version greater than %1$s. Your PHP version can be updated by your hosting company.', 'nm-packaging' ),
				esc_html__( '7.0', 'nm-packaging' )
			)
			/* translators: %s: search term */
			. '</p> <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">' . esc_html__( 'go back', 'nm-packaging' ) . '</a>'
		);
	}

	if ( version_compare( $wp_version, $wp, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				/* translators: %s: search term */
				esc_html__( 'This plugin can not be activated because it requires a WordPress version greater than %1$s. Please go to Dashboard &#9656; Updates to gran the latest version of WordPress .', 'nm-packaging' ),
				esc_html__( '7.0', 'nm-packaging' )
			)
			/* translators: %s: search term */
			. '</p> <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">' . esc_html__( 'go back', 'nm-packaging' ) . '</a>'
		);
	}
}
