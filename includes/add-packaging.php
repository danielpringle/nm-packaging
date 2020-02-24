<?php
/**
 *  The core functions for the plugin
 *
 *  @since 1.0.0
 *  @package NM\packaging
 **/

namespace NM\packaging;

add_action( 'wp', __NAMESPACE__ . '\check_nonce_and_process' );
/**
 *  Check and veify the packaging form nonce.
 *
 *  Check to see if the packaging product was added and created an array key.
 *
 *  If the array key exists run the add_product_based_on_category_cart_count().
 *
 *  @since 1.0.0
 */
function check_nonce_and_process() {
	if ( isset( $_POST['packaging-nonce'], $_POST['packaging-nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['packaging-nonce'] ), 'packaging-nonce' ) ) {
		$foo = sanitize_text_field( wp_unslash( $_POST['packaging-nonce'] ) );
			// Initialize our $arryKeyExists variable so it has a starting value.
			$array_key_exists = false;
			// if we're on the basket page and the key exists change the variable value.
		if ( is_page( 'basket' ) && array_key_exists( 'addPremiumPackaging', $_POST ) ) {
			$array_key_exists = true;
		}
			// If $array_key_exists is true run the add_product_based_on_category_cart_count(); function.
		if ( $array_key_exists ) {
			add_product_based_on_category_cart_count();
		}
	} else {
		return;
	}
}
/**
 * Add packaging product to cart based on cart contents.
 *
 * If the cart contains a certain product id the packaging product will be added.
 *
 * The quantity of items added will match the quantity of items with the set
 *
 * product id
 *
 *  @since 1.0.0
 */
function add_product_based_on_category_cart_count() {
	// Grab our values from the helper functions.
	$category_qty_in_cart         = category_qty_in_cart();
	$cat_in_cart                  = cat_in_cart();
	$is_packaging_product_in_cart = check_packaging_product_is_in_cart();
	$packaging_product_id         = get_the_product_id();

	if ( $is_packaging_product_in_cart['ProductInCart'] ) {
		WC()->cart->set_quantity( $is_packaging_product_in_cart['productItemKey'], $category_qty_in_cart );
	}
	// if the category is in the cart but not the product id.
	if ( $cat_in_cart && ! $is_packaging_product_in_cart['ProductInCart'] ) {
		WC()->cart->add_to_cart( $packaging_product_id, $category_qty_in_cart );
	}
	// We'll remove this for now as we're only going to show the button IF
	// a prouct with the correct category is in the cart.
	// if ( !$cat_in_cart ) { // if the category is not in the cart
	// wc_print_notice( 'Sorry, no compatible products in your basket', 'notice', 1 );
	// }
	// .
}
add_filter( 'woocommerce_update_cart_action_cart_updated', __NAMESPACE__ . '\filter_woocommerce_update_cart_action_cart_updated', 10, 1 );
/**
 *  Filter the WooCommerce 'Update basket' button on the basket page.
 *
 *  Needed to maintain the "add packaging functionality"
 *
 *  @param string $cart_updated updates the woo csrt.
 *
 *  @since 1.0.0
 **/
function filter_woocommerce_update_cart_action_cart_updated( $cart_updated ) {

	$is_packaging_product_in_cart = check_packaging_product_is_in_cart();

	// run the appropriate action based on the condition.
	if ( $is_packaging_product_in_cart['ProductInCart'] ) {
		add_product_based_on_category_cart_count();
		return $cart_updated;
	} elseif ( ! $is_packaging_product_in_cart['ProductInCart'] ) {
		return $cart_updated;
	} else {
		return $cart_updated;
	}
};
add_action( 'woocommerce_before_cart', __NAMESPACE__ . '\add_count' );
/**
 * Check if the cart contains a packaging product.
 *
 * If 'yes' run function 'add_product_based_on_category_cart_count();'
 *
 * Needed if a customer has previously been on the cart page, returned to the
 *
 * shop and added another product.
 *
 *  @since 1.0.0
 */
function add_count() {

	$packaging_product_id = get_the_product_id();
	$product_cart_id      = WC()->cart->generate_cart_id( $packaging_product_id );
	$in_cart              = WC()->cart->find_product_in_cart( $product_cart_id );

	if ( $in_cart ) {
		add_product_based_on_category_cart_count();
	}
}
