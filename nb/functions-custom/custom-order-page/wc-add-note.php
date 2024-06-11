<?php

/*

// If you don't have the WC_Order object (from a dynamic $order_id)
$order = wc_get_order(  $order_id );

// The text for the note
$note = __("This is my note's text…");

// Add the note
$order->add_order_note( $note );

*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('nb_add_note_callback')) {
    function nb_add_note_callback() {
		if( current_user_can( 'manage_woocommerce' ) )  {
            if ( !wp_verify_nonce( $_REQUEST['nonce'], "custom_order_page_nonce")) {
                exit("No naughty business please");
            }
			
			$order_id = $_POST['order_id'];
			$blog_id = $_POST['blog_id'];
			$order_note = sanitize_text_field($_POST['order_note']);
			$order_status = $_POST['order_status'] ? $_POST['order_status'] : null;

			switch_to_blog($blog_id);

			try {
				$order = new WC_Order($order_id);

				if (!empty($order)) {
                    if(function_exists('nb_get_orders_clear_transient')) {
                        nb_get_orders_clear_transient();
                    }
					
					$order->add_order_note( $order_note, false, true );
					wp_send_json_success(array('status' => 1 ));
				} else {
					wp_send_json_error(array('status' => 0, 'error' => 'Not allowed' ));
				}				
			} catch (Exception $e) {
				wp_send_json_error(array('status' => 0, 'error' => $e->getMessage() ));
				# echo 'Caught exception: ',  $e->getMessage(), "\n";
			}

			restore_current_blog();
		} else {
			wp_send_json_error(array('status' => 0, 'error' => 'Not allowed' ));
		}
        wp_die();
    }
    add_action('wp_ajax_nopriv_add_note', 'nb_add_note_callback');
    add_action('wp_ajax_add_note', 'nb_add_note_callback');
}