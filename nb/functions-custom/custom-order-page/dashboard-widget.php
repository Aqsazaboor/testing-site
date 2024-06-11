<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('nb_custom_dashboard_widgets')):
add_action('wp_dashboard_setup', 'nb_custom_dashboard_widgets');
function nb_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('wp_custom_dashboard', 'Skyltdax orderhantering', 'nb_custom_dashboard');
}
endif;

if(!function_exists('nb_custom_dashboard')):
function nb_custom_dashboard() {
	$output = '';
	$output .= '<div style="text-align: center; margin-bottom: 12px;"><a href="/wp-admin/admin.php?page=skyltdax-admin"><img src="'.get_stylesheet_directory_uri().'/assets/images/admin/skyltdax-admin-illustration.png" style="max-width: 100%; height: auto;" /></a></div>';
	$output .= '<h3>Välkommen!</h3>';
	$output .= '<p>Dags att ta hand om lite ordar? Du hittar snabbt till våra beställningar genom att klicka här under.</p>';
	$output .= '<p><a href="/wp-admin/admin.php?page=skyltdax-admin" class="button button-primary">Skyltdax Order Admin</a></p>';
	echo $output;
}
endif;