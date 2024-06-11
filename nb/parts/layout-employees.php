<?php
$employees_title = get_sub_field('employees_title');
?>

<div class="module-wrapper module-wrapper--employeelist list">

<?php
if($employees_title) {
	echo '<h3 class="module-title">' . $employees_title . '</h3>';	
}

$output = '<ul>';

if( have_rows('employee_list') ):

 	// loop through the rows of data
    while ( have_rows('employee_list') ) : the_row();
		
		$output .= '<li>';

		if( get_sub_field('employee_title') ) {
			$output .= get_sub_field('employee_title');
		}

		if( get_sub_field('employee_name') ) {
			$output .= '<br /><span class="small">'.get_sub_field('employee_name').'</small>';
		}
		
		$output .= '</li>';

    endwhile;

else :
	$output = 'Inga länkar hittades';
endif;

$output .= '</ul>';

echo $output;

?>

</div>