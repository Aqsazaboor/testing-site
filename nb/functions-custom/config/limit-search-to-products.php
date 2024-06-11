<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

//Only show products in the front-end search results
function nb_search_filter_pages($query) {
	if ( !is_admin() && $query->is_search) {
		$query->set('post_type', 'product');
		$query->set( 'wc_query', 'product_query' );
	}
	return $query;
}
add_filter('pre_get_posts','nb_search_filter_pages');