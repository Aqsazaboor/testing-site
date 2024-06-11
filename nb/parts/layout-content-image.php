<?php

$text = trim( get_sub_field("text") );
$image = trim( get_sub_field("image") );
$image_tag_lg = wp_get_attachment_image( $image, 'large', false,  false);
$image_tag = wp_get_attachment_image( $image, 'medium', false,  false);
$caption = trim( get_sub_field("caption") );

?>
<div class="module-wrapper module-wrapper--content-image">
	<div class="row">
		<div class="col-sm-12">
		    <div class="ImageText">
			    <div class="image__image">
					<?php echo $image_tag_lg; ?>
					<?php if($caption) { ?>
					<div class="image__text">
						<?php echo $caption; ?>
					</div>
					<?php } ?>
			    </div>
		    </div>
		</div>
	</div>
</div>