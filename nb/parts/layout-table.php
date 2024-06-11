<?php
$table_header = get_sub_field("section_title");
?>

<div class="module-wrapper module-wrapper--table">
	<div class="container">
	
		<?php if($table_header) {
			echo '<div class="module-wrapper--table-header"><h2>' . $table_header . '</h2></div>';
		}
		?>
		<div class="row">
			<div class="table col-md-12">
		<?php
		
		$output = '';
		
		if( have_rows('table_item') ):
			$output .= '<div class="row">';
			$output .= '<div class="col-md-6 table-header"><h3 class="col-title">Spec.</h3></div>';
			$output .= '<div class="col-md-6 table-header"><h3 class="col-title">Pris</h3></div>';		
	
		 	// loop through the rows of data
		    while ( have_rows('table_item') ) : the_row();
				
				$output .= '<div class="col-md-12">';
				$output .= '	<div class="row">';
				
				$item_product = trim(get_sub_field("product"));
				$item_price = trim(get_sub_field("price"));
				
				if( $item_product ) {
					$output .= '<div class="col-md-6">'.$item_product.'</div>';
				}
				
				if( $item_price ) {
					
					$output .= '<div class="col-md-6">'.$item_price.'</div>';
					
				}
				$output .= '	</div>';
				$output .= '</div>';
		
		    endwhile;
			$output .= '</div>';
		else :
			$output = 'Inga produkter hittades';
		endif;
		
		echo $output;
		
		?>
			</div>
		</div>
	</div>
</div>