<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

// Function that returns our textsizes

if( !function_exists('editor_text_size') ):
function editor_text_size() {
	
	// Extra price?
	if( function_exists('get_field') && get_field('price_for_large_text','options') ) {
		$base_extra_price = get_field('price_for_large_text','options');
	} else {
		$base_extra_price = 0;
	}

	// No extra fee
	// Designer type = 0 is from the shelf and has no extra charge for text sizes
	// Designer type = 1 is plastic and has no extra charge for text sizes
	// Designer type = 2 is brass and has extra charge for text sizes

	// Move to ACF later
	$textSizes = array(
		array(
			'name' => "3.5",
			'truesize' => "11.6",
			'fee' => 0,
			'simple' => 1
		),
		array(
			'name' => "4.5",
			'truesize' => "15.6",
			'fee' => 0,
			'simple' => 1
		),
		array(
			'name' => "5.5",
			'truesize' => "18.6",
			'fee' => 0,
			'simple' => 1
		),
		array(
			'name' => "6.5",
			'truesize' => "21.3",
			'fee' => 0,
			'simple' => 1
		),
		array(
			'name' => "7.5",
			'truesize' => "24.2",
			'fee' => 0,
			'simple' => 1
		),
		array(
			'name' => "8.5",
			'truesize' => "27",
			'fee' => $base_extra_price,
			'simple' => 1
		),
		array(
			'name' => "9.5",
			'truesize' => "29.9",
			'fee' => $base_extra_price,
			'simple' => 1
		),
		array(
			'name' => "10.5",
			'truesize' => "32.7",
			'fee' => $base_extra_price,
			'simple' => 1
		),
		array(
			'name' => "11.5",
			'truesize' => "35.6",
			'fee' => $base_extra_price,
			'simple' => 1
		),
		array(
			'name' => "12.5",
			'truesize' => "38.5",
			'fee' => $base_extra_price,
			'simple' => 1
		),
		array(
			'name' => "13.5",
			'truesize' => "41.5",
			'fee' => $base_extra_price,
			'simple' => 1
		),
		array(
			'name' => "14.5",
			'truesize' => "45.2",
			'fee' => $base_extra_price,
			'simple' => 1
		),
		array(
			'name' => "15.5",
			'truesize' => "51.5",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "16.5",
			'truesize' => "56.5",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "20",
			'truesize' => "71.5",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "22",
			'truesize' => "90",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "26",
			'truesize' => "113.6",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "30",
			'truesize' => "96.8",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "34",
			'truesize' => "130.4",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "38",
			'truesize' => "147.2",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "42",
			'truesize' => "164",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "46",
			'truesize' => "180.8",
			'fee' => $base_extra_price,
			'simple' => 0
		),
		array(
			'name' => "52",
			'truesize' => "197.6",
			'fee' => $base_extra_price,
			'simple' => 0
		),
	);
	return JSON_encode($textSizes);
}
endif;