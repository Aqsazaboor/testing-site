<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ---------------------------------------------------------
// Remove magnyfying glass
// ---------------------------------------------------------

add_action( 'after_setup_theme', 'bc_remove_magnifier', 100 );
function bc_remove_magnifier() { remove_theme_support( 'wc-product-gallery-zoom' ); }