<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists("wc_add_offers_after_cart")) {
    function wc_add_offers_after_cart() {
		$args = array(
			'product_cat' => 'Checkout',
			'posts_per_page' => 99,
			// 'orderby' => 'rand'
		);
		$loop = new WP_Query($args);

		$output = '<div class="cart__offers">';
		
		// Offer text
		if( function_exists('get_field') && get_field('cart_upsell_text','options') ) {
			$output .= '<div class="cart__offers--content">';
			$output .= '<p>'.get_field('cart_upsell_text','options').'</p>';
			$output .= '</div>';
		}
		
		// Products list
		$output .= '<div class="cart__offers--products">';
		$output .= '<div>';
		while ($loop->have_posts()) : $loop->the_post();
			global $product;
			$product_id = $loop->post->ID;
			$product_width = get_post_meta( $product_id, 'product_width' ) ? get_post_meta( $product_id, 'product_width' )[0] : '';
			$product_height = get_post_meta( $product_id, 'product_height' ) ? get_post_meta( $product_id, 'product_height' )[0] : '';
			$output .= '<div class="product">';
			$output .= '<a href="#" class="cart-offer" data-pid="'.$product_id.'">';
				$output .= '<div class="product-image product-id-'.$product_id.'">';

				if (has_post_thumbnail($product_id)) {
					$output .= get_the_post_thumbnail($product_id, 'shop_catalog');
				} else {
					$output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
				}

				$output .= '</div>';

				$output .= '<div class="product-description">';
					$output .= '<div class="product-name">'.get_the_title().'</div>';
					if($product_width != "" && $product_height != "") {
						$output .= '<div class="product-size">'.$product_width.'x'.$product_height.' mm</div>';
					}
					$output .= '<span class="price">'.$product->get_price_html().'</span>';
				$output .= '</div>';

				$output .= '<div class="add-to-cart">'.pll__('Lägg i varukorgen').'</div>';
			$output .= '</a>';
			$output .= '</div>';
		endwhile;
		wp_reset_query();
			$output .= '</div>';
			
		$output .= '</div>';
		// Products list end
		
		$output .= '</div>';

        echo $output;
    }    
    add_action( 'woocommerce_after_cart_contents', 'wc_add_offers_after_cart', 10 );
}