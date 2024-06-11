<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'woocommerce_product_tabs', 'my_remove_description_tab', 11 );
function my_remove_description_tab( $tabs ) {
  unset( $tabs['description'] );
  return $tabs;
}