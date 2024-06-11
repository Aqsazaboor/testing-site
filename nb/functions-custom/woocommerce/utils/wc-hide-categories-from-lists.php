<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Hide these categories from FE lists of categories
add_filter('get_the_terms', 'hide_categories_terms', 10, 3);
function hide_categories_terms($terms, $post_id, $taxonomy){

    // list of category slug to exclude, 
    $exclude = array('frontpage', 'checkout');

    if (!is_admin()) {
        foreach($terms as $key => $term){
            if($term->taxonomy == "product_cat"){
                if(in_array($term->slug, $exclude)) unset($terms[$key]);
            }
        }
    }

    return $terms;
}