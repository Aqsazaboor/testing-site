<?php
/*
 *
 * Template name: Landing page
 *
 */

get_header(); ?>

<div class="sections-wrapper">
	<?php if( have_rows('sections') ): ?>
		<?php while( have_rows('sections') ): the_row(); 
			$image = get_sub_field('image');
			?>
			<section class="content-section">
				<div class="container">
					<div class="columns is-vcentered">
						<div class="column">
							<?php the_sub_field('wysiwyg'); ?>
						</div>
						<?php if($image) { ?>
							<div class="column">
								<div class="image"><img src="<?php echo $image; ?>" alt=""></div>
							</div>
						<?php } ?>
					</div>
				</div>
			</section>
		<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php
get_footer();