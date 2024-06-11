<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add the text field as item data to the cart object, saves fields to CART
 * When order put in cart these are the fields that save the data to the temp cart...
 * 
 * @since 1.0.0
 * @param Array 		$cart_item_data Cart item meta data.
 * @param Integer   $product_id     Product ID.
 * @param Integer   $variation_id   Variation ID.
 * @param Boolean  	$quantity   		Quantity
 */
function nb_add_custom_field_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {
	/*
		case 'url':
		$filter = FILTER_SANITIZE_URL;

		case 'int':
		$filter = FILTER_SANITIZE_NUMBER_INT;

		case 'float':
		$filter = FILTER_SANITIZE_NUMBER_FLOAT;
		$flags = FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND;

		case 'email':
		$var = substr($var, 0, 254);
		$filter = FILTER_SANITIZE_EMAIL;

		case 'string':
		$filter = FILTER_SANITIZE_STRING;
		$flags = FILTER_FLAG_NO_ENCODE_QUOTES;		
	*/
	
	function make_safer($variable, $type) {
		$formValidator = new FormValidator();
		$variable = $formValidator->sanitizeItem($variable, $type);
		#$variable = strip_tags(mysql_real_escape_string(trim($variable)));
		#	$textrow2 = new FormValidator()->sanitizeItem($_POST['textrow2'], 'string');
		#	$textrow3 = new FormValidator()->sanitizeItem($_POST['textrow3'], 'string');
		#	$textrow4 = new FormValidator()->sanitizeItem($_POST['textrow4'], 'string');
		#	$textrow5 = new FormValidator()->sanitizeItem($_POST['textrow5'], 'string');
		return $variable; 
	}
	
	// font: string
	// textalignment: string
	// textsize: number
	// textoffset: string -> center left right
	// textbold: number 1 / 0
	// textitalic: number 1 / 0
	// interface: string
	// signicon: number 1 / 0
	// textuppercase: number 1 / 0
	$font = isset($_POST['font']) ? make_safer($_POST['font'], 'string') : '';
	$textsize = isset($_POST['textsize']) ? make_safer($_POST['textsize'], 'string') : '';
	$interface = isset($_POST['interface']) ? make_safer($_POST['interface'], 'string') : '';
	
	$textrow1 = isset($_POST['textrow1']) ? make_safer($_POST['textrow1'], 'string') : '';
	$textrow2 = isset($_POST['textrow2']) ? make_safer($_POST['textrow2'], 'string') : '';
	$textrow3 = isset($_POST['textrow3']) ? make_safer($_POST['textrow3'], 'string') : '';
	$textrow4 = isset($_POST['textrow4']) ? make_safer($_POST['textrow4'], 'string') : '';
	$textrow5 = isset($_POST['textrow5']) ? make_safer($_POST['textrow5'], 'string') : '';
	
	// -----------------------------------
	// Text styling
	// -----------------------------------
	
	if( ! empty( $font ) ) {
		// Add the item data
		$cart_item_data['font'] = sanitize_text_field($font);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
		
	}
	if( ! empty( $textsize ) ) {
		// Add the item data
		$cart_item_data['textsize'] = sanitize_text_field($textsize);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price + 1000;
		
	}
	if( ! empty( $_POST['textalignment'] ) ) {
		// Add the item data
		$cart_item_data['textalignment'] = sanitize_text_field($_POST['textalignment']);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
		
	}
	if( ! empty( $_POST['signicon'] ) ) {
		// Add the item data
		$cart_item_data['signicon'] = sanitize_text_field($_POST['signicon']);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}
	
	// -----------------------------------
	// Text styling
	// -----------------------------------
	
	if( ! empty( $_POST['textitalic'] ) ) {
		// Add the item data
		$cart_item_data['textitalic'] = sanitize_text_field($_POST['textitalic']);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
	}
	
	if( ! empty( $_POST['textbold'] ) ) {
		// Add the item data
		$cart_item_data['textbold'] = sanitize_text_field($_POST['textbold']);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		
		// No extra fee for bold etc
		if( $cart_item_data['textbold'] === '1' ) {
			// Extra price for bold... no
			$cart_item_data['total_price'] = $price + 30;
		}
	}

	if( ! empty( $_POST['textuppercase'] ) ) {
		// Add the item data
		$cart_item_data['textuppercase'] = sanitize_text_field($_POST['textuppercase']);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}

	if( ! empty( $_POST['engravingtype'] ) ) {
		// Add the item data
		$cart_item_data['engravingtype'] = sanitize_text_field($_POST['engravingtype']);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}


	if( ! empty( $_POST['textoffset'] ) ) {
		// Add the item data
		$cart_item_data['textoffset'] = sanitize_text_field($_POST['textoffset']);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}	
		
	// ------------------------------------------------------------------
	// Text fields
	// ------------------------------------------------------------------
	
	if( ! empty( $textrow1 ) ) {
		$cart_item_data['textrow1'] = sanitize_text_field($textrow1);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}
	if( ! empty( $textrow2 ) ) {
		$cart_item_data['textrow2'] =  sanitize_text_field($textrow2);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}
	if( ! empty( $textrow3 ) ) {
		$cart_item_data['textrow3'] =  sanitize_text_field($textrow3);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}
	if( ! empty( $textrow4 ) ) {
		$cart_item_data['textrow4'] =  sanitize_text_field($textrow4);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}
	if( ! empty( $textrow5 ) ) {
		$cart_item_data['textrow5'] =  sanitize_text_field($textrow5);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		$cart_item_data['total_price'] = $price;
	}
	
	// ------------------------------------------------------------------
	// Interface
	// ------------------------------------------------------------------
	if( ! empty( $interface ) ) {
		
		// Add the item data
		$cart_item_data['interface'] = sanitize_text_field($interface);
		$product = wc_get_product( $product_id );
		$price = $product->get_price();
		
		if( $cart_item_data['interface'] == 'militaryclip' ) {
			$cart_item_data['total_price'] = $price + 25;
		} elseif( $cart_item_data['interface'] == 'metalmagnet' ) {
			$cart_item_data['total_price'] = $price + 15;
		} elseif( $cart_item_data['interface'] == 'plasticmagnet' ) {
			$cart_item_data['total_price'] = $price + 15;
		} elseif( $cart_item_data['interface'] == 'safetypin' ) {
			$cart_item_data['total_price'] = $price + 10;
		}
	}

	// ------------------------------------------------------------------
	// Canvasfile
	// ------------------------------------------------------------------
	// This Works
	if( ! empty( $_POST['oi'] ) ) {
		$imageData = sanitize_text_field($_POST['oi']);
		$savedfile = make_image_form_canvas($imageData);
		$cart_item_data['oi'] = $savedfile;
	}

	return $cart_item_data;
	
}
add_filter( 'woocommerce_add_cart_item_data', 'nb_add_custom_field_item_data', 10, 4 );