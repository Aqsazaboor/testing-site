<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('translate_materials_and_color')):
function translate_materials_and_color($string) {
	$translation = '';
	
	if( strLen($string) < 1 ) {
		return '';
	}
	
	// Hack to not break if statements
	$arrayFromStr = array($string);
	
	if( in_array("material_plastic", $arrayFromStr) || in_array("Plastic", $arrayFromStr) )
	{
		$translation = pll__('Plast');
	}
	elseif( in_array("material_aluminum", $arrayFromStr) || in_array("Aluminium", $arrayFromStr) )
	{
		$translation = pll__('Aluminium');
	}
	elseif( in_array("material_steel", $arrayFromStr) || in_array("Steel", $arrayFromStr) )
	{
		$translation = pll__('Stål');
	}
	elseif( in_array("material_vinyl", $arrayFromStr) || in_array("Vinyl", $arrayFromStr) )
	{
		$translation = pll__('Vinyl');
	}
	elseif( in_array("material_oak", $arrayFromStr) || in_array("Oak", $arrayFromStr) )
	{
		$translation = pll__('Ek');
	}
	elseif( in_array("material_birch", $arrayFromStr) || in_array("Birch", $arrayFromStr) )
	{
		$translation = pll__('Björk');
	}
	elseif( in_array("material_brass", $arrayFromStr) || in_array("Brass", $arrayFromStr) )
	{
		$translation = pll__('Mässing');
	} elseif( in_array("variant_steel", $arrayFromStr) || in_array("Steel", $arrayFromStr) )
	{
		$translation = pll__('Stål');
	}
	elseif( in_array("variant_gold", $arrayFromStr) || in_array("Gold", $arrayFromStr) )
	{
		$translation = pll__('Guld');
	}
	elseif( in_array("variant_black", $arrayFromStr) || in_array("Black", $arrayFromStr) )
	{
		$translation = pll__('Svart');
	}
	elseif( in_array("variant_polished", $arrayFromStr) || in_array("Polished", $arrayFromStr) )
	{
		$translation = pll__('Blank');
	}
	elseif( in_array("variant_brushed", $arrayFromStr) || in_array("Brushed", $arrayFromStr) )
	{
		$translation = pll__('Borstad');
	}
	elseif( in_array("variant_nickelplated", $arrayFromStr) || in_array("NickelPlated", $arrayFromStr) )
	{
		$translation = pll__('Förnicklad');
	}
	elseif( in_array("variant_oxidixed", $arrayFromStr) || in_array("Oxidixed", $arrayFromStr) )
	{
		$translation = pll__('Oxiderad');
	}
	elseif( in_array("variant_brushedoxidixed", $arrayFromStr) || in_array("BrushedOxidixed", $arrayFromStr) )
	{
		$translation = pll__('Borstad/oxiderad');
	}
	elseif( in_array("variant_blue", $arrayFromStr) || in_array("Blue", $arrayFromStr) )
	{
		$translation = pll__('Blå');
	}
	elseif( in_array("variant_pink", $arrayFromStr) || in_array("Pink", $arrayFromStr) )
	{
		$translation = pll__('Rosa');
	}
	elseif( in_array("variant_copper", $arrayFromStr) || in_array("Copper", $arrayFromStr) )
	{
		$translation = pll__('Koppar');
	}
	elseif( in_array("variant_yellow", $arrayFromStr) || in_array("Yellow", $arrayFromStr) )
	{
		$translation = pll__('Gul');
	}
	elseif( in_array("variant_grey", $arrayFromStr) || in_array("Grey", $arrayFromStr) )
	{
		$translation = pll__('Grå');
	}
	elseif( in_array("variant_green", $arrayFromStr) || in_array("Green", $arrayFromStr) )
	{
		$translation = pll__('Grön');
	}
	elseif( in_array("variant_red", $arrayFromStr) || in_array("Red", $arrayFromStr) )
	{
		$translation = pll__('Röd');
	}
	elseif( in_array("variant_white", $arrayFromStr) || in_array("White", $arrayFromStr) )
	{
		$translation = pll__('Vit');
	}
	elseif( in_array("variant_brown", $arrayFromStr) || in_array("Brown", $arrayFromStr) )
	{
		$translation = pll__('Brun');
	}
	elseif( in_array("variant_silver", $arrayFromStr) || in_array("Silver", $arrayFromStr) )
	{
		$translation = pll__('Silver');
	}
	elseif( in_array("variant_chrome", $arrayFromStr) || in_array("Chrome", $arrayFromStr) )
	{
		$translation = pll__('Kromad');
	}
	elseif( in_array("variant_oak", $arrayFromStr) || in_array("Oak", $arrayFromStr) )
	{
		$translation = pll__('Ek');
	}
	elseif( $string == 'variant_none' )
	{
		$translation = '';
	} else {
		$translation = $string;
	}
	
	return $translation;
}
endif;