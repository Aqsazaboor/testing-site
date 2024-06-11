<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Validate the text field
 * @since 1.0.0
 * @param Array 		$passed					Validation status.
 * @param Integer   $product_id     Product ID.
 * @param Boolean  	$quantity   		Quantity
 */
function nb_validate_custom_field( $passed, $product_id, $quantity ) {
	/*
	if( empty( $_POST['cfwc-title-field-1'] ) ) {
		// Fails validation
		$passed = false;
		wc_add_notice( __( 'Please enter a value into the text field', 'cfwc' ), 'error' );
	}
	return $passed;
	*/
	
	// Do not validate if fields have data
	$passed = true;
	
	return $passed;
}
add_filter( 'woocommerce_add_to_cart_validation', 'nb_validate_custom_field', 10, 3 );