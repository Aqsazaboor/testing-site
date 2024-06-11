<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('gb_get_tags_class')):
function gb_get_tags_class($tags) {
	$tagsClasses = array();
	if($tags) {
		foreach ( $tags as $tagsItem ) {
			if($tagsItem->slug) {
				array_push( $tagsClasses, sanitize_title($tagsItem->slug) );
			}
		}
	}
	return implode(" ", $tagsClasses);
}
endif;

if(!function_exists('gb_get_material_class')):
function gb_get_material_class($materials) {
	$materialClasses = array();
	if($materials) {
		foreach ( $materials as $materialItem ) {
			if($materialItem->slug) {
				array_push( $materialClasses, sanitize_title($materialItem->slug) );
			}
		}
	}
	return implode(" ", $materialClasses);
}
endif;

if(!function_exists('gb_get_interface_class')):
function gb_get_interface_class($interfaces) {
	$interfaceClasses = array();
	if($interfaces) {
		foreach ( $interfaces as $interfaceItem ) {
			if($interfaceItem) {
				array_push( $interfaceClasses, sanitize_title($interfaceItem) );
			}
		}
	}
	return implode(" ", $interfaceClasses);
}
endif;
