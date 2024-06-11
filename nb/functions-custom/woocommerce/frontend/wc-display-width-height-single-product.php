<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('wc_woocommerce_product_width_height')):
add_action( 'woocommerce_before_add_to_cart_form', 'wc_woocommerce_product_width_height', 35 );  
function wc_woocommerce_product_width_height() {

	// Exclude on signs with no edit...
	global $post;
	$product_id = $post->ID;
	$_product = wc_get_product( $product_id );
		
	$sign_height = get_post_meta( $product_id, 'product_height', true );
	$sign_width = get_post_meta( $product_id, 'product_width', true );
	$sign_material = get_post_meta( $product_id, 'product_material', true );
	$sign_color = get_post_meta( $product_id, 'product_color', true );
	
	$output = '<div class="product-description__custom">';
	
	if($sign_width && $sign_height) {
		$output .= '<div class="product-size">';
		$output .= '<span>' . pll__('Storlek') . ':</span> ' . $sign_width . 'x' . $sign_height .' mm';
		$output .= '</div>';
	}

	if(function_exists('translate_materials_and_color') && $sign_material != "None" && $sign_color != "None") {
		$output .= '<div class="product-color">';
		$output .= '<span>' . pll__('Material') . ':</span> ' . translate_materials_and_color($sign_material) . ' ' . translate_materials_and_color($sign_color);
		$output .= '</div>';
	}
	# var_dump($_product);

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

	if ( $_product->is_type( 'variable' ) ) {
		// var_dump( $_product->is_type( 'variable' ) );
		$currency = 'kr';
		if( function_exists('get_woocommerce_currency_symbol') ) {
			$currency = nb_get_woocommerce_currency_symbol();
		}
		$output .= '<div id="variation_selection" class="is-hidden" style="display: flex; align-items: center; gap: 16px; border: 1px solid #EEE; width: fit-content; padding: 6px;"><div class="price-container hidden" style="display: flex; align-items: center; gap: 4px;"><div id="variation_price">0</div> <div>'.$currency.'</div></div></div>';
	}
	
	echo $output;
}
endif;