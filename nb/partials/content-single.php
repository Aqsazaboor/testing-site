<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>

<div class="container">
	<div class="columns has-background-white has-border-grey">
		<div class="column">
			<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
			
				<?php
				do_action( 'storefront_single_post_top' );

				/**
				 * Functions hooked into storefront_single_post add_action
				 *
				 * @hooked storefront_post_header          - 10
				 * @hooked storefront_post_content         - 30
				 */
				do_action( 'storefront_single_post' );

				/**
				 * Functions hooked in to storefront_single_post_bottom action
				 *
				 * @hooked storefront_post_nav         - 10
				 * @hooked storefront_display_comments - 20
				 */
				do_action( 'storefront_single_post_bottom' );
				?>

			</article><!-- #post-## -->
		</div>
		<div class="column is-one-quarter">
			<div class="sidebar">
				<div id="secondary" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div><!-- #secondary -->
			</div>
		</div>
	</div>
</div>