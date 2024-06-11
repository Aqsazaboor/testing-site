<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists("nb_save_account_details_required_fields")) {
    function nb_save_account_details_required_fields( $required_fields ){
        unset( $required_fields['account_display_name'] );
        return $required_fields;
    }
    add_filter('woocommerce_save_account_details_required_fields', 'nb_save_account_details_required_fields' );
}