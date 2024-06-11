<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class GenerateProductsJson {
    // property declaration
    public $var = 'a default value';

	private function getAllProducts() {
		wp_reset_query();

		$category_slug = 'frontpage';

		// Default Woocommerce ordering args
		# $ordering_args = WC()->query->get_catalog_ordering_args();

		$args = array(
				'post_type'             => 'product',
				'post_status'           => 'publish',
				# 'ignore_sticky_posts'   => 1,
				// 'orderby'               => $ordering_args['orderby'],
				// 'order'                 => $ordering_args['order'],
				'posts_per_page'        => -1,
				// 'meta_query'            => array(
				// 	array(
				// 		'key'           => '_visibility',
				// 		'value'         => array('catalog', 'visible'),
				// 		'compare'       => 'IN'
				// 	)
				// ),
				// 'tax_query'             => array(
				// 	array(
				// 		'taxonomy'      => 'product_cat',
				// 		'terms'         => array( esc_attr( $category_slug ) ),
				// 		'field'         => 'slug',
				// 		'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
				// 	)
				// )
			);

		if ( isset( $ordering_args['meta_key'] ) ) {
			$args['meta_key'] = $ordering_args['meta_key'];
		}
		$products = new WP_Query($args);

		# woocommerce_reset_loop();
		# wp_reset_postdata();

		return $products;
	}

    // method declaration
    public function createProductsObject() {
		$allProducts = $this->getAllProducts();
		$allProductsObject = $allProducts->posts;
		$newProductsArray = array();

		// I need
		// Title
		// Slug
		// Price string
		// Material Meta
		// Color Meta
		// Image URL
		// Desc
		// Width Meta
		// Height Meta
		// On Sale

		// post_title
		// slug
		// sale_price
		// image_id

		foreach($allProductsObject as $key => $value) {
			$thisProduct = $allProductsObject[$key];

			$productObject = new stdClass();
			$productId = $thisProduct->ID;
			$productObject->id = $productId;
			$productObject->title = $thisProduct->post_title;
			$productObject->slug = $thisProduct->post_name;
			$productObject->desc = $thisProduct->post_content;
			$productObject->image = get_the_post_thumbnail_url($productId, 'full');
			$productObject->sale_price = $thisProduct->sale_price;

			// Meta
			$productObject->width = get_post_meta($productId, 'product_width', true );
			$productObject->height = get_post_meta($productId, 'product_height', true );

			// get original image url on image_id

			$newProductsArray[] = $productObject;
		}

		// $productObject = new stdClass();
		// $productObject->title = 'Here we go';

		return $newProductsArray;
    }
}


// On Post save, grab and make a JSON from it.
function save_products_object_on_save($post_ID)  {
   //do my stuff here;

   $generateProductsJson = new GenerateProductsJson();
   #file_put_contents('myfile.json', json_encode($generateProductsJson->createProductsObject()));

	$json = json_encode($generateProductsJson->createProductsObject());
	$bytes = file_put_contents(get_stylesheet_directory().'/data/allproducts.json', $json); //generate json file
	echo "Here is the myfile data $bytes.";
}
add_action('save_post', 'save_products_object_on_save');