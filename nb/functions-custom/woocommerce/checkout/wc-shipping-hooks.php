<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists("wc_add_shipping_logotypes")):
function wc_add_shipping_logotypes( $method, $index ) {
	if(isset($method->label)) {
		$shippingMethod = strtolower($method->label);
		// Sverige
		if ($method->label && str_contains($shippingMethod, 'postnord')) {
			echo '<div class="service-logo se-postnord"><span class="sr-only">Postnord</span></div>';
		}
		// Finland
		if ($method->label && str_contains($shippingMethod, 'posti')) {
			echo '<div class="service-logo fi-posti"><span class="sr-only">Posti</span></div>';
		}
		// England
		if ($method->label && str_contains($shippingMethod, 'royal')) {
			echo '<div class="service-logo uk-post"><span class="sr-only">Royal Mail</span></div>';
		}
		if ($method->label && str_contains($shippingMethod, 'deutsche')) {
			echo '<div class="service-logo de-post"><span class="sr-only">Deutsche Post</span></div>';
		}
		
		if ($method->label && str_contains($shippingMethod, 'dhl')) {
			echo '<div class="service-logo dhl"><span class="sr-only">DHL</span></div>';
		}
		if ($method->label && str_contains($shippingMethod, 'ups')) {
			echo '<div class="service-logo ups"><span class="sr-only">UPS</span></div>';
		}
		if ($method->label && str_contains($shippingMethod, 'fedex')) {
			echo '<div class="service-logo fedex"><span class="sr-only">FedEx</span></div>';
		}
	}
}
add_filter('woocommerce_after_shipping_rate', 'wc_add_shipping_logotypes', 10, 2);
endif;