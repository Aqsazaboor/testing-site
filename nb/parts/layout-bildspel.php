<?php
$slider_header = get_sub_field("section_title");
$slide_image = trim(get_sub_field("bildspel_image"));
$slide_title = trim(get_sub_field("bildspel_title"));
$slide_URL = trim(get_sub_field("bildspel_url"));
?>

<div class="module-wrapper module-wrapper--slideshow">
	
	<?php if($slider_header) {
		echo '<div class="module-wrapper--slideshow-header"><h1>' . $slider_header . '</h1></div>';
	}
	?>

	<div class="flickity-container carousel" data-flickity='{ "draggable": false }'>
	<?php
	
	$output = '';
	
	if( have_rows('bildspel_item') ):
	
	 	// loop through the rows of data
	    while ( have_rows('bildspel_item') ) : the_row();
			
			$image = get_sub_field("bildspel_image");
			$image_tag_lg = wp_get_attachment_image($image, 'large', false,  false);
			$image_tag = wp_get_attachment_image($image, 'medium', false,  false);
			$image_tag_lg_URL = wp_get_attachment_url($image);
			
			$background_image = '';
			
			if($image) {
				$background_image = 'style="background-image: url('.$image_tag_lg_URL.');"';
			}
			
			$output .= '<div class="carousel-cell" '.$background_image.'>';
			
			if( get_sub_field('bildspel_url') ) {
				$output .= '<div><a href="'.get_sub_field('bildspel_url').'">';
			}
			
			if( get_sub_field('bildspel_title') ) {
				$output .= '<div class="slide-item-inner">';
				$output .= '<h1 class="slide-title">' . get_sub_field('bildspel_title') . '</h1>';
				$output .= '</div>';
			}
			
			if( get_sub_field('bildspel_url') ) {
				$output .= '</a></div>';
			}
			
			$output .= '</div>';
	
	    endwhile;
	
	else :
		$output = 'Inga länkar hittades';
	endif;
	
	echo $output;
	
	?>
	</div>
	
</div>