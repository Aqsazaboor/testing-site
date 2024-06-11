<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Update the price in the cart
 * @since 1.0.0
 */
function nb_before_calculate_totals( $cart_obj ) {
  if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
    return;
  }
  // Iterate through each cart item
  foreach( $cart_obj->get_cart() as $key=>$value ) {
    if( isset( $value['total_price'] ) ) {
      $price = $value['total_price'];
      $value['data']->set_price( ( $price ) );
    }
  }
}
add_action( 'woocommerce_before_calculate_totals', 'nb_before_calculate_totals', 10, 1 );
