<?php

$image = trim( get_sub_field("image") );
$image_tag = wp_get_attachment_image( $image, 'full', false,  array( 'class' => 'ImageFull-image' ));
$title = trim( get_sub_field("title") );
$text = trim( get_sub_field("text") );
?>
<div class="module-wrapper module-wrapper--hero">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-10 col-lg-offset-1">
				<?php if ($title) { ?>
				<div class="image-full-caption">
					<div class="text__text">
						<h1><?php echo $title ?></h1>
						<p><?php echo $text; ?></p>
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