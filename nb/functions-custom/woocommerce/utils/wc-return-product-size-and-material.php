<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_get_product_size_material')):
function nb_get_product_size_material($product_id) {
	$_product = wc_get_product( $product_id );
	
	$sign_height = get_post_meta( $product_id, 'product_height', true );
	$sign_width = get_post_meta( $product_id, 'product_width', true );
	$sign_material = get_post_meta( $product_id, 'product_material', true );
	$sign_color = get_post_meta( $product_id, 'product_color', true );

	// Product price

	$output = '<div>';
		$output .= '<div class="product-description">';
			$translated_material = "";
			$translated_color = "";
			
			if( $sign_color != "None" && $sign_material != "None") {
				if(function_exists('translate_materials_and_color')) {
					$translated_material = '<span class="product-material">'.translate_materials_and_color($sign_material).'</span>';
				} else {
					$translated_material = $sign_material;
				}
				if(function_exists('translate_materials_and_color') && $sign_color != "None") {
					$translated_color = '<span class="product-color">'.translate_materials_and_color($sign_color).'</span>';
				} else {
					$translated_color = $sign_color;
				}
			}
			
			$output .= '<div class="woocommerce-loop-product__material">' . ($translated_material ? $translated_material : '') . ($translated_color ? ' '. $translated_color : '') . '</div>';
			if( $sign_width != "" || $sign_height != "" ) {
				$output .= '<div class="woocommerce-loop-product__size">'.$sign_width.' x '.$sign_height.' mm</div>';
			}

			// Only use this on single product page
			if(is_single() && is_product()) {
				$output .= '<div class="price">';
				$output .= $_product->get_price_html();
				$output .= '</div>';
			}

		$output .= '</div>';
	$output .= '</div>';

	return $output;
}
endif;