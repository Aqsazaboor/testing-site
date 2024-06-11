<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_site_message')):
function nb_site_message() {

	if(function_exists('get_field') && get_field('site_message','options')) {
	?>
		<div class="campaign-top-bar">
			<div class="container">
				<?php echo get_field('site_message','options'); ?>
			</div>
		</div>
	<?php
	}

}
endif;