<?php
/**
 *  Functions to help us test the functionality of the plugintester
 *  Remove from the live version
 */
 namespace NM\packaging;

 /**
  * Tester Notice
  *
  */
add_action( 'genesis_before_header', __NAMESPACE__ . '\pluginTesterActivated' );
 function pluginTesterActivated() {
   ?>
   <h3><?php echo 'plugintester.php is activated - remove from live version';?> </h3>
   <?php
 }

/**
 * Test our constants are set up the way we want
 *
 */
 add_action( 'genesis_after_header', __NAMESPACE__ . '\nm_dpuk_check_defined_constants' );
  function nm_dpuk_check_defined_constants() {
    ?>
    <h3><?php echo 'Constants defined';?> </h3>

    <ul>
      <li>Dir: <?php echo NMPP_DIR;?> </li>
      <li>Base: <?php echo NMPP_BASE;?> </li>
      <li>URL: <?php echo NMPP_URL;?> </li>
      <li>Path: <?php echo NMPP_PATH;?> </li>
      <li>Slug: <?php echo NMPP_SLUG;?> </li>
      <li>NAME: <?php echo NMPP_NAME;?> </li>
      <li>Version: <?php echo NMPP_VERSION;?> </li>
      <li>Text Domian: <?php echo NMPP_TEXT;?> </li>
      <li>Prefix: <?php echo NMPP_PREFIX;?> </li>
      <li>Settigs: <?php echo NMPP_SETTINGS;?></li>
    </ul>
    <?php
  }


/**
 * Show the plugin path's and url's
 * Should be the same as our defined constants
 */
add_action( 'genesis_after_header', __NAMESPACE__ . '\show_plugin_paths' );
function show_plugin_paths() {

  $plugin_url = plugin_dir_url( __FILE__ );

	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}
  ?>

  <h3><?php echo 'Plugin Path\'s and URL\'s';?> </h3>
  <ul>
    <li>Dir: <?php echo dirname( plugin_basename( __FILE__ ) );?> </li>
    <li>Base: <?php echo plugin_basename( __FILE__ );?> </li>
    <li>URL: <?php echo $plugin_url;?> </li>
    <li>URL: <?php echo plugin_dir_url( __FILE__ );?> </li>
    <li>Path: <?php echo plugin_dir_path( __FILE__ );?> </li>
    <li>Slug: <?php echo dirname( plugin_basename( __FILE__ ) );?> </li>
  </ul>
  <?php
}

/**
 * Check our array key is firing
 *
 */
add_action( 'wp', __NAMESPACE__ . '\test_array_key_exists' );
function test_array_key_exists() {

  $arryKeyExists = false;
  if ( is_page( 'basket' ) && array_key_exists('addPremiumPackaging',$_POST) ) {
    $arryKeyExists = true;
  }

  if ($arryKeyExists){
    echo 'The array key exists. </br>';
    echo 'We can run the add_product_based_on_category_cart_count() function </br>';
  }
}

/**
 * Test the helper functions are working
 *
 */
add_action( 'genesis_after_header', __NAMESPACE__ . '\test_functions_are_working' );
function test_functions_are_working(){
  $category_qty_in_cart = category_qty_in_cart();
  $cat_in_cart = cat_in_cart();
  $is_packaging_product_in_cart = check_packaging_product_is_in_cart();
  echo '</br><h3>Test the helper functions are working</h3> ';
  echo '</br> Is the category in the cart (1=true, 0=false): ';
  echo $cat_in_cart;
  echo '</br> How many category items are in the cart: ';
  echo $category_qty_in_cart;
  //echo $is_packaging_product_in_cart;
  echo '</br> Is the packaging product in the cart (1=true, 0=false): ';
//  echo $is_packaging_product_in_cart[0];
  echo $is_packaging_product_in_cart['PIC'];
  echo '</br> The itemKey is: ';
//  echo $is_packaging_product_in_cart[1];
  echo $is_packaging_product_in_cart['IK'];
//  echo $thisItemKey;
}
