<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('only_frontend_category_products')):
function only_frontend_category_products() {
	?>

	<ul class="columns product_list is-multiline has-background-white has-border-grey">
		<?php
		
			$products = wc_get_products(
				array(
					'status' => 'publish',
					'limit' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC'
				)
			);

			foreach ( $products as $product ) {
				$productId = $product->get_id();
				// Check if product in frontpage category
				$product_cats = wp_get_post_terms( $productId, 'product_cat' );
				$categoryArray = array();
				foreach( $product_cats as $cat) {
					$categoryArray[] = $cat->slug;
				}

				if( count($categoryArray) > 0 && in_array("frontpage", $categoryArray) && $product->is_in_stock()) {
					
					$permalink = $product->get_permalink();
					?>
					<li class="product column is-one-quarter-tablet is-half-mobile">
						<?php
							if( $product->is_on_sale() ) {
								$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
								echo '<span class="onsale">-'.$percentage.'%</span>';
							}
						?>
						<a href="<?php echo $permalink; ?>">
							<div class="product-image wc-block-grid__product-image">
								<?php
								$attachment_id = get_post_thumbnail_id( $productId );
								$img_src = wp_get_attachment_image_url( $attachment_id, 'medium' );
								$img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'medium' );
								$image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', TRUE);
								?>
								<img src="<?php echo esc_url( $img_src ); ?>"
								srcset="<?php echo esc_attr( $img_srcset ); ?>"
								sizes="(max-width: 50em) 87vw, 680px" alt="<?php echo $image_alt; ?>">
							</div>
						</a>
						<a href="<?php echo $permalink; ?>">
							<?php
								$product_title = $product->get_title();
								// Do it the other way around, use alternate title in admin
								// $product_alternate_title = get_post_meta( $productId, 'alternate_title', true );
								// if(strLen($product_alternate_title) > 0) {
								// 	$product_title = $product_alternate_title;
								// }
							?>
							<div class="product-description">
								<div class="product-name woocommerce-loop-product__title"><?php echo $product_title; ?></div>
								<?php					
								if(function_exists('nb_get_product_size_material')) {
									echo nb_get_product_size_material($productId);	
								}
								?>
								<div class="price">
									<?php echo $product->get_price_html(); ?>
								</div>
							</div>
						</a>
					</li>
				<?php
				}
			}
			wp_reset_query();
		?>
	</ul>
<?php
}
endif;