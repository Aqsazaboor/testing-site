<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_get_trusticons')):
function nb_get_trusticons($type = "list") {

    if(function_exists('get_site_language')) {
		$siteLanguage = get_site_language();
	} else {
		$siteLanguage = 'sv';
	}

    $trustIcons = array(
        "klarna" => array("image" => "/images/svg/po-klarna.svg", "class" => "klarna"),
        "mastercard" => array("image" => "images/svg/po-mastercard.svg", "class" => "mastercard"),
        "swish" => array("image" => "images/svg/po-swish.svg", "class" => "swish"),
        "visa" => array("image" => "/images/svg/po-visa.svg", "class" => "visa"),
    );

    if( $type == "array" ) {
        return $trustIcons;
    } elseif($type == "list") {
        $output = '<li class="payment-merchant"><div class="service-logo klarna"><span class="is-sr-only">Klarna Logo</span></div></li>';
        $output .= '<li class="payment-merchant"><div class="service-logo mastercard"><span class="is-sr-only">Mastercard Logo</span></div></li>';
        if( $siteLanguage == 'sv' ) {
            $output .= '<li class="payment-merchant"><div class="service-logo swish"><span class="is-sr-only">Swish Logo</span></div></li>';
        }
        $output .= '<li class="payment-merchant"><div class="service-logo visa"><span class="is-sr-only">Visa Logo</span></div></li>';

        return $output;
    }
}
endif;