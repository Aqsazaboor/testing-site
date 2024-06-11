<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('wc_site_settings_footer')):
function wc_site_settings_footer() {
	$upload_dir = wp_upload_dir();
	$site_url = get_site_url();
	$uploads_dir = $upload_dir['baseurl'];
	$category_id = null;

	// Not shop page
	$category = get_queried_object();

	// Shop page
	if( is_shop() && function_exists('only_frontend_category_products') ) {
		$frontpage_category = get_term_by( 'slug', "frontpage", 'product_cat' );
		$category_id = $frontpage_category->term_id;
	} elseif(!is_shop() && $category) {
		$category_id = $category->term_id;
	}

	$trust_icons = "";
	if(function_exists('nb_get_trusticons')) {
		$trust_icons = json_encode(nb_get_trusticons('array'));
	}

	$output = '<script>';
	$output .= 'const siteSettings = {"base_url": "'.$site_url.'", "uploads_dir": "'.$uploads_dir.'", "blog_id": "'.get_current_blog_id().'", "current_term_id": '.($category_id ? $category_id : 0).', "trust_icons" : ['.$trust_icons.']};';
	$output .= '</script>';
	echo $output;
}
add_action( 'wp_footer', 'wc_site_settings_footer', 10 );
endif;