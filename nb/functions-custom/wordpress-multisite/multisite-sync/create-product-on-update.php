<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

// Creates a new product everytime you save...
/*
add_action( 'woocommerce_update_product', 'rudr_crosspost_product', 20, 2 );

function rudr_crosspost_product( $product_id, $product ) {

	remove_action( 'woocommerce_update_product', 'rudr_crosspost_product', 20, 2 );
	
	switch_to_blog( 2 );
	
	$new_product = new WC_Product_Simple();
	$new_product->set_name( $product->get_name() );
	$new_product->set_regular_price( floatval( $product->get_regular_price() ) );
	$new_product->save();

	restore_current_blog();

}
*/

// Create internal title, and external title for products!

add_action( 'woocommerce_update_product', 'nb_crosspost_product', 20, 2 );

function nb_crosspost_product( $product_id, $product ) {

	// remove_action( 'woocommerce_update_product', 'nb_crosspost_product', 20, 2 );
	
	// $current_blog = get_current_blog_id();
	
	// if( $current_blog == 1) {
	// 	//$current_blog = get_current_blog_id();
	// 	//$sub_blog_id = 2;

		
	// 	// Blog 1 = skyltdax - se
	// 	// Blog 2 = ovikilpi - fi
	// 	// Blog 3 = 24signs - uk
	// 	// Blog 4 = deurbordje24 - nl
	// 	// Blog 5 = turschilder - de
	// 	// Blog 6 = 24skilte - dk
		
	// 	// Create loop to create the product on all blogs
		
	// 	// Avoid
	// 	// Saving product on the blog 2 creates a copy on the blog 2
				
	// 	// let's try to get ID of the same product on Site 2
	// 	$site_2_product_id = $product->get_meta( 'site_2_product_id', true );
		
	// 	// Meta data
	// 	$product_stock_status = $product->get_stock_status();
		
	// 	$product_width = get_post_meta( $product_id ,'product_width', true );
	// 	$product_height = get_post_meta( $product_id ,'product_height', true );
		
	// 	$product_text_rows = get_post_meta( $product_id ,'text_rows', true );
		
	// 	$product_color = get_post_meta( $product_id ,'product_color', true );
	// 	$product_material = get_post_meta( $product_id ,'product_material', true );
		
	// 	$product_designer_type = get_post_meta( $product_id ,'designer_type', true );
	// 	$product_text_color_shadow = get_post_meta( $product_id ,'text_color_shadow', true );
	// 	$product_text_color = get_post_meta( $product_id ,'text_color', true );
		
	// 	$product_topoffset = get_post_meta( $product_id ,'topoffset', true );
	// 	$product_has_holes = get_post_meta( $product_id ,'has_holes', true );
	// 	$product_only_laser = get_post_meta( $product_id ,'only_laser', true ) ? get_post_meta( $product_id ,'only_laser', true ) : '';

	// 	$product_interface_militaryclip = get_post_meta( $product_id ,'sign_interface_militaryclip', true ) ? get_post_meta( $product_id ,'sign_interface_militaryclip', true ) : '';
	// 	$product_interface_safetypin = get_post_meta( $product_id ,'sign_interface_safetypin', true ) ? get_post_meta( $product_id ,'sign_interface_safetypin', true ) : '';
	// 	$product_interface_metalmagnet = get_post_meta( $product_id ,'sign_interface_metalmagnet', true ) ? get_post_meta( $product_id ,'sign_interface_metalmagnet', true ) : '';
	// 	$product_interface_plasticmagnet = get_post_meta( $product_id ,'sign_interface_plasticmagnet', true ) ? get_post_meta( $product_id ,'sign_interface_plasticmagnet', true ) : '';
	// 	$product_interface_keyring = get_post_meta( $product_id ,'sign_interface_keyring', true ) ? get_post_meta( $product_id ,'sign_interface_keyring', true ) : '';
	// 	$product_interface_screw = get_post_meta( $product_id ,'sign_interface_screw', true ) ? get_post_meta( $product_id ,'sign_interface_screw', true ) : '';
		
	// 	// $product_sku = get_post_meta( $post->ID, '_sku', true );
	// 	$product_sku = get_post_meta( $product_id ,'_sku', true );
		
	// 	// Finland
	// 	// switch to Site 2
	// 	//if( $current_blog != $sub_blog_id ) {
	// 	#if( $current_blog != 1 ) {
			
	// 	// Currently this function keeps the blog 1 product id on a meta field
	// 	// But that's not enouch, cause it actually needs more than 1 id saved to
	// 	// not create dupes...
		
	// 	foreach (get_sites() as $blog) {
			
	// 		switch_to_blog($blog->blog_id);
				
	// 			// Do not clone for first blog (Sweden)
	// 			if( $blog->blog_id != 1) {
					
	// 				// Save array to original product
	// 				// Update array when the product is created the first time
	// 				// Check the array for dupes?
					
	// 				if( $site_2_product_id ) {
	// 					$site_2_product = wc_get_product( $site_2_product_id );
	// 				}
					
	// 				if( !$site_2_product ) {
	// 					$site_2_product = new WC_Product_Simple();
	// 				}
					
	// 				// So, save blog 1 product ID to new product, and just update META
	// 				// if product already exits?
					
	// 				// update the info
	// 				$site_2_product->set_name( $product->get_name() );
					
	// 				$site_2_product->add_meta_data( 'product_width', $product_width, true );
	// 				$site_2_product->add_meta_data( 'product_height', $product_height, true );
					
	// 				$site_2_product->add_meta_data( 'text_rows', $product_text_rows, true );
					
	// 				$site_2_product->add_meta_data( 'product_color', $product_color, true );
	// 				$site_2_product->add_meta_data( 'product_material', $product_material, true );
					
	// 				$site_2_product->add_meta_data( 'designer_type', $product_designer_type, true );
	// 				$site_2_product->add_meta_data( 'text_color_shadow', $product_text_color_shadow, true );
	// 				$site_2_product->add_meta_data( 'text_color', $product_text_color, true );
							
	// 				$site_2_product->add_meta_data( 'topoffset', $product_topoffset, true );
	// 				$site_2_product->add_meta_data( 'has_holes', $product_has_holes, true );
	// 				$site_2_product->add_meta_data( 'only_laser', $product_only_laser, true );
					
	// 				$site_2_product->add_meta_data( 'sign_interface_militaryclip', $product_interface_militaryclip, true );
	// 				$site_2_product->add_meta_data( 'sign_interface_safetypin', $product_interface_safetypin, true );
	// 				$site_2_product->add_meta_data( 'sign_interface_metalmagnet', $product_interface_metalmagnet, true );
	// 				$site_2_product->add_meta_data( 'sign_interface_plasticmagnet', $product_interface_plasticmagnet, true );
	// 				$site_2_product->add_meta_data( 'sign_interface_keyring', $product_interface_keyring, true );
	// 				$site_2_product->add_meta_data( 'sign_interface_screw', $product_interface_screw, true );
					
	// 				$site_2_product->add_meta_data( '_stock_status', $product_stock_status, true );
												
	// 				// Update meta
	// 				$site_2_product->save();
					
	// 			}
				
	// 		restore_current_blog();
	// 	}
		
	// 	# $product->add_meta_data( 'site_2_product_id', $site_2_product->get_id(), true );
	// 	$product->save_meta_data();
	// }
	
		/*
		switch_to_blog( $sub_blog_id );
	
		if( $site_2_product_id ) {
			$site_2_product = wc_get_product( $site_2_product_id );
		}
	
		if( ! $site_2_product ) {
			$site_2_product = new WC_Product_Simple();
		}
		
		// product_material
		// product_color
		// product_width
		// product_height
		
		// update the info
		$site_2_product->set_name( $product->get_name() );
		
		// Do not change the price!
		// $site_2_product->set_regular_price( floatval( $product->get_regular_price() ) );
		
		$site_2_product->add_meta_data( 'product_width', $product_width, true );
		$site_2_product->add_meta_data( 'product_height', $product_height, true );
		
		$site_2_product->add_meta_data( 'text_rows', $product_text_rows, true );
		
		$site_2_product->add_meta_data( 'product_color', $product_color, true );
		$site_2_product->add_meta_data( 'product_material', $product_material, true );
		
		$site_2_product->add_meta_data( 'designer_type', $product_designer_type, true );
		$site_2_product->add_meta_data( 'text_color_shadow', $product_text_color_shadow, true );
		$site_2_product->add_meta_data( 'text_color', $product_text_color, true );
				
		$site_2_product->add_meta_data( 'topoffset', $product_topoffset, true );
		$site_2_product->add_meta_data( 'has_holes', $product_has_holes, true );
		$site_2_product->add_meta_data( 'only_laser', $product_only_laser, true );
		
		$site_2_product->add_meta_data( 'sign_interface_militaryclip', $product_interface_militaryclip, true );
		$site_2_product->add_meta_data( 'sign_interface_safetypin', $product_interface_safetypin, true );
		$site_2_product->add_meta_data( 'sign_interface_metalmagnet', $product_interface_metalmagnet, true );
		$site_2_product->add_meta_data( 'sign_interface_plasticmagnet', $product_interface_plasticmagnet, true );
		$site_2_product->add_meta_data( 'sign_interface_keyring', $product_interface_keyring, true );
		$site_2_product->add_meta_data( 'sign_interface_screw', $product_interface_screw, true );
		
		$site_2_product->add_meta_data( '_stock_status', $product_stock_status, true );
				
		// Update meta
		$site_2_product->save();
	
		restore_current_blog();
	
		$product->add_meta_data( 'site_2_product_id', $site_2_product->get_id(), true );
		$product->save_meta_data();
*/
		
	#}
}