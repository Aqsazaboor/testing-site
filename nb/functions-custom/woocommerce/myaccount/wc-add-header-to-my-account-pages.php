<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_add_header_dashboard')):
function nb_add_header_dashboard() {
	$output = '<div class="woocommerce-MyAccount__page-title">';
	$output .= '<h1>'.pll__('Mitt konto').'</h1>';
	$output .= '</div>';
	echo $output;
}
add_action( 'woocommerce_before_account_navigation', 'nb_add_header_dashboard');
endif;