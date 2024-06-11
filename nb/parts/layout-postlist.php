<?php
$section_title = get_sub_field('section_title');
$post_items = get_sub_field('post_list');
?>

<section class="module-wrapper module-wrapper--post-list">
	<div class="container">
		<?php
		$output = '<div class="row">';
		
		if($section_title) {
			$output .= '<header class="col-sm-12 section-header">';
			$output .= '	<h2 class="module-title">' . $section_title. '</h2>';
			$output .= '</header>';
		}
		$output .= '</div>';
		
$lastposts = get_posts( array(
	'post_type' => $post_items,
    'posts_per_page' => 3
) );
 
if ( $lastposts ) {
    foreach ( $lastposts as $post ) :
        setup_postdata( $post ); ?>

		<?php
		
			$post_ID = $post->ID;
			$post_title = $post->post_title;
			
			$output .= '<article class="col-sm-4 post-item post-'.$post_ID.'">';
			
			$output .= '	<a href="'.get_permalink($post_ID).'">';
			$output .= '	<div class="post-item-inner">';
			
			if ( has_post_thumbnail($post_ID) ) {
				// Give the Post Thumbnail a class "alignleft".
				$output .= '		<div class="post-item-thumbnail">';
				$output .= get_the_post_thumbnail( $post_ID, 'post-item-crop', array( 'class' => 'alignleft' ) );
				$output .= '		</div>';
			}
			else {
				$output .= '<img src="' . get_stylesheet_directory_uri() . '/assets/img/theme/article-fallback.jpg" />';
			}				
			
			$output .= '		<div class="post-item-content">';
			$output .= '			<h3 class="post-item-title">'.$post_title.'</h3>';
			
			if (has_excerpt()) {
				$output .=  wp_strip_all_tags(get_the_excerpt($post_ID));
			}
			
			$output .= '			<a class="read-more" href="'.get_permalink($post_ID).'">Läs mer <span class="sr-only">om '.$post_title.'</span></a>';
			$output .= '		</div>';
			
			$output .= '	</div>';
			$output .= '	</a>';
			
			$output .= '</article>';
		
		?>
		
    <?php
    endforeach; 
    wp_reset_postdata();
		echo $output;
		
		?>
	</div>
</section>