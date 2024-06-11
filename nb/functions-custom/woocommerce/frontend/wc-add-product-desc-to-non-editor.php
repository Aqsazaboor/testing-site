<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'woocommerce_before_add_to_cart_form', 'nb_show_excerpt_shop_page', 5 );
function nb_show_excerpt_shop_page() {
    global $product;
	echo $product->get_description();
}