<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ----------------------------------------------------
// Remove direct add to cart from small products loop
// ----------------------------------------------------
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');