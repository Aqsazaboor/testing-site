<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

/**
 * Proper way to enqueue scripts and styles.
 */
function nb_scripts() {
	wp_enqueue_style( 'bulma', get_template_directory_uri() . '/assets/bulma/css/bulma.css' );
	wp_enqueue_style( 'production', get_template_directory_uri() . '/assets/dist/css/app.css', array(), filemtime(get_template_directory() . '/assets/dist/css/app.css') );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/assets/dist/css/fonts.css', array(), filemtime(get_template_directory() . '/assets/dist/css/fonts.css') );
	
	// wp_enqueue_script( 'fastclick', get_template_directory_uri() . '/assets/src/vendor/fastclick.js', array(), '1.0', true );
	wp_enqueue_script( 'axios', get_template_directory_uri() . '/assets/src/vendor/axios.min.js', array(), '1.0', true );
	wp_enqueue_script( 'vue', get_template_directory_uri() . '/assets/src/vendor/vue-v2-6-11.min.js', array(), '2.6.11', true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/dist/main.js', array(), filemtime(get_template_directory() . '/assets/dist/main.js'), true );
	
	// Only enqueue the product designer on product pages... Initiates the Vue App
	if( is_product() ) {
		wp_enqueue_script( 'bundle', get_template_directory_uri() . '/assets/dist/app.js', array(), filemtime(get_template_directory() . '/assets/dist/app.js'), true );
	}

	// Products app should be on all pages
	wp_enqueue_script( 'products-bundle', get_template_directory_uri() . '/assets/dist/products.js', array(), '2.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'nb_scripts' );