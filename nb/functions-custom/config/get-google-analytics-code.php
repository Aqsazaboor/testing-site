<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if( function_exists('get_field')):
	if(get_field('google_analytics_tag','options')) {
		// GTM Scripts
		function nb_add_gtm_to_head() {
			$getGTMtag = get_field('google_analytics_tag','options');

// <!-- Google Tag Manager -->
?>
<script>
window.dataLayer = window.dataLayer || [];
</script>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo $getGTMtag; ?>');</script>

<?php
// <!-- End Google Tag Manager -->
// Removed, use GTM instead
/*
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $getG4Tag; ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', '<?php echo $getG4Tag; ?>');
</script>
<!-- End Google tag (gtag.js) -->
*/

			}
			add_action('wp_head', 'nb_add_gtm_to_head', 1);
		

			// GTM Scripts
			if(!function_exists('nb_add_gtm_to_body')):
			function nb_add_gtm_to_body() {
					$getGTMtag = get_field('google_analytics_tag','options');

					// <!-- Google Tag Manager (noscript) -->
?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $getGTMtag; ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php
				// <!-- End Google Tag Manager (noscript) -->
			}
			add_action( 'storefront_before_site', 'nb_add_gtm_to_body', 0 );
		endif;
	}
endif;