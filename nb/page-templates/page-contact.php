<?php
/*
 * Template Name: Contact us
 */

get_header(); ?>

	<div class="container">

		<div class="columns">
			<div class="column">
				<div class="entry">
					<div class="entry__header">
						<h1><?php the_title(); ?></h1>
						<?php the_content();?>
					</div>
				</div>
			</div>
		</div>

		<div class="columns widget__columns">
			<?php
			if( have_rows('faq_blocks') ):
				while ( have_rows('faq_blocks') ) : the_row();
				?>
				<div class="widget column">
					<div class="widget__image">
						<img src="<?php echo get_sub_field('block_image'); ?>" alt="" />
					</div>
					<div class="">
						<?php echo get_sub_field('block_content'); ?>
					</div>
				</div>
				<?php
				endwhile;
			endif;
			?>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>

		<?php
		$args = array(
			'post_type' => 'faq',
			'posts_per_page' => 999
		);
		$the_query = new WP_Query( $args ); ?>

		<?php if ( $the_query->have_posts() ) : ?>
		<div class="columns faq__columns">
			<div class="column">
				<h2><?php pll_e('Vanliga frågor'); ?></h2>
				<div class="contact-us__faq checkout__faq">
					<?php
						$output = '<div id="checkout__faq--container">';
						$output .= '<div class="faq__wrapper">';

						while ( $the_query->have_posts() ) : $the_query->the_post();
							$postId = get_the_ID();
							$output .= '<div class="faq__question--wrapper post-id-'.$postId.'">';
								$output .= '<div id="answer-id-'.$postId.'" class="faq__question">';
								$output .= '<button aria-controls="question-id-'.$postId.'" role="button" class="faq__question--trigger" data-content="question-id-'.$postId.'">';
								$output .= '<span>'.get_the_title().'</span>';
								$output .= '</button></div>';
								$output .= '<div id="question-id-'.$postId.'" class="faq__answer"><div>'.get_the_content().'</div></div>';
							$output .= '</div>';
						endwhile;

						$output .= '</div>';
						$output .= '</div>';
						
						echo $output;
					?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>

<?php
get_footer();