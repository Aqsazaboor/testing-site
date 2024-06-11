<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if( !function_exists('get_site_details') ):
function get_site_details() {
	
	$countriesObj = '{
		"sv" : {
			"name" : "Skyltdax.se",
			"url" : "https://www.skyltdax.se",
			"lang_code" : "sv",
			"language" : "Svenska"
		},
		"dk" : {
			"name" : "24skilte.dk",
			"url" : "https://www.24skilte.dk",
			"lang_code" : "dk",
			"language" : "Dansk"
		},
		"fi" : {
			"name" : "Ovikilpi.fi",
			"url" : "https://www.ovikilpi.fi",
			"lang_code" : "fi",
			"language" : "Suomalainen"
		},
		"de" : {
			"name" : "Turschilder.de",
			"url" : "https://www.turschilder.de",
			"lang_code" : "de",
			"language" : "Deutsche"
		},
		"en" : {
			"name" : "24signs.co.uk",
			"url" : "https://www.24signs.co.uk",
			"lang_code" : "en",
			"language" : "English"
		},
		"nl" : {
			"name" : "Deurbordje24.nl",
			"url" : "https://www.deurbordje24.nl",
			"lang_code" : "nl",
			"language" : "Nederlands"
		}
	}';
	
	return $countriesObj;
}
endif;