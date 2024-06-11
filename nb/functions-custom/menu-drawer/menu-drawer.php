<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('menu_drawer')):
function menu_drawer() {
	?>
		<dialog id="drawer-menu">
			<div class="drawer-menu__wrapper">
				<form method="dialog">

					<div class="drawer-menu__wrapper--header">
						<div class="drawer-menu__wrapper--header--title">
							
						</div>
						<div>
							<button id="drawer-menu__close" class="drawer-menu__close"><?php pll_e('Stäng'); ?></button>
						</div>
					</div>
					<div class="drawer-menu__wrapper--content">
						<div class="drawer-menu__wrapper--cart">
							<div>
								<h2><?php pll_e('Varukorg'); ?></h2>
							</div>

							<?php
							if( function_exists('woocommerce_mini_cart') ) {
								woocommerce_mini_cart();
							}
							?>
						</div>

						<nav class="drawer-menu__navigation">
							<div class="drawer-menu__navigation--title">
								<?php pll_e('Meny'); ?>
							</div>
						<?php
							wp_nav_menu( array(
								'theme_location'  => 'handheld',
								'fallback_cb'    => false // Do not fall back to wp_page_menu()
							) );
						?>
						</nav>
					</div>
				</form>
			</div>
		</dialog>
	<?php
}
endif;