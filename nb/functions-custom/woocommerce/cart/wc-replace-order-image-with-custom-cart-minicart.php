<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// -----------------------------------------------------
// This function replaces the order image with our
// saved custom image via order meta
// -----------------------------------------------------
if(!function_exists('nb_custom_new_product_image')):
function nb_custom_new_product_image( $_product_img, $cart_item, $cart_item_key ) {
	
	$customorderimage = '';
	$product_id = $cart_item['product_id'];
	$_product = wc_get_product( $product_id );
	$current_product = new  WC_Product_Variable($product_id);
	
	$output = '<div class="checkout__image-merge">';
	if ( $_product->is_type( 'variable' ) ) {
		$values = $cart_item['data'];
		$image_id = $values->image_id;
		if(isset($image_id)) {
			$normal_product_image_url = wp_get_attachment_image_url($image_id);
			$customorderimage = '<div class="checkout__generated-image"><img src="'.$normal_product_image_url.'" alt="Order image" /></div>';
			$output .= $customorderimage;
		}
	} else {
		if( isset( $cart_item['oi'] ) ) {
			$imagename = $cart_item['oi'];
			$imagepath = $imagename;
			$customorderimage = '<div class="checkout__generated-image"><img src="'.$imagename.'" alt="Order image" /></div>';
			$output .= $customorderimage;
		} else {
			$normal_product_image_url = get_the_post_thumbnail_url($product_id);
			if($normal_product_image_url) {
				$customorderimage = '<div class="checkout__generated-image"><img src="'.$normal_product_image_url.'" alt="Order image" /></div>';
			}
			$output .= $customorderimage;
		}
	}

	$output .= '</div>';
	
	return $output;
}
add_filter( 'woocommerce_cart_item_thumbnail', 'nb_custom_new_product_image', 10, 3 );
endif;