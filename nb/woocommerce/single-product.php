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
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$product_id = get_the_id();
if( count(get_post_meta( get_the_ID(), 'designer_type')) > 0 ) {
	$product_designer = get_post_meta( get_the_ID(), 'designer_type')[0];
} else {
	$product_designer = 0;
}

get_header( 'shop' );

// --------------------------------------------------------
// Checka vilken designer som ska användas:
// --------------------------------------------------------

if($product_designer == 1 || $product_designer == 2):
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
// Get sign obj from class
$product_id = get_the_id();
echo $VueEditor->signobj($product_id)."\n\n";
// All data
echo $VueEditor->alldata();
?>
</script>
<script>
<?php
$product_color_output = '';
$product_material_output = '';
if(function_exists('translate_materials_and_color')) {
	$product_material = get_post_meta( $product_id, 'product_material', true) ? get_post_meta( $product_id, 'product_material', true) : "none";
	$product_color = get_post_meta( $product_id, 'product_color', true) ? get_post_meta( $product_id, 'product_color', true) : "none";

	if($product_material && $product_color) {
		$get_material = 'material_'.strtolower( $product_material );
		$get_color = 'variant_'.strtolower( $product_color );
	}

	$material = translate_materials_and_color($get_material);
	$color = translate_materials_and_color($get_color );

	if($material) {
		$product_material_output = $material;
	}
	if($color) {
		$product_color_output = $color;	   				        
	}
}
	$singleProductString = array(
		"material" => $product_color_output ? $product_color_output : '',
		"color" => $product_material_output ? $product_material_output : '',
	);
	echo "const product_language_strings = " . ($singleProductString ? json_encode($singleProductString) : '{}') . ";";
?>
</script>
<?php
get_footer( 'shop' );