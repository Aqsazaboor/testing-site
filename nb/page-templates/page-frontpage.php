<?php
/*
 *
 * Template Name: Frontpage
 *
 */
 
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( "parts/loop-modules" );
			endwhile;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	$promises = '';
	
	if( have_rows('sopt_promises', 'options') ):
		
		echo '<div clas="container">';
		echo '	<div class="row">';
		echo '		<div class="col-sm-12">';
		
		$promises .= '<ul class="shop-promises">';
		
		while ( have_rows('sopt_promises', 'options') ) : the_row();
			$promises .= '<li class="shop-promises-item">' . get_sub_field('sopt_promise') . '</li>';
		endwhile;
		
		$promises .= '</ul>';
		
		echo '		</div>';
		echo '	</div>';
		echo '</div>';
		
	else :
		$promises .= 'No shop promises found';
	endif;
	
	echo $promises;
		
	?>

	</div>
</div>

<div class="category">
	<div class="container">
		
		<div class="row no-gutters products">
		    <?php
		    $args = array(
		        'product_cat' => 'popular',
		        'posts_per_page' => -1,
		        'orderby' => 'rand'
		    );
		    
		    $loop = new WP_Query($args);
		    while ($loop->have_posts()) : $loop->the_post();
		        global $product; ?>
					<div class="col-sm-3">
						<div class="product">
							<a href="<?php echo get_permalink($loop->post->ID) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
							
							<?php woocommerce_show_product_sale_flash($post, $product); ?>
							
							<?php if (has_post_thumbnail($loop->post->ID)) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
							else echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />'; ?>
							
							<h3 class="product-title"><?php the_title(); ?></h3>
							
							<span class="price"><?php echo $product->get_price_html(); ?></span>
							
							</a>
							
							<?php #woocommerce_template_loop_add_to_cart($loop->post, $product); ?>
						</div>
					</div>
		    <?php endwhile; ?>
		    <?php wp_reset_query(); ?>
			
		</div>
	</div>
</div>

<div class="category-squares" style="margin-bottom: 2em; background-color: transparent;">
	<div class="container">
		<div class="row" style="border: 1px solid #EEE;">
			<?php
			
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
			        $category_id = $cat->term_id;
			        
			        if($cat->count > 1) {
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
						
						// get the image URL
						$image = wp_get_attachment_url( $thumbnail_id );
						
						// Top categories only
						echo '<div class="item col-md-4">';
						echo '	<a href="'. get_term_link($cat->slug, 'product_cat') .'">';
						echo '		<h2 class="item-title"><span>'.$cat->name.'</span></h2>';
						echo '		<div class="item-image"><img src="'.$image.'" alt="" /></div>';
						echo '	</a>';
						echo '</div>';
			        }
			    }       
			}
			?>
		</div>
	</div>
</div>

<div>
	<div>

<?php
get_footer();