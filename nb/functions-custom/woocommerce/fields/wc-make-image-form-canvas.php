<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!function_exists('make_image_form_canvas')):
function make_image_form_canvas($base64img) {
	// ------------------------------------------------
	// Create image
	// Check this for security issues
	// You must create this folder for every site you create...
	// It's relative to the sites (blog NUM) uploads folder.
	// ------------------------------------------------
	$upload_dir = wp_upload_dir();
	$upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['basedir'] ) . DIRECTORY_SEPARATOR . 'oisc' . DIRECTORY_SEPARATOR;
	
	$img = $_POST['oi'];
	
	try {
		if($img) {
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			
			$decoded = base64_decode($img);
			
			if($decoded) {
				$filename = 'oi_'.date("Ymd").'.png';
				$hashed_filename = md5( $filename . microtime() ) . '_' . $filename;
				
				// imagecreatefrompng()
				$image_upload = file_put_contents( $upload_path . $hashed_filename, $decoded );
			
				if($image_upload) {
					// Add the item data
					http_response_code(200);
					return $upload_dir['baseurl'] . DIRECTORY_SEPARATOR . 'oisc'  . DIRECTORY_SEPARATOR . $hashed_filename;
				}				
			}
		}
	} catch (Exception $e) {
		var_dump($e->getMessage());
		http_response_code(500);
		return 'An error occurred';
	}
}
endif;