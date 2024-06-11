<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('gb_category_list_shortcode')):
add_shortcode( 'woocategorylist', 'gb_category_list_shortcode' );
function gb_category_list_shortcode( $atts ) {
	$shortcodeAttributes = shortcode_atts( array(
		'category' => 'frontpage',
	), $atts );

	$categoryList = '';

	if($shortcodeAttributes['category']) {
		$category = get_term_by( 'slug', $shortcodeAttributes['category'], 'product_cat' );

		if($category) {
			$parent_term_id = $category->term_id;
			$taxonomy_name = 'product_cat'; // e.g. 'category'
			$termChildren = get_term_children( $parent_term_id, $taxonomy_name );

			if ( !empty($termChildren) ) {
				foreach ($termChildren as $termchild) {
					$term = get_term_by( 'id', $termchild, $taxonomy_name );

					// Get the ID of a given category
					$category_id = get_cat_ID( 'Category Name' );

					// Get the URL of this category
					$category_link = get_category_link( $termchild );
					$categoryList .= '<li class="category column is-one-quarter-tablet is-half-mobile">';
					$categoryList .= '<a href="'.$category_link.'">';
					$categoryList .= $term->name;
					$categoryList .= '</a>';
					$categoryList .= '</li>';
				}
			}
		}
	}


	$output = '';
	if($categoryList) {
		$output .= '<div class="columns category_list is-multiline">';
		$output .= $categoryList;
		$output .= '</div>';
	} else {
		$output .= '<div>';
		$output .= 'Missing categories.';
		$output .= '</div>';
	}

	return $output;
}
endif;