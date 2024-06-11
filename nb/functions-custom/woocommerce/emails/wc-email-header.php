<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function testing_hook_headers( $headers, $id, $order ) {
    // The order ID | Compatibility with WC version +3
    $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;

    $your_email = '<name@email.com>';
    $headers = "To: Order Num $order_id $your_email";
    return $headers;
}
add_filter( 'woocommerce_email_headers', 'testing_hook_headers', 10, 3);