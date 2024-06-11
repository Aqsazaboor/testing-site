<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
        
function woocommerce_ajax_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && $product_status === 'publish') {
        
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        
        if (get_option('woocommerce_cart_redirect_after_add') === 'yes') {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();

    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );
        echo wp_send_json($data);
    }

    wp_die();
}



add_filter( 'woocommerce_add_to_cart_fragments', 'refresh_cart_count', 50, 1 );

function refresh_cart_count( $fragments ){
    ob_start();
    ?>
    <span class="counter" id="cart-count"><?php
    $cart_count = WC()->cart->get_cart_contents_count();
    echo sprintf ( _n( '%d', '%d', $cart_count ), $cart_count );
    ?></span>
    <?php
     $fragments['#cart-count'] = ob_get_clean();

    return $fragments;
}