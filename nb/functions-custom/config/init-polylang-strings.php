<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(function_exists('nb_register_pll_string')):
function nb_register_pll_string() {
	pll_register_string('nb-home', 'Hem');
	
	// Material
	pll_register_string('material_brass', 'Mässing');
	pll_register_string('material_aluminium', 'Aluminium');
	pll_register_string('material_oak', 'Ek');
	pll_register_string('material_birch', 'Björk');
	pll_register_string('material_plexi', 'Plexiglas');
	pll_register_string('material_steel', 'Stål');
	
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

	// Annan variant
	pll_register_string('variant_brushed', 'Borstad');
	pll_register_string('variant_polished', 'Blank');
	pll_register_string('variant_copper', 'Koppar');
	pll_register_string('variant_bronze', 'Brons');
	pll_register_string('variant_oxidized', 'Oxiderad');
	pll_register_string('variant_nickelplated', 'Förnicklad');
	pll_register_string('variant_brushedoxidixed', 'Borstad / oxiderad');
	pll_register_string('variant_chrome', 'Kromad');
	pll_register_string('variant_copper', 'Koppar');
	
	// Designer
	pll_register_string('nb-designer-hide-more-text-fields', 'Dölj textfält');
	pll_register_string('nb-designer-show-more-text-fields', 'Visa mer textfält');
	pll_register_string('nb-designer-sign-interface', 'Fästtyp');
	pll_register_string('nb-designer-interface-tape', 'Dubbelhäftande tejp');
	pll_register_string('nb-designer-interface-militaryclip', 'Militärfäste');
	pll_register_string('nb-designer-interface-safetypin', 'Säkerhetsnål');
	pll_register_string('nb-designer-interface-magnet-metal', 'Magnet metall');
	pll_register_string('nb-designer-interface-magnet-plastic', 'Magnet plast');
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
	
	pll_register_string('nb-designer-row1', 'Textrad 1');
	pll_register_string('nb-designer-row2', 'Textrad 2');
	pll_register_string('nb-designer-row3', 'Textrad 3');
	pll_register_string('nb-designer-row4', 'Textrad 4');
	pll_register_string('nb-designer-row5', 'Textrad 5');
	
	pll_register_string('nb-designer-stock', 'Finns i lager');
	pll_register_string('nb-designer-laserengraving', 'Lasergravyr');
	pll_register_string('nb-designer-deepengraving', 'Lackfylld djupgravyr');
	pll_register_string('nb-designer-screws-included', 'Skruvar ingår');
	
	pll_register_string('trust_safe_ecommerce', 'Trygg E-handel');
	pll_register_string('trust_quality_engraving', 'Kvalitativ gravyr');
	pll_register_string('trust_delivery', 'Skickas inom en vecka');
	pll_register_string('produced_in_sweden', 'Produceras i Sverige');
	pll_register_string('flat_rate_shipping', 'Frakt 39 kr (fast pris)');
	
	pll_register_string('shopping_basket', 'Varukorg');
	
	pll_register_string('nb-in-stock', 'Finns i lager');
	pll_register_string('nb-sent-withing-a-week', 'Skickas inom 7 dagar');

	pll_register_string('nb-price', 'Pris');
	pll_register_string('nb-price-exvat', 'exkl. moms');
	pll_register_string('nb-price-inclvat', '(inkl. moms)');
	
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
	pll_register_string('nb-products', 'Produkter');
	pll_register_string('nb-email', 'E-post');
	pll_register_string('nb-telephone', 'Telefon');
	
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
}
endif;