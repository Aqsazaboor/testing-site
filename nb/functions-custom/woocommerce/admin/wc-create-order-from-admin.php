<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 *
 * This function to handle order data from the Admin
 * 
 */

function display_custom_editable_field_on_admin_orders( $item_id, $item, $product ) {

    if( ! $item->is_type('line_item') ) return;
    
    // Should only be on a self created order
    // should not be visible on shipping
    // Should not collide with other fields (double)
    
    // Check if Order Image is Present. This is only possible
    // if you create it thru the designer and FE flow	
	if( is_admin() && !wc_get_order_item_meta( $item_id, 'orderimage', true) ) {
	    $post_id = get_the_ID();
	    $product_id = $product->get_id();
		$product_width = get_post_meta( $product_id, 'product_width' );
		$product_height = get_post_meta( $product_id, 'product_height' );
			    
	    $extraFont = get_post_meta( $post_id, 'font', true);
	    $extraTextRow1 = get_post_meta( $post_id, 'textrow1', true);
	    $extraTextRow2 = get_post_meta( $post_id, 'textrow2', true);
	    $extraTextRow3 = get_post_meta( $post_id, 'textrow3', true);
	    $extraTextRow4 = get_post_meta( $post_id, 'textrow4', true);
	    $extraTextRow5 = get_post_meta( $post_id, 'textrow5', true);
	    $extraBold = get_post_meta( $post_id, 'bold', true);
	    $extraItalic = get_post_meta( $post_id, 'italic', true);
		$textSize = get_post_meta( $post_id, 'textsize', true);
    ?>
    
    <div class="custom-fields extra_fields_data_wrapper-<?php echo $item_id ?>" v-cloak>
		<?php
	    if( $product_width && $product_height ) {
			echo '<div class="custom-fields-product-size">Storlek: ' . $product_width[0] . ' x ' . $product_height[0] . ' mm' . '</div>';		
		}
		?>
		<?php
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );
		if($image) {
			echo '<img class="order-image" src="'.$image[0].'">';
		}
		?>
	    
	    <div class="">
		    <ul class="order sign properties list-unstyled" style="margin: 20px 0px;">
				<?php echo $extraFont ? '<li><label>Typsnitt</label> <div>' . $extraFont . '</div></li>' : ''; ?>
				<?php echo $extraTextRow1 ? '<li><label>Textrad 1</label> <div contenteditable="true">' . $extraTextRow1 . '</div></li>' : ''; ?>
				<?php echo $extraTextRow2 ? '<li><label>Textrad 2</label> <div contenteditable="true">' . $extraTextRow2 . '</div></li>' : ''; ?>
				<?php echo $extraTextRow3 ? '<li><label>Textrad 3</label> <div contenteditable="true">' . $extraTextRow3 . '</div></li>' : ''; ?>
				<?php echo $extraTextRow4 ? '<li><label>Textrad 4</label> <div contenteditable="true">' . $extraTextRow4 . '</div></li>' : ''; ?>
				<?php echo $extraTextRow5 ? '<li><label>Textrad 5</label> <div contenteditable="true">' . $extraTextRow5 . '</div></li>' : ''; ?>
				<?php echo $extraBold ? '<li><label>Fet text</label> <div>' . $extraBold . '</div></li>' : ''; ?>
				<?php echo $extraItalic ? '<li><label>Kursiv</label> <div>' . $extraItalic . '</div></li>' : ''; ?>
				<?php echo $textSize ? '<li><label>Textstorlek</label> <div>' . $textSize . '</div></li>' : ''; ?>
		    </ul>
	    </div>
    	
	    <div class="extra-fields-inner" v-if="openExtraFields.indexOf('extra_fields_data_wrapper-<?php echo $item_id ?>') !== -1">
		    <h2>Använd dessa om du skapar en intern order</h2>
		    
		    <div>
			    <?php
			    woocommerce_wp_text_input( array(
			        'id' => 'font',
			        'label' => __('Typsnitt:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
			</div>
		    
		    <div>
			    <?php
			    woocommerce_wp_text_input( array(
			        'id' => 'textrow1',
			        'label' => __('Textrow1:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
			</div>

		    
		    <div>
			    <?php
			    woocommerce_wp_text_input( array(
			        'id' => 'textrow2',
			        'label' => __('Textrow2:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
			</div>

		    
		    <div>
				<?php
			    woocommerce_wp_text_input( array(
			        'id' => 'textrow3',
			        'label' => __('Textrow3:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
			</div>

		    
		    <div>
			    <?php
			    woocommerce_wp_text_input( array(
			        'id' => 'textrow4',
			        'label' => __('Textrow4:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
		    </div>
		    
			<div>
			    <?php
			    woocommerce_wp_text_input( array(
			        'id' => 'textrow5',
			        'label' => __('Textrow5:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
			</div>
			
			<div>
			    <?php
			    woocommerce_wp_text_input( array(
			        'id' => 'bold',
			        'label' => __('Fet text:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
			</div>

			
			<div>
			    <?php
			    woocommerce_wp_text_input( array(
			        'id' => 'italic',
			        'label' => __('Kursiv:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
			</div>


			<div>
			    <?php
			    woocommerce_wp_text_input( array(
			        'id' => 'textsize',
			        'label' => __('Textstorlek:'),
			        'wrapper_class' => 'form-field-wide'
			    ) );
			    ?>
			</div>

	    </div>
		<button class="toggle-internal-order-extra-fields" role="button" @click.prevent="showExtraFields('extra_fields_data_wrapper-<?php echo $item_id ?>')">Edit extra fields</button>
    </div>
<?php
	}

}
add_action( 'woocommerce_after_order_itemmeta',  'display_custom_editable_field_on_admin_orders', 20, 3 );
#add_action( 'woocommerce_before_order_itemmeta',  'display_custom_editable_field_on_admin_orders' );



function save_order_custom_field_meta( $post_id ) {

	if ( isset($_POST['font']) )
		update_post_meta( $post_id, 'font', sanitize_text_field($_POST['font']) );	
		
	if ( isset($_POST['textrow1']) )
		update_post_meta( $post_id, 'textrow1', sanitize_text_field($_POST['textrow1']) );
	
	if ( isset($_POST['textrow2']) )
		update_post_meta( $post_id, 'textrow2', sanitize_text_field($_POST['textrow2']) );
	
	if ( isset($_POST['textrow3']) )
		update_post_meta( $post_id, 'textrow3', sanitize_text_field($_POST['textrow3']) );
	
	if ( isset($_POST['textrow4']) )
		update_post_meta( $post_id, 'textrow4', sanitize_text_field($_POST['textrow4']) );
	
	if ( isset($_POST['textrow5']) )
		update_post_meta( $post_id, 'textrow5', sanitize_text_field($_POST['textrow5']) );

	if ( isset($_POST['bold']) )
		update_post_meta( $post_id, 'bold', sanitize_text_field($_POST['bold']) );
		
	if ( isset($_POST['italic']) )
		update_post_meta( $post_id, 'italic', sanitize_text_field($_POST['italic']) );

	if ( isset($_POST['textsize']) )
		update_post_meta( $post_id, 'textsize', sanitize_text_field($_POST['textsize']) );
	
	// etc
}
add_action( 'woocommerce_process_shop_order_meta', 'save_order_custom_field_meta' );

/*
function get_users_by_role($role, $orderby, $order) {
	$args = array(
		'role'    => $role,
		'orderby' => $orderby,
		'order'   => $order
	);
	$users = get_users( $args );
	return $users;
}

//Add a custom field
add_action( 'woocommerce_before_order_itemmeta', 'add_order_item_sohag_assigned', 10, 2 );
function add_order_item_sohag_assigned( $item_id, $item ) {
	// Targeting line items type only
	if( $item->get_type() !== 'line_item' ) return;
	
	$users = get_users_by_role('field_worker', 'user_nicename', 'ASC');
	$opts = array();
	foreach ( $users as $user )
	{
	$opts[$user->ID] = $user->user_email;
	}
	woocommerce_wp_select( array(
		'id'            => 'sohag_assigned_'.$item_id,
		'label'         => __( 'Assigned Engineer', 'cfwc' ),
		'description'   => __( 'Select an engineer', 'ctwc' ),
		'desc_tip'      => true,
		'class'         => 'woocommerce',
		'options'       => $opts,
		'value'         => wc_get_order_item_meta( $item_id, '_sohag_assigned' ),
	) );}
	
	// Save the custom field value
	add_action('save_post_shop_order', 'save_order_item_sohag_assigned_value');
	function save_order_item_sohag_assigned_value( $post_id ){
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
		return $post_id;
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
		
		if ( ! current_user_can( 'edit_shop_order', $post_id ) )
		return $post_id;
		
	$order = wc_get_order( $post_id );
		
		// Loop through order items
	foreach ( $order->get_items() as $item_id => $item ) {
		if( isset( $_POST['sohag_assigned_'.$item_id] ) ) {
		    wc_update_order_item_meta( $item_id, '_sohag_assigned', 
			sanitize_text_field( $_POST['sohag_assigned_'.$item_id] ) );
		}
	}
}

// Optionally Keep the new meta key/value as hidden in backend
add_filter( 'woocommerce_hidden_order_itemmeta','additional_hidden_order_itemmeta', 10, 1 );
function additional_hidden_order_itemmeta( $args ) {
	$args[] = '_sohag_assigned';
	return $args;
}
*/