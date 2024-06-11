<?php

/*
font - defines the font properties for the text
fillText(text,x,y) - draws "filled" text on the canvas
strokeText(text,x,y) - draws text on the canvas (no fill)
*/
// http://www.ckollars.org/canvas-text-centering.html
// https://www.w3schools.com/tags/canvas_textalign.asp

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

class VueEditor {
	
	public function __construct() {
		// Code called for time you use the class
	}
		
	// ------------------------------------------
	// Icon handler
	// ------------------------------------------
	public function iconHandler() {
		#$dir = get_stylesheet_directory().'/assets/img/vueeditor-icons/';
		#$url = get_stylesheet_directory_uri().'/assets/img/vueeditor-icons/';
		#$dir = "./wp-content/themes/nb/assets/img/vueeditor-icons";
		
		$dir = get_stylesheet_directory().'/assets/img/vueeditor-icons';
		
		$i = 0;
		$list = array();
		
		if(is_dir($dir)){
		    if($dh = opendir($dir)){
		        while(($file = readdir($dh)) != false){
					
		            if($file == "." or $file == ".."){
		                //...
		            } else { //create object with two fields
						$list3 = array(
							'id' => $i,
							'file' => $file,
							'url' => get_stylesheet_directory_uri().'/assets/img/vueeditor-icons/'.$file
						);
						array_push($list, $list3);
		            }
		            $i++;
		        }
		    }
		
		    $return_array = array('files'=> $list);
		}
		
		return $return_array;
	}
	
	public function iconArray() {
		$assets = $this->iconHandler()['files'];
		$output = '{';
		$icon_count = count( (array)$assets );
		$index = 0;
		foreach( $assets as $key => $item ) {
			$url = $item['url'];
			$output .= $item['id'].' : { "id" : '.$item['id'].', "file" : "'.$item['file'].'", "url" : "'.$url.'" }';
			if($icon_count != $index) {
				$output .= ',';
			}
			$index++;
		}
		$output .= '}';
		return $output;
	}
	
	public function alldata() {
		$base_extra_price = 0;
		$dir = get_stylesheet_directory_uri().'/assets/';
		
		// ---------------------------------------------
		// Text sizes
		// ---------------------------------------------
		if( function_exists('editor_text_size') ) {
			$sizes = editor_text_size();
		} else {
			$sizes = '';
		}		
		
		// ---------------------------------------------
		// Fonts
		// ---------------------------------------------
		if( function_exists('editor_fonts') ) {
			$fonts = JSON_encode(editor_fonts());
		} else {
			$fonts = '';
		}
		
		// Interfaces
		// Todo get translations in		
		$interfaces_dir = $dir.'/editor-images/';
		$interfaces_obj = '';
		
		// Get ACF fields for interfaces		
		global $woocommerce;
		
		// Currency symbol
		$currency = 'kr';
		if( class_exists( 'WooCommerce' ) && function_exists('get_woocommerce_currency_symbol') ) {
			$currency = nb_get_woocommerce_currency_symbol();
		}
		
		// Woo cart url
		$wooCommerceCartPage = '';
		if( class_exists( 'WooCommerce' ) && function_exists('wc_get_cart_url') ) {
			$wooCommerceCartPage = wc_get_cart_url();
		}
		
		// Prices for extras
		$bold_text_price = 0;
		$large_text_price = 0;
		$extra_line_price = 0;

		if( function_exists('get_field') && get_field('price_for_bold_text','options') && get_field('price_for_large_text','options') && get_field('price_for_extra_text_line','options') ) {
			$bold_text_price = get_field('price_for_bold_text','options');
			$large_text_price = get_field('price_for_large_text','options');
			$extra_line_price = get_field('price_for_extra_text_line','options');
		}

		// Editor Settings, get_field, Feature Toggle in WP
		$engraving_options = (function_exists('get_field') && get_field('engraving_options','options') === true) ? get_field('engraving_options','options') : false;
		$visual_font_selector = (function_exists('get_field') && get_field('visual_font_selector','options') === true) ? get_field('visual_font_selector','options') : false;

		$settingsArray = array(
			"engraving_options" => $engraving_options,
			"visual_font_selector" => $visual_font_selector,
			"fonts" => json_decode($fonts),
			"textsizes" => json_decode($sizes),
			"boldextraprice" => $bold_text_price,
			"largeextraprice" => $large_text_price,
			"rowextraprice" => $extra_line_price,
			"currency" => $currency,
			"sitecurrency" => get_option('woocommerce_currency'),
			"carturl" => $wooCommerceCartPage,
			"termspage" => get_permalink( wc_terms_and_conditions_page_id() ),
		);
		$data = 'const settings = '.json_encode($settingsArray).';';
		
		return $data;
	}
	
	public function signobj($id) {
		$_product = wc_get_product( $id );
		
		// This works for the attributes
		// var_dump( json_encode(get_post_meta( $id, '_product_attributes' )) );

		// --------------------------------------------------------
		// Setup
		// --------------------------------------------------------
		$product_id = $id;
		$attachment = null;
		$variant_image_path = null;
		$editor_image_path = null;

		// No extra fee
		// designer_type = 0 ? It's a off the shelf product
		// designer_type = 1 ? It's plastic
		// designer_type = 2 ? It's a brass sign
		$product_designer = get_post_meta( $product_id, 'designer_type') ? get_post_meta( $product_id, 'designer_type')[0] : 0;
		$path = get_stylesheet_directory();
		
		// ------------------------------------------------
		// Output current sign
		// ------------------------------------------------
		$current_sign_obj = '';

		$product_title = get_the_title();
		$product_width = get_post_meta( $product_id, 'product_width') ? get_post_meta( $product_id, 'product_width') : 0;
		$product_height = get_post_meta( $product_id, 'product_height') ? get_post_meta( $product_id, 'product_height') : 0;
		$variant_topoffset = get_post_meta( $product_id, 'topoffset') ? get_post_meta( $product_id, 'topoffset') : 0;
		$product_variant_hasicon = 'false';
		$product_variant_icon_default = 0;
		
		$product_desc = '';
		$sale_price = '';
		$product_color = '';
		
		// --------------------------------------------
		// Image
		// --------------------------------------------
		if ( has_post_thumbnail( $product_id ) ) {
			$attachment_ids[0] = get_post_thumbnail_id( $product_id );
			$attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );
			$variant_image_path = $attachment ? $attachment[0] : '';
			
			$attachment_width = isset($attachment[1]) ? $attachment[1] : null;
			$attachment_height = isset($attachment[2]) ? $attachment[1] : null;
		}
		
		if(function_exists('get_field')) {
			$editor_image_data = get_field('editor_image', $product_id);
			if( $editor_image_data ) {
				$attachment_id = $editor_image_data['ID'];
				$attachment = wp_get_attachment_image_src($attachment_id, 'full' );
				$editor_image_url = isset($attachment) ? $attachment[0] : '';			
				$attachment_width = isset($editor_image_data['width']) ? $editor_image_data['width'] : null;
				$attachment_height = isset($editor_image_data['height']) ? $editor_image_data['height'] : null;
			}
		}
		
		if($product_variant_hasicon) {
			$product_variant_icon_default = 'e025';
		}
		
		$sign_interface = get_post_meta( $product_id, 'sign_interface');
		
		// --------------------------------------------
		// Misc
		// --------------------------------------------
		$product_text_color = get_post_meta( $product_id, 'text_color');
		$variant_text_color = count($product_text_color) < 1 ? '#0000FF' : $product_text_color[0];
		$product_text_color_shadow = get_post_meta( $product_id, 'text_color_shadow');
		$variant_text_color_shadow = count($product_text_color_shadow) < 1 ? '' : $product_text_color_shadow[0];
		$variant_leftoffset = get_post_meta( $product_id, 'leftoffset');
		$variant_rightoffset = get_post_meta( $product_id, 'rightoffset');
		
		$product_description = get_post( $product_id )->post_content;
		
		// --------------------------------------------
		// Price
		// --------------------------------------------
		
		$product_price = get_post_meta( $product_id, '_regular_price', true);
		
		if( get_post_meta( $product_id, '_sale_price', true) ) {
			$sale_price = get_post_meta( $product_id, '_sale_price', true);
		}
		
		// --------------------------------------------
		// How many textrows
		// --------------------------------------------
		// Must be parsed as number
		$text_rows_amount = get_post_meta( $product_id, 'text_rows' ) ? get_post_meta( $product_id, 'text_rows' ) : 0;
		$text_rows_amount = $text_rows_amount ? $text_rows_amount[0] : 0;
		
		if(empty($text_rows_amount)) {
			$text_rows_amount = 1;
		}
		
		// --------------------------------------------
		// Does this sign have holes?
		// --------------------------------------------
		$sign_has_holes = get_post_meta( $product_id, 'has_holes', true) ? get_post_meta( $product_id, 'has_holes', true) : "no";
		
		if($sign_has_holes == "yes") {
			$sign_has_holes = 1;
		} else {
			$sign_has_holes = 0;
		}
		
		// --------------------------------------------
		// Does this sign have icons?
		// --------------------------------------------
		$sign_has_icons = get_post_meta( $product_id, 'has_icon', true) ? get_post_meta( $product_id, 'has_icon', true) : "no";
		
		if($sign_has_icons == "yes") {
			$sign_has_icons = 1;
		} else {
			$sign_has_icons = 0;
		}
		
		// --------------------------------------------
		// Material?
		// --------------------------------------------
		$product_material = get_post_meta( $product_id, 'product_material', true) ? get_post_meta( $product_id, 'product_material', true) : "none";

		// --------------------------------------------
		// Product color?
		// --------------------------------------------
		$product_color = get_post_meta( $product_id, 'product_color', true) ? get_post_meta( $product_id, 'product_color', true) : "none";
		
		// In stock
        // Compatibility for WC versions from 2.5.x to 3.0+
        $stock_status = 'instock';
        if ( method_exists( $_product, 'get_stock_status' ) ) {
            $stock_status = $_product->get_stock_status(); // For version 3.0+
        }
        
        // --------------------------------------------
		// Does the sign only take laser?
		// --------------------------------------------
		$only_laser = get_post_meta( $product_id, 'only_laser', true) ? get_post_meta( $product_id, 'only_laser', true) : "none";
		
		// --------------------------------------------
		// Sign interface
		// --------------------------------------------
		
		$build_interface_array = array();
		$interfaces_array = array(
			'sign_interface_tape',
			'sign_interface_militaryclip',
			'sign_interface_safetypin',
			'sign_interface_metalmagnet',
			'sign_interface_plasticmagnet',
			'sign_interface_keyring',
			'sign_interface_screw'
		);
		
		foreach ( $interfaces_array as $key=>$interface ) {
			$check_interface_value = get_post_meta( $product_id, $interface, true);
			if( $check_interface_value == 'yes' ) {
				$build_interface_array[] = $interfaces_array[$key];
			}
		}
		$only_laser = get_post_meta( $product_id, 'only_laser', true) ? get_post_meta( $product_id, 'only_laser', true) : "none";
		
		// Gallery
		# global $product;
		$gallery_urls = array();
		$attachment_ids = $_product->get_gallery_image_ids();
		foreach( $attachment_ids as $attachment_id ) {
			$image_link = wp_get_attachment_url( $attachment_id );
			array_push($gallery_urls, $image_link);
		}

		// --------------------------------------------
		// Build data object for VUE app
		// --------------------------------------------
		$current_sign_obj = (object) [
			'id' => $product_id ? $product_id : 0,
			'price' => $product_price ? $product_price : 0,
			'saleprice' => $sale_price ? $sale_price : 0,
			'currency' => get_option('woocommerce_currency'),
			'name' => $product_title ? $product_title : 'NA',
			'description' => htmlspecialchars(json_encode($product_description), ENT_QUOTES, 'UTF-8'),
			'image' => $variant_image_path ? urlencode($variant_image_path) : '',
			'color' => $product_color ? $product_color : 0,
			'width' => $product_width ? $product_width[0] : 0,
			'height' => $product_height ? $product_height[0] : 0,
			'hasicon' => $sign_has_icons ? $sign_has_icons : 0,
			'hasholes' => $sign_has_holes ? $sign_has_holes : 0,
			'align' => 'left',
			'textcolor' => $variant_text_color ? $variant_text_color : "#FF0000",
			'textcolorshadow' => $variant_text_color_shadow ? $variant_text_color_shadow : "",
			'topoffset' => $variant_topoffset ? $variant_topoffset[0] : 0,
			'leftoffset' => $variant_leftoffset ? $variant_leftoffset[0] : 0,
			'rightoffset' => $variant_rightoffset ? $variant_rightoffset[0] : 0,
			'rowsnum' => $text_rows_amount ? $text_rows_amount : 0,
			'interfaces' => count($build_interface_array) > 0 ? json_encode($build_interface_array) : "",
			'productmaterial' => $product_material ? $product_material : "none",
			'productcolor' => $product_color ? $product_color : "none",
			'sku' => $_product->get_sku() ? $_product->get_sku() : '',
			
			// New
			"realwidth" => $product_width ? $product_width[0] : 0,
			"realheight" => $product_height ? $product_height[0] : 0,
			"imagewidth" => $attachment ? $attachment[1] : 0,
			"imageheight" => $attachment ? $attachment[2] : 0,
			"onlylaser" => $only_laser,
			"stockstatus" => $stock_status,
			"designertype" => $product_designer,
			"gallery" => $gallery_urls ? json_encode($gallery_urls) : '',
			'editorimage' => isset($editor_image_url) ? $editor_image_url : null,
		];
		$obj = $current_sign_obj;
		
		$signobj = 'const signobj = {';

		$product_count = count( (array)$obj );
		
		$dataString = '';
		foreach($obj as $key => $value) {
			$dataString .= "'".$key."' : '" . urldecode($value) . "'";		
			$dataString .= ',';
		}
		// Remove the last comma
		$signobj .= rtrim($dataString, ", ");

		$signobj .= '};';
		return $signobj;
	}
}

if (class_exists('VueEditor')) {
	$VueEditor = new VueEditor();
} else {
	throw new Exception('The class Generator does not exist.');
}



