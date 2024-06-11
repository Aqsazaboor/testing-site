<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists("checkout_faq_custom_post_type")) {

	function checkout_faq_custom_post_type() {
	
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Checkout FAQ', 'Post Type General Name', 'twentytwentyone' ),
			'singular_name'       => _x( 'FAQ', 'Post Type Singular Name', 'twentytwentyone' ),
			'menu_name'           => __( 'Checkout FAQ', 'twentytwentyone' ),
			'parent_item_colon'   => __( 'Parent FAQ', 'twentytwentyone' ),
			'all_items'           => __( 'All FAQs', 'twentytwentyone' ),
			'view_item'           => __( 'View FAQ', 'twentytwentyone' ),
			'add_new_item'        => __( 'Add New FAQ', 'twentytwentyone' ),
			'add_new'             => __( 'Add New', 'twentytwentyone' ),
			'edit_item'           => __( 'Edit FAQ', 'twentytwentyone' ),
			'update_item'         => __( 'Update FAQ', 'twentytwentyone' ),
			'search_items'        => __( 'Search FAQ', 'twentytwentyone' ),
			'not_found'           => __( 'Not Found', 'twentytwentyone' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
		);
		
		// Set other options for Custom Post Type
		
		$args = array(
			'label'               => __( 'faq', 'twentytwentyone' ),
			'description'         => __( 'FAQ', 'twentytwentyone' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'genres' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'post',
			'show_in_rest' => true,
	
		);
		
		register_taxonomy("categories", array("faq"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => array( 'slug' => 'work', 'with_front'=> false )));

		// Registering your Custom Post Type
		register_post_type( 'checkout_faq', $args );
	
	}
	
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	
	add_action( 'init', 'checkout_faq_custom_post_type', 0 );
}