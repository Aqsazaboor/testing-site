<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function nb_remove_shop_manager_capabilities() {   
  #remove_cap( 'shop_manager', 'list_users' );
	
	add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );
	add_filter('woocommerce_show_marketplace_suggestions', function ($show) { return 'no'; });
  
  $shop_manager = get_role( 'shop_manager' );
  
  if( $shop_manager !== null) {
    $caps = array (
        'edit_theme_options',
        'import',
        'export',
        'moderate_comments',
        'manage_categories',
        'manage_links',
        
        // Misc
        'view_woocommerce_reports',
        'moderate_comments',
        
        // Coupons
        'edit_shop_coupon',
		'read_shop_coupon',
		'delete_shop_coupon',
		'edit_shop_coupons',
		'edit_others_shop_coupons',
		'publish_shop_coupons',
		'read_private_shop_coupons',
		'delete_shop_coupons',
		'delete_private_shop_coupons',
		'delete_published_shop_coupons',
		'delete_others_shop_coupons',
		'edit_private_shop_coupons',
        'edit_published_shop_coupons',
        'edit_shop_coupon_terms',
        'delete_shop_coupon_terms',
        'assign_shop_coupon_terms',
    );

    foreach ( $caps as $cap ) {
        $shop_manager->remove_cap( $cap );
    }	  
  }

  
}
add_action( 'admin_init', 'nb_remove_shop_manager_capabilities' );

/*
{
	["name"] => string(12)
	"shop_manager" ["capabilities"] => array(92) {
		["level_9"] => bool(true)
		["level_8"] => bool(true)
		["level_7"] => bool(true)
		["level_6"] => bool(true)
		["level_5"] => bool(true)
		["level_4"] => bool(true)
		["level_3"] => bool(true)
		["level_2"] => bool(true)
		["level_1"] => bool(true)
		["level_0"] => bool(true)
		["read"] => bool(true)
		
		["read_private_pages"] => bool(true)
		["read_private_posts"] => bool(true)
		
		["edit_posts"] => bool(true)
		["edit_pages"] => bool(true)
		["edit_published_posts"] => bool(true)
		["edit_published_pages"] => bool(true)
		["edit_private_pages"] => bool(true)
		["edit_private_posts"] => bool(true)
		["edit_others_posts"] => bool(true)
		["edit_others_pages"] => bool(true)
		
		["publish_posts"] => bool(true)
		["publish_pages"] => bool(true)
		["delete_posts"] => bool(true)
		["delete_pages"] => bool(true)
		["delete_private_pages"] => bool(true)
		["delete_private_posts"] => bool(true)
		["delete_published_pages"] => bool(true)
		["delete_published_posts"] => bool(true)
		["delete_others_posts"] => bool(true)
		["delete_others_pages"] => bool(true)
		["manage_categories"] => bool(true)
		["manage_links"] => bool(true)
		["moderate_comments"] => bool(true)
		["upload_files"] => bool(true)
		["export"] => bool(true)
		["import"] => bool(true)
		["list_users"] => bool(true)
		["edit_theme_options"] => bool(true)
		
		
		["manage_woocommerce"] => bool(true)
		
		
		["view_woocommerce_reports"] => bool(true)
		["edit_product"] => bool(true)
		["read_product"] => bool(true)
		["delete_product"] => bool(true)
		["edit_products"] => bool(true)
		["edit_others_products"] => bool(true)
		["publish_products"] => bool(true)
		["read_private_products"] => bool(true)
		["delete_products"] => bool(true)
		["delete_private_products"] => bool(true)
		["delete_published_products"] => bool(true)
		["delete_others_products"] => bool(true)
		["edit_private_products"] => bool(true)
		["edit_published_products"] => bool(true)
		["manage_product_terms"] => bool(true)
		["edit_product_terms"] => bool(true)
		["delete_product_terms"] => bool(true)
		["assign_product_terms"] => bool(true)
		
		["edit_shop_order"] => bool(true)
		["read_shop_order"] => bool(true)
		["delete_shop_order"] => bool(true)
		["edit_shop_orders"] => bool(true)
		["edit_others_shop_orders"] => bool(true)
		["publish_shop_orders"] => bool(true)
		["read_private_shop_orders"] => bool(true)
		["delete_shop_orders"] => bool(true)
		["delete_private_shop_orders"] => bool(true)
		["delete_published_shop_orders"] => bool(true)
		["delete_others_shop_orders"] => bool(true)
		["edit_private_shop_orders"] => bool(true)
		["edit_published_shop_orders"] => bool(true)
		["manage_shop_order_terms"] => bool(true)
		
		
		["edit_shop_order_terms"] => bool(true)
		["delete_shop_order_terms"] => bool(true)
		["assign_shop_order_terms"] => bool(true)
		["edit_shop_coupon"] => bool(true)
		["read_shop_coupon"] => bool(true)
		["delete_shop_coupon"] => bool(true)
		["edit_shop_coupons"] => bool(true)
		["edit_others_shop_coupons"] => bool(true)
		["publish_shop_coupons"] => bool(true)
		["read_private_shop_coupons"] => bool(true)
		["delete_shop_coupons"] => bool(true)
		["delete_private_shop_coupons"] => bool(true)
		["delete_published_shop_coupons"] => bool(true)
		["delete_others_shop_coupons"] => bool(true)
		["edit_private_shop_coupons"] => bool(true)
		["edit_published_shop_coupons"] => bool(true)
		["manage_shop_coupon_terms"] => bool(true)
		["edit_shop_coupon_terms"] => bool(true)
		["delete_shop_coupon_terms"] => bool(true)
		["assign_shop_coupon_terms"] => bool(true)
	}
}

*/