<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_hide_certain_product_terms')):
add_filter( 'get_terms', 'nb_hide_certain_product_terms', 10, 3 );
function nb_hide_certain_product_terms( $terms, $taxonomies, $args ) {
    $new_terms = array();

    // && !is_main_query()

    if ( in_array( 'product_cat', $taxonomies ) && !is_admin() && !is_main_query() ) {
        foreach( $terms as $key => $term ) {
            if ( !in_array( $term->slug, array( 'frontpage', 'checkout', 'uncategorized', 'okategoriserad', 'out-of-stock' ) ) ) {
                $new_terms[] = $term;
            }
        }
        $terms = $new_terms;
    }
    return $terms;
}
endif;