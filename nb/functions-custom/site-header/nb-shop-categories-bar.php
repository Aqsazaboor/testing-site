<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_shop_categories')):
function nb_shop_categories() {
	$siteLanguage = '';
	if(function_exists('get_site_language')) {
		$siteLanguage = get_site_language();
	} else {
		$siteLanguage = 'sv';
	}
?>
	<nav class="navbar-categories">
		<div>
		<?php
			wp_nav_menu( array(
				'theme_location'  => 'categories',
				'fallback_cb'    => false,
				'container_class' => 'tabs is-centered'
			) );
		?>
		</div>
	</nav>

	<div class="payment-options-mobile">
		<ul class="payment-options">
			<li class="payment-merchant"><div class="service-logo klarna"><span class="is-sr-only">Klarna Logo</span></div></li>
			<li class="payment-merchant"><div class="service-logo mastercard"><span class="is-sr-only">Mastercard Logo</span></div></li>
			<?php if( $siteLanguage == 'sv' ) { ?>
			<li class="payment-merchant"><div class="service-logo swish"><span class="is-sr-only">Swish Logo</span></div></li>
			<?php } ?>
			<li class="payment-merchant"><div class="service-logo visa"><span class="is-sr-only">Visa Logo</span></div></li>
		</ul>
	</div>

<?php
}
endif;