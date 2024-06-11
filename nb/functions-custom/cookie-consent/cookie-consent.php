<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

/*
Information om cookies

Vi använder cookies för att ge dig bästa möjliga upplevelse på Skyltmax.se. Genom att trycka på "Jag förstår" accepterar du cookies samt informationen i vår integritetspolicy. Läs mer om våra cookies och hantera dina val här.
*/

if(!function_exists('nb_cookie_consent_modal') && function_exists('get_field')):
	add_action('wp_footer', 'nb_cookie_consent_modal'); 
	function nb_cookie_consent_modal() {
	?>
		<div id="cookie-consent-modal" class="cookie-consent-modal">
			<?php echo get_field('cookie_consent_modal_text','option'); ?>
			<button class="button is-primary is-fullwidth" id="approve-cookies-policy"><?php pll_e('Jag godkänner'); ?></button>
		</div>
	<?php
	}
endif;