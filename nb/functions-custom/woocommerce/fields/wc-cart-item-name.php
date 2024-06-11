<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 * Show custom fields in Cart page and Billing page
 */
function nb_cart_item_name( $name, $cart_item, $cart_item_key ) {

	$output = '';

	global $woocommerce;
	$currency = 'kr';
	if( function_exists('get_woocommerce_currency_symbol') ) {
		$currency = nb_get_woocommerce_currency_symbol();
	}
	
	$bold_text_price = 0;
	$large_text_price = 0;
	$extra_line_price = 0;
	
	if( function_exists('get_field') && get_field('price_for_bold_text','options') && get_field('price_for_large_text','options') && get_field('price_for_extra_text_line','options') ) {
		$bold_text_price = get_field('price_for_bold_text','options');
		$large_text_price = get_field('price_for_large_text','options');
		$extra_line_price = get_field('price_for_extra_text_line','options');
	}

	$product_id = $cart_item['product_id'];
	$product_width = get_post_meta($product_id, 'product_width');
	$product_height = get_post_meta($product_id, 'product_height');
	$product_designer = get_post_meta( $product_id, 'designer_type') ? get_post_meta( $product_id, 'designer_type')[0] : 0;
	$advanced_editor = false;
	
	if( isset( $product_width[0] ) && isset( $product_height[0] ) ) {
		$output .= '<strong>'.$name.'</strong>'. ', ' . $product_width[0] . 'x' . $product_height[0] . ' mm';		
	} else {
		$output .= '<strong>'.$name.'</strong>';
	}

	$output .= '<ul class="cart-extra-fields">';
	
	// --------------------------------------------------
	// Text styling
	// --------------------------------------------------
	if( isset( $cart_item['font'] ) ) {
		$output .= sprintf(
			'<li>' . pll__('Typsnitt') . ': %s</li>',
			esc_html( $cart_item['font'] )
		);
	}
	
	// Do not display
	if( isset( $cart_item['textalignment'] ) && $advanced_editor ) {
		$output .= sprintf(
			'<li>' . pll__('Textjustering') . ': %s</li>',
			esc_html( $cart_item['textalignment'] )
		);
	}
	
	if( isset( $cart_item['textsize'] ) ) {
		// No extra fee
		// Designer type = 0 is from the shelf and has no extra charge for text sizes
		// Designer type = 1 is plastic and has no extra charge for text sizes
		// Designer type = 2 is brass and has extra charge for text sizes
		
		$extraPriceLargeText = '';
		if($product_designer != 1 && (int)$cart_item['textsize'] >= 8 ) {
			$extraPriceLargeText = ' (+'.$large_text_price.' '.$currency.')';			
		}
		$output .= sprintf(
			'<li>' . pll__('Textstorlek') .': %s mm'.$extraPriceLargeText.'</li>',
			esc_html( $cart_item['textsize'] )
		);
	}
	
	if( isset( $cart_item['signicon'] ) && $cart_item['signicon'] != 'false' ) {
		if( $cart_item['signicon'] != 'undefined' ) {
			$output .= '<li>' . __('Ikon') . ': <img src="'.$cart_item['signicon'].'" style="width: 15px; height: 15px;" /></li>';
		}
	}
	
	// --------------------------------------------------
	// String, not Boolean
	// --------------------------------------------------
	if( isset( $cart_item['textbold'] ) && $cart_item['textbold'] != 'false' && $cart_item['textbold'] == 1 ) {
		# $extraPriceBold = ' (+'.$bold_text_price.' '.$currency.')';
		$output .= sprintf(
			'<li>' . pll__('Fet text') . '</li>',
			esc_html( $cart_item['textbold'] )
		);
	}
	
	// --------------------------------------------------
	// String, not Boolean
	// --------------------------------------------------
	if(  isset( $cart_item['textitalic'] ) && $cart_item['textitalic'] != 'false' && $cart_item['textitalic'] != '0' ) {
		$output .= sprintf(
			'<li>' . pll__('Kursiv') . '</li>',
			esc_html( $cart_item['textitalic'] )
		);
	}

	// --------------------------------------------------
	// String, not Boolean
	// --------------------------------------------------
	if( isset( $cart_item['textuppercase'] ) && $cart_item['textuppercase'] != 'false' &&  $cart_item['textuppercase'] != 'undefined' ) {
		$output .= '<li>' . pll__('Versaler') . '</li>';
	}
	
	// --------------------------------------------------
	// String, not Boolean
	// --------------------------------------------------
	if( isset( $cart_item['textoffset'] ) && $cart_item['textoffset'] != 'false' && $advanced_editor ) {
		$output .= sprintf(
			'<li>' . pll__('Offset') . ': %s</li>',
			esc_html( $cart_item['textoffset'] )
		);
	}

	// Displays Order image data, should be hidden
	// if( isset( $cart_item['oi'] ) && $cart_item['oi'] != 'false' ) {
	// 	$name .= sprintf(
	// 		'<li>Order Image: %s</li>',
	// 		esc_html( $cart_item['oi'] )
	// 	);
	// }
	
	// --------------------------------------------------
	// Interface, enable this if we are using interfaces
	// --------------------------------------------------
	// if( isset( $cart_item['interface'] ) && $cart_item['interface'] != 'na' ) {
	// 	$name .= sprintf(
	// 		'<li>' . pll__('Fästtyp') . ': %s</li>',
	// 		esc_html( $cart_item['interface'] )
	// 	);
	// }

	
	// --------------------------------------------------
	// Text fields
	// --------------------------------------------------
	
	if( isset( $cart_item['textrow1'] ) && $cart_item['textrow1'] !== 'undefined' ) {
	  	$output .= sprintf(
			'<li>' . pll__('Textrad 1') . ': %s</li>',
			esc_html( $cart_item['textrow1'] )
		);
	}
	if( isset( $cart_item['textrow2'] ) && $cart_item['textrow2'] !== 'undefined' ) {
		$output .= sprintf(
			'<li>' . pll__('Textrad 2') . ': %s</li>',
			esc_html( $cart_item['textrow2'] )
		);
	}
	if( isset( $cart_item['textrow3'] ) && $cart_item['textrow3'] !== 'undefined' ) {
		$output .= sprintf(
			'<li>' . pll__('Textrad 3') . ': %s</li>',
			esc_html( $cart_item['textrow3'] )
		);
	}
	if( isset( $cart_item['textrow4'] ) && $cart_item['textrow4'] !== 'undefined' ) {
		$output .= sprintf(
			'<li>' . pll__('Textrad 4') . ': %s</li>',
			esc_html( $cart_item['textrow4'] )
		);
	}
	if( isset( $cart_item['textrow5'] ) && $cart_item['textrow5'] !== 'undefined' ) {
		$output .= sprintf(
			'<li>' . pll__('Textrad 5') . ': %s</li>',
			esc_html( $cart_item['textrow5'] )
		);
	}

	// --------------------------------------------------
	// String, not Boolean
	// --------------------------------------------------
	if( isset( $cart_item['engravingtype'] ) && $cart_item['engravingtype'] !== false && $cart_item['engravingtype'] !== 'undefined' ) {
		$output .= '<li>' . pll__('Gravyrtyp') . ': ';
		$translated_engraving_type = '';
		if(function_exists('translate_materials_and_color')) {
			$translated_engraving_type = translate_engraving_types($cart_item['engravingtype']);
			$output .= $translated_engraving_type;
		} else {
			$output .= $cart_item['engravingtype'];
		}
		$output .= '</li>';
	}

	$output .= '</ul>';
	
	return $output;
}
add_filter( 'woocommerce_cart_item_name', 'nb_cart_item_name', 10, 3 );
