<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ------------------------------------------------
// Add width and height to shop pages
// https://businessbloomer.com/woocommerce-visual-hook-guide-archiveshopcat-page/ 
// ------------------------------------------------

if(!function_exists('wc_woocommerce_product_excerpt')):
add_action( 'woocommerce_shop_loop_item_title', 'wc_woocommerce_product_excerpt', 35 );  
function wc_woocommerce_product_excerpt() {

	// Exclude on signs with no edit...
	global $post;
	$product_id = $post->ID;
	$_product = wc_get_product( $product_id );

	$output = '<div class="product-description__custom">';
	$output .= '<div class="product-description">';

	if(function_exists('nb_get_product_size_material')) {
		if(nb_get_product_size_material($product_id) != "") {
			$output .= nb_get_product_size_material($product_id);
		}
	}

	// In stock
	// Compatibility for WC versions from 2.5.x to 3.0+
	$stock_status = 'instock';
	if ( method_exists( $_product, 'get_stock_status' ) ) {
		$stock_status = $_product->get_stock_status(); // For version 3.0+
	}
	
	if( $stock_status == 'outofstock' ) {
		$output .= '<div class="outofstock-badge">'.pll__('Slut i lager').'</div>';
	}

	$output .= '</div>';
	$output .= '</div>';
	
	echo $output;
}
endif;

// Remove standard product title
if(!function_exists('wc_own_product_title')) {
	remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
	add_action('woocommerce_shop_loop_item_title', 'wc_own_product_title', 10 );
	function wc_own_product_title() {
		$product_id = get_the_ID();
		$_product = wc_get_product( $product_id );
		$product_title = get_the_title();
		echo '<div class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . $product_title . '</div>';
	}
}