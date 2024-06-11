<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 * This creates the meta data fields on the order object, for each item
 * 
 */
function nb_add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {

	// This actually ends up in the confirmation email as well:

	foreach( $item as $cart_item_key=>$values ) {
		if( isset( $values['font'] ) && !empty($values['font']) ) {
			$item->add_meta_data( 'font', $values['font'], true );
		}
		if( isset( $values['textalignment'] ) && !empty($values['textalignment']) ) {
			$item->add_meta_data( 'textalignment', $values['textalignment'], true );
		}
		if( isset( $values['textitalic'] ) && !empty($values['textitalic']) ) {
			$item->add_meta_data( 'textitalic', $values['textitalic'], true );
		}
		if( isset( $values['textbold'] ) && !empty($values['textbold']) ) {
			$item->add_meta_data( 'textbold', $values['textbold'], true );
		}
		if( isset( $values['textsize'] ) && !empty($values['textsize']) ) {
			$item->add_meta_data( 'textsize', $values['textsize'], true );
		}
		if( isset( $values['textoffset'] ) && !empty($values['textoffset']) ) {
			$item->add_meta_data( 'textoffset', $values['textoffset'], true );
		}
		if( isset( $values['textoffset'] ) && !empty($values['textoffset']) ) {
			$item->add_meta_data( 'textoffset', $values['textoffset'], true );
		}
		if( isset( $values['textuppercase'] ) && !empty($values['textuppercase']) ) {
			$item->add_meta_data( 'textuppercase', $values['textuppercase'], true );
		}
		if( isset( $values['engravingtype'] ) && !empty($values['engravingtype']) ) {
			$item->add_meta_data( 'engravingtype', $values['engravingtype'], true );
		}
		
		// Text fields
		if( isset( $values['textrow1'] ) && !empty($values['textrow1']) ) {
			$cleanInput1 = esc_html($values['textrow1']);
			$item->add_meta_data( 'textrow1', $cleanInput1, true );
		}
		if( isset( $values['textrow2'] ) && !empty($values['textrow2']) ) {
			$cleanInput2 = esc_html($values['textrow2']);
			$item->add_meta_data( 'textrow2', $cleanInput2, true );
		}
		if( isset( $values['textrow3'] ) && !empty($values['textrow3']) ) {
			$cleanInput3 = esc_html($values['textrow3']);
			$item->add_meta_data( 'textrow3', $cleanInput3, true );
		}
		if( isset( $values['textrow4'] ) && !empty($values['textrow4']) ) {
			$cleanInput4 = esc_html($values['textrow4']);
			$item->add_meta_data( 'textrow4', $cleanInput4, true );
		}
		if( isset( $values['textrow5'] ) && !empty($values['textrow5']) ) {
			$cleanInput5 = esc_html($values['textrow5']);
			$item->add_meta_data( 'textrow5', $cleanInput5, true );
		}
		
		// Interface
		if( isset( $values['interface'] ) && !empty($values['interface']) ) {
			$item->add_meta_data( 'interface', $values['interface'], true );
		}

		// Canvas image
		if( isset( $values['oi'] ) && !empty($values['oi']) ) {
			$item->add_meta_data( 'orderimage', $values['oi'], true );
		}
		
		/*
		if( isset( $values['textuppercase'] ) ) {
			$item->add_meta_data( __( 'textuppercase', 'woocommerce' ), $values['textuppercase'], true );
		}
		*/
		/*
		if( isset( $values['signicon'] ) ) {
			$item->add_meta_data( __( 'signicon', 'woocommerce' ), $values['signicon'], true );
		}
		*/
	}
	
}
add_action( 'woocommerce_checkout_create_order_line_item', 'nb_add_custom_data_to_order', 10, 4 );

