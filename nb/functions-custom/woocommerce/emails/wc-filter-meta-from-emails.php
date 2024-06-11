<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Hide meta from emails
if(!function_exists('unset_specific_order_item_meta_data')):
add_filter( 'woocommerce_order_item_get_formatted_meta_data', 'unset_specific_order_item_meta_data', 10, 2);
function unset_specific_order_item_meta_data($formatted_meta, $item) {

	  // Only on emails notifications
    // send_order_details
    // send_order_details_admin
    $is_resend = isset($_POST['wc_order_action']) ?  wc_clean( wp_unslash( $_POST['wc_order_action'] ) ) === 'send_order_details' : false;

    // Check if it's a resend?
    if ( !$is_resend && ( is_admin() || is_wc_endpoint_url() ) ) {
      return $formatted_meta;
    }

    foreach( $formatted_meta as $key => $meta ){
        if( in_array( $meta->key, array('orderimage', 'textalignment', 'font', 'textsize', 'engravingtype', 'textrow1', 'textrow2', 'textrow3', 'textrow4', 'textrow5', 'interface', 'textuppercase') ) )
            unset($formatted_meta[$key]);
    }

    return $formatted_meta;

}
endif;
