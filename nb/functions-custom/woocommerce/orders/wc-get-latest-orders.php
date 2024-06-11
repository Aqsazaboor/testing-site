<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

function get_latest_orders_widget() {

    if(function_exists('wc_get_order_statuses')) {

        // Get any existing copy of our transient data
        if ( false === ( $previous_orders_transient = get_transient( 'previous_orders_transient' ) ) ) {
            global $wpdb;

            $statuses = array_keys(wc_get_order_statuses());
            $statuses = implode( "','", $statuses );

            $previous_orders_transient = $wpdb->get_results(
                "SELECT * FROM {$wpdb->prefix}posts WHERE post_type LIKE 'shop_order' AND post_status IN ('$statuses')"
            );

            // It wasn't there, so regenerate the data and save the transient
            set_transient( 'previous_orders_transient', $previous_orders_transient, 1 * HOUR_IN_SECONDS );
        }

        $results = get_transient( 'previous_orders_transient' );
        $lang_string = pll__('Vi sålde precis en') ? pll__('Vi sålde precis en') : '';
        // Loop through each order post object
        $getlatestOrders = array();

        if(count($results) > 0) {
            $index = 0;
            $orderItemAmount = 5;
            foreach( $results as $result ) {
                if($index == $orderItemAmount) {
                    break;
                }
                $order_id = $result->ID; // The Order ID
                $order = wc_get_order( $result->ID );

                if( $order && isset($order) && count($order->get_items()) > 0) {
                    $items = $order->get_items();
                    $productDataArray = array();

                    if(!$items) {
                        break;
                    }

                    foreach ($items as $itemKey => $item ) {
                        $itemData = $item->get_product();
                        $itemId = $itemData ? $itemData->get_id() : 1;
                        $productName = $itemData ? $itemData->get_title() : '';
                        $productImage = $itemData ? wp_get_attachment_image_url( get_post_thumbnail_id( $itemId ), 'medium' ) : "";
                        $productUrl = $itemData ? get_permalink( $itemId ) : '';

                        // Add to array once per order
                        $productDataArray['product_name'] = $productName;
                        $productDataArray['product_image'] = $productImage;
                        $productDataArray['product_url'] = $productUrl;
                        break;
                    };
                    if(count($productDataArray) > 0) {
                        $orderArray = array(
                            // Don't add order number to array
                            "order_product" => count($productDataArray) > 0 ? $productDataArray : array(),
                        );
                        
                        array_push( $getlatestOrders, $orderArray );
                    }
                    $index++;
                }
            }
            $data = (isset($order) && count($getlatestOrders) > 0) ? json_encode($getlatestOrders) : '[]';

            $output = "<script>";
            $output .= 'const previousOrders = {"lang_string": "'.$lang_string.'", "products": '.$data.'};';
            $output .= "</script>\n\n";
            echo $output;
        } else {
            $output = "<script>";
            $output .= 'const previousOrders = [];';
            $output .= "</script>\n\n";
            echo $output;
        }
    } else {
        echo '<div style="color:white;text-align:center;width:100%;padding:10px;background-color:#d63638;">Woocommerce must be installed for this site to work!</div>';
    }
}
add_action('wp_footer', 'get_latest_orders_widget');