<?php
/**
 * 
 * Template Name: Gutenberg Landing Page
 *
 * @package storefront
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container-x">
				<div class="page__wrapper">
					<div class="entry">
						<?php
						if ( have_posts() ) :
							the_content();
						endif;
						?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
