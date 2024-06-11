<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 *
 * This function saves the meta to the order when it is processed from the Checkout page
 * 
 */


/*

function product_certification_number_save( $product ){

    if( isset($_POST['font']) ) {
        $product->update_meta_data( 'font', sanitize_text_field( $_POST['font'] ) );
    }

	if( isset($_POST['textrow1']) ) {
        $product->update_meta_data( 'textrow1', sanitize_text_field( $_POST['textrow1'] ) );
    }

	#$textfont = isset( $_POST['font'] ) ? $_POST['font'] : '';
	#$product->update_meta_data( 'font', sanitize_text_field( $textfont ) );

}
add_action( 'woocommerce_admin_process_product_object', 'product_certification_number_save', 10, 1 );

*/

// https://stackoverflow.com/questions/62376013/which-hook-to-save-woocommerce-product-meta-in-woocommerce
/*
add_action( 'woocommerce_admin_process_product_object', 'action_save_product_meta' );
function action_save_product_meta( $product ) {
    // $product->update_meta_data( 'test_acf_product', 'text' );

	// $product = wc_get_product( $post_id );
	
	// ------------------------------------------------------------------
	// Text styling
	// ------------------------------------------------------------------
	$textfont = isset( $_POST['font'] ) ? $_POST['font'] : '';
	$product->update_meta_data( 'font', sanitize_text_field( $textfont ) );
	
	$textsize = isset( $_POST['textsize'] ) ? $_POST['textsize'] : '';
	$product->update_meta_data( 'textsize', sanitize_text_field( $textsize ) );
	
	$textalignment = isset( $_POST['textaligment'] ) ? $_POST['textaligment'] : '';
	$product->update_meta_data( 'textaligment', sanitize_text_field( $textalignment ) );
	
	$signicon = isset( $_POST['custom_icon'] ) ? $_POST['custom_icon'] : '';
	$product->update_meta_data( 'custom_icon', sanitize_text_field( $signicon ) );

	$textbold = isset( $_POST['textbold'] ) ? $_POST['textbold'] : '';
	$product->update_meta_data( 'textbold', sanitize_text_field( $textbold ) );
	
	$textitalic = isset( $_POST['textitalic'] ) ? $_POST['textitalic'] : '';
	$product->update_meta_data( 'textitalic', sanitize_text_field( $textitalic ) );	

	$textuppercase = isset( $_POST['textuppercase'] ) ? $_POST['textuppercase'] : '';
	$product->update_meta_data( 'textuppercase', sanitize_text_field( $textuppercase ) );

	$textoffset = isset( $_POST['textoffset'] ) ? $_POST['textoffset'] : '';
	$product->update_meta_data( 'textoffset', sanitize_text_field( $textoffset ) );
	
	// ------------------------------------------------------------------
	// Text fields
	// ------------------------------------------------------------------
	$row1 = isset( $_POST['textrow1'] ) ? strip_tags($_POST['textrow1']) : '';
	$product->update_meta_data( 'textrow1', sanitize_text_field( $row1 ) );
	
	// Text 2
	$row2 = isset( $_POST['textrow2'] ) ? $_POST['textrow2'] : '';
	$product->update_meta_data( 'textrow2', sanitize_text_field( $row2 ) );
	
	// Text 3
	$row3 = isset( $_POST['textrow3'] ) ? $_POST['textrow3'] : '';
	$product->update_meta_data( 'textrow3', sanitize_text_field( $row3 ) );
	
	// Text 4
	$row4 = isset( $_POST['textrow4'] ) ? $_POST['textrow4'] : '';
	$product->update_meta_data( 'textrow4', sanitize_text_field( $row4 ) );

	// Text 5
	$row5 = isset( $_POST['textrow5'] ) ? $_POST['textrow5'] : '';
	$product->update_meta_data( 'textrow5', sanitize_text_field( $row5 ) );
	
	// ------------------------------------------------------------------
	// Interface
	// ------------------------------------------------------------------
	$interface = isset( $_POST['interface'] ) ? $_POST['interface'] : '';
	$product->update_meta_data( 'interface', sanitize_text_field( $interface ) );
	
	// ------------------------------------------------------------------
	// Save image to order
	// ------------------------------------------------------------------
	$canvasfile = isset( $_POST['canvasfile'] ) ? $_POST['canvasfile'] : '';
	$product->update_meta_data( 'canvasfile', sanitize_text_field( $canvasfile ) );
	
	// $product->save();
}*/


/**
 * Save the custom field on post?
 * @since 1.0.0
 */
function nb_save_custom_fields( $post_id ) {
	
	// ------------------------------------------------------------------
	// This is posted from admin, so not that unsecure?
	// ------------------------------------------------------------------
	//$safePost = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	
	$safePost = filter_input_array(INPUT_POST, [
		"font" => FILTER_SANITIZE_STRING,
		"textsize" => FILTER_VALIDATE_INT,
		"textaligment" => FILTER_SANITIZE_STRING,
		"textitalic" => FILTER_VALIDATE_INT,
		"custom_textbold" => FILTER_VALIDATE_INT,
		"textoffset" => FILTER_VALIDATE_INT,
		"textuppercase" => FILTER_SANITIZE_STRING,
		"engravingtype" => FILTER_SANITIZE_STRING,
		"textrow1" => FILTER_SANITIZE_STRING,
		"textrow2" => FILTER_SANITIZE_STRING,
		"textrow3" => FILTER_SANITIZE_STRING,
		"textrow4" => FILTER_SANITIZE_STRING,
		"textrow5" => FILTER_SANITIZE_STRING,
		"interface" => FILTER_SANITIZE_STRING,
		// "canvasfile" => FILTER_SANITIZE_STRING
	]);
	
	if(!$safePost) {
		var_dump('error in sanitize, unallowed chars');
	}
	
	$product = wc_get_product( $post_id );
	
	// ------------------------------------------------------------------
	// Text styling
	// ------------------------------------------------------------------
	$textfont = isset( $_POST['font'] ) ? $_POST['font'] : '';
	$product->update_meta_data( 'font', sanitize_text_field( $textfont ) );
	
	$textsize = isset( $_POST['textsize'] ) ? $_POST['textsize'] : '';
	$product->update_meta_data( 'textsize', sanitize_text_field( $textsize ) );
	
	$textalignment = isset( $_POST['textaligment'] ) ? $_POST['textaligment'] : '';
	$product->update_meta_data( 'textaligment', sanitize_text_field( $textalignment ) );
	
	$signicon = isset( $_POST['custom_icon'] ) ? $_POST['custom_icon'] : '';
	$product->update_meta_data( 'custom_icon', sanitize_text_field( $signicon ) );

	$textbold = isset( $_POST['textbold'] ) ? $_POST['textbold'] : '';
	$product->update_meta_data( 'textbold', sanitize_text_field( $textbold ) );
	
	$textitalic = isset( $_POST['textitalic'] ) ? $_POST['textitalic'] : '';
	$product->update_meta_data( 'textitalic', sanitize_text_field( $textitalic ) );	

	$textoffset = isset( $_POST['textoffset'] ) ? $_POST['textoffset'] : '';
	$product->update_meta_data( 'textoffset', sanitize_text_field( $textoffset ) );

	$engravingtype = isset( $_POST['engravingtype'] ) ? $_POST['engravingtype'] : '';
	$product->update_meta_data( 'engravingtype', sanitize_text_field( $engravingtype ) );

	// ------------------------------------------------------------------
	// Text fields
	// ------------------------------------------------------------------
	$row1 = isset( $_POST['textrow1'] ) ? strip_tags($_POST['textrow1']) : '';
	$product->update_meta_data( 'textrow1', sanitize_text_field( $row1 ) );
	
	// Text 2
	$row2 = isset( $_POST['textrow2'] ) ? $_POST['textrow2'] : '';
	$product->update_meta_data( 'textrow2', sanitize_text_field( $row2 ) );
	
	// Text 3
	$row3 = isset( $_POST['textrow3'] ) ? $_POST['textrow3'] : '';
	$product->update_meta_data( 'textrow3', sanitize_text_field( $row3 ) );
	
	// Text 4
	$row4 = isset( $_POST['textrow4'] ) ? $_POST['textrow4'] : '';
	$product->update_meta_data( 'textrow4', sanitize_text_field( $row4 ) );

	// Text 5
	$row5 = isset( $_POST['textrow5'] ) ? $_POST['textrow5'] : '';
	$product->update_meta_data( 'textrow5', sanitize_text_field( $row5 ) );
	
	// ------------------------------------------------------------------
	// Interface
	// ------------------------------------------------------------------
	$interface = isset( $_POST['interface'] ) ? $_POST['interface'] : '';
	$product->update_meta_data( 'interface', sanitize_text_field( $interface ) );
	
	// ------------------------------------------------------------------
	// Save image to order
	// ------------------------------------------------------------------
	$canvasfileName = isset( $_POST['oi'] ) ? $_POST['oi'] : '';
	$product->update_meta_data( 'orderimage', $_POST['oi'] );
	
	$product->save();

}
add_action( 'woocommerce_process_product_meta', 'nb_save_custom_fields' );