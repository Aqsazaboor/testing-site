<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('fabricScripts')):
function fabricScripts() {
	wp_enqueue_script( 'fabric', 'https://cdn.jsdelivr.net/npm/fabric@5.3.0/dist/fabric.min.js', array(), '5.3.0', true );
}
add_action( 'wp_enqueue_scripts', 'fabricScripts' );
endif;