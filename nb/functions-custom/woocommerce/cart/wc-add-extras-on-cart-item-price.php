<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 *
 * This is to handle extra costs related to bigger text and more lines
 * 
 */

add_action( 'woocommerce_before_calculate_totals', 'set_custom_cart_item_price', 20, 1 );
function set_custom_cart_item_price( $cart ) {
	$disableTextsizeFee = true;

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    // First loop to check if product 11 is in cart
    foreach ( $cart->get_cart() as $cart_item ) {

		$product_id = $cart_item['product_id'];
		$product_designer = get_post_meta( $product_id, 'designer_type') ? get_post_meta( $product_id, 'designer_type')[0] : 0;
	    
	    // Get extra costs from ACF custom fields
	    if( function_exists('get_field') && get_field('price_for_bold_text','options') && get_field('price_for_large_text','options') && get_field('price_for_extra_text_line','options') ) {
		    $bold_text_price = get_field('price_for_bold_text','options');
		    $large_text_price = get_field('price_for_large_text','options');
		    $extra_line_price = get_field('price_for_extra_text_line','options');
	    } else {
			$bold_text_price = 0;
			$large_text_price = 0;
			$extra_line_price = 0;
	    }
	    
	    $_textsize = isset($cart_item['textsize']) ? $cart_item['textsize'] : '';
	    $_textsizeInt = isset($_textsize) ? (float) $_textsize : '';
	    $_textbold = isset($cart_item['textbold']) ? $cart_item['textbold'] : '';
	    
	    // Convert to boolean
	    $_textbold = ($_textbold === 'true');
	    if( $_textbold && isset($_textbold) && ! empty($_textbold) ) {
		    $price = $cart_item['data']->get_price();
		    $cart_item['data']->set_price( $price + $bold_text_price );
	    }

		// No extra fee
		// designer_type = 0 ? It's a off the shelf product
		// designer_type = 1 ? It's plastic, no extra fee for text size
		// designer_type = 2 ? It's a brass sign

		if(!$disableTextsizeFee && $product_designer != 1) {
			// If size bigger equal or bigger than 8.5 mm
			if( $_textsizeInt >= 8.5 && isset($_textsizeInt) && ! empty($_textsizeInt) ) {
				$price = $cart_item['data']->get_price();
				$cart_item['data']->set_price( $price + $large_text_price );
			}
		}
    }
}