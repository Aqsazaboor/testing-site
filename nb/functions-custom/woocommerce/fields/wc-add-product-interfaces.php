<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// --------------------------------------------
// Get sign interface
// --------------------------------------------

// Get language strings
if(!function_exists('get_interface_langString')) {
	function get_interface_langString($interfaceString) {
		if( strLen($interfaceString) < 1 ) {
			return '';
		}
		
		// Hack to not break if statements
		$arrayFromStr = array($interfaceString);
		
		if( in_array("sign_interface_tape", $arrayFromStr) || in_array("tape", $arrayFromStr) )
		{
			$translation = pll__('Dubbelhäftande tejp');
		}
		elseif( in_array("sign_interface_militaryclip", $arrayFromStr) || in_array("militaryclip", $arrayFromStr) )
		{
			$translation = pll__('Militärfäste');
		}
		elseif( in_array("sign_interface_safetypin", $arrayFromStr) || in_array("safetypin", $arrayFromStr) )
		{
			$translation = pll__('Säkerhetsnål');
		}
		elseif( in_array("sign_interface_metalmagnet", $arrayFromStr) || in_array("metalmagnet", $arrayFromStr) )
		{
			$translation = pll__('Magnet metall');
		}
		elseif( in_array("sign_interface_plasticmagnet", $arrayFromStr) || in_array("plasticmagnet", $arrayFromStr) )
		{
			$translation = pll__('Magnet plast');
		}
		elseif( in_array("sign_interface_keyring", $arrayFromStr) || in_array("keyring", $arrayFromStr) )
		{
			$translation = pll__('Nyckelring');
		}
		elseif( in_array("sign_interface_screw", $arrayFromStr) || in_array("screw", $arrayFromStr) )
		{
			$translation = pll__('Skruv');
		} else {
			$translation = $interfaceString;
		}
		
		return $translation;
	}
}

if(!function_exists('nb_get_product_interfaces')):
function nb_get_product_interfaces($post_ID, $asString = false) {
	
	$interface_array = array();

	$signInterfaceTape = get_post_meta( $post_ID, 'sign_interface_tape' );
	$signInterfaceMilitaryclip = get_post_meta( $post_ID, 'sign_interface_militaryclip' );
	$signInterfaceSafetypin = get_post_meta( $post_ID, 'sign_interface_safetypin' );
	$signInterfaceMetalmagnet = get_post_meta( $post_ID, 'sign_interface_metalmagnet' );
	$signInterfacePlasticmagnet = get_post_meta( $post_ID, 'sign_interface_plasticmagnet' );
	$signInterfaceKeyring = get_post_meta( $post_ID, 'sign_interface_keyring' );
	$signInterfaceScrew = get_post_meta( $post_ID, 'sign_interface_screw' );

	if(count($signInterfaceTape) != 0 && $signInterfaceTape[0] == 'yes') {
		if($asString) {
			$interface_array['sign_interface_tape'] = 'tape';
		} else {
			array_push($interface_array, 'sign_interface_tape');
		}
	}
	
	if(count($signInterfaceMilitaryclip) != 0 && $signInterfaceMilitaryclip[0] == 'yes') {
		if($asString) {
			$interface_array['sign_interface_militaryclip'] = 'militaryclip';
		} else {
			array_push($interface_array, 'sign_interface_militaryclip');
		}
	}
	
	if(count($signInterfaceSafetypin) != 0 && $signInterfaceSafetypin[0] == 'yes') {
		if($asString) {
			$interface_array['sign_interface_safetypin'] = 'safetypin';
		} else {
			array_push($interface_array, 'sign_interface_safetypin');
		}
	}
	
	if(count($signInterfaceMetalmagnet) != 0 && $signInterfaceMetalmagnet[0] == 'yes') {
		if($asString) {
			$interface_array['sign_interface_metalmagnet'] = 'metalmagnet';
		} else {
			array_push($interface_array, 'sign_interface_metalmagnet');
		}
	}
	
	if(count($signInterfacePlasticmagnet) != 0 && $signInterfacePlasticmagnet[0] == 'yes') {
		if($asString) {
			$interface_array['sign_interface_plasticmagnet'] = 'plasticmagnet';
		} else {
			array_push($interface_array, 'sign_interface_plasticmagnet');
		}
	}

	if(count($signInterfaceKeyring) != 0 && $signInterfaceKeyring[0] == 'yes') {
		if($asString) {
			$interface_array['sign_interface_keyring'] = 'keyring';
		} else {
			array_push($interface_array, 'sign_interface_keyring');
		}
	}

	if(count($signInterfaceScrew) != 0 && $signInterfaceScrew[0] == 'yes') {
		if($asString) {
			$interface_array['sign_interface_screw'] = 'screw';
		} else {
			array_push($interface_array, 'sign_interface_screw');
		}
	}
	
	// Must have value, is always true...
	if( $asString ) {
		// Return string
		return implode( ' ', $interface_array );
	} else {
		// Return array
		return $interface_array;
	}
}
endif;