<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// https://docs.woocommerce.com/document/editing-product-data-tabs/

add_filter( 'the_content', 'customizing_woocommerce_description' );
function customizing_woocommerce_description( $content ) {

    // Only for single product pages (woocommerce)
    if ( is_product() ) {
	    
	    $product_id = get_the_ID();
	    		
		$product_width = get_post_meta( $product_id, 'product_width' );
		$product_height = get_post_meta( $product_id, 'product_height' );
		
		$product_interface_keyring = get_post_meta( $product_id, 'sign_interface_keyring' );
		$product_interface_plasticmagnet = get_post_meta( $product_id, 'sign_interface_plasticmagnet' );
		$product_interface_metalmagnet = get_post_meta( $product_id, 'sign_interface_metalmagnet' );
		$product_interface_tape = get_post_meta( $product_id, 'sign_interface_tape' );
		$product_interface_militaryclip = get_post_meta( $product_id, 'sign_interface_militaryclip' );
		$product_interface_safetypin = get_post_meta( $product_id, 'sign_interface_safetypin' );
		$product_interface_screw = get_post_meta( $product_id, 'sign_interface_screw' );

        // The custom content
        $custom_content = '<p>'.pll__('Produktinformation').'<br />';
		
		if( $product_width && $product_height ) {
			$custom_content .= pll__('Storlek') . ': '.$product_width[0] . 'x' . $product_height[0] . ' mm<br />';
		}
		
		if( isset($product_interface_keyring) || isset($product_interface_tape) || isset($product_interface_plasticmagnet) || isset($product_interface_metalmagnet) || isset($product_interface_militaryclip) ) {
			$custom_content .= pll__('Fästtyp') . ': ';
			$custom_content .= $product_interface_keyring ? '<span class="interface-tag">' . pll__('Nyckelring') . '</span>' : '';
			$custom_content .= $product_interface_plasticmagnet ? '<span class="interface-tag">' . pll__('Magnet i plast') . '</span>' : '';
			$custom_content .= $product_interface_metalmagnet ? '<span class="interface-tag">' . pll__('Magnet i metall') . '</span>' : '';
			$custom_content .= $product_interface_tape ? '<span class="interface-tag">' . pll__('Dubbelhäftande tejp') . '</span>' : '';
			$custom_content .= $product_interface_militaryclip ? '<span class="interface-tag">' . pll__('Militärklämma') . '</span>' : '';
			$custom_content .= $product_interface_safetypin ? '<span class="interface-tag">' . pll__('Säkerhetsnål') . '</span>' : '';
			$custom_content .= $product_interface_screw ? '<span class="interface-tag">' . pll__('Skruv') . '</span>' : '';
		}

        // Inserting the custom content at the end
        $content .= $custom_content;
    }
    return $content;
}

add_filter( 'woocommerce_product_tabs', 'force_description_product_tabs' );
function force_description_product_tabs( $tabs ) {

    $tabs['description'] = array(
        'title'    => __( 'Description', 'woocommerce' ),
        'priority' => 10,
        'callback' => 'woocommerce_product_description_tab',
    );

    return $tabs;
}

/**
 * Remove product data tabs
 */

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] ); // Remove the reviews tab
    return $tabs;
}