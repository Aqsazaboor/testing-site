<?php
/**
 * 
 * Template Name: Gutenberg Skyltdax Combo
 *
 * @package storefront
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="page__wrapper">
					<div class="entry">
					<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
					?>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
