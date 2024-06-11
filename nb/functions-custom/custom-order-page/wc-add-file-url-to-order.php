<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Should work with own API
// User should enter file url from Media archive and save. Should display file in Custom Order Admin
if(!function_exists("custom_checkout_field_update_order_meta")) {
    add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');
    function custom_checkout_field_update_order_meta($order_id)
    {
        session_start();
        if ($_SESSION['orderfile'])
            update_post_meta($order_id, 'orderfile', esc_attr(htmlspecialchars($_SESSION['orderfile'])));
    }
}