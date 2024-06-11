<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package storefront
 */

do_action( 'storefront_loop_before' );

while ( have_posts() ) :
	the_post();

	if( !get_post_format() ) {
		
		$product_id = get_the_ID();
		
		echo '<div class="row search-results-product">';
		
			echo '<div class="columns">';

			// Image
			echo '<div class="column is-one-fifth">';
				echo '<div class="product-image">';
				echo '<a href="'.get_permalink().'">' . '<img src="'.get_the_post_thumbnail_url().'" alt="" />' . '</a>';
				echo '</div>';
			echo '</div>';
			
			// Content
			echo '<div class="column">';
				echo '<a href="'.get_permalink().'">';
					echo '<h2>' . get_the_title() . '</h2>';
						// if(function_exists('nb_get_product_size_material')) {
						// 	echo nb_get_product_size_material($product_id);	
						// }
					echo '<p>' . get_the_excerpt() . '</p>';
				echo '</a>';
				echo '<a class="button is-ghost" href="'.get_permalink().'">Gå till ' . get_the_title() . '</a>';
			echo '</div>';
			
			echo '</div>';
		
		echo '</div>';
	
	} else {
		/**
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'content', get_post_format() );		
	}

endwhile;

/**
 * Functions hooked in to storefront_paging_nav action
 *
 * @hooked storefront_paging_nav - 10
 */
do_action( 'storefront_loop_after' );
