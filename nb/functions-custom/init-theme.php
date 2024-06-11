<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

add_action('init', function() {
	
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page();	
	}
	
	// Disable Gutenberg
	// add_filter('use_block_editor_for_post', '__return_false');
	
	if(!function_exists('is_product')) {
		function is_product() {
			return null;
		}
	}
	if (!class_exists('ACF')) {
		echo '<div style="color:white;text-align:center;width:100%;padding:10px;background-color:#be8419;">ACF Pro must be installed for this to work!</div>';
	}

	/**
	 * Outputs localized string if polylang exists or  output's not translated one as a fallback
	 *
	 * @param $string
	 *
	 * @return  void
	 */
	if ( !function_exists( 'pll_e' ) ) {
		function pll_e($string) {
			echo $string;
		}
	}
	
	/**
	 * Returns translated string if polylang exists or  output's not translated one as a fallback
	 *
	 * @param $string
	 *
	 * @return string
	 */
	if ( !function_exists( 'pll__' ) ) {
		function pll__($string) {
			return $string;
		}
	}
	
	/**
	 * Returns string if polylang don't exist
	 *
	 * @param $string
	 *
	 * @return string
	 */

	// ---------------------------------------------------
	// Language, strings
	// ---------------------------------------------------
	
	if( function_exists('pll_register_string') ) {
		pll_register_string('nb-home', 'Hem');
		
		// Material
		pll_register_string('material_brass', 'Mässing');
		pll_register_string('material_aluminium', 'Aluminium');
		pll_register_string('material_oak', 'Ek');
		pll_register_string('material_birch', 'Björk');
		pll_register_string('material_plexi', 'Plexiglas');
		pll_register_string('material_plastic', 'Plast');
		
		// Färger
		pll_register_string('variant_white', 'Vit');
		pll_register_string('variant_yellow', 'Gul');
		pll_register_string('variant_red', 'Röd');
		pll_register_string('variant_blue', 'Blå');
		pll_register_string('variant_pink', 'Rosa');
		pll_register_string('variant_green', 'Grön');
		pll_register_string('variant_black', 'Svart');
		pll_register_string('variant_orange', 'Orange');
		pll_register_string('variant_brown', 'Brun');
		pll_register_string('variant_grey', 'Grå');
		pll_register_string('variant_gold', 'Guld');
		pll_register_string('variant_silver', 'Silver');
		pll_register_string('variant_oak', 'Ek');
		pll_register_string('variant_steel', 'Stål');
		
		
		// Annan variant
		pll_register_string('variant_brushed', 'Borstad');
		pll_register_string('variant_polished', 'Blank');
		pll_register_string('variant_copper', 'Koppar');
		pll_register_string('variant_bronze', 'Brons');
		pll_register_string('variant_oxidized', 'Oxiderad');
		pll_register_string('variant_nickelplated', 'Förnicklad');
		pll_register_string('variant_brushedoxidixed', 'Borstad/oxiderad');
		pll_register_string('variant_chrome', 'Kromad');
		
		
		// Designer
		pll_register_string('nb-designer-hide-more-text-fields', 'Dölj textfält');
		pll_register_string('nb-designer-show-more-text-fields', 'Visa mer textfält');
		pll_register_string('nb-designer-sign-interface', 'Fästtyp');
		pll_register_string('nb-designer-interface-tape', 'Dubbelhäftande tejp');
		pll_register_string('nb-designer-interface-militaryclip', 'Militärfäste');
		pll_register_string('nb-designer-interface-safetypin', 'Säkerhetsnål');
		pll_register_string('nb-designer-interface-magnet-metal', 'Magnet metall');
		pll_register_string('nb-designer-interface-magnet-plastic', 'Magnet plast');
		pll_register_string('nb-designer-interface-keyring', 'Nyckelring');
		pll_register_string('nb-designer-fonts', 'Typsnitt');
		pll_register_string('nb-designer-choose-font', 'Välj typsnitt');
		pll_register_string('nb-designer-text-size', 'Välj storlek på texten');
		pll_register_string('nb-designer-text-alignment', 'Textjustering');
		pll_register_string('nb-designer-text-left', 'Vänster');
		pll_register_string('nb-designer-text-center', 'Centrerad');
		pll_register_string('nb-designer-text-right', 'Höger');
		pll_register_string('nb-designer-text-uppercase', 'Versaler');
		pll_register_string('nb-designer-text-italic', 'Snedställd text');
		pll_register_string('nb-designer-text-italic-short', 'Kursiv');
		pll_register_string('nb-designer-text-bold', 'Fet text');
		pll_register_string('nb-designer-add-to-cart', 'Lägg i varukorgen');
		pll_register_string('nb-designer-tags', 'Taggar');
		pll_register_string('nb-designer-entertext', 'Skriv in din text');
		pll_register_string('nb-designer-signcolor', 'Färg');
		pll_register_string('nb-designer-reset', 'Rensa');
		pll_register_string('nb-designer-textsize', 'Textstorlek');
		pll_register_string('nb-designer-text-in-sign', 'Text i skylt');
		pll_register_string('nb-designer-all-text-rows', 'Fler textrader');
		pll_register_string('nb-designer-enter-text', 'Skriv in din text');
		pll_register_string('nb-designer-show_productinformation','Visa produktinformation');
		pll_register_string('nb-designer-screw-included-long','Skruvar ingår i alla våra produkter med skruvhål.');
		pll_register_string('nb-designer-tape-included-long','Dubbelhäftande tejp i alla våra produkter utan skruvhål.');
		pll_register_string('nb-designer-longer-delivery-large-orders','Vid större beställningar kan leveranstid ligga på upp till två veckor.');
		pll_register_string('nb-designer-motif-to-big', 'Hoppsan, motivet är för stort för skylten.');
		
		
		pll_register_string('nb-designer-reserved', 'Med reservation för felskrivningar.');
		pll_register_string('nb-designer-row1', 'Textrad 1');
		pll_register_string('nb-designer-row2', 'Textrad 2');
		pll_register_string('nb-designer-row3', 'Textrad 3');
		pll_register_string('nb-designer-row4', 'Textrad 4');
		pll_register_string('nb-designer-row5', 'Textrad 5');
		pll_register_string('nb-designer-stock', 'Finns i lager');
		pll_register_string('nb-designer-outofstock', 'Slut i lager');
		pll_register_string('nb-designer-outofstock-long', 'Varan slut i lager.');
		
		pll_register_string('nb-designer-laserengraving', 'Lasergravyr');
		pll_register_string('nb-designer-deepengraving', 'Lackfylld djupgravyr');
		pll_register_string('nb-designer-unfilled-deepengraving', 'Oifylld djupgravyr');
		pll_register_string('nb-designer-screws-included', 'Skruvar ingår');
		pll_register_string('nb-designer-tape-included', 'Dubbelhäftande tejp ingår');
		pll_register_string('nb-designer-keyring-included', 'Nyckelring ingår');
		
		pll_register_string('trust_safe_ecommerce', 'Trygg E-handel');
		pll_register_string('trust_quality_engraving', 'Kvalitativ gravyr');
		pll_register_string('trust_delivery', 'Skickas inom en vecka');
		pll_register_string('produced_in_sweden', 'Produceras i Sverige');
		pll_register_string('flat_rate_shipping', 'Frakt 39 kr (fast pris)');
		
		pll_register_string('shopping_basket', 'Varukorg');
		pll_register_string('shopping_basket_summary', 'Summering');
		pll_register_string('shopping_basket_your_order', 'Din beställning');
		pll_register_string('shopping_basket_page_sum', 'Delsumma');
		pll_register_string('shopping_basket_goto_checkout', 'Gå till kassan');

		
		pll_register_string('nb-in-stock', 'Finns i lager');
		pll_register_string('nb-sent-withing-a-week', 'Skickas inom 7 dagar');
	
		pll_register_string('nb-price', 'Pris');
		pll_register_string('nb-price-exvat', 'exkl. moms');
		
		// Product
		pll_register_string('nb-product-description', 'Produktinformation');
		pll_register_string('nb-product-size', 'Storlek');
		pll_register_string('nb-product-screw', 'Skruv');
	
		pll_register_string('nb-designer-close-texteditor', 'Stäng text-editor');
		pll_register_string('nb-designer-close-modal', 'Stäng modal');
		
		// Footer
		pll_register_string('nb-customer-service', 'Kundtjänst');
		pll_register_string('nb-important-pages', 'Viktiga sidor');
		pll_register_string('nb-about-us', 'Om oss');
		
		// Vanlig text
		pll_register_string('nb-categories', 'Kategorier');
		pll_register_string('nb-products', 'Produkter');
		pll_register_string('nb-email', 'E-post');
		pll_register_string('nb-telephone', 'Telefon');
		pll_register_string('nb-terms', 'Köpvillkor');
		pll_register_string('nb-welcome', 'Välkommen');
		pll_register_string('nb-count-products', 'Skyltar');
		pll_register_string('nb-sign-look', 'Utförande');
		pll_register_string('nb-approve', 'Jag godkänner');
		pll_register_string('nb-close', 'Stäng');
		pll_register_string('nb-menu', 'Meny');
		pll_register_string('nb-go-back', 'Tillbaka');
		pll_register_string('nb-material-title', 'Material');
		pll_register_string('nb-base-price', 'Grundpris');
		pll_register_string('nb-engraving-type', 'Gravyrtyp');
		pll_register_string('nb-we-just-sold', 'Vi sålde precis en');
		pll_register_string('nb-faq-title', 'Vanliga frågor');
		pll_register_string('nb-page-not-found', 'Page could not be found.');
		pll_register_string('nb-checkout-faq-header', 'Det är enkelt att handla hos Skyltdax.se!');
		pll_register_string('nb-category-colon', 'Category:');
		pll_register_string('nb-tage-colon', 'Tags:');
		pll_register_string('nb-sale', 'Rabatt!');
		pll_register_string('nb-search', 'Sök');
		pll_register_string('nb-choose-product', 'Välj och anpassa design');
		
		pll_register_string('nb-about-quote', 'Tack för mycket snabb och bra tjänst! Skylten blev mycket elegant! / Patrick');
		pll_register_string('nb-about-trustpilot-link', 'Se våra omdömmen på Trustpilot');
		pll_register_string('nb-loading', 'Laddar');
		pll_register_string('nb-show-product', 'Visa produkt');
		
		// Footer
		pll_register_string('nb-reseller', 'Återförsäljare');
		pll_register_string('nb-orgnumber', 'Orgnummer');		
		pll_register_string('nb-address', 'Adress');
		
		pll_register_string('nb-about-skyltdax', 'Om Skyltdax');
		pll_register_string('nb-about-my-account', 'Mitt konto');
		pll_register_string('nb-about-login', 'Logga in');
		
		// Site names
		pll_register_string('nb-about-skyltdax', 'Skyltdax.se');
		pll_register_string('nb-about-ovikilpi', 'ovikilpi.fi');
		pll_register_string('nb-about-24signs', '24signs.co.uk');
		pll_register_string('nb-about-24skilte', '24skilte.dk');
		pll_register_string('nb-about-turschilder', 'Turschilder.de');
		pll_register_string('nb-about-deurbordje24', 'Deurbordje24.nl');

		// Filters
		pll_register_string('nb-filters-filter', 'Filter');
		pll_register_string('nb-filters-clear-filters', 'Rensa filter');
		pll_register_string('nb-filters-all-materials', 'Alla material');
		pll_register_string('nb-filters-all-shapes', 'Alla former');
		pll_register_string('nb-filters-all-interfaces', 'Alla fästmetoder');
		pll_register_string('nb-filters-none-found', 'Inga produkter som matchade din filtrering hittades.');
		
		// Woocommerce translations
		pll_register_string('wc-subtotal', 'Subtotal');
		pll_register_string('wc-subtotal-colon', 'Subtotal:');
		pll_register_string('wc-related-products', 'Related products');
		pll_register_string('wc-you-may-also-like', 'You may also like...');
		pll_register_string('wc-shipping', 'Shipping');
		pll_register_string('wc-shipping-colon', 'Shipping:');
		pll_register_string('wc-proceed-to-checkout', 'Proceed to checkout');
		pll_register_string('wc-apply-coupon', 'Apply coupon');
		pll_register_string('wc-coupon-code', 'Coupon code');
		pll_register_string('wc-update-cart', 'Update cart');
		pll_register_string('wc-total', 'Total');
		pll_register_string('wc-total-color', 'Total:');
		pll_register_string('wc-view-cart', 'View cart');
		pll_register_string('wc-checkout', 'Checkout');
		pll_register_string('wc-shipping-to', 'Shipping to');
		pll_register_string('wc-product', 'Product');
		pll_register_string('wc-quantity', 'Quantity');
		pll_register_string('wc-price', 'Price');
		pll_register_string('wc-have-a-coupon', 'Have a coupon?');
		pll_register_string('wc-enter-your-code', 'Click here to enter your code');
		pll_register_string('wc-place-order', 'Place order');
		pll_register_string('wc-order-details', 'Order details');
		pll_register_string('wc-shipping-address', 'Shipping address');
		pll_register_string('wc-billing-address', 'Billing address');
		pll_register_string('wc-payment-method', 'Payment method:');
		pll_register_string('wc-order-number', 'Order number:');
		pll_register_string('wc-date', 'Date:');
		pll_register_string('wc-email-colon', 'Email:');
		pll_register_string('wc-thank-you-order', 'Thank you. Your order has been received.');
		pll_register_string('wc-default-sorting', 'Default sorting');
		pll_register_string('wc-sort-popularity', 'Sort by popularity');
		pll_register_string('wc-sort-latest', 'Sort by latest');
		pll_register_string('wc-sort-low-high', 'Sort by price: low to high');
		pll_register_string('wc-sort-high-low', 'Sort by price: high to low');

		// Dashboard
		pll_register_string('wc-ma-dashboard', 'Dashboard');
		pll_register_string('wc-ma-orders', 'Orders');
		pll_register_string('wc-ma-addresses', 'Addresses');
		pll_register_string('wc-ma-account-details', 'Account details');
		pll_register_string('wc-ma-first-name', 'First name');
		pll_register_string('wc-ma-last-name', 'Last name');
		pll_register_string('wc-ma-save-changes', 'Save changes');
		pll_register_string('wc-ma-email-address', 'Email address');
		pll_register_string('wc-ma-password-change', 'Password change');
		pll_register_string('wc-ma-logut', 'Log out');
		pll_register_string('wc-ma-logut', 'Your cart is currently empty.');
		pll_register_string('wc-ma-return-to-shop', 'Return to shop');
		pll_register_string('wc-ma-coupon', 'Coupon');
		pll_register_string('wc-ma-coupon-color', 'Coupon:');
		pll_register_string('wc-ma-coupon-removed', 'Coupon has been removed.');
		pll_register_string('wc-ma-coupon-applied', 'Coupon code applied successfully.');
		pll_register_string('wc-ma-cart-updated', 'Cart updated.');
		pll_register_string('wc-ma-order-notes', 'Order notes');
		pll_register_string('wc-ma-optional', '(optional)');
		pll_register_string('wc-ma-order-notes-paragraph', 'Notes about your order, e.g. special notes for delivery.');
		pll_register_string('wc-ma-undo', 'Undo?');
		pll_register_string('wc-ma-remove', 'Remove');
		pll_register_string('wc-ma-remove-extra', '[Remove]');
		pll_register_string('wc-ma-save-address', 'Save address');
		pll_register_string('wc-ma-login-button', 'Login');
		pll_register_string('wc-ma-browser-products', 'Browse products');
		pll_register_string('wc-ma-no-order-made', 'No order has been made yet.');
		pll_register_string('wc-ma-confirm-password', 'Confirm new password');
		pll_register_string('wc-ma-username-or-email-address', 'Username or email address');
		pll_register_string('wc-ma-lost-password', 'Lost your password?');
		pll_register_string('wc-ma-password', 'Password');
		pll_register_string('wc-ma-following-addresses', 'The following addresses will be used on the checkout page by default.');
		pll_register_string('wc-ma-shipping-costs-calculated', 'Shipping costs are calculated during checkout.');
		pll_register_string('wc-ma-street-address', 'Street address');
		pll_register_string('wc-ma-postcode-zip', 'Postcode / ZIP');
		pll_register_string('wc-ma-phone', 'Phone');
		pll_register_string('wc-ma-town-city', 'Town / City');
		pll_register_string('wc-ma-country-region', 'Country / Region');
		pll_register_string('wc-ma-country-region', 'House number and street name');
		pll_register_string('wc-ma-country-region', 'Company name');
	
		pll_register_string('wc-ma-current-password-leave-blank', 'Current password (leave blank to leave unchanged)');
		pll_register_string('wc-ma-new-password-leave-blank', 'New password (leave blank to leave unchanged)');
		// Shipping options will be updated during checkout.
		
		// Text
		pll_register_string('wc-ma-new-password-leave-blank', 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.');
		
	} else {
		echo '<div style="color:white;text-align:center;width:100%;padding:10px;background-color:orange;">You must install Polylang plugin to make this theme work.</div>';
	}
	
});

/**
 * @snippet       New Products Table Column @ WooCommerce Admin
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
/*
add_filter( 'manage_edit-product_columns', 'bbloomer_admin_products_visibility_column', 9999 );
 
function bbloomer_admin_products_visibility_column( $columns ){
   $columns['visibility'] = 'Visibility';
   return $columns;
}
 
add_action( 'manage_product_posts_custom_column', 'bbloomer_admin_products_visibility_column_content', 10, 2 );
 
function bbloomer_admin_products_visibility_column_content( $column, $product_id ){
    if ( $column == 'visibility' ) {
        $product = wc_get_product( $product_id );
      echo $product->get_catalog_visibility();
    }
}
*/

// Generate
// require_once "generate-products/generate-products.php";

// Custom Admin Page
require_once 'custom-order-page/init.php';
require_once 'woocommerce-dashboard-widget/woocommerce-dashboard-widget.php';

// Faq
require_once 'faq/faq-custom-post-type.php';

// Helpers
require_once 'helpers/get-product-filter-functions.php';
require_once 'helpers/get-site-langugage-id-function.php';
require_once 'helpers/get-single-product-object.php';

// Frontend
require_once 'config/preload-fonts-in-header.php';
require_once 'menu-drawer/menu-drawer.php';
require_once 'acf-fields-for-site.php';
require_once 'config/add-site-settings-to-footer.php';
require_once 'cookie-consent/cookie-consent.php';
require_once "config/silence-jquery-migrate.php";
require_once 'config/get-google-analytics-code.php';
require_once 'config/google-datalayer-functions.php';
require_once 'config/get-trustpilot-code.php';
require_once 'config/editor-fonts.php';
require_once 'config/editor-text-sizes.php';
require_once 'config/configure-acf-options-fields.php';
require_once 'config/configure-acf-frontpage-fields.php';
require_once 'config/configure-acf-landing-page-fields.php';
require_once 'config/configure-acf-editor-product-image.php';
require_once 'config/clean-wordpress-identifiers-body.php';
require_once 'config/limit-search-to-products.php';
require_once 'config/hide-categories-from-loop.php';
require_once 'config/get-trust-icons.php';
require_once 'languages/wc-translate-materials-and-color.php';
require_once 'languages/wc-translate-engraving-types.php';
require_once 'languages/add-language-string-to-footer.php';
require_once 'microsoft-clarity/install-microsoft-clarity.php';

// Site functions
require_once 'site-header/nb-site-meta.php';
require_once 'site-header/nb-site-message.php';
require_once 'site-header/nb-shop-promises.php';
require_once 'site-header/nb-site-navbar.php';
require_once 'site-header/nb-shop-categories-bar.php';
require_once 'site-header/nb-site-search-bar.php';
require_once 'olark-script/olark-script.php';

// Gutenberg functionality
require_once 'gutenberg/init-gutenberg-functionality.php';

// Fabric editor
require_once 'fabric-editor/fabric-editor.php';

// Backend
require_once 'form-validator.php';
require_once 'enqueue-scripts.php';
require_once 'vueeditor/preload-fonts.php';
require_once 'vueeditor/vueeditor.php';
require_once 'woocommerce/init.php';
require_once 'languages/wc-find-language-string-in-json.php';

// Admin
require_once 'wordpress-multisite/init.php';
require_once 'wordpress-multisite/wm-admin-hide-wp-logo.php';



