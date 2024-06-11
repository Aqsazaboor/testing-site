<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Exclude products from a particular category on the shop page
 */
function nb_custom_pre_get_posts_query( $query ) {

	if(is_shop()) {	
	    $tax_query = (array) $query->get( 'tax_query' );
	    
	    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'frontpage'),
           'operator' => 'IN',
	    );
	    $query->set( 'tax_query', $tax_query );
    }

}
add_action( 'woocommerce_product_query', 'nb_custom_pre_get_posts_query' );