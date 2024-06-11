<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('wc_add_date_to_gutenberg_block')):
function wc_add_date_to_gutenberg_block( $html, $data, $product ) {
	$product_id = $product->get_id();

	if(function_exists('nb_get_product_size_material')) {
		$data->meta = nb_get_product_size_material($product_id);
	}

    $output = "
		<li class=\"wc-block-grid__product\">
				<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
					{$data->image}
					{$data->title}
				</a>
				{$data->meta}
				{$data->badge}
				{$data->price}
				{$data->rating}
				{$data->button}
		</li>
    ";
    return $output;
}
add_filter("woocommerce_blocks_product_grid_item_html", "wc_add_date_to_gutenberg_block", 10, 3);
endif;