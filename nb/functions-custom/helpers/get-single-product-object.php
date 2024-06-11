<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if( !function_exists('get_single_product_object') ):
function get_single_product_object($productId) {
	if(!$productId || !function_exists('wc_get_product')) {
		echo 'Woo not installed or missing product id in get_single_product_object().';
	}
	$productItem = wc_get_product( $productId );

	$permalink = $productItem->get_permalink();
	$productName = $productItem->get_title();

	$signHeight = get_post_meta( $productId, 'product_height', true );
	$signWidth = get_post_meta( $productId, 'product_width', true );
	$signMaterial = get_post_meta( $productId, 'product_material', true );
	$signColor = get_post_meta( $productId, 'product_color', true );
	$signDesignerOption = get_post_meta( $productId, 'designer_type', true );

	// Translate color and materials
	if(function_exists('translate_materials_and_color')) {
		$signMaterialTranslated = translate_materials_and_color($signMaterial);
		$signColor = translate_materials_and_color($signColor);
	}

	// Image
	$attachmentId = get_post_thumbnail_id( $productId );
	$imgSrc = wp_get_attachment_image_url( $attachmentId, 'medium' );
	$imgSrcset = wp_get_attachment_image_srcset( $attachmentId, 'medium' );
	$imageAlt = get_post_meta($attachmentId, '_wp_attachment_image_alt', TRUE);

	$productTermsArray = array();
	$productMaterialArray = array();

	// Filters
	$filtersString = '';
	$tags = wp_get_post_terms( $productId, 'product_tag' );

	if(function_exists('gb_get_tags_class') && $tags) {
		$filtersString .= gb_get_tags_class($tags);
	}
	
	if($signMaterial) {
		$filtersString .= ' material-'. strtolower(sanitize_title($signMaterial)) . ' ' . strtolower(sanitize_title($signMaterialTranslated));
	}

	// Interfaces
	$interfaces = nb_get_product_interfaces($productId, false);
	if(function_exists('nb_get_product_interfaces')) {
		$interfaceFilterOptions = gb_get_interface_class($interfaces);
		$filtersString .= ' '. strtolower($interfaceFilterOptions);
	}

	// Sale badge
	// Slut i lager
	$stockStatus = get_post_meta( $productId, '_stock_status', true );

	// Sale price
	// $product_price = get_post_meta( $product_id, '_regular_price', true);
	
	$salePrice = '';
	if( get_post_meta( $productId, '_sale_price', true) ) {
		$salePrice = get_post_meta( $productId, '_sale_price', true);
	}

	// Setup array
	$productObj = array(
		"id" => $productId,
		"name" => $productName,
		"width" => $signWidth,
		"height" => $signHeight,
		"specs" => nb_get_product_size_material($productId),
		"pricehtml" => $productItem->get_price_html(),
		"material" => $signMaterial,
		"color" => $signColor,
		"url" => $permalink,
		"imgsrc" => $imgSrc,
		"imgsrcset" => $imgSrcset,
		"imagealt" => $imageAlt,
		"filters" => $filtersString,
		"designer" => $signDesignerOption,
		"saleprice" => $salePrice,
		"stock" => $stockStatus
	);

	return $productObj;
}
endif;