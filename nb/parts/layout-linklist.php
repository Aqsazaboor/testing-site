<?php
$linklist_title = get_sub_field('linklist_title');
?>

<div class="module-wrapper module-wrapper--linklist list">

<?php
if($linklist_title) {
	echo '<h3 class="module-title">' . $linklist_title . '</h3>';	
}

$output = '<ul>';

if( have_rows('links') ):

 	// loop through the rows of data
    while ( have_rows('links') ) : the_row();
		
		if( get_sub_field('link_url') ) {
			$output .= '<li><a href="'.get_sub_field('link_url').'">';
		}
		
		if( get_sub_field('link_title') ) {
			$output .= get_sub_field('link_title');
		} else {
			$output .= get_sub_field('link_url');
		}
		
		if( get_sub_field('link_url') ) {
			$output .= '</a></li>';
		}

    endwhile;

else :
	$output = 'Inga länkar hittades';
endif;

$output .= '</ul>';

echo $output;

?>

</div>