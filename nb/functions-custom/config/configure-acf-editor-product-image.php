<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group( array(
		'key' => 'group_65797c202963a',
		'title' => 'Editor Product Image',
		'fields' => array(
			array(
				'key' => 'field_65797c20a7438',
				'label' => 'Editor Image',
				'name' => 'editor_image',
				'aria-label' => '',
				'type' => 'image',
				'instructions' => 'This image is used in the Editor. Woo default Image is used for product cards.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'preview_size' => 'medium',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	) );
endif;