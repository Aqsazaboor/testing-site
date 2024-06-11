<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_site_search_bar')):
function nb_site_search_bar() {
?>
	<div id="site-search" class="site-search">
		<?php
			if(shortcode_exists('fibosearch')) {
		?>
			<?php echo do_shortcode('[fibosearch]'); ?>
		<?php
			} else {
		?>
		<form action="/" method="get">
			<div class="container">
				<div class="columns is-centered">
					<div class="column">
						<div class="field has-addons">
							<div class="control is-expanded">
								<input class="input" type="text" name="s" id="search" placeholder="" value="<?php the_search_query(); ?>">
							</div>
							<div class="control">
								<button class="button">
									<?php echo pll__('Sök'); ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<?php
			}
		?>
	</div>
<?php
}
endif;

if(!function_exists('nb_site_search_bar_mobile')):
function nb_site_search_bar_mobile() {
?>
	<div class="site-search-mobile">
		<?php
			if(shortcode_exists('fibosearch')) {
		?>
		<div class="container fibo-search-container">
			<div class="columns">
				<div class="column columns is-multiline has-background-white has-border-grey">
					<?php echo do_shortcode('[fibosearch]'); ?>
				</div>
			</div>
		</div>
		<?php
			} else {
		?>
		<form action="/" method="get">
			<div class="container">
				<div class="columns is-centered">
					<div class="column">
						<div class="field has-addons">
							<div class="control is-expanded">
								<input class="input" type="text" name="s" id="search" placeholder="" value="<?php the_search_query(); ?>">
							</div>
							<div class="control">
								<button class="button">
									<?php echo pll__('Sök'); ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<?php
			}
		?>
	</div>
<?php
}
endif;