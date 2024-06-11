<?php
/**
 * The template for displaying search results pages.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="columns is-centered">
					<div class="column">
						
						<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">

							<div class="field has-addons">
								<div class="control">
									<label>
										<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
										<input type="text" class="search-field input" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
									</label>
								</div>
								<div class="control">
									<input type="submit" class="button is-info" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
								</div>
							</div>

						</form>
					</div>

				</div>
			</div>

			<div class="container">

				<div class="search-results-container columns is-multiline">
					<div class="column is-full">
						<?php if ( have_posts() ) : ?>
							<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'storefront' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						<?php else : ?>
							<div class="no-search-results">
								<img class="vincent-lost" src="<?php echo get_stylesheet_directory_uri().'/assets/images/theme/'; ?>vincent-lost.gif" alt="<?php pll_e('The page can not be found.'); ?>" />
								<h1 class="page-title no-search-results"><?php _e( 'Nothing Found', 'storefront' ); ?></h1>
								<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'storefront' ); ?></p>
							</div>
						<?php endif; ?>
					</div>
					
					<div class="columns is-multiline">
						<?php if ( have_posts() ) {
							get_template_part( 'loop' );
						} else {
							get_template_part( 'content', 'none' );
						};
						?>
					</div>
				</div>

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
