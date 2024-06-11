<?php

$text = trim( get_sub_field("text") );
$image = trim( get_sub_field("image") );
$link_url = trim( get_sub_field("link_url") );
$button_text = trim( get_sub_field("button_text") );
$image_tag_lg = wp_get_attachment_image( $image, 'large', false,  false);
$image_tag = wp_get_attachment_image( $image, 'medium', false,  false);
$caption = trim( get_sub_field("caption") );

?>
<div class="module-wrapper module-wrapper--campaign-surface">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="valign">
					<div class="text-inner">
						<?php if($text) {
							echo $text;
						} ?>
						<a class="btn btn-primary mt-1" href="<?php echo $link_url; ?>"><?php echo $button_text; ?></a>
					</div>
				</div>
			</div>
			<div class="col-md-6 image">
				<?php echo $image_tag_lg; ?>
			</div>
		</div>
	</div>
</div>