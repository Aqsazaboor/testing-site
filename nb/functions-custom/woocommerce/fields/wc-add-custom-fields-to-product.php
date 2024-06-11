<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ------------------------------------------------------------------------
// For admin
// ------------------------------------------------------------------------

if(!function_exists('nb_adv_product_options')):
add_action( 'woocommerce_product_options_general_product_data', 'nb_adv_product_options' );
# Move the options outside the Simple Products etc-selector.
# add_action( 'woocommerce_product_options_pricing', 'nb_adv_product_options');
function nb_adv_product_options(){
			
	$rows[''] = __( 'Select a value', 'woocommerce');
	
	for ($x = 0; $x <= 5; $x++) {
		$rows[$x] = $x;
	} 
	
	echo '<div class="options_group">';
	
	woocommerce_wp_text_input( array(
		'id'      => 'alternate_title',
		'value'   => get_post_meta( get_the_ID(), 'alternate_title', true ),
		'label'   => 'Alternate title',
		'desc_tip' => true,
		'description' => 'Enter alternate title',
	) );
	
	// Sizes
	woocommerce_wp_text_input( array(
		'id'      => 'product_width',
		'value'   => get_post_meta( get_the_ID(), 'product_width', true ),
		'label'   => 'Width',
		'desc_tip' => true,
		'description' => 'Enter sign width',
	) );
	
	woocommerce_wp_text_input( array(
		'id'      => 'product_height',
		'value'   => get_post_meta( get_the_ID(), 'product_height', true ),
		'label'   => 'Height',
		'desc_tip' => true,
		'description' => 'Enter sign height',
	) );
	
	woocommerce_wp_text_input( array(
		'id'      => 'text_color',
		'value'   => get_post_meta( get_the_ID(), 'text_color', true ),
		'label'   => 'Text color',
		'desc_tip' => true,
		'description' => 'What color is the text?',
	) );
	
	woocommerce_wp_text_input( array(
		'id'      => 'text_color_shadow',
		'value'   => get_post_meta( get_the_ID(), 'text_color_shadow', true ),
		'label'   => 'Text color Shadow',
		'desc_tip' => true,
		'description' => 'What color is the text shadow?',
	) );
	
	woocommerce_wp_select( array(
		'id'      => 'text_rows',
		'value'   => get_post_meta( get_the_ID(), 'text_rows', true ),
		'label'   => 'Text rows',
		'desc_tip' => true,
		'description' => 'How many lines of text can be entered in sign?',
		'options' =>  $rows,
	) );

	woocommerce_wp_select( array(
		'id'      => 'designer_type',
		'value'   => get_post_meta( get_the_ID(), 'designer_type', true ),
		'label'   => 'Designer type',
		'desc_tip' => true,
		'description' => 'Use other designer than the general one for brass?',
		'options' => array('None','Plastic', 'Brass', 'Advanced'),
	) );
	
	// Colors
	woocommerce_wp_select( array(
		'id'      		=> 'product_color',
		'value'   		=> get_post_meta( get_the_ID(), 'product_color', true ),
		'label'   		=> 'Product color',
		'desc_tip' 		=> true,
		'description'	 => 'What color is this product?',
		'options' => array(
			'None' 		=> 'none',
			'Blue' 		=> 'blue',
			'White' 	=> 'white',
			'Brown' 	=> 'brown',
			'Red' 		=> 'red',
			'Bronze' 	=> 'bronze',
			'Copper' 	=> 'copper',
			'Yellow' 	=> 'yellow',
			'Orange' 	=> 'orange',
			'Pink' 		=> 'pink',
			'Purple' 	=> 'purple',
			'Black' 	=> 'black',
			'Grey' 		=> 'grey',
			'Green' 	=> 'green',
			'Silver' 	=> 'silver',
			'Gold' 		=> 'gold',
			'Polished' 	=> 'polished',
			'Oxidixed' 	=> 'oxidized',
			'BrushedOxidixed' 	=> 'brushedoxidized',
			'NickelPlated' 		=> 'nickelplated',
			'Brushed' 	=> 'brushed',
			'Chrome' 	=> 'chrome',
			'Oak' 		=> 'oak',
			'Birch' 	=> 'birch',
			'Steel' 	=> 'steel',
		),
	) );

	// Material
	woocommerce_wp_select( array(
		'id'      		=> 'product_material',
		'value'   		=> get_post_meta( get_the_ID(), 'product_material', true ),
		'label'   		=> 'Product material',
		'desc_tip' 		=> true,
		'description' 	=> 'What material is this product?',
		'options' => array(
			'None' 		=> 'none',
			'Plastic' 	=> 'plastic',
			'Brass' 	=> 'brass',
			'Aluminum' 	=> 'aluminum',
			'Steel' 	=> 'steel',
			'Oak' 		=> 'oak',
			'Birch' 	=> 'birch',
			'Plexi' 	=> 'plexi',
			'Vinyl' 	=> 'vinyl',
		),
	) );
	
	// Interface
	
	woocommerce_wp_checkbox( array(
		'id'      => 'sign_interface_tape',
		'value'   => get_post_meta( get_the_ID(), 'sign_interface_tape', true ),
		'label'   => 'Interface, tape',
		'desc_tip' => true,
		'description' => 'What kind of interface does the sign have?',
	) );
	
	woocommerce_wp_checkbox( array(
		'id'      => 'sign_interface_militaryclip',
		'value'   => get_post_meta( get_the_ID(), 'sign_interface_militaryclip', true ),
		'label'   => 'Interface, militaryclip',
		'desc_tip' => true,
		'description' => 'What kind of interface does the sign have?',
	) );
	
	woocommerce_wp_checkbox( array(
		'id'      => 'sign_interface_safetypin',
		'value'   => get_post_meta( get_the_ID(), 'sign_interface_safetypin', true ),
		'label'   => 'Interface, safetypin',
		'desc_tip' => true,
		'description' => 'What kind of interface does the sign have?',
	) );
	
	woocommerce_wp_checkbox( array(
		'id'      => 'sign_interface_metalmagnet',
		'value'   => get_post_meta( get_the_ID(), 'sign_interface_metalmagnet', true ),
		'label'   => 'Interface, magnet metal',
		'desc_tip' => true,
		'description' => 'What kind of interface does the sign have?',
	) );
	
	woocommerce_wp_checkbox( array(
		'id'      => 'sign_interface_plasticmagnet',
		'value'   => get_post_meta( get_the_ID(), 'sign_interface_plasticmagnet', true ),
		'label'   => 'Interface, magnet plastic',
		'desc_tip' => true,
		'description' => 'What kind of interface does the sign have?',
	) );

	woocommerce_wp_checkbox( array(
		'id'      => 'sign_interface_keyring',
		'value'   => get_post_meta( get_the_ID(), 'sign_interface_keyring', true ),
		'label'   => 'Interface, metal key ring',
		'desc_tip' => true,
		'description' => 'What kind of interface does the sign have?',
	) );
	
	woocommerce_wp_checkbox( array(
		'id'      => 'sign_interface_screw',
		'value'   => get_post_meta( get_the_ID(), 'sign_interface_screw', true ),
		'label'   => 'Interface, metal screw',
		'desc_tip' => true,
		'description' => 'What kind of interface does the sign have?',
	) );	
	
	
	// Sign image offset

	woocommerce_wp_text_input( array(
		'id'      => 'topoffset',
		'value'   => get_post_meta( get_the_ID(), 'topoffset', true ),
		'label'   => 'Offset top',
		'desc_tip' => true,
		'description' => 'Is an offset needed? Add it here.',
	) );	
	
	woocommerce_wp_text_input( array(
		'id'      => 'leftoffset',
		'value'   => get_post_meta( get_the_ID(), 'leftoffset', true ),
		'label'   => 'Offset left',
		'desc_tip' => true,
		'description' => 'Is an offset needed? Add it here.',
	) );
	
	woocommerce_wp_text_input( array(
		'id'      => 'rightoffset',
		'value'   => get_post_meta( get_the_ID(), 'rightoffset', true ),
		'label'   => 'Offset right',
		'desc_tip' => true,
		'description' => 'Is an offset needed? Add it here.',
	) );
	
	woocommerce_wp_checkbox( array(
		'id'      => 'has_holes',
		'value'   => get_post_meta( get_the_ID(), 'has_holes', true ),
		'label'   => 'Sign have holes',
		'desc_tip' => true,
		'description' => 'Does this sign have holes?',
	) );

	woocommerce_wp_checkbox( array(
		'id'      => 'has_icon',
		'value'   => get_post_meta( get_the_ID(), 'has_icon', true ),
		'label'   => 'Sign has icon',
		'desc_tip' => true,
		'description' => 'Does this product have icons?',
	) );

	woocommerce_wp_checkbox( array(
		'id'      => 'only_laser',
		'value'   => get_post_meta( get_the_ID(), 'only_laser', true ),
		'label'   => 'Only laser engraving',
		'desc_tip' => true,
		'description' => 'Does this sign only allow for laser engraving?',
	) );
	
	echo '</div>';
}
endif;
 

 
add_action( 'woocommerce_process_product_meta', 'nb_save_fields', 10, 2 );
function nb_save_fields( $id, $post ) {
	
	#if( !empty( $_POST['alternate_title'] ) ) {
		update_post_meta( $id, 'alternate_title', $_POST['alternate_title'] );
	#}
	
	if( !empty( $_POST['product_width'] ) ) {
		update_post_meta( $id, 'product_width', $_POST['product_width'] );
	}
	
	if( !empty( $_POST['product_height'] ) ) {
		update_post_meta( $id, 'product_height', $_POST['product_height'] );
	}
	
	if( !empty( $_POST['text_rows'] ) ) {
		update_post_meta( $id, 'text_rows', $_POST['text_rows'] );
	}
	
	// Color
	if( !empty( $_POST['product_color'] ) ) {
		update_post_meta( $id, 'product_color', $_POST['product_color'] );
	}
	if( !empty( $_POST['product_material'] ) ) {
		update_post_meta( $id, 'product_material', $_POST['product_material'] );
	}

		
	// Interface
	// Must be able to send empty value
	if( !empty( $_POST['sign_interface_tape'] ) ) {
		update_post_meta( $id, 'sign_interface_tape', $_POST['sign_interface_tape'] );
	} else {
		update_post_meta( $id, 'sign_interface_tape', false );
	}
	if( !empty( $_POST['sign_interface_militaryclip'] ) ) {
		update_post_meta( $id, 'sign_interface_militaryclip', $_POST['sign_interface_militaryclip'] );
	} else {
		update_post_meta( $id, 'sign_interface_militaryclip', false );
	}
	if( !empty( $_POST['sign_interface_safetypin'] ) ) {
		update_post_meta( $id, 'sign_interface_safetypin', $_POST['sign_interface_safetypin'] );
	} else {
		update_post_meta( $id, 'sign_interface_safetypin', false );
	}
	if( !empty( $_POST['sign_interface_metalmagnet'] ) ) {
		update_post_meta( $id, 'sign_interface_metalmagnet', $_POST['sign_interface_metalmagnet'] );
	} else {
		update_post_meta( $id, 'sign_interface_metalmagnet', false );
	}
	if( !empty( $_POST['sign_interface_plasticmagnet'] ) ) {
		update_post_meta( $id, 'sign_interface_plasticmagnet', $_POST['sign_interface_plasticmagnet'] );	
	} else {
		update_post_meta( $id, 'sign_interface_plasticmagnet', false );
	}
	if( !empty( $_POST['sign_interface_keyring'] ) ) {
		update_post_meta( $id, 'sign_interface_keyring', $_POST['sign_interface_keyring'] );
	} else {
		update_post_meta( $id, 'sign_interface_keyring', false );
	}
	if( !empty( $_POST['sign_interface_screw'] ) ) {
		update_post_meta( $id, 'sign_interface_screw', $_POST['sign_interface_screw'] );	
	} else {
		update_post_meta( $id, 'sign_interface_screw', false );
	}
	
	if( !empty( $_POST['designer_type'] ) ) {
		update_post_meta( $id, 'designer_type', $_POST['designer_type'] );	
	}
	
	// Must be able to send empty value
	#if( !empty( $_POST['text_color_shadow'] ) ) {
		update_post_meta( $id, 'text_color_shadow', $_POST['text_color_shadow'] );	
	#}
	
	if( !empty( $_POST['text_color'] ) ) {
		update_post_meta( $id, 'text_color', $_POST['text_color'] );	
	}
	
	// Must be able to send empty value
	if( $_POST['topoffset'] == 0 ) {
		update_post_meta( $id, 'topoffset', 0 );
	} elseif( empty( $_POST['topoffset']) ) {
		update_post_meta( $id, 'topoffset', 0 );
	} else {
		update_post_meta( $id, 'topoffset', $_POST['topoffset'] );	
	}
	
	if( $_POST['leftoffset'] == 0 ) {
		update_post_meta( $id, 'leftoffset', 0 );
	} elseif( empty( $_POST['leftoffset']) ) {
		update_post_meta( $id, 'leftoffset', 0 );
	} else {
		update_post_meta( $id, 'leftoffset', $_POST['leftoffset'] );	
	}

	if( $_POST['rightoffset'] == 0 ) {
		update_post_meta( $id, 'rightoffset', 0 );
	} elseif( empty( $_POST['rightoffset']) ) {
		update_post_meta( $id, 'rightoffset', 0 );
	} else {
		update_post_meta( $id, 'rightoffset', $_POST['rightoffset'] );	
	}
	
	// Must be able to send empty value
	if( !empty( $_POST['has_holes'] ) ) {
		update_post_meta( $id, 'has_holes', $_POST['has_holes'] );	
	} else {
		update_post_meta( $id, 'has_holes', false );
	}
	
	if( !empty( $_POST['has_icon'] ) ) {
		update_post_meta( $id, 'has_icon', $_POST['has_icon'] );	
	} else {
		update_post_meta( $id, 'has_icon', false );
	}

	if( !empty( $_POST['only_laser'] ) ) {
		update_post_meta( $id, 'only_laser', $_POST['only_laser'] );	
	} else {
		update_post_meta( $id, 'only_laser', false );
	}
}