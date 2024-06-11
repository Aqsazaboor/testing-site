<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<?php

// This is to exit broken search
if(is_search()) {
?>

	<?php
	if( function_exists('is_shop') && is_shop() ):
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
		}
	endif;
	?>

	<div class="container">
		<div class="columns">
			<div class="column">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'storefront' ); ?></h1>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'storefront' ); ?></p>
			</div>
		</div>
	</div>
<?php
} else if(!is_search()) { ?>

	<?php
	if( function_exists('is_shop') && is_shop() ):
		if(function_exists('hero')) {
			echo hero();
		}
	endif;
	?>

	<?php
	if( function_exists('is_shop') && is_shop() ):
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
		}
	endif;
	?>

	<?php
	if( function_exists('is_shop') && is_shop() ):
		if(function_exists('nb_get_trustpilot_widget') && function_exists('get_site_language')) {
			if(get_site_language() === 'sv') {
				nb_get_trustpilot_widget();
			}
		}
	endif;
	?>

	<div class="container">
		<?php
			// Display only on shop page
			if( function_exists('is_shop') && !is_shop() ):
		?>
		<div class="columns">
			<div class="column">
				
				<article class="entry">
					<header class="woocommerce-products-header">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
					</header>
					<?php
						/**
						 * Hook: woocommerce_archive_description.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
					?>
				</article>
				
			</div>
			
			<div class="column is-one-quarter">
				<div id="secondary" class="sidebar">
					<div class="sidebar">
						<?php
						// verify that this is a product category page
						if ( is_product_category() ):
							global $wp_query;
							
							// get the query object
							$cat = $wp_query->get_queried_object();
							
							// get the thumbnail id using the queried category term_id
							$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
							
							// get the image URL
							$image = wp_get_attachment_url( $thumbnail_id );
							if($image) {
						?>
							<aside class="widget">
								<div class="category-image">
									<?php
										// print the IMG HTML
										echo "<img src='{$image}' width='400' height='300' alt='' />";
									?>
								</div>
							</aside>	
						<?php							
							}
						endif; ?>
					</div>
				</div>
			</div>
			
		</div>
		<?php
			endif;
			
			// Only get product that are tagged with frontend category
			if( is_shop() && function_exists('only_frontend_category_products') ) {
				echo only_frontend_category_products();
			}
		?>	
		<?php if(function_exists('is_shop') && !is_shop()): ?>
		<div class="columns columns__wrapper has-background-white has-border-grey">
			<?php
			if ( woocommerce_product_loop() ) {
			
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			
				woocommerce_product_loop_start();
				
				
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();
			
						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );
			
						wc_get_template_part( 'content', 'product' );
					}
				}
			
				woocommerce_product_loop_end();
			
				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
			
			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
			
			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );
		
			?>
		</div>
		<?php endif; ?>
	</div>

	<?php
	if( is_shop() && function_exists('only_frontend_category_products') ) {
	?>

	<section class="category-squares">
		<div class="container">
			<div class="columns">
				<div class="column">
					<h2><?php echo pll__('Kategorier'); ?></h2>
				</div>
			</div>
			<div class="columns is-multiline">
				<?php

				$exclude_categories = array('frontpage', 'uncategorized', 'okategoriserad', 'checkout', 'out-of-stock');
				
				$taxonomy     = 'product_cat';
				$orderby      = 'name';  
				$show_count   = 0;      // 1 for yes, 0 for no
				$pad_counts   = 0;      // 1 for yes, 0 for no
				$hierarchical = 1;      // 1 for yes, 0 for no  
				$title        = '';  
				$empty        = 0;
				
				$args = array(
					'taxonomy'     => $taxonomy,
					'orderby'      => $orderby,
					'show_count'   => $show_count,
					'pad_counts'   => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li'     => $title,
					'hide_empty'   => $empty
				);
				
				$all_categories = get_categories( $args );
				foreach ($all_categories as $cat) {
					
					if($cat->category_parent == 0) {
						if( !in_array($cat->slug, $exclude_categories) ) {
							$category_id = $cat->term_id;

							if($cat->count > 1) {
								$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
								
								// get the image URL
								$image = wp_get_attachment_url( $thumbnail_id );
								
								// Top categories only
								echo '<div class="category column is-one-quarter-tablet">';
								echo '	<a href="'. get_term_link($cat->slug, 'product_cat') .'">';
								echo '		<div class="item-title"><span>'.$cat->name.'</span></div>';
								echo '		<div class="item-image"><img src="'.$image.'" alt="" /></div>';
								echo '	</a>';
								echo '</div>';
							}
						}
					}       
				}
				?>
			</div>
		</div>
	</section>

	<?php
	}
	?>

<?php } ?>

<?php
	
get_footer( 'shop' );