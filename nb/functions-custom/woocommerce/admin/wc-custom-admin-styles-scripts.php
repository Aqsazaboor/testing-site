<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ---------------------------------------------------------
// Styles and scripts
// ---------------------------------------------------------

/*
if(!function_exists('ks_admin_scripts')):
function ks_admin_scripts($hook) {
	wp_enqueue_script( 'ks_admin_scripts', get_template_directory_uri() . '/functions-custom/woocommerce/assets/ks-admin.js' );
	wp_localize_script('ks_admin_scripts', 'genpdf', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'sxnonce' => wp_create_nonce('sx-generic-nonce'),
		'pdf_url' => get_template_directory_uri().'/functions/woocommerce/wc-admin-get-sign-as-pdf.php'
	));	
}
add_action( 'admin_enqueue_scripts', 'ks_admin_scripts' );
endif;
*/

if(!function_exists('custom_woocommerce_admin_style')):
	add_action('admin_enqueue_scripts', 'custom_woocommerce_admin_style');
	function custom_woocommerce_admin_style() {
		wp_enqueue_script('custom-woocommerce-admin-vue', get_template_directory_uri() . '/functions-custom/woocommerce/admin/assets/vendor/vue.min.js', array(), '1.0', true);
		wp_enqueue_script('custom-woocommerce-admin-fabricjs', get_template_directory_uri() . '/functions-custom/woocommerce/admin/assets/vendor/fabric.min.js', array(), '5.3.0', true);
		wp_enqueue_script('custom-woocommerce-admin-app', get_template_directory_uri() . '/functions-custom/woocommerce/admin/assets/sdx-woocommerce-app.js', array(), filemtime(get_template_directory() . '/functions-custom/woocommerce/admin/assets/sdx-woocommerce-app.js'), true);
		
		// Only use this JS on Skyltdax Admin page
		$screen = get_current_screen();
		if( $screen->base == "toplevel_page_skyltdax-admin" ) {
			wp_enqueue_script('custom-woocommerce-admin-scripts', get_template_directory_uri() . '/functions-custom/woocommerce/admin/assets/sdx-admin.js', array(), filemtime(get_template_directory() . '/functions-custom/woocommerce/admin/assets/sdx-admin.js'), true);
			wp_localize_script( 'custom-woocommerce-admin-scripts', 'custom_order_page', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'custom_order_page_nonce' ),
			) );
		}
		wp_enqueue_style('custom-woocommerce-admin-styles', get_template_directory_uri().'/functions-custom/woocommerce/admin/assets/nb-admin-styles.css');
		wp_enqueue_style('custom-woocommerce-print-styles', get_template_directory_uri().'/functions-custom/woocommerce/admin/assets/nb-print-styles.css');
	}
endif;