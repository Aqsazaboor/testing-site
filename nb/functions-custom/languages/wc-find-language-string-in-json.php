<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !function_exists('pll_e') ) {
	function pll_e($searchString) {

		// Get languages JSON file generated by Google Docs
		$languageJSON = file_get_contents(plugin_dir_path(__FILE__) . "languages.json");
		  
		// Decode the JSON file
		$json_data = json_decode($languageJSON, true);
		
		if($json_data) {
			$whatCountry = get_site_language();
			$countryStrings = array();
			
			foreach($json_data as $langString) { //foreach element in $arr
				if( $langString['langid'] == $whatCountry) {
					$countryStrings = $langString['strings'];
				}
			}

			if($countryStrings) {
				$totalString = count($countryStrings);
				$index = 1;
				foreach ($countryStrings as $key => $langString) {
					if( $key == $searchString ) {
						echo $langString;
						break;				
					} else {
						if($index == $totalString) {
							echo 'String missing.';
						}						
					}
					$index++;
				}		
			}
	
		}
	}
}