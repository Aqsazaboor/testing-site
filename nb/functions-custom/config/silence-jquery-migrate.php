<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

// silencer script

// This breaks console.log

// if(!function_exists('jquery_migrate_silencer')) {
// 	function jquery_migrate_silencer() {
// 		// create function copy
// 		$silencer = '<script>window.console.logger = window.console.log; ';
// 		// modify original function to filter and use function copy
// 		$silencer .= 'window.console.log = function(tolog) {';
// 		// bug out if empty to prevent error
// 		$silencer .= 'if (tolog == null) {return;} ';
// 		// filter messages containing string
// 		$silencer .= 'if (tolog.indexOf("Migrate is installed") == -1) {';
// 		$silencer .= 'console.logger(tolog);} ';
// 		$silencer .= '}</script>';
// 		return $silencer;
// 	}

// 	// for the frontend, use script_loader_tag filter
// 	add_filter('script_loader_tag','jquery_migrate_load_silencer', 10, 2);
// 	function jquery_migrate_load_silencer($tag, $handle) {
// 		if ($handle == 'jquery-migrate') {
// 			$silencer = jquery_migrate_silencer();
// 			// prepend to jquery migrate loading
// 			$tag = $silencer.$tag;
// 		}
// 		return $tag;
// 	}
// }
