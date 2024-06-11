<?php
/*
 * Template Name: About us
 */

get_header(); ?>

	<div class="page-404">
		<div class="container">
			<div class="columns">
				<div class="column">
					<h1 class="page-title"><?php pll_e( 'Page could not be found.', 'woocommerce' ); ?></h1>

					<div class="page-404__image">
						<img src="<?php echo get_stylesheet_directory_uri().'/assets/images/theme/'; ?>vincent-lost.gif" alt="<?php pll_e('The page can not be found.'); ?>" />
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
get_footer();