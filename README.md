Add Packaging Plugin
==============================

=== Add Packaging Plugin ===
Contributors: danpringle
Donate link:
Tags:
Requires at least: 3.0.1
Tested up to: 5.2.1
Requires PHP: 7
Stable tag: 5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This Plugin adds the option to add premium packaging in the WooCommerce cart.

## Features

* Add premium packaging product in the WooCommerce cart.

## How it works

The plugin adds a button on the cart page.
The button will only display if a specified product category (Phone Cases) is in the cart.
On click the button will add your premium packaging product to the cart with the same
quantity set as the number of products in the cart with a specified category.
e.g. The specified category is 'Phone Cases' and you have 3 products with that category in the cart. The premium packaging
product will be added to the cart with a quantity of 3. If you add or remove a 'Phone Case' product the quantity of the
premium packaging product will update accordingly.
The premium packaging product is defined by a product SKU added in includes/helper-functions.php

=== Important ===
You can not add packaging to single items. It will apply for all items with the specified category.

## Installation & Setup

1. Download it.
2. Put into your `wp-content/plugins/` folder
3. Extract it
4. Go into the new folder
5. Edit the 'helper-functions.php' file and add the SKU of your 'packaging' plugin.
   and the category term that the 'packing' product will apply to.
6. log in to your wordpress dashboard.
7. Add a product for your 'packaging' product with a SKU and price.
8. Add the category term to the products that the 'packaging' product will be applied to.
9. Select the 'Plugins' menu in the dashboard and activate the plugin.

## Contributions

All feedback is welcome.


## Notes
