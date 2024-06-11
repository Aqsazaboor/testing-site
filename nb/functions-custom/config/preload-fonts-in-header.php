<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}
if(!function_exists('nb_preload_fonts_loop')):
function nb_preload_fonts_loop() {
	
	$addToAdmin = false;
	if(function_exists('get_current_screen')) {
		$screen = get_current_screen();
		if ( isset($screen) && $screen->id == "admin_page_download-image" ) {
		 	$addToAdmin = true;
		}
	}
	if( is_product() || (is_admin() && $addToAdmin) ) {
		if(!function_exists('editor_fonts')) {
			exit;
		}
		# var_dump( editor_fonts() );

		$fontPath = '/assets/editor-fonts/';
		
		$fontsArray = editor_fonts();
		$output = '';
		foreach($fontsArray as $singleFont) {
			if($singleFont['files']) {
				foreach($singleFont['files'] as $singleFontFiles) {
					$output .= '<link rel="preload" href="'.get_stylesheet_directory_uri().$fontPath.$singleFontFiles.'" as="font" type="font/woff" crossorigin>'."\n";
				}
			}
		}
		echo $output;
	}
}
add_action( 'wp_head', 'nb_preload_fonts_loop' );
add_action( 'admin_head', 'nb_preload_fonts_loop' );
endif;