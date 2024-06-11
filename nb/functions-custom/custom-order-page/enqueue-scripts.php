<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

function nb_load_custom_wp_admin_style($hook) {	
	// if( $hook != 'toplevel_page_skyltdax-admin' ) {
	// 	return;
	// }
	wp_enqueue_style( 'custom_wp_admin_css', get_template_directory_uri() . '/assets/dist/css/admin.css', false, '1.0.0' );
	//wp_enqueue_style( 'custom_wp_admin_css_new', get_template_directory_uri() . '/assets/dist/css/custom-admin-styles.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'nb_load_custom_wp_admin_style' );