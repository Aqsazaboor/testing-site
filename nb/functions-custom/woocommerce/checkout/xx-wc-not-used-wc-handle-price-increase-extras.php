<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Utility function to change the prices with a multiplier (number)
function get_price_multiplier() {
    return 2; // x2 for testing
}

// Simple, grouped and external products
add_filter('woocommerce_product_get_price', 'custom_price', 99, 2 );
add_filter('woocommerce_product_get_regular_price', 'custom_price', 99, 2 );


// Variations
add_filter('woocommerce_product_variation_get_regular_price', 'custom_price', 99, 2 );
add_filter('woocommerce_product_variation_get_price', 'custom_price', 99, 2 );
function custom_price( $price, $product ) {
	$product_id = $product->get_id();

	$cart_product_rows_bold = get_post_meta( $product_id, 'custom_textbold', true );
	$cart_product_text_size = get_post_meta( $product_id, 'custom_textsize', true );
	
    return (float) $price * get_price_multiplier();
}