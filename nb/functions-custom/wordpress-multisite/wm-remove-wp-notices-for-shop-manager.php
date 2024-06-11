<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
function nb_hide_notices() {
	$user = wp_get_current_user();
	if ( ($user->roles[0] == 'shop_manager') ) {
		remove_all_actions( 'admin_notices' );
	}
}
add_action( 'admin_head', 'nb_hide_notices', 1 );
*/


function nb_hide_core_update_notifications_from_users() {
	if ( ! current_user_can( 'update_core' ) ) {
		remove_all_actions( 'admin_notices' );
		remove_action( 'admin_notices', 'update_nag', 3 );
	}
}
add_action( 'admin_head', 'nb_hide_core_update_notifications_from_users', 1 );