<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ---------------------------------------------------------
// Stefan: user-id-3
// ---------------------------------------------------------

function print_user_classes() {
    if ( is_user_logged_in() ) {		
		add_filter('body_class','class_to_body');
		add_filter('admin_body_class', 'class_to_body_admin');
	}
}
add_action('init', 'print_user_classes');


// ---------------------------------------------------------
// Add user role class to front-end body tag
// ---------------------------------------------------------
function class_to_body($classes) {
    global $current_user;
    $user_role = array_shift($current_user->roles);
    $classes[] = $user_role.' ';
    return $classes;
}

// ---------------------------------------------------------
// Add user role class and user id to front-end body tag
// ---------------------------------------------------------
 
// add 'class-name' to the $classes array
function class_to_body_admin($classes) {
    global $current_user;
    $user_role = array_shift($current_user->roles);
    #Adds the user id to the admin body class array
    $user_ID = $current_user->ID;
    $classes = $user_role . '' . $user_role.' '.'user-id-'.$user_ID;
    $classes = $user_role;
    return $classes;
}