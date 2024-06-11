<?php

// Ref: https://quadlayers.com/change-order-status-automatically-in-woocommerce/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('nb_status_callback')) {
    function nb_status_callback() {
        if( current_user_can( 'manage_woocommerce' ) )  {
            if ( !wp_verify_nonce( $_REQUEST['nonce'], "custom_order_page_nonce")) {
                exit("No naughty business please");
            }

            $order_id = $_POST['order_id'];
            $blog_id = $_POST['blog_id'];
            $order_status = $_POST['order_status'] ? $_POST['order_status'] : null;

            // This needs to empty the transient
            // if ( false === ( $get_orders_for_all_countries = get_transient( 'all_countries_orders' ) ) ) {
            // 
            // }

            switch_to_blog($blog_id);

            $order = new WC_Order($order_id);

            try {
                if (!empty($order)) {
                    if(function_exists('nb_get_orders_clear_transient')) {
                        nb_get_orders_clear_transient();
                    }
                    $order->update_status( $order_status );
                    wp_send_json_success($data);
                } else {
                    wp_send_json_error(array('status' => 0, 'error' => 'Not allowed' ));
                }
             } catch (Exception $e) {
				wp_send_json_error(array('status' => 0, 'error' => $e->getMessage() ));
			}

            restore_current_blog();
        } else {
            wp_send_json_error(array('status' => 0, 'error' => 'Not allowed' ));
        }
        wp_die();
    }
    add_action('wp_ajax_nopriv_cos', 'nb_status_callback');
    add_action('wp_ajax_cos', 'nb_status_callback');
}