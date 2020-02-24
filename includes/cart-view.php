<?php
/**
 * Display the cart view
 *
 * @package     DPUK\NM\addPackaging;
 * @since       1.0.0
 * @author      Dan Pringle
 * @link        https://www.danielpringle.co.uk
 * @license     GNU General Public License 2.0+
 */

namespace NM\packaging;

add_action( 'woocommerce_after_cart_table', __NAMESPACE__ . '\add_packaging_product_cart_view', 20 );
/**
 * Display the cart view
 *
 * @since 0.0.0
 */
function add_packaging_product_cart_view() {
	$cat_in_cart = cat_in_cart();

	if ( $cat_in_cart ) {
		$site_url                  = site_url() . '/packaging';
		$button_text               = 'Add Premium Packaging';
		$click_here                = __( 'Click here', NMPP_TEXT );
		$info_text                 = __( 'for more information on packaging. ', NMPP_TEXT );
		$packaging_title           = __( 'Phone case premium packaging', NMPP_TEXT );
		$add_packaging_product_url = site_url() . '/basket/?add-to-cart=180';
		?>
		<h2><?php echo esc_html( $packaging_title ); ?></h2>
		<div class = "ppContainer clearfix">
			<div class = "ppImg">
				<img src="<?php echo esc_url( NMPP_URL . 'assets/images/premium-packaging.jpg' ); ?>";>
			</div>
			<div class = "ppTextContainer">
				<div class = "ppText">
				<!--  <h2>Phone case premium packaging</h2> -->
					<p><a href="<?php echo esc_url( $site_url ); ?>" target="_blank"><?php echo esc_html( $click_here ); ?></a><?php echo ' ' . esc_html( $info_text ); ?></p>
				</div>
				<div class = "ppForm">
					<form method="post" action="<?php echo esc_url( $add_packaging_product_url ); ?>">
						<input type="hidden" id="packaging-nonce" name="packaging-nonce" value="<?php echo wp_create_nonce('packaging-nonce');?>" />
						<input type="submit" name="addPremiumPackaging" id="addPackaging" value="<?php echo esc_html( $button_text ); ?>" /><br/>
					</form>
				</div>
			</div>
		</div>
		<?php
	} else {
		return;
	}
}
