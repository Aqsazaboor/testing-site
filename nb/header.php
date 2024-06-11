<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<h1>hello world</h1>
<?php
if(function_exists('nb_site_meta')) {
	echo nb_site_meta();
}
if(function_exists('install_microsoft_clarity')) {
	install_microsoft_clarity();
}
?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
<?php
if(function_exists('nb_site_message')) {
	echo nb_site_message();
}
?>
<?php
if(function_exists('nb_shop_promises')) {
	echo nb_shop_promises();
}
?>
<?php
if(function_exists('nb_site_navbar')) {
	echo nb_site_navbar();
}
if(function_exists('nb_site_search_bar_mobile')) {
	nb_site_search_bar_mobile();
}
?>
<?php
if(function_exists('nb_shop_categories')) {
	echo nb_shop_categories();
}
?>
<?php
if(function_exists('nb_site_search_bar')) {
	echo nb_site_search_bar();
}
?>

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'storefront_before_content' );
	?>

	<div id="content" class="site-content" tabindex="-1">
		<?php
		do_action( 'storefront_content_top' );
