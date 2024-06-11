<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_site_navbar')):
function nb_site_navbar() {
	$siteLanguage = '';
	if(function_exists('get_site_language')) {
		$siteLanguage = get_site_language();
	} else {
		$siteLanguage = 'sv';
	}
?>
	<nav class="navbar">
		<div class="container">
			<div class="navbar-mobile">
				
				<div class="navbar-mobile-left">
					<button id="drawer-menu__trigger--mobile--menu" class="hamburger">
						<span></span>
						<span></span>
						<span></span>
						<span class="is-sr-only"><?php pll_e('Meny'); ?></span>
					</button>
				</div>
								
				<div class="navbar-brand-mobile">
					<a href="<?php echo bloginfo('url'); ?>">
						<div class="logo-build">
							<div><?php echo bloginfo('name'); ?></div>
							<svg version="1.1" id="svg-logo" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 417 146.9" width="417" height="146.9" xml:space="preserve" role="img" aria-hidden="true"><style>.st0{fill:#351408}</style><path class="svg-logo-path" d="M408.4 64.4c-.2-1.2-.5-2.3-.8-3.5-.3-1.1-.7-2.3-1.1-3.4-.4-1.1-.9-2.2-1.3-3.3-.2-.5-.5-1.1-.8-1.6-.5-1.1-1.1-2.1-1.7-3.1l-.9-1.5c-1-1.5-2-2.9-3.1-4.3-.7-.9-1.5-1.8-2.3-2.6-1.6-1.7-3.4-3.3-5.3-4.7-3.8-2.9-8-5.2-12.6-6.9-2.1-.8-3.7-2.4-4.4-4.3-.2-.7-.3-1.3-.3-2.1v-1.7c0-1.6-.3-3.1-.8-4.6-.2-.5-.4-1-.6-1.4-.4-.9-1-1.7-1.6-2.5-.3-.4-.7-.9-1.1-1.3s-.8-.8-1.3-1.1c-.8-.6-1.6-1.1-2.5-1.6-.5-.2-.9-.4-1.4-.6-1.4-.5-3-.8-4.6-.8H57.2c-1.4 0-2.8.2-4.1.6-.9.3-1.7.6-2.5 1.1-.4.2-.8.4-1.1.7-.7.5-1.4 1.1-2 1.7-2.5 2.5-4.1 6-4.1 9.8v1.7c0 2.9-1.8 5.4-4.7 6.4-1.7.6-3.4 1.3-5 2.1-1.1.5-2.1 1.1-3.2 1.7-1.8 1.1-3.6 2.3-5.2 3.6-.7.5-1.3 1.1-2 1.7-.9.8-1.7 1.6-2.5 2.5-1.6 1.7-3.1 3.5-4.5 5.4-1.7 2.4-3.2 5-4.4 7.7-.5 1.1-.9 2.2-1.3 3.3-.2.6-.4 1.1-.6 1.7-.4 1.1-.7 2.3-1 3.4-.1.6-.3 1.2-.4 1.8L8 68c-.2 1.2-.2 2.4-.3 3.6v1.8c0 6.8 1.5 13.3 4.1 19.2.5 1.1 1 2.1 1.6 3.2l.9 1.5c.6 1 1.2 2 1.9 3 .3.5.7 1 1 1.4.7.9 1.5 1.8 2.2 2.7 1.2 1.3 2.4 2.6 3.7 3.8 1.3 1.2 2.7 2.3 4.2 3.3 1.9 1.4 4 2.6 6.2 3.7l3.3 1.5c.6.2 1.1.4 1.7.7 1.1.4 2 1 2.7 1.7.5.5.9 1.1 1.2 1.7.2.3.3.6.4.9.2.7.3 1.3.3 2.1v1.7c0 7.6 6.2 13.8 13.8 13.8h302.6c4.8 0 9-2.4 11.5-6.1.2-.4.5-.8.7-1.1.4-.8.8-1.6 1.1-2.5.4-1.3.6-2.7.6-4.1v-1.7c0-.7.1-1.4.3-2.1.1-.3.2-.6.4-.9.3-.6.7-1.2 1.2-1.7.7-.7 1.7-1.3 2.7-1.7 18.5-6.6 30.9-24.3 30.9-43.9.3-3.1 0-6.1-.5-9.1M377 113.6c-4.5 1.6-7.4 5.6-7.4 10.1v1.7c0 5.4-4.4 9.8-9.8 9.8H57.2c-5.4 0-9.8-4.4-9.8-9.8v-1.7c0-4.6-2.9-8.6-7.4-10.1-16.9-6-28.3-22.2-28.3-40.1 0-18 11.4-34.1 28.3-40.1 4.5-1.6 7.4-5.6 7.4-10.1v-1.7c0-5.4 4.4-9.8 9.8-9.8h302.6c5.4 0 9.8 4.4 9.8 9.8v1.7c0 4.6 2.9 8.5 7.4 10.1 16.9 6 28.3 22.2 28.3 40.1-.1 17.9-11.4 34-28.3 40.1"/><path class="st0" d="M377.5 38.3c-6.8-2.4-11.4-8.7-11.4-15.9v-1.7c0-2.2-1.8-4-4-4H55c-2.2 0-4 1.8-4 4v1.7c0 7.2-4.6 13.5-11.4 15.9-14.4 5.2-24.8 18.9-24.8 35.1 0 16.2 10.3 30 24.8 35.2 6.8 2.4 11.4 8.7 11.4 15.9v1.7c0 2.2 1.8 4.1 4 4.1h307c2.2 0 4-1.8 4-4.1v-1.7c0-7.2 4.6-13.5 11.4-15.9 14.4-5.2 24.8-18.9 24.8-35.2 0-16.2-10.3-29.9-24.7-35.1M52.1 79.6c-3.4 0-6.1-2.7-6.1-6.1 0-3.4 2.7-6.1 6.1-6.1s6.1 2.7 6.1 6.1c0 3.3-2.7 6.1-6.1 6.1m312.8 0c-3.4 0-6.1-2.7-6.1-6.1 0-3.4 2.7-6.1 6.1-6.1s6.1 2.7 6.1 6.1c0 3.3-2.7 6.1-6.1 6.1"/></svg>
						</div>
					</a>
				</div>

				<div class="cart-trigger">
					<?php
					if(function_exists('WC')):
						$cartItemsCount = WC()->cart->get_cart_contents_count();
							if($cartItemsCount > 0) {
					?>
						<button class="cart-btn" aria-label="<?php pll_e('Meny'); ?>" id="drawer-menu__trigger--mobile">
							<span class="is-sr-only"><?php pll_e('Varukorg'); ?> </span><div class="cart-badge"><?php echo WC()->cart->get_cart_contents_count(); ?></div> <span><?php echo WC()->cart->get_cart_total(); ?></span>	
						</button>
						<?php /*
						<button data-drawer-trigger="" class="cart-btn" aria-label="Meny" aria-controls="drawer-menu" aria-expanded="false">
							<span class="is-sr-only"><?php pll_e('Varukorg'); ?> </span><div class="cart-badge"><?php echo WC()->cart->get_cart_contents_count(); ?></div> <span><?php echo WC()->cart->get_cart_total(); ?></span>
						</button>
						*/ ?>
					<?php } else { ?>
						<div class="cart-btn">
							<span class="is-sr-only"><?php pll_e('Varukorg'); ?></span>
						</div>
					<?php
						}
					endif;
					?>
				</div>
			</div>
			
			<div id="navbar-menu" class="navbar-menu">
				<div class="navbar-start" role="navigation" aria-label="Main">
					<div class="navbar-item">
						<?php
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
						$var_lang_code = $siteLanguage;
						$countriesObj = json_decode($countriesObj, TRUE);
						$langDropdown = '';
						foreach($countriesObj as $key => $value) {
							// Current lang code
							if( $value['lang_code'] != $var_lang_code ) {
								$langDropdown .= '<a class="dropdown-item '.$key.'" href="'.$value['url'].'"><span class="flag flag-'.$value['lang_code'].'"></span> ' . $value['name'] . '</a>';
							}
						}
						?>
						
						<div class="dropdown">
						  <div class="dropdown-trigger">
						    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
						      <span class="flag flag-<?php echo $var_lang_code; ?>">&nbsp;</span>
						      <span class="icon is-small">
						        <i class="drop-down-arrow" aria-hidden="true"></i>
						      </span>
						    </button>
						  </div>
						  <div class="dropdown-menu" id="dropdown-menu" role="menu">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'countries',
									'fallback_cb'    => false,
									'container_class' => 'dropdown-content'
								) );
							?>
						  </div>
						</div>
					</div>
					
					<?php
						wp_nav_menu( array(
							'theme_location'	=> 'primary',
							'fallback_cb'		=> false, // Do not fall back to wp_page_menu()
							'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
						) );
					?>
				</div>

				<div class="navbar-checkout-left" role="navigation" aria-label="Main">
					<div class="menu-top-container">
						<ul id="menu-top" class="menu">
							<?php if(function_exists("button_go_back")) {
								echo '<li class="menu-item menu-item__go-back">';
								button_go_back();
								echo '</li>';
							}
							?>
						</ul>
					</div>
				</div>
	
				<div class="navbar-brand-new">
					<div class="navbar-item">
						<a href="<?php echo bloginfo('url'); ?>">
							<div class="logo-build">
								<div><?php echo bloginfo('name'); ?></div>
								<svg version="1.1" id="svg-logo" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 417 146.9" width="417" height="146.9" xml:space="preserve" role="img" aria-hidden="true"><style>.st0{fill:#351408}</style><path class="svg-logo-path" d="M408.4 64.4c-.2-1.2-.5-2.3-.8-3.5-.3-1.1-.7-2.3-1.1-3.4-.4-1.1-.9-2.2-1.3-3.3-.2-.5-.5-1.1-.8-1.6-.5-1.1-1.1-2.1-1.7-3.1l-.9-1.5c-1-1.5-2-2.9-3.1-4.3-.7-.9-1.5-1.8-2.3-2.6-1.6-1.7-3.4-3.3-5.3-4.7-3.8-2.9-8-5.2-12.6-6.9-2.1-.8-3.7-2.4-4.4-4.3-.2-.7-.3-1.3-.3-2.1v-1.7c0-1.6-.3-3.1-.8-4.6-.2-.5-.4-1-.6-1.4-.4-.9-1-1.7-1.6-2.5-.3-.4-.7-.9-1.1-1.3s-.8-.8-1.3-1.1c-.8-.6-1.6-1.1-2.5-1.6-.5-.2-.9-.4-1.4-.6-1.4-.5-3-.8-4.6-.8H57.2c-1.4 0-2.8.2-4.1.6-.9.3-1.7.6-2.5 1.1-.4.2-.8.4-1.1.7-.7.5-1.4 1.1-2 1.7-2.5 2.5-4.1 6-4.1 9.8v1.7c0 2.9-1.8 5.4-4.7 6.4-1.7.6-3.4 1.3-5 2.1-1.1.5-2.1 1.1-3.2 1.7-1.8 1.1-3.6 2.3-5.2 3.6-.7.5-1.3 1.1-2 1.7-.9.8-1.7 1.6-2.5 2.5-1.6 1.7-3.1 3.5-4.5 5.4-1.7 2.4-3.2 5-4.4 7.7-.5 1.1-.9 2.2-1.3 3.3-.2.6-.4 1.1-.6 1.7-.4 1.1-.7 2.3-1 3.4-.1.6-.3 1.2-.4 1.8L8 68c-.2 1.2-.2 2.4-.3 3.6v1.8c0 6.8 1.5 13.3 4.1 19.2.5 1.1 1 2.1 1.6 3.2l.9 1.5c.6 1 1.2 2 1.9 3 .3.5.7 1 1 1.4.7.9 1.5 1.8 2.2 2.7 1.2 1.3 2.4 2.6 3.7 3.8 1.3 1.2 2.7 2.3 4.2 3.3 1.9 1.4 4 2.6 6.2 3.7l3.3 1.5c.6.2 1.1.4 1.7.7 1.1.4 2 1 2.7 1.7.5.5.9 1.1 1.2 1.7.2.3.3.6.4.9.2.7.3 1.3.3 2.1v1.7c0 7.6 6.2 13.8 13.8 13.8h302.6c4.8 0 9-2.4 11.5-6.1.2-.4.5-.8.7-1.1.4-.8.8-1.6 1.1-2.5.4-1.3.6-2.7.6-4.1v-1.7c0-.7.1-1.4.3-2.1.1-.3.2-.6.4-.9.3-.6.7-1.2 1.2-1.7.7-.7 1.7-1.3 2.7-1.7 18.5-6.6 30.9-24.3 30.9-43.9.3-3.1 0-6.1-.5-9.1M377 113.6c-4.5 1.6-7.4 5.6-7.4 10.1v1.7c0 5.4-4.4 9.8-9.8 9.8H57.2c-5.4 0-9.8-4.4-9.8-9.8v-1.7c0-4.6-2.9-8.6-7.4-10.1-16.9-6-28.3-22.2-28.3-40.1 0-18 11.4-34.1 28.3-40.1 4.5-1.6 7.4-5.6 7.4-10.1v-1.7c0-5.4 4.4-9.8 9.8-9.8h302.6c5.4 0 9.8 4.4 9.8 9.8v1.7c0 4.6 2.9 8.5 7.4 10.1 16.9 6 28.3 22.2 28.3 40.1-.1 17.9-11.4 34-28.3 40.1"/><path class="st0" d="M377.5 38.3c-6.8-2.4-11.4-8.7-11.4-15.9v-1.7c0-2.2-1.8-4-4-4H55c-2.2 0-4 1.8-4 4v1.7c0 7.2-4.6 13.5-11.4 15.9-14.4 5.2-24.8 18.9-24.8 35.1 0 16.2 10.3 30 24.8 35.2 6.8 2.4 11.4 8.7 11.4 15.9v1.7c0 2.2 1.8 4.1 4 4.1h307c2.2 0 4-1.8 4-4.1v-1.7c0-7.2 4.6-13.5 11.4-15.9 14.4-5.2 24.8-18.9 24.8-35.2 0-16.2-10.3-29.9-24.7-35.1M52.1 79.6c-3.4 0-6.1-2.7-6.1-6.1 0-3.4 2.7-6.1 6.1-6.1s6.1 2.7 6.1 6.1c0 3.3-2.7 6.1-6.1 6.1m312.8 0c-3.4 0-6.1-2.7-6.1-6.1 0-3.4 2.7-6.1 6.1-6.1s6.1 2.7 6.1 6.1c0 3.3-2.7 6.1-6.1 6.1"/></svg>
							</div>
							<div class="logo-subline"><?php echo get_bloginfo('description'); ?></div>
						</a>
					</div>
				</div>
	
				<div class="navbar-end">
					<div class="navbar-item navbar-checkout-right">
						<?php
							wp_nav_menu( array(
								'theme_location'  => 'checkout',
								'fallback_cb'    => false // Do not fall back to wp_page_menu()
							) );
						?>
					</div>
					
					<div class="navbar-item mini-cart">
						<ul class="payment-options">
							<?php
							if(function_exists('nb_get_trusticons')) {
								echo nb_get_trusticons("list");
							}
							?>
						</ul>
					</div>
					<div class="navbar-item mini-cart">
						<div class="cart-trigger">
							<?php
							if(function_exists('WC')):
								$cartItemsCount = WC()->cart->get_cart_contents_count();
									if($cartItemsCount > 0) {
							?>
								<button class="cart-btn" aria-label="<?php pll_e('Meny'); ?>" id="drawer-menu__trigger">
									<span class="is-sr-only"><?php pll_e('Varukorg'); ?> </span><div class="cart-badge"><?php echo WC()->cart->get_cart_contents_count(); ?></div> <span><?php echo WC()->cart->get_cart_total(); ?></span>	
								</button>
								<?php /*
								<button data-drawer-trigger="" class="cart-btn" aria-label="Meny" aria-controls="drawer-menu" aria-expanded="false">
									<span class="is-sr-only"><?php pll_e('Varukorg'); ?> </span><div class="cart-badge"><?php echo WC()->cart->get_cart_contents_count(); ?></div> <span><?php echo WC()->cart->get_cart_total(); ?></span>
								</button>
								*/ ?>
							<?php } else { ?>
								<div class="cart-btn">
									<?php pll_e('Varukorg'); ?>
								</div>
							<?php
								}
							endif;
							?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</nav>

<?php
}
endif;