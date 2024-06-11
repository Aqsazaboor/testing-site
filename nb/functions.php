<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

/**
 * Storefront engine room
 *
 * @package storefront
 */

if(!class_exists('Theme')):
class Theme {

	function __construct() {
		$this->load_external_functions();
	}

	function load_external_functions() {

		// find and include files in functions directory
		// filter it to only include php files
		$files = glob( get_stylesheet_directory() . "/functionsl/*.{php}", GLOB_BRACE);

		// Can't trust that glob always returns files in same order
		// https://glotpress.trac.wordpress.org/ticket/211
		natsort($files);

		foreach ($files as $filepath) {
			// Use load_template so $post and other globals are automatically set
			load_template($filepath, true, true );
		}

	}
}

$theme = new Theme();
endif;

/**
 * Assign the Storefront version to a var
 */
$theme = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'functions/inc/class-storefront.php',
	'customizer' => require 'functions/inc/customizer/class-storefront-customizer.php',
);

// -------------------------------------------------------
// Custom functions
// -------------------------------------------------------

require_once 'functions-custom/init-theme.php';


// -------------------------------------------------------
// Storefront functions
// -------------------------------------------------------

require_once 'functions/inc/storefront-functions.php';
require_once 'functions/inc/storefront-template-hooks.php';
require_once 'functions/inc/storefront-template-functions.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'functions/inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'functions/inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'functions/inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'functions/inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';
	require 'functions/inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'functions/inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'functions/inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'functions/inc/admin/class-storefront-admin.php';

	require 'functions/inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'functions/inc/nux/class-storefront-nux-admin.php';
	require 'functions/inc/nux/class-storefront-nux-guided-tour.php';

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
		require 'functions/inc/nux/class-storefront-nux-starter-content.php';
	}
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */
