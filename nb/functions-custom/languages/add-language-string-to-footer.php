<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('add_language_string_to_footer')):
function add_language_string_to_footer() {
	$language = array(
		"clear_design" => pll__('Rensa'),
		"out_of_stock" => pll__('Varan slut i lager.'),
		"in_stock" => pll__('Finns i lager'),
		"ex_vat" => pll__('exkl. moms'),
		"bold" => pll__('Fet text'),
		"close" => pll__('Stäng'),
		"italic" => pll__('Kursiv'),
		"font" => pll__('Typsnitt'),
		"textsize" => pll__('Textstorlek'),
		"uppercase" => pll__('Versaler'),
		"text_in_sign" => pll__('Text i skylt'),
		"left_aligned" => pll__('Vänsterställd text'),
		"center_aligned" => pll__('Centrera text'),
		"right_aligned" => pll__('Högerställd text'),
		"extra_textrows" => pll__('Fler textrader'),
		"shipping_cost" => pll__('Frakt 39 kr (fast pris)'),
		"delivery_times" => pll__('Skickas inom en vecka'),
		"large_orders" => pll__('Vid större beställningar kan leveranstid ligga på upp till två veckor.'),
		"reservation" => pll__('Med reservation för felskrivningar.'),
		"show_product_information" => pll__('Visa produktinformation'),
		"enter_text" => pll__('Skriv in din text'),
		"sku" => pll__('SKU'),
		"terms" => pll__('Köpvillkor'),
		"material" => pll__('Material'),
		"variant" => pll__('Utförande'),
		"size" => pll__('Storlek'),
		"add_to_cart" => pll__('Lägg i varukorgen'),
		"designer_tip" => get_field('designer_tip','option'),
		"material_title" => pll__('Material'),
		"base_price" => pll__('Grundpris'),
		"screws_included" => pll__('Skruvar ingår i alla våra produkter med skruvhål.'),
		"tape_included" => pll__('Dubbelhäftande tejp i alla våra produkter utan skruvhål.'),
		"screws_included_short" => pll__('Skruvar ingår'),
		"tape_included_short" => pll__('Dubbelhäftande tejp ingår'),
		"keyring_included_short" => pll__('Nyckelring ingår'),
		"engraving_type" => pll__('Gravyrtyp'),
		"laser_engraving" => pll__('Lasergravyr'),
		"laquer_engraving" => pll__('Lackfylld djupgravyr'),
		"laquer_unfilled_engraving" => pll__('Oifylld djupgravyr'),
		"sign_interface_tape" => pll__('Dubbelhäftande tejp'),
		"sign_interface_militaryclip" => pll__('Militärfäste'),
		"sign_interface_screws" => pll__('Skruvar ingår'),
		"sign_interface_safetypin" => pll__('Säkerhetsnål'),
		"sign_interface_metalmagnet" => pll__('Magnet metall'),
		"sign_interface_plasticmagnet" => pll__('Magnet plast'),
		"sign_interface_keyring" => pll__('Nyckelring'),
		"currency_symbol" => get_woocommerce_currency_symbol(),
		"choose_product" => pll__('Välj och anpassa design'),
		"products" => pll__('Produkter'),
		"filters" => pll__('Filter'),
		"clear_filters" => pll__('Rensa filter'),
		"filter_no_products_found" => pll__('Inga produkter som matchade din filtrering hittades.'),
		"all_materials" => pll__('Alla material'),
		"all_shapes" => pll__('Alla former'),
		"all_interfaces" => pll__('Alla fästmetoder'),
		'material_brass' => pll__('Mässing'),
		'material_aluminium' => pll__('Aluminium'),
		'material_oak' => pll__('Ek'),
		'material_birch' => pll__('Björk'),
		'material_plexi' => pll__('Plexiglas'),
		'material_plastic' => pll__('Plast'),
		'loading' => pll__('Laddar'),
		'show_product' => pll__('Visa produkt'),
		'sale' => pll__('Rabatt'),
		'interface_application' => pll__('Fästtyp'),
		'motif_to_big' => pll__('Hoppsan, motivet är för stort för skylten.'),
	);
	$output = '<script>';
	$output .= "const language_string = " . ($language ? json_encode($language) : '{}') . ";";
	$output .= '</script>';

	echo $output;
}
add_action( 'wp_footer', 'add_language_string_to_footer', 10 );
endif;