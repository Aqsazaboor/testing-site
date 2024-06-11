<?php

$image = trim( get_sub_field("image") );
$image_tag = wp_get_attachment_image( $image, 'full', false,  array( 'class' => 'ImageFull-image' ));
$caption = trim( get_sub_field("caption") );
?>
<div class="module-wrapper module-wrapper--full-image">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-10 col-lg-offset-1">
				<?php if ($caption) { ?>
				<div class="image-full-caption">
					<div class="text__text">
						<?php echo $caption ?>
					</div>
				</div>
				<?php } ?>

				<div class="image-full">
					<?php echo $image_tag ?>
				</div>
			</div>
		</div>
	</div>
</div>