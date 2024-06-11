<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
* woocommerce_single_product_summary hook
*
* @hooked woocommerce_template_single_title - 5
* @hooked woocommerce_template_single_price - 10
* @hooked woocommerce_template_single_excerpt - 20
* @hooked woocommerce_template_single_add_to_cart - 30
* @hooked woocommerce_template_single_meta - 40
* @hooked woocommerce_template_single_sharing - 50
*/
#remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
#remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
#remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

// Utils
require_once 'utils/wc-return-product-size-and-material.php';
require_once 'utils/wc-hide-categories-from-lists.php';
require_once 'search/wc-search-improvements.php';

// Checkout
require_once 'checkout/wc-checkout-functionality.php';
require_once 'checkout/wc-checkout-faq-custom-post-type.php';
require_once 'checkout/wc-shipping-hooks.php';

// Cart
require_once 'cart/wc-add-cart-offers.php';
require_once 'cart/wc-add-to-cart-ajax.php';
require_once 'cart/wc-replace-order-image-with-custom-cart-minicart.php';
require_once 'cart/wc-custom-ajax-button.php';
require_once 'cart/wc-remove-cart-button-from-product-card.php';
require_once 'cart/wc-hide-orderimage-and-more-for-customer.php';
require_once 'cart/wc-add-extras-on-cart-item-price.php';
# require_once 'cart/wc-redirect-after-add-to-cart.php';
# require_once 'cart/wc-custom-thumbnail-minicart.php';

// Custom fields
require_once 'fields/wc-add-custom-fields-to-product.php';
require_once 'fields/wc-add-product-interfaces.php';

# Require for all files in this:
# require_once 'fields/wc-custom-field-to-order.php';

// What does these do?
require_once 'fields/wc-add-custom-data-to-order.php';
require_once 'fields/wc-save-custom-fields.php';

// Checkout
// Save custom fields, this is broken
require_once 'fields/wc-make-image-form-canvas.php';
require_once 'fields/wc-validate-custom-field.php';
require_once 'fields/wc-add-custom-field-item-data.php';
require_once 'fields/wc-before-calculate-totals.php';
require_once 'fields/wc-cart-item-name.php';
# require_once 'checkout/wc-handle-price-increase-extras.php';

// Custom product flows
require_once 'custom-product-flows/product-only-frontend-category.php';

// Display layer
require_once 'frontend/wc-remove-product-tabs.php';
require_once 'frontend/wc-remove-magnifying-glass.php';
require_once 'frontend/wc-display-width-height-product-card.php';
require_once 'frontend/wc-display-width-height-single-product.php';
# require_once 'frontend/wc-custom-content-to-product-desc.php';
require_once 'frontend/wc-shop-page-hero.php';
require_once 'frontend/wc-add-product-desc-to-non-editor.php';
require_once 'frontend/wc-exclude-categories-shop-page.php';
require_once 'frontend/wc-get-currency-symbols.php';
require_once 'frontend/wc-update-price-on-variation.php';


// Empty cart
require_once 'frontend/wc-empty-cart-design.php';


// Customer portal
require_once 'myaccount/wc-add-header-to-my-account-pages.php';
require_once 'myaccount/wc-show-meta-order-details.php';
require_once 'myaccount/wc-force-email-login.php';
require_once 'myaccount/wc-remove-required-for-display-name.php';


// Admin
require_once 'admin/wc-custom-menu-pages.php';
require_once 'admin/wc-display-product-color-admin.php';
require_once 'admin/wc-custom-admin-styles-scripts.php';
require_once 'admin/wc-add-user-role-to-body.php';
require_once 'admin/wc-remove-shop-manager-capabilities.php';
require_once 'admin/wc-display-custom-fields-on-order-item.php';
require_once 'admin/wc-create-order-from-admin.php';
require_once 'admin/wc-custom-order-status.php';
require_once 'admin/wc-add-column-to-product-table.php';
require_once 'admin/wc-create-image-from-fabric.php';
# require_once 'admin/wc-add-order-status-prio.php';
# require_once 'admin/wc-custom-order-admin-page.php';
# require_once 'admin/wc-admin-get-sign-as-pdf.php';

// Emails
require_once "emails/wc-filter-meta-from-emails.php";
require_once "emails/wc-email-header.php";

// Growth hacking
require_once 'orders/wc-get-latest-orders.php';

// Translations
require_once 'translations/wc-translations.php';

if(!function_exists('nb_price_show')):
function nb_price_show() {
    global $product;
    if( $product->is_on_sale() ) {
        return $product->get_sale_price();
    }
    return $product->get_regular_price();
}
endif;

function nb_create_product_filters($atts, $content = null) {   
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 999,
		//'product_cat' => $atts[0],
		//'orderby' => 'rand'
	);
	
	$loop = new WP_Query( $args );
	
	$filters = array();
	
	//echo '<h1 class="upp">Style '.$atts[0].'</h1>';
	echo "<ul class='mylisting'>";
	while ( $loop->have_posts() ) : $loop->the_post(); 
		global $product; 
		$product_id = $loop->post->ID;
				
		echo '<li><a href="'.get_permalink().'">'.get_the_post_thumbnail($product_id, 'thumbnail').'</a></li>';

		$sign_color = get_post_meta( $product_id, 'product_color', true );
		echo $sign_color;
		
	endwhile; 
	
	echo "</ul>";
	
	wp_reset_query(); 
}