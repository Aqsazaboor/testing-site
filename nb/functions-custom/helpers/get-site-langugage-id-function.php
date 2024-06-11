<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !function_exists('get_site_language') ):
function get_site_language($blogId = 0) {
	
	// Check country via bloginfo url
	$check_this_value = $bloginfoName = strtolower( get_bloginfo('name') );
	if($blogId !== 0) {
		$check_this_value =strtolower( get_bloginfo('name', $blogId) );
	}
	// $bloginfoUrl = strtolower( get_bloginfo('url') );
	// $bloginfoName = strtolower( get_bloginfo('name') );

	#str_contains($bloinfoUrl, 'namnbrickor.nu') ||
	if( str_contains($bloginfoName, 'skyltdax') ) {
		$whatCountry = 'sv';
	} elseif( str_contains($bloginfoName, 'ovikilpi') ) {
		$whatCountry = 'fi';
	} elseif( str_contains($bloginfoName, '24skilte') ) {
		$whatCountry = 'dk';
	} elseif( str_contains($bloginfoName, 'turschilder') ) {
		$whatCountry = 'de';
	} elseif( str_contains($bloginfoName, 'türschilder') ) {
		$whatCountry = 'de';
	} elseif( str_contains($bloginfoName, '24signs') ) {
		$whatCountry = 'en';
	} elseif( str_contains($bloginfoName, 'deurbordje24') ) {
		$whatCountry = 'nl';
	} elseif( str_contains($bloginfoName, '24plaques') ) {
		$whatCountry = 'fr';
	} else {
		$whatCountry = 'sv';
	}
	
	return $whatCountry;
}
endif;