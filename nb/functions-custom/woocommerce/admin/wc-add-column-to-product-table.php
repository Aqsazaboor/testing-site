<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter('manage_product_posts_columns', 'nb_product_table_head');
function nb_product_table_head( $columns ) {
    $columns['product_size'] = __('Storlek');
    return $columns;

}

add_action( 'manage_product_posts_custom_column', 'nb_product_table_content', 10, 2 );
function nb_product_table_content( $column_name, $post_id ) {
	$product_width = get_post_meta( $post_id, 'product_width', true );
	$product_height = get_post_meta( $post_id, 'product_height', true );
	
	if( $column_name == 'product_size' ) {
	    if( $product_width && $product_height ) {
	        echo $product_width.'x'.$product_height;
	    }	
	}
}