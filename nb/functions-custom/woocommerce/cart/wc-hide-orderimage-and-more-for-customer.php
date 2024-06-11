<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 * Customer Account Order Item Page
 * This function displays extra fields on customer account order page
 * 
 */

// Remove order item meta key
if(!function_exists('nb_order_item_get_formatted_meta_data')):
add_filter( 'woocommerce_order_item_get_formatted_meta_data', 'nb_order_item_get_formatted_meta_data', 10, 1 );
function nb_order_item_get_formatted_meta_data($formatted_meta) {
	$translatedKeys = array();
	$index = 0;
	
	// Hide order image on logged in orders page, single order
	// Hide meta from emails
	// https://stackoverflow.com/questions/72256607/hide-item-meta-data-in-certain-woocommerce-email-notifications

    if ( !is_admin() ) {
	    $temp_metas = [];
	    foreach($translatedKeys as $key => $meta) {
	        if ( isset( $meta->key ) && ! in_array( $meta->key, [ 'oi', 'textoffset', 'textalignment', 'textuppercase' ] ) ) {
	            $temp_metas[ $key ] = $meta;
	        }
	    }
	    return $temp_metas;
    } else {
	    return $formatted_meta;
    }
}
endif;

// Hide 'Qty Selector', 'Qty' and 'Total' completely
add_filter( 'woocommerce_order_item_get_formatted_meta_data', 'unset_specific_order_item_meta_data');
function unset_specific_order_item_meta_data($formatted_meta){
    foreach( $formatted_meta as $key => $meta ){
        if( in_array( $meta->key, array('orderimage', 'textalignment', 'interface', 'font', 'textuppercase', 'textoffset', 'textsize', 'textrow1', 'textrow2', 'textrow3','textrow4','textrow5','engravingtype') ) )
            unset($formatted_meta[$key]);
    }
    
    return $formatted_meta;
}

// Add 'Qty Selector', 'Qty' and 'Total' in the admin backend only
// add_action('woocommerce_before_order_itemmeta', 'add_specific_order_item_meta_data_in_backend', 10, 2);
// function add_specific_order_item_meta_data_in_backend( $item_id, $item ) {
//     //Only applies for line items
//     if( $item->get_type() !== 'line_item' ) return;
    
//     $qty_sel_lines = wc_get_order_item_meta($item_id, 'orderimage', false);
//     $qty_lines = wc_get_order_item_meta($item_id, 'textalignment', false);
//     $total_lines = wc_get_order_item_meta($item_id, 'interface', false);
    
//     foreach ($qty_sel_lines as $qty_sel_line){
//         echo $qty_sel_line . '<br>';
//     }
    
//     foreach ($qty_lines as $qty_line){
//         echo $qty_line . '<br>';
//     }
    
//     foreach ($total_lines as $total_line){
//         echo $total_line. '<br>';
//     }
// }

/*

new_order
customer_on_hold_order
customer_processing_order
customer_completed_order
customer_refunded_order
customer_partially_refunded_order
cancelled_order
failed_order
customer_reset_password
customer_invoice
customer_new_account
customer_note
low_stock
no_stock

*/

// if(!function_exists('check_meta_data')):
// function check_meta_data($item) {
// 	if ( $item->get_meta( 'orderimage' ) ) {
// 		return true;
// 	} elseif($item->get_meta( 'textalignment' )) {
// 		return true;
// 	} elseif($item->get_meta( 'interface' )) {
// 		return true;
// 	} elseif($item->get_meta( 'font' )) {
// 		return true;
// 	} elseif($item->get_meta( 'textrow1' )) {
// 		return true;
// 	} elseif($item->get_meta( 'textrow2' )) {
// 		return true;
// 	} elseif($item->get_meta( 'textrow3' )) {
// 		return true;
// 	} elseif($item->get_meta( 'textrow4' )) {
// 		return true;
// 	} elseif($item->get_meta( 'textrow5' )) {
// 		return true;
// 	} elseif($item->get_meta( 'textuppercase' )) {
// 		return true;
// 	} elseif($item->get_meta( 'textoffset' )) {
// 		return true;
// 	}
// 	return false;
// }
// endif;

// if(!function_exists('nb_filter_woocommerce_display_item_meta')):
// function nb_filter_woocommerce_display_item_meta ( $html, $item, $args ) {

//     // For email notifications and specific meta
//     if ( ! is_wc_endpoint_url() && $item->is_type( 'line_item' ) && check_meta_data($item) ) {

//         // Getting the email ID global variable
//         $ref_name_globals_var = isset( $GLOBALS ) ? $GLOBALS : '';
//         $email_id = isset( $ref_name_globals_var['email_id'] ) ? $ref_name_globals_var['email_id'] : '';

//         // NOT empty and targeting specific email. Multiple statuses can be added, separated by a comma
// 		// 'new_order', 'cancelled_order', 'customer_note', 'customer_refunded_order', 'customer_processing_order', 'customer_on_hold_order', 'customer_partially_refunded_order', 'failed_order', 'customer_new_account', 'customer_reset_password', 'customer_invoice', 'customer_completed_order' 
//         if ( ! empty ( $email_id ) && ! in_array( $email_id, array('failed_order') ) ) {
//             $html = '';
//         }
//     }

//     return $html;
// }
// add_filter( 'woocommerce_display_item_meta', 'nb_filter_woocommerce_display_item_meta', 10, 3 );
// endif;

/*
	$textRow1 = $item->get_meta('textrow1');
	$textRow2 = $item->get_meta('textrow2');
	$textRow3 = $item->get_meta('textrow3');
	$textRow4 = $item->get_meta('textrow4');
	$textRow5 = $item->get_meta('textrow5');
	*/
	// This actually also displays values on the confirmation page...
	/*
	foreach($formatted_meta as $key => $meta) {
		if ( isset( $meta->key ) ) {
			if( $meta->key == 'font') {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('Typsnitt'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			} elseif( $meta->key == 'textsize') {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('Textstorlek'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			} elseif( $meta->key == 'textbold' && $meta->value == 'true' ) {
				// Hide if false
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('Fet text'),
					'value' => $meta->value,
					'display_value' => 'Ja',
				];
			} elseif( $meta->key == 'textitalic' && $meta->value == 'true' ) {
				// Hide if false
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('Kursiv'),
					'value' => $meta->value,
					'display_value' => 'Ja',
				];
			// } elseif( $meta->key == 'interface' ) {
			// 	$translatedKeys[$index] = (object) [
			// 		'key' => $meta->key,
			// 		'display_key' => pll__('Fästtyp'),
			// 		'value' => $meta->value,
			// 		'display_value' => $meta->value,
			// 	];
			} elseif( $meta->key == 'textalignment' ) {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('Textjustering'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			} elseif( $meta->key == 'textrow1' ) {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('textrow1'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			} elseif( $meta->key == 'textrow2' ) {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('textrow2'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			} elseif( $meta->key == 'textrow3' ) {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('textrow3'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			} elseif( $meta->key == 'textrow4' ) {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('textrow4'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			} elseif( $meta->key == 'textrow5' ) {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('textrow5'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			} elseif( $meta->key == 'orderimage' ) {
				$translatedKeys[$index] = (object) [
					'key' => $meta->key,
					'display_key' => pll__('Orderbild'),
					'value' => $meta->value,
					'display_value' => $meta->value,
				];
			}
		}
		$index++;
	}
	*/