<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('getCategoryProductAndFilters')) {
	function getCategoryProductAndFilters($shortcodeAttributes) {
		$layout = $shortcodeAttributes['layout'] ?  $shortcodeAttributes['layout'] : 'dropdowns';
		$category_slug = $shortcodeAttributes['category'];

		$product_term_slugs = array($category_slug);
		$product_args = array(
			'post_status' => 'publish',
			'limit' => -1,
			'category' => $product_term_slugs,
			'orderby' => 'menu_order',
			'order' => 'ASC'
		);
		$products = wc_get_products($product_args);

		$productObject = array();
		$tagsObject = array();
		$materialsObject = array();
		$interfaceObject = array();

		foreach ( $products as $productItem ) {
			$productId = $productItem->get_id();

			$signMaterial = get_post_meta( $productId, 'product_material', true );
			$signColor = get_post_meta( $productId, 'product_color', true );

			$signMaterialTranslated = translate_materials_and_color($signMaterial);
			$signColorTranslated = translate_materials_and_color($signColor);

			// Filters
			$tags = wp_get_post_terms( $productId, 'product_tag' );

			if($signMaterial) {
				$materialNamePrefix = 'material-'.strtolower(sanitize_title($signMaterial));
				$productMaterialArray = array(
					"name" => $signMaterialTranslated,
					"slug" => $materialNamePrefix
				);
				if(!in_array($productMaterialArray, $materialsObject)) {
					array_push( $materialsObject, $productMaterialArray );
				}
			}
			
			// Tags
			if($tags) {
				foreach ( $tags as $tagsItem ) {
					$tagsItemArray = array(
						'id' => $tagsItem->term_id,
						'name' => $tagsItem->name,
						'slug' => $tagsItem->slug
					);
					if(!in_array($tagsItemArray, $tagsObject)) {
						array_push( $tagsObject, $tagsItemArray );
					}
				}
			}

			// Interfaces
			$interfaces = nb_get_product_interfaces($productId, false);
			if($interfaces) {
				foreach ( $interfaces as $interfaceItem ) {
					$interfaceItemArray = array(
						'name' => function_exists('get_interface_langString') ? get_interface_langString($interfaceItem) : $interfaceItem,
						'slug' => $interfaceItem
					);
					if(!in_array($interfaceItemArray, $interfaceObject)) {
						array_push( $interfaceObject, $interfaceItemArray );
					}
				}
			}
			
			if(function_exists('get_single_product_object')) {
				$productItemArray = get_single_product_object($productId);
			} else {
				$productItemArray = array();
			}

			array_push( $productObject, $productItemArray );
		}

		$mergedFilterOptions = array(
			"products" => $productObject,
			"filters" => array(
				"tags" => count($tagsObject) > 0 ? $tagsObject : array(),
				"materials" => count($materialsObject) > 0 ? $materialsObject : array(),
				"interfaces" => count($interfaceObject) > 0 ? $interfaceObject : array(),
				"layout" => $layout
			)
		);

		wp_reset_query();
		return $mergedFilterOptions;
	}
}

if(!function_exists('gb_product_categories_shortcode')):
add_shortcode( 'woocategories', 'gb_product_categories_shortcode' );
function gb_product_categories_shortcode( $atts ) {
	
	$shortcodeAttributes = shortcode_atts( array(
		'category' => 'frontpage',
		'title' => '',
		'layout' => 'dropdowns', 
	), $atts );

	$category_slug = $shortcodeAttributes['category'];
	$layout = $shortcodeAttributes['layout'] ?  $shortcodeAttributes['layout'] : 'dropdowns';
	$transientName = "gb_product_feed_".$shortcodeAttributes['category'];

	if($shortcodeAttributes['category']) {
		if ( false === ( $savedCategoryProducts = get_transient( $transientName ) ) ) {
			$savedCategoryProducts = getCategoryProductAndFilters($shortcodeAttributes);
			// Put the results in a transient. Expire after 12 hours.
			set_transient( $transientName, $savedCategoryProducts, 1 * HOUR_IN_SECONDS );
		}
		$mergedFilterOptions = get_transient( $transientName );
	}

	$output = '';
	$output .= '<section class="product-list__container product-list__container--'.$layout.'">';
	if( $shortcodeAttributes['title'] ) {
		$output .= '<h2 class="product-list__container--title">'.$shortcodeAttributes['title'].'</h2>';
	}
	if(count($mergedFilterOptions) > 0) {
		$output .= '<div id="productsapp" class="product_list__wrapper"></div>';
	} else {
		$output .= '<div>';
		$output .= 'Missing category.';
		$output .= '</div>';
	}
	$output .= '<script>';
	$output .= 'const filterOptions = '.json_encode($mergedFilterOptions).'';
	$output .= '</script>';
	$output .= '</section>';
	return $output;
}
endif;