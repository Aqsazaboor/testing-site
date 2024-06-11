<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// The filter callback function.
function nb_custom_thumbnail_minicart( $cartData ) {
    // (maybe) modify $string.
    return '<div>hello!</div>';
}
#add_filter( 'woocommerce_cart_item_thumbnail', 'nb_custom_thumbnail_minicart', 10, 3 );

/*

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// -----------------------------------------------------
// This function replaces the order image with our
// saved custom image via order meta
// -----------------------------------------------------

function custom_new_product_image( $_product_img, $cart_item, $cart_item_key ) {
	// Only show custom image if this is set...
	// Else display the product image
	
	echo '<div class="checkout-image-merge">';
	
	if(isset( $cart_item['oi'] )) {
		$imagename = $cart_item['oi'];
		$imagepath = $imagename;
		#$imagepath = get_stylesheet_directory_uri() . '/generator/savedsigns/image'.$imagename.'.png';
		$customorderimage = '<div class="checkout-generated-image"><img src="'.$imagepath.'" /></div>';
		echo $customorderimage;
	} else {
		$customorderimage = $_product_img;
	}
	
	##return $customorderimage;
	echo $_product_img;
	
	echo '</div>';
    
}

add_filter( 'woocommerce_cart_item_thumbnail', 'custom_new_product_image', 10, 3 );

*/