<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// add_action( 'admin_menu', 'custom_menu_pages' );
// function custom_menu_pages() {
// 	// add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
	
// 	add_menu_page( 'Beställningar', 'Beställningar', 'manage_woocommerce', 'edit.php?post_type=shop_order', '', 'dashicons-cart', 6 );
	
// 	// add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null )
	
// 	// Behandlas
// 	add_submenu_page( 'edit.php?post_type=shop_order', 'Behandlas', 'Behandlas', 'manage_woocommerce', 'edit.php?post_status=wc-processing&post_type=shop_order', '');

// 	// Prio
// 	add_submenu_page( 'edit.php?post_type=shop_order', 'Prio', 'Prio', 'manage_woocommerce', 'edit.php?post_status=wc-priod&post_type=shop_order', '');

// 	// Pausad
// 	add_submenu_page( 'edit.php?post_type=shop_order', 'Pausade', 'Pausade', 'manage_woocommerce', 'edit.php?post_status=wc-on-hold&post_type=shop_order', '');

// 	// Färdigbehandlade
// 	add_submenu_page( 'edit.php?post_type=shop_order', 'Färdigbehandlade', 'Färdigbehandlade', 'manage_woocommerce', 'edit.php?post_status=wc-completed&post_type=shop_order', '');	
	
// 	// Inväntar betalning
// 	// edit.php?post_status=wc-pending&post_type=shop_order
// 	add_submenu_page( 'edit.php?post_type=shop_order', 'Inväntar betalning', 'Inväntar betalning', 'manage_woocommerce', 'edit.php?post_status=wc-cancelled&post_type=shop_order', '');

// 	// Avbruten
// 	// edit.php?post_status=wc-cancelled&post_type=shop_order
// 	add_submenu_page( 'edit.php?post_type=shop_order', 'Avbruten', 'Avbruten', 'manage_woocommerce', 'edit.php?post_status=wc-cancelled&post_type=shop_order', '');

// 	// Återbetald
// 	// edit.php?post_status=wc-refunded&post_type=shop_order
// 	add_submenu_page( 'edit.php?post_type=shop_order', 'Återbetald', 'Återbetald', 'manage_woocommerce', 'edit.php?post_status=wc-refunded&post_type=shop_order', '');

// 	// Misslyckad
// 	// edit.php?post_status=wc-failed&post_type=shop_order
// 	add_submenu_page( 'edit.php?post_type=shop_order', 'Misslyckad', 'Misslyckad', 'manage_woocommerce', 'edit.php?post_status=wc-failed&post_type=shop_order', '');

// }
