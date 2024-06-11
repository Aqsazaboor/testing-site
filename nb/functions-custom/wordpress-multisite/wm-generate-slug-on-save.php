<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

// Slug should be
// product-title-material-WidthxHeight

function nb_update_slug( $data, $postarr ) {
    if ( ! in_array( $data['post_status'], array( 'draft', 'pending', 'auto-draft' ) ) ) {
	    
	    $post_id = $postarr['ID'];
	    
	    $product_width = get_post_meta( $post_id ,'product_width', true );
	    if( strLen($product_width) <= 0 ) {
		    $product_width = '';
	    }
	    
	    $product_height = get_post_meta( $post_id ,'product_height', true );
	    if( strLen($product_height) <= 0 ) {
		    $product_height = '';
	    }
	    
	    $product_color = get_post_meta( $post_id ,'product_color', true );
	    if( strLen($product_color) <= 0 ) {
		    $product_color = '';
	    }
	    
	    // Is product create special slug
	    
	    // Get width
	    // Get height
	    // Get material
	    // Get color
	    	    
        $data['post_name'] = sanitize_title( $data['post_title'] ) .'-'. sanitize_title( $product_color ) .'-'. $product_width.'x'.$product_height;
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'nb_update_slug', 99, 2 );