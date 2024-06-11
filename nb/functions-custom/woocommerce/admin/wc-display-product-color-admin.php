<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ---------------------------------------------------------
// Column to show color bullets for order products items
// ---------------------------------------------------------

/*
			'None' 		=> 'none',
			'Plastic' 	=> 'plastic',
			'Brass' 	=> 'brass',
			'Aluminum' 	=> 'aluminum',
			'Vinyl' 	=> 'vinyl',
			'Oak' 		=> 'oak',
			'Birch' 	=> 'birch',
			'Plexi' 	=> 'plexi',
*/

function get_first_letter_in_material( $material ){
	switch ($material) {
		case "plastic":
			return "P";
			break;
		case "brass":
			return "M";
			break;
		case "aluminum":
			return "A";
			break;
		case "vinyl":
			return "V";
			break;
		case "oak":
			return "E";
			break;
		case "birch":
			return "B";
			break;
		case "plexi":
			return "PL";
			break;
		default:
			return "";
	}
}


add_filter( 'manage_edit-shop_order_columns', 'shop_order_columns' );
function shop_order_columns( $columns ){
    $new_columns = (is_array($columns)) ? $columns : array();
    $new_columns['material'] = 'Material/färg';
    return $new_columns;
}

add_action( 'manage_shop_order_posts_custom_column', 'shop_order_posts_custom_column' );
function shop_order_posts_custom_column( $column ){
    global $post, $the_order;
	
    if ( empty( $the_order ) || $the_order->get_id() != $post->ID ) {
        $the_order = wc_get_order( $post->ID );
    }
    
    if ( $column == 'material' ) {
		$hi = $the_order->get_items();
		
		foreach ( $hi as $item_id => $item ) {
			if( isset(get_post_meta($item['product_id'])['product_color'][0]) ) {
				$productcolor = get_post_meta($item['product_id'])['product_color'][0];
				$productmaterial = get_post_meta($item['product_id'])['product_material'][0];
				$productletter = get_first_letter_in_material(sanitize_title($productmaterial));
				$colorname = sanitize_title($productcolor);
				echo '<div class="product-color-badge" data-product-color="'.$colorname.'" title="'.$item['name'].'"><span data-product-name="'.$item['name'].'">'.$productletter.'</span></div>';
				
			} else {
				echo '<div class="product-color-badge" data-product-color="na">?<span data-product-name="'.$item['name'].'"></span></div>';
			}
		}
    }
}
