<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('wc_add_content_empty_cart')):
add_action( 'woocommerce_cart_is_empty', 'wc_add_content_empty_cart' );
function wc_add_content_empty_cart() {
?>
	<div class="page-empty-cart">
		<div class="container">
			<div class="columns has-background-white has-border-grey">
				<div class="column">
					<h1 class="page-title"><?php pll_e('Your cart is currently empty.'); ?></h1>

					<div class="page-empty-cart__image">
						<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/theme/'; ?>vincent-lost.gif" alt="<?php pll_e('Your cart is currently empty.'); ?>" />
					</div>

					<nav>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'emptycart',
								'fallback_cb'    => false,
								'container_class' => 'menu-list'
							) );
						?>
					</nav>
				</div>
			</div>
		</div>
	</div>
<?php
}
endif;