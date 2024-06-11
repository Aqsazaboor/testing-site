<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/*
 *
 * This is to handle extra costs related to bigger text and more lines
 * 
 */
if( !function_exists('custom_meta_after_order_itemmeta') ):
function custom_meta_after_order_itemmeta( $item_id, $item, $product ) {
    if( ! $item->is_type('line_item') ) return;
	if( isset($product) && is_admin() && wc_get_order_item_meta( $item_id, 'orderimage', true) ) {

	global $post;
	$order = new WC_Order($post->ID);
	$order_id = $order->get_order_number();
?>
<div id="custom_order_app" class="nbordereditapp-<?php echo $item_id; ?>">
	<div v-if="showCustomFields" class="custom-fields">

<?php
if(!$product) {
	echo '<div>';
	echo "Error! Kan inte hitta produkt.";
	echo '</div>';
} else {
	$product_id = $product->get_id();
	$product_width = get_post_meta( $product_id, 'product_width' );
	$product_height = get_post_meta( $product_id, 'product_height' );
	$designer_id = get_post_meta( $product_id, 'designer_type' );
	$onlyLaser = get_post_meta( $product_id, 'only_laser');

	// Product has designer type start
	if(isset($designer_id)) {
?>

	<?php
	if( $product_width && $product_height ) {
		echo '<div class="custom-fields-product-size">Storlek: ' . $product_width[0] . ' x ' . $product_height[0] . ' mm' . '</div>';		
	}
	?>

	<?php
	if( wc_get_order_item_meta( $item_id, 'orderimage', true) ) {
		$orderImageUrl = wc_get_order_item_meta( $item_id, 'orderimage', true);
		echo '<img class="order-image" src="'.$orderImageUrl.'" alt="" />' . '<br>';
	}	
	?>

	<?php
		$textrows = '';
		$textrow1 = wc_get_order_item_meta( $item_id, 'textrow1', true);
		$textrow2 = wc_get_order_item_meta( $item_id, 'textrow2', true);
		$textrow3 = wc_get_order_item_meta( $item_id, 'textrow3', true);
		$textrow4 = wc_get_order_item_meta( $item_id, 'textrow4', true);
		$textrow5 = wc_get_order_item_meta( $item_id, 'textrow5', true);
		
		$textrows .= $textrow1 !== 'undefined' ? $textrow1."\n" : null;
		$textrows .= $textrow2 !== 'undefined' ? $textrow2."\n" : null;
		$textrows .= $textrow3 !== 'undefined' ? $textrow3."\n" : null;
		$textrows .= $textrow4 !== 'undefined' ? $textrow4."\n" : null;
		$textrows .= $textrow5 !== 'undefined' ? $textrow5."\n" : null;
		
		$textFont1 = wc_get_order_item_meta( $item_id, 'Font', true);
		$textFont2 = wc_get_order_item_meta( $item_id, 'font', true);
		$checkItalic = (int)wc_get_order_item_meta( $item_id, 'textitalic', true) == 1 ? 'Ja' : '';
		$checkBold = (int)wc_get_order_item_meta( $item_id, 'textbold', true) == 1 ? 'Ja' : '';
		$textAlignment = wc_get_order_item_meta( $item_id, 'textalignment', true);
		$textOffset = wc_get_order_item_meta( $item_id, 'textoffset', true);
		$textSize = wc_get_order_item_meta( $item_id, 'textsize', true);
		$engravingType = wc_get_order_item_meta( $item_id, 'engraving_type', true);
	?>
		<ul class="order sign properties list-unstyled" style="margin: 20px 0;" contenteditable="true">
			<?php echo $textFont1 ? '<li><label>' . pll__('Typsnitt') . '</label><div style="text-transform: capitalize;">' . $textFont1 . '</div></li>' : ''; ?>
			<?php echo $textFont2 ? '<li><label>' . pll__('Typsnitt') . '</label><div style="text-transform: capitalize;">' . $textFont2 . '</div></li>' : ''; ?>
			<?php echo $textSize ? '<li><label>' . pll__('Textstorlek') . '</label><div>'. $textSize .' mm</div></li>' : ''; ?>
			<?php echo $checkBold ? '<li><label>' . pll__('Fet text') . '</label><div>' . $checkBold. '</div></li>' : ''; ?>
			<?php echo $checkItalic ? '<li><label>' . pll__('Kursiv') . '</label><div>' . $checkItalic . '</div></li>' : ''; ?>
			<?php
			if( $textAlignment !== 'center') {
				echo $textAlignment ? '<li><label>' . pll__('Alignment') . '</label><div>' . $textAlignment . '</div></li>' : '';
				echo $textOffset ? '<li><label>' . pll__('Offset') . '</label><div>' . $textOffset . ' mm</div></li>' : '';			
			}
			?>
			<?php
			if($textrows) {
				echo '<li class="text_box"><label>Text:</label><div><textarea style="width:300px; height:90px; border-color:#ccc;">';
				echo $textrows ? trim($textrows) : '';
				echo '</textarea></div></li>';
				echo '<li class="amount"><label>' . pll__('Antal') . '</label><div>' . $item['quantity'] . ' st</div></li>';
			}
			?>
			<?php echo $engravingType; ?><br />
			<?php if(isset($onlyLaser[0])) {
				echo $onlyLaser[0] == "yes" ? "<strong>Gravyr:</strong> Endast lasergravyr" : "";
			} ?>
			<?php echo $engravingType ? '<li><label>' . pll__('Gravyrtyp') . '</label><div>' . $engravingType . '</div></li>' : ''; ?>
		</ul>
	<?php		
			}
		}
	?>

	<?php
	$productData = array(
		"order_id" => isset($order_id) ? $order_id : 0,
		"item_id" => isset($item_id) ? $item_id : 0,
		"product_width" => isset($product_width[0]) ? $product_width[0] : 0,
		"product_height" => isset($product_height[0]) ? $product_height[0] : 0,
		"text_alignment" => isset($textAlignment) ? $textAlignment : 0,
		"text_font" => isset($textFont2) ? $textFont2 : 0,
		"text_size" => isset($textSize) ? $textSize : 0,
		"text_offset" => isset($textOffset) ? $textOffset : 0,
		"text_bold" => isset($checkBold) ? $checkBold : 0,
		"text_italic" => isset($checkItalic) ? $checkItalic : 0,
		"text_rows" => isset($checkItalic) ? trim($textrows) : "",
	);
	$lineItemObject = json_encode($productData);
?>
		<div class="create-image__container">	
			<button
			class="button"
			type="button"
			@click.prevent='saveOrderIdLocalstorage(<?php echo $lineItemObject; ?>)'
			>Ladda ner bild (öppnas i nytt fönster)</button>
		</div>
	</div>
</div>

<?php
	}
	// Product has designer type END
}
add_action( 'woocommerce_after_order_itemmeta', 'custom_meta_after_order_itemmeta', 20, 3 );
endif;