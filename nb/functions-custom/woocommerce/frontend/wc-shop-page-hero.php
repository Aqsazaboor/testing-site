<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// woocommerce_before_main_content

if(!function_exists('hero') && function_exists('get_field')):
function hero() {
	
	if( function_exists('is_shop') && is_shop() ):
		$shop_page_id = wc_get_page_id( 'shop' );
?>

<section class="hero is-small">
	<div class="hero-body">
		<div class="container">
			<div class="columns has-background-white has-border-grey">
				<?php
				$shop_page = get_post($shop_page_id);
				if($shop_page->post_content) {
					$url = get_the_post_thumbnail_url( $shop_page_id, 'medium' );
				?>
				
				<div class="column frontpage-hero">
					<div class="hero-inner hero-inner-custom">
						<div class="hero-content">
							<div>
								<?php echo $shop_page->post_content; ?>
							</div>
						</div>
						<div class="hero-content-image" style="background-image: url('<?php echo $url; ?>');"></div>
					</div>
				</div>

				<?php
				} else {
				?>
				
				<div class="column frontpage-hero">
					<div class="hero-inner">
						<div class="hero-content">

							<?php
								function mytheme_has_content( $post = 0 ){
									$post = get_post( $post );
									return ( !empty(apply_filters('the_content', $post->post_content)) );
								}
							?>

							<?php
								if(get_field('spotlight_title', $shop_page_id)) {
							?>
								<h1 class="title is-size-4-mobile">
									<span><?php the_field('spotlight_title', $shop_page_id) ?></span>
								</h1>
							<?php	
								}
							?>
							<?php
								if(get_field('spotlight_subtitle', $shop_page_id)) {
							?>
								<h2 class="subtitle is-size-6-mobile">
									<span><?php the_field('spotlight_subtitle', $shop_page_id) ?></span>
								</h2>
							<?php	
								}
							?>
							<?php
								if(get_field('spotlight_button_text', $shop_page_id) && get_field('spotlight_button_target', $shop_page_id)) {
							?>
								<a href="<?php the_field('spotlight_button_target', $shop_page_id); ?>" class="button button-primary is-info">
									<?php the_field('spotlight_button_text', $shop_page_id) ?>
								</a>
							<?php	
								}
								wp_reset_postdata();
							?>
							
						</div>
						
						<?php
						$imageID = get_field('spotlight_image', $shop_page_id);
						
						if($imageID) {
							$image = wp_get_attachment_image_src( $imageID, 'full' );
							$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
							
							echo get_field('spotlight_button_target', $shop_page_id) ? '<a href="'.get_field('spotlight_button_target', $shop_page_id).'" class="hero-image">' : '';
						?>
							<img src="<?php echo $image[0]; ?>" width="800" height="350" alt="<?php echo $alt_text; ?>" />
						<?php
							echo get_field('spotlight_button_target', $shop_page_id) ? '</a>' : '';
						
						} ?>
					</div>
				</div>
				<?php
				}
				?>
				
				<div class="column is-two-fifths customer-service">
					<div class="columns is-multiline">
						<div class="column is-full">
							<div class="so-many-products">
								<?php
								function product_count_shortcode( ) {
									$count_posts = wp_count_posts( 'product' );
									return $count_posts->publish;
								}
								echo product_count_shortcode() .' '. pll__('Skyltar');
								?>
							</div>
						</div>

						<?php if( have_rows('shortcuts', $shop_page_id) ): ?>
							<?php while( have_rows('shortcuts', $shop_page_id) ): the_row(); 
								?>
								<div class="column is-full">
									<article class="media">
										<?php
										$imageUrl = get_sub_field('shortcut_image');
										if($imageUrl) {
										?>
										<figure class="media-left">
											<p class="image is-64x64">
												<img src="<?php echo $imageUrl; ?>" alt="">
											</p>
										</figure>
										<?php
										}
										?>

										<div class="media-content">
											<div class="content">
												<?php
												if(get_sub_field('shortcut_url')) {
													echo '<a href="'.get_sub_field('shortcut_url').'">';
												}
												?>
													<?php the_sub_field('shortcut_title'); ?>
												<?php
												if(get_sub_field('shortcut_url')) {
													echo '</a>';
												}
												?>
											</div>
										</div>
									</article>	
								</div>
							<?php endwhile; ?>
						<?php endif;
						wp_reset_postdata();
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	endif;
}
// add_filter( 'woocommerce_before_main_content', 'hero' );
endif;