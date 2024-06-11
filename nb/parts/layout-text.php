<?php
$text = trim(get_sub_field("text"));
$background = trim(get_sub_field("section_background_color"));

$background_color = '';
if($background) {
	$background_color = 'style="background-color: '.$background.';"';
}

?>

<div class="module-wrapper module-wrapper--text" <?php echo $background_color; ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-10">
				
			    <div class="text">
					<?php if ($text): ?>
						<div class="text__text wysiwyg">
							<?php echo $text; ?>
						</div>
					<?php endif; ?>
			    </div>
			    
			</div>
		</div>
	</div>
</div>