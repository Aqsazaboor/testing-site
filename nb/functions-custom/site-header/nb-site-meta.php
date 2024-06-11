<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_site_meta')):
function nb_site_meta() {
?>

<?php
$siteLanguage = '';
if(function_exists('get_site_language')) {
	$siteLanguage = get_site_language();
} else {
	$siteLanguage = 'sv';
}

if( $siteLanguage != 'sv' ) {
	echo "<link rel='alternate' href='https://www.skyltdax.se/' hreflang='sv-se' />\n";
} else if( $siteLanguage != 'da' ) {
	echo "<link rel='alternate' href='https://www.24skilte.dk/' hreflang='da-dk' />\n";
} else if( $siteLanguage != 'fi' ) {
	echo "<link rel='alternate' href='https://www.ovikilpi.fi/' hreflang='fi-fi' />\n";
} else if( $siteLanguage != 'de' ) {
	echo "<link rel='alternate' href='https://www.turschilder.de/' hreflang='de-de' />\n";
} else if( $siteLanguage != 'en' ) {
	echo "<link rel='alternate' href='https://www.24signs.co.uk/' hreflang='en-gb' />\n";
} else if( $siteLanguage != 'nl' ) {
	echo "<link rel='alternate' href='https://www.deurbordje24.nl/' hreflang='nl-nl' />\n";
} else if( $siteLanguage != 'fr' ) {
	echo "<link rel='alternate' href='https://www.24plaques.fr/' hreflang='fr-fr' />\n";
}
?>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="msvalidate.01" content="EEC82FFD19715ECE29E3476AA5366941" />
<meta name="p:domain_verify" content="a42ad6f5c42d45989a3c690455633575"/>
<link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/favicon.png' ); ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/favicon.png' ); ?>" type="image/x-icon" />
<?php
}
endif;


if(!function_exists('nb_prefetch')):
function nb_prefetch() {
/*
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
*/
?>
<link rel="preconnect" href="https://widget.trustpilot.com">
<link rel="preconnect" href="https://connect.facebook.net">
<link rel="dns-prefetch" href="https://widget.trustpilot.com" />
<link rel="dns-prefetch" href="https://connect.facebook.net" />
<?php
}
add_action('wp_head', 'nb_prefetch');
endif;