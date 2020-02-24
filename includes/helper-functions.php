<?php
/**
 * Plugin Config and helper functions
 *
 * @package     DPUK\NM\addPackaging;
 * @since       1.0.0
 * @author      Dan Pringle
 * @link        https://www.danielpringle.co.uk
 * @license     GNU General Public License 2.0+
 */

namespace NM\packaging;

// import the woocommerce class here because we use namespacing.
use  WC_Data_Store;

/**
 * Get the product Id based on product SKU.
 *
 * @since 0.0.0
 */
function get_the_product_id() {
	// Specify the SKU we want to use.
	$sku = 'PWLP';

	// Get the product ID from the product SKU.
	$data_store = WC_Data_Store::load( 'product' );
	$product_id = $data_store->get_product_id_by_sku( $sku );

	// $product_id =  '180'; .
	// return the Product ID.
	return $product_id;
}
/**
 *  Get the quantity of products with the specified category in the cart.
 *
 *  @since 1.0.0
 */
function category_qty_in_cart() {

	// Set our variables.
	// Initialize our count so it has a starting value.
	$count = 0;
	// Initialize our category is in cart value to false.
	$cat_in_cart = false;
	// Specify our category.
	$specified_product_category = 'Phone Cases';
	// Define our product id.
	// $packaging_product_id = '180'; .
	$packaging_product_id = get_the_product_id();

	// Loop through the cart items.
	foreach ( WC()->cart->get_cart() as $cart_item ) {
		// Check if our product category is in the cart.
		if ( has_term( $specified_product_category, 'product_cat', $cart_item['product_id'] ) ) {
			// Count the number of items with the specific category.
			$count += $cart_item['quantity'];
			// if it's in the cart, change are value.
			$cat_in_cart = true;
			// break; .
		}
	}

	$category_qty_in_cart = $count;

	return $category_qty_in_cart;
}
/**
 *
 * Return whether the specified category is in the cart.
 *
 * @since 1.0.0
 */
function cat_in_cart() {

	$category_qty_in_cart = category_qty_in_cart();

	$cat_in_cart = false;

	if ( $category_qty_in_cart > 0 ) {
		$cat_in_cart = true;
	}

	return $cat_in_cart;

}
/**
 *
 * Check if the packaging product is in the cart
 *
 * @since 1.0.0
 */
function check_packaging_product_is_in_cart() {

	$packaging_product_id         = get_the_product_id();
	$is_packaging_product_in_cart = false;
	$this_item_key                = null;

	// loop though the cart items key.
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		// Check if the our product in the cart.
		$_product = $cart_item['data'];
		if ( $_product->get_id() === $packaging_product_id ) {
			// if it's in the cart, change are value.
			$is_packaging_product_in_cart = true;
			$this_item_key                = $cart_item_key;
		}
	}

	// We need to return 2 values, whether the item is in the cart and the $cart_item_key
	// We can only return one value but we can use an array that contains the two values:
	// Let's create an associative array.
	return array(
		'ProductInCart'  => $is_packaging_product_in_cart,
		'productItemKey' => $this_item_key,
	);
}
