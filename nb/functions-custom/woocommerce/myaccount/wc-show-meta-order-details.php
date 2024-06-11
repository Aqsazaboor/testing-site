<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * 
 * Order confirmation, and maybe on Customer Account Order page?
 * Displays the custom fields on the last order confirmation page
 *
 */

if(!function_exists('nb_display_order_items')):
function nb_display_order_items( $item_id, $item, $order ) {
	$textRow1 = $item->get_meta('textrow1');
	$textRow2 = $item->get_meta('textrow2');
	$textRow3 = $item->get_meta('textrow3');
	$textRow4 = $item->get_meta('textrow4');
	$textRow5 = $item->get_meta('textrow5');
	
	$textFont = $item->get_meta('font');
	$textItalic = $item->get_meta('textitalic');
	$textBold = $item->get_meta('textbold');
	$textSize = $item->get_meta('textsize');
	
	$output = '<div class="woocommerce-order-meta">';
	
	$output .= $textFont ? '<div><strong>' . pll__('Typsnitt') . '</strong> ' . $textFont . '</div>' : '';
	$output .= $textSize ? '<div><strong>' . pll__('Textstorlek') . '</strong> ' . $textSize . '</div>' : '';
	$output .= (int) $textBold === 1 ? '<div><strong>' . pll__('Fet text') . '</strong></div>' : '';
	$output .= (int) $textItalic === 1 ? '<div><strong>' . pll__('Kursiv') . '</strong></div>' : '';
	
	// Text rows
	$output .= $textRow1 !== 'undefined' && strlen($textRow1) > 0 ? '<div><strong>' . pll__('Textrad 1') . ':</strong> ' . $textRow1 . '</div>' : '';
	$output .= $textRow2 !== 'undefined' && strlen($textRow2) > 0 ? '<div><strong>' . pll__('Textrad 2') . ':</strong> ' . $textRow2 . '</div>' : '';
	$output .= $textRow3 !== 'undefined' && strlen($textRow3) > 0 ? '<div><strong>' . pll__('Textrad 3') . ':</strong> ' . $textRow3 . '</div>' : '';
	$output .= $textRow4 !== 'undefined' && strlen($textRow4) > 0 ? '<div><strong>' . pll__('Textrad 4') . ':</strong> ' . $textRow4 . '</div>' : '';
	$output .= $textRow5 !== 'undefined' && strlen($textRow5) > 0 ? '<div><strong>' . pll__('Textrad 5') . ':</strong> ' . $textRow5 . '</div>' : '';

	$output .= '</div>';
	echo $output;
}
add_action( 'woocommerce_order_item_meta_start', 'nb_display_order_items', 10, 3 );
endif;