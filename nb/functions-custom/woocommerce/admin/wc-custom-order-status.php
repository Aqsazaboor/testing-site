<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*

Order statuses from old system

Sparad (betalningsförsök har gjorts)
Betald/Väntar på hantering
Skickad och klar
Pausad/Avvakta
Reklamation
Ska faktureras av Skyltdax
Borrtagen/annulerad

*/

/** 
 * Register Skickad och klar
 * Tutorial: http://www.sellwithwp.com/woocommerce-custom-order-status-2/
**/
function register_skickad_klar_order_status() {
    register_post_status( 'wc-skickad-klar', array(
        'label'                     => 'Skickad och klar',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Skickad och klar <span class="count">(%s)</span>', 'Skickad och klar <span class="count">(%s)</span>' )
    ) );
    // register_post_status( 'wc-prio-order', array(
    //     'label'                     => 'Prio',
    //     'public'                    => true,
    //     'exclude_from_search'       => false,
    //     'show_in_admin_all_list'    => true,
    //     'show_in_admin_status_list' => true,
    //     'label_count'               => _n_noop( 'Prio list <span class="count">(%s)</span>', 'Prio list <span class="count">(%s)</span>' )
    // ) );
    // register_post_status( 'wc-in-production', array(
    //     'label'                     => 'Under arbete',
    //     'public'                    => true,
    //     'exclude_from_search'       => false,
    //     'show_in_admin_all_list'    => true,
    //     'show_in_admin_status_list' => true,
    //     'label_count'               => _n_noop( 'Under arbete <span class="count">(%s)</span>', 'Under arbete <span class="count">(%s)</span>' )
    // ) );
}
add_action( 'init', 'register_skickad_klar_order_status' );

// Add to list of WC Order statuses
function add_skickad_klar_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-skickad-klar'] = 'Skickad och klar';
        }
        // if ( 'wc-prio' === $key ) {
        //     $new_order_statuses['wc-prio'] = 'Prio';
        // }
        // if ( 'wc-prio' === $key ) {
        //     $new_order_statuses['wc-in-production'] = 'Under arbete';
        // }
    }
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_skickad_klar_to_order_statuses' );




/** 
 * Register Prio
 * Tutorial: http://www.sellwithwp.com/woocommerce-custom-order-status-2/
**/

function register_prio_order_status() {
    register_post_status( 'wc-prio-order', array(
        'label'                     => 'Prio',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Prio list <span class="count">(%s)</span>', 'Prio list <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_prio_order_status' );

// Add to list of WC Order statuses
function add_prio_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-prio-order'] = 'Prio';
        }
    }
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_prio_to_order_statuses' );

/** 
 * Register Prio
 * Tutorial: http://www.sellwithwp.com/woocommerce-custom-order-status-2/
**/

function register_in_production_order_status() {
    register_post_status( 'wc-in-production', array(
        'label'                     => 'Under arbete',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Under arbete <span class="count">(%s)</span>', 'Under arbete <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_in_production_order_status' );

// Add to list of WC Order statuses
function add_in_production_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-in-production'] = 'Under arbete';
        }
    }
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_in_production_to_order_statuses' );
