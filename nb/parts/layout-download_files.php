<?php
$filelist_title = get_sub_field('title');
?>

<div class="module-wrapper module-wrapper--download-files">

<?php
if($filelist_title) {
	echo '<h3 class="module-title">' . $filelist_title . '</h3>';	
}

$output = '<ul>';

if( have_rows('files') ):

 	// loop through the rows of data
    while ( have_rows('files') ) : the_row();
		$file_item_filename = get_sub_field('file_item')['filename'];
		$file_item_URL = get_sub_field('file_item')['url'];
		
		if( $file_item_URL ) {
			$output .= '<li><a href="'.$file_item_URL.'">';
		}
		
		if( get_sub_field('file_item_name') ) {
			$output .= get_sub_field('file_item_name');
		} else {
			$output .= $file_item_filename;
		}
		
		if( $file_item_URL ) {
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