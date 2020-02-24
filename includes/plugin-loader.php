<?php
/**
 *  Plugin Loader and Tests
 *
 *  This file is responsible for loading tests. Delete once live.
 *
 * @package   NM\packaging
 * @since  1.0.0
 * @author    Dan Pringle <dan@danielpringle.co.uk>
 * @license GPL-2.0+
 * @link    https://www.danielpringle.co.uk/
 */

namespace NM\packaging;

// add_action( 'genesis_before_header', __NAMESPACE__ . '\plugin_loader' );.
/**
 * Test plgunin is loading.
 *
 * @since 1.0.0
 */
function plugin_loader() {
	?>
	<h3>plugin_loader.php is loading</h3>
	<?php
}
