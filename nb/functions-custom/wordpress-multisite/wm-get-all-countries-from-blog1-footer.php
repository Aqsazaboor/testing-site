<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('nb_get_our_sites')):
	function nb_get_our_sites() {
		global $blog_id;
		switch_to_blog(1); // site id from which you want to get the data
		
			wp_nav_menu( array(
				'theme_location' => 'countries',
				'fallback_cb'    => false,
				'container_class' => 'menu-list'
			) );			

		restore_current_blog(); // restore to current blog
	}
endif;