<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

# temp
$product_id = get_the_id();
$product_designer = get_post_meta( get_the_ID(), 'designer_type')[0];

/*
// --------------------------------------------------------
// Setup
// --------------------------------------------------------
$product_id = get_the_id();
$product_designer = get_post_meta( get_the_ID(), 'designer_type')[0];
$path = get_stylesheet_directory();

// ------------------------------------------------
// Output current sign
// ------------------------------------------------
$current_sign_obj = '';
$product_title = get_the_title();
$product_width = get_post_meta( get_the_ID(), 'product_width');
$product_height = get_post_meta( get_the_ID(), 'product_height');
$product_variant_hasicon = 'false';
$product_variant_icon_default = 0;
$product_desc = '';

// --------------------------------------------
// Image
// --------------------------------------------
if ( has_post_thumbnail( $product_id ) ) {
	$attachment_ids[0] = get_post_thumbnail_id( $product_id );
	$attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );
	$variant_image_path = $attachment[0];
	
	$attachment_width = $attachment[1];
	$attachment_height = $attachment[2];
	
	# $image_info = list($width, $height, $type, $attr) = getimagesize("download.jpg");
	# $width = $image_info[0];
	# $height = $image_info[1];
	
	#$variant_image_path = explode( '/' , $variant_image_path, 4 );
	#$variant_image_path = $variant_image_path[3];
} else {
	echo '<div class="alert alert-danger">OBS! Ingen produktbild inlagd.</div>';
}

if($product_variant_hasicon) {
	$product_variant_icon_default = 'e025';
}

$sign_interface = get_post_meta( $product_id, 'sign_interface');

// --------------------------------------------
// Misc
// --------------------------------------------
$product_text_color = get_post_meta( $product_id, 'text_color');
$variant_text_color = empty( strlen($product_text_color[0]) ) ? '#0000FF' : $product_text_color[0];
$variant_leftoffset = get_post_meta( $product_id, 'leftoffset');
$variant_rightoffset = get_post_meta( $product_id, 'rightoffset');

$product_description = get_post( $product_id )->post_content;

// --------------------------------------------
// Price
// --------------------------------------------

$product_price = get_post_meta( $product_id, '_regular_price', true);

if( get_post_meta( get_the_ID(), '_sale_price', true) ) {
	$sale_price = get_post_meta( $product_id, '_sale_price', true);
}

// --------------------------------------------
// How many textrows
// --------------------------------------------
// Must be parsed as number
$text_rows_amount = get_post_meta( $product_id, 'text_rows' );
$text_rows_amount = $text_rows_amount[0];

if(empty($text_rows_amount)) {
	$text_rows_amount = 1;
}

// --------------------------------------------
// Does this sign have holes?
// --------------------------------------------
$sign_has_holes = get_post_meta( $product_id, 'has_holes', true);

if($sign_has_holes == "yes") {
	$sign_has_holes = 1;
} else {
	$sign_has_holes = 0;
}

// --------------------------------------------
// Does this sign have icons?
// --------------------------------------------
$sign_has_icons = get_post_meta( $product_id, 'has_icon', true);

if($sign_has_icons == "yes") {
	$sign_has_icons = 1;
} else {
	$sign_has_icons = 0;
}

// --------------------------------------------
// Sign interface
// --------------------------------------------

$interfaces = nb_get_product_interfaces( $product_id );

// --------------------------------------------
// Build data object for VUE app
// --------------------------------------------

$current_sign_obj = (object) [
	'id' => $product_id,
	'price' => $product_price,
	'saleprice' => $sale_price,
	'currency' => get_option('woocommerce_currency'),
	'name' => $product_title,
	'description' => htmlspecialchars(json_encode($product_description), ENT_QUOTES, 'UTF-8'),
	'image' => urlencode($variant_image_path),
	'color' => $product_color,
	'width' => $product_width[0],
	'height' => $product_height[0],
	'hasicon' => $sign_has_icons,
	'hasholes' => $sign_has_holes,
	'align' => 'left',
	'textcolor' => $variant_text_color,
	'leftoffset' => $variant_leftoffset[0],
	'rightoffset' => $variant_rightoffset[0],
	'rowsnum' => $text_rows_amount,
	'interface' => $interfaces,
	
	// New
	"realwidth" => $product_width[0],
	"realheight" => $product_height[0],
	"imagewidth" => $attachment[1],
	"imageheight" => $attachment[2],
];
$obj = $current_sign_obj;

#$output = '<div id="current-sign" ';
#foreach($obj as $key => $value) {
#	$output .= ' data-'.$key.'="'.urldecode($value).'"';
#}
#$output .= '></div>';
#echo $output;

*/

// --------------------------------------------------------
// Checka vilken designer som ska användas:
// --------------------------------------------------------

if($product_designer == 1):
?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php wc_get_template_part( 'content', 'single-designer' ); ?>
<?php endwhile; ?>

<?php
else:
?>
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php wc_get_template_part( 'content', 'single-product' ); ?>
		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>
<?php endif; ?>

<script>
<?php
/*
font - defines the font properties for the text
fillText(text,x,y) - draws "filled" text on the canvas
strokeText(text,x,y) - draws text on the canvas (no fill)
*/
// http://www.ckollars.org/canvas-text-centering.html
// https://www.w3schools.com/tags/canvas_textalign.asp

//----------------------------------------------------------------
// Make an object with the current product... Vars from above...
//----------------------------------------------------------------

/*
$signobj = 'var signobj = {';
foreach($obj as $key => $value) {
	$signobj .= '"'.$key.'" : "' . urldecode($value) . '", ';
}
$signobj .= '};';
*/

#echo '//----------------------------';
#echo $signobj;
#echo '//----------------------------';


// Get sign obj from class
#echo '//----------------------------';
$product_id = get_the_id();
echo $VueEditor->signobj($product_id);
#echo '//----------------------------';

// All data
echo $VueEditor->alldata();

// Path
echo $VueEditor->icon_json();

?>
</script>

<?php
get_footer( 'shop' );