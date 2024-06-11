<?php
function canvas($product_id) {
?>

<div class="generator-image">
    <div class="generated-image" data-material-id="1">
	    <?php
		// Get image size
		$product = wc_get_product();
		$product_id = $product->get_id();
		$product_image = wp_get_attachment_url( get_post_thumbnail_id( $product_id ) );
		
		if($product_image) {
			$image_info = list($width, $height, $type, $attr) = getimagesize($product_image);
			$product_image_width = $image_info[0];
			$product_image_height = $image_info[1];
			$output = '<canvas ref="canvas" id="generator-canvas" class="generator-canvas" width="'.$product_image_width.'" height="'.$product_image_height.'"></canvas>';
			echo $output;			
		} else {
			echo 'No product image found.';
		}
		?>
	</div>
</div>

<?php
}