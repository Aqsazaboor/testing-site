<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('translate_engraving_types')):
function translate_engraving_types($string) {
	$translation = '';
	
	if( strLen($string) < 1 ) {
		return '';
	}
	
	// Hack to not break if statements
	$arrayFromStr = array($string);
	
	if( in_array("laser", $arrayFromStr) ) {
		$translation = pll__('Lasergravyr');
	} elseif( in_array("laquer", $arrayFromStr) ) {
		$translation = pll__('Lackfylld djupgravyr');
	} elseif( in_array("unfilled", $arrayFromStr) ) {
		$translation = pll__('Oifylld djupgravyr');
	} else {
		$translation = $string;
	}
	return $translation;
}
endif;