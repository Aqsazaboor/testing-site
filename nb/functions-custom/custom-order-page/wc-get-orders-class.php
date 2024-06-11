<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

class GetWoocommerceOrders {

	public function getAllOrders() {

		$allCountriesOrders = array();

		if(!function_exists('get_sites')) {
			echo '<div class="notice notice-info"><p>This functionality requires a Wordpress Multisite.</p></div>';
			exit;
		}

		foreach (get_sites() as $blog) {
			$blog_id = $blog->blog_id;
			$blog_path = $blog->path;
			switch_to_blog($blog_id);

			$orders = wc_get_orders( array('numberposts' => -1) );
			$orderItems = array();

			if( $orders ) {
				foreach( $orders as $order ) {
					$order_data = $order->get_data();
					$order_id = $order_data['id'];

					if( $order_data['status'] != 'completed' ) {
						// ----------------------------------------------------------------
						// Order information
						// ----------------------------------------------------------------
						
						$order_parent_id = isset($order_data['parent_id']) ? $order_data['parent_id'] : '';
						$order_status = isset($order_data['status']) ? $order_data['status'] : '';
						$order_currency = isset($order_data['currency']) ? $order_data['currency'] : '';
						$order_version = isset($order_data['version']) ? $order_data['version'] : '';
						$order_payment_method = isset($order_data['payment_method']) ? $order_data['payment_method'] : '';
						$order_payment_method_title = isset($order_data['payment_method_title']) ? $order_data['payment_method_title'] : '';
						## Creation and modified WC_DateTime Object date string ##

						// Using a formated date ( with php date() function as method)
						$order_date_created = $order_data['date_created']->date('Y-m-d H:i:s');
						$order_date_modified = $order_data['date_modified']->date('Y-m-d H:i:s');

						// Using a timestamp ( with php getTimestamp() function as method)
						$order_timestamp_created = $order_data['date_created']->getTimestamp();
						$order_timestamp_modified = $order_data['date_modified']->getTimestamp();

						$order_discount_total = $order_data['discount_total'];
						$order_discount_tax = $order_data['discount_tax'];
						$order_shipping_total = $order_data['shipping_total'];
						$order_shipping_tax = $order_data['shipping_tax'];
						$order_total = $order_data['total'];
						$order_total_tax = $order_data['total_tax'];
						$order_customer_id = isset($order_data['customer_id']) ? $order_data['customer_id'] : '';

						$order_url = $blog_path . 'wp-admin/post.php?post='.$order_id.'&action=edit';
						$createdDateFormatted = convert_date( $order->get_date_created() );

						// ----------------------------------------------------------------
						// Order notes
						// ----------------------------------------------------------------

						if($order_id) {
							$order_notes = array();
							$notes = wc_get_order_notes( array(
								'order_id' => $order_id,
								'type'     => 'internal',
								// use 'internal' for admin and system notes, empty for all
							) );

							if ( $notes ) {
								foreach( $notes as $key => $note ) {
									// system notes can be identified by $note->added_by == 'system'
									# printf( '<div class="note_content">%s</div>', wpautop( wptexturize( wp_kses_post( make_clickable( $note->content ) ) ) ) );
									$order_note_single = array(
										"note_date" => convert_date($note->date_created),
										"note_content" => $note->content,
										"note_added_by" => $note->added_by,
									);                
									$order_notes[] = $order_note_single;
								}
							}
						}
						$lowerCaseCountryCode = $order_data['billing']['country'] !== "undefined" ? strtolower($order_data['billing']['country']) : 'SV';
						
						// ----------------------------------------------------------------
						// Order items loop
						// ----------------------------------------------------------------
						$allOrderItems = array();

						// NOT USED
						
						foreach ( $order->get_items() as $key => $item ) {
							$item_id = $key;
							$product_id = $item->get_product_id();
							$product_name = get_the_title($product_id);
							$product_width = get_post_meta( $product_id, 'product_width' );
							$product_height = get_post_meta( $product_id, 'product_height' );
							$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id) ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $product_id), 'full' )[0] : null;
							$product_variant = get_post_meta( $product_id, 'product_material' ) ? get_post_meta( $product_id, 'product_material' ) : null;
							$product_color = get_post_meta( $product_id, 'product_color' ) ? get_post_meta( $product_id, 'product_color' ) : null;
							$onlylaser = get_post_meta( $product_id, 'only_laser');
							
							$textrows = '';
							$textrow1 = wc_get_order_item_meta( $item_id, 'textrow1', true) ? wc_get_order_item_meta( $item_id, 'textrow1', true) : null;
							$textrow2 = wc_get_order_item_meta( $item_id, 'textrow2', true) ? wc_get_order_item_meta( $item_id, 'textrow2', true) : null;
							$textrow3 = wc_get_order_item_meta( $item_id, 'textrow3', true) ? wc_get_order_item_meta( $item_id, 'textrow3', true) : null;
							$textrow4 = wc_get_order_item_meta( $item_id, 'textrow4', true) ? wc_get_order_item_meta( $item_id, 'textrow4', true) : null;
							$textrow5 = wc_get_order_item_meta( $item_id, 'textrow5', true) ? wc_get_order_item_meta( $item_id, 'textrow5', true) : null;
							
							// Format for textarea
							$textrows .= $textrow1 !== null && $textrow1 !== 'undefined' ? $textrow1."\n" : null;
							$textrows .= $textrow2 !== null && $textrow2 !== 'undefined' ? $textrow2."\n" : null;
							$textrows .= $textrow3 !== null && $textrow3 !== 'undefined' ? $textrow3."\n" : null;
							$textrows .= $textrow4 !== null && $textrow4 !== 'undefined' ? $textrow4."\n" : null;
							$textrows .= $textrow5 !== null && $textrow5 !== 'undefined' ? $textrow5 : null;
							
							$textFont1 = wc_get_order_item_meta( $item_id, 'Font', true);
							$textFont2 = wc_get_order_item_meta( $item_id, 'font', true);
							$checkItalic = (int)wc_get_order_item_meta( $item_id, 'textitalic', true) == 1 ? 'Ja' : '';
							$checkBold = (int)wc_get_order_item_meta( $item_id, 'textbold', true) == 1 ? 'Ja' : '';
							$textAlignment = wc_get_order_item_meta( $item_id, 'textalignment', true);
							$textOffset = wc_get_order_item_meta( $item_id, 'textoffset', true);
							$textSize = wc_get_order_item_meta( $item_id, 'textsize', true);
							$engravingtype = wc_get_order_item_meta( $item_id, 'engravingtype', true);
							$order_item_image = wc_get_order_item_meta( $item_id, 'orderimage', true);
							$quantity = $item->get_quantity();

							$thisItem = array(
								"product_id" => $product_id ? $product_id : "",
								"product_name" => $product_name ? $product_name : "",
								"product_width" => $product_width ? $product_width : "",
								"product_height" => $product_height ? $product_height : "",
								"product_image" => $product_image,
								"product_variant" => $product_variant,
								"product_color" => $product_color,
								"font_1" => $textFont1 ? $textFont1 : "",
								"font_2" => $textFont2 ? $textFont2 : "",
								"text_italic" => $checkItalic ? $checkItalic : false,
								"text_bold" => $checkBold ? $checkBold : false,
								"text_alignment" => $textAlignment ? $textAlignment : 0,
								"text_offset" => $textOffset ? $textOffset : 0,
								"text_size" => $textSize ? $textSize : 0,
								"text_rows" => $textrows ? $textrows : null,
								"order_image" => $order_item_image,
								"engravingtype" => $engravingtype ? $engravingtype : "",
								"onlylaser" => $onlylaser === "yes" ? "true" : "false",
								"quantity" => $quantity ? $quantity : 1,
							);

							$allOrderItems[] = $thisItem ? $thisItem : array();
						}
						
						$orderItem = array(
							"order_id" => $order_id ? $order_id : "",
							"blog_id" => $blog_id ? $blog_id : "",
							"order_url" => $blog_path . 'wp-admin/post.php?post='.$order_id.'&action=edit',
							"order_created_formatted" => $createdDateFormatted ? $createdDateFormatted : "",
							"country_code" => $lowerCaseCountryCode ? $lowerCaseCountryCode : "",
							"firstname" => $order_data['billing']['first_name'],
							"lastname" => $order_data['billing']['last_name'],
							"order_parent_id" => $order_data['parent_id'],
							"order_status" => $order_data['status'],
							"order_currency" => $order_data['currency'],
							"order_version" => $order_data['version'],
							"order_payment_method_title" => $order_data['payment_method_title'],
							"order_payment_method" => $order_data['payment_method'],

							## Creation and modified WC_DateTime Object date string ##

							// Using a formated date ( with php date() function as method)
							"order_date_created" => $order_data['date_created']->date('Y-m-d H:i:s'),
							"order_date_modified" => $order_data['date_modified']->date('Y-m-d H:i:s'),

							// Using a timestamp ( with php getTimestamp() function as method)
							"order_timestamp_created" => $order_data['date_created']->getTimestamp(),
							"order_timestamp_modified" => $order_data['date_modified']->getTimestamp(),

							"order_discount_total" => $order_data['discount_total'],
							"order_discount_tax" => $order_data['discount_tax'],
							"order_shipping_total" => $order_data['shipping_total'],
							"order_shipping_tax" => $order_data['shipping_tax'],
							"order_total" => $order_data['total'],
							"order_total_tax" => $order_data['total_tax'],
							"order_customer_id" => $order_data['customer_id'], // ... and so on

							## BILLING INFORMATION:

							"order_billing_first_name" => $order_data['billing']['first_name'],
							"order_billing_last_name" => $order_data['billing']['last_name'],
							"order_billing_company" => $order_data['billing']['company'],
							"order_billing_address_1" => $order_data['billing']['address_1'],
							"order_billing_address_2" => $order_data['billing']['address_2'],
							"order_billing_city" => $order_data['billing']['city'],
							"order_billing_state" => $order_data['billing']['state'],
							"order_billing_postcode" => $order_data['billing']['postcode'],
							"order_billing_country" => $order_data['billing']['country'],
							"order_billing_email" => $order_data['billing']['email'],
							"order_billing_phone" => $order_data['billing']['phone'],

							## SHIPPING INFORMATION:

							"order_shipping_first_name" => $order_data['shipping']['first_name'],
							"order_shipping_last_name" => $order_data['shipping']['last_name'],
							"order_shipping_company" => $order_data['shipping']['company'],
							"order_shipping_address_1" => $order_data['shipping']['address_1'],
							"order_shipping_address_2" => $order_data['shipping']['address_2'],
							"order_shipping_city" => $order_data['shipping']['city'],
							"order_shipping_state" => $order_data['shipping']['state'],
							"order_shipping_postcode" => $order_data['shipping']['postcode'],
							"order_shipping_country" => $order_data['shipping']['country'],

							## ORDER ITEMS
							"order_items" => $allOrderItems,
							"order_notes" => $order_notes ? $order_notes : '',
						);

						if(
						    isset($order_data['status']) &&
						    $order_data['status'] !== 'completed' &&
						    $order_data['status'] !== 'refunded' &&
						    $order_data['status'] !== 'cancelled' &&
						    $order_data['status'] !== 'failed'
						) {
							$orderItems[] = $orderItem;
						}
					}
				}
			}			
			if(count($orderItems) > 0) {
				$allCountriesOrders[$blog_id] = $orderItems;
			}
			restore_current_blog();

		}
		
		
		if(count($allCountriesOrders) > 0) {
			return json_encode($allCountriesOrders);
		} else {
			$fallback = array(
				'orders' => 0
			);
			return json_encode($fallback);
		}
	}

}