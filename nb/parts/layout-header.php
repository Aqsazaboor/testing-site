<?php
$header_text = trim(get_sub_field("header_text"));
$header_size = get_sub_field("header_size");
?>

<div class="module-wrapper module-wrapper--header">

	<div class="text__text">
		<?php
			$post_type = get_post_type( get_the_ID() );
			if( $post_type == 'casefonts' ) {
				echo '<div class="label">Custom fonts</div>';
			} elseif( $post_type == 'fonts' ) {
				echo '<div class="label">Commercial fonts</div>';
			}
		?>
		<header class="entry-header">
			<<?php echo $header_size; ?> id="<?php echo sanitize_title( $header_text ); ?>" class="entry-title"><?php echo $header_text; ?></<?php echo $header_size; ?>>
		</header>
		
		
	</div>

</div>