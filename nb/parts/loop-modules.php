<?php

/**
 * Template part that
 *  - loops ACF Flexible Content rows
 *  - loads template for each layout
 */

if (have_rows('modules')):

	while (have_rows('modules')):

		the_row();
		
		// Get row layout name and check for template with same name
		// Rows are called "section_headline", "full_width_image", "section_headline", "duosection", and so on
		$row_layout = get_row_layout();
		
		$template_part = "parts/layout-$row_layout";
		
		// Look for template called "layout-section_headline", "layout-duosection", and so on
		$template_location = locate_template($template_part . ".php");

		if ( empty( $template_location ) ) {
			echo "<p class='ep-admin-info ep-admin-info--warning'>Warning: no layout template found for template " . esc_html($template_part) . "</p>";
			continue;
		}

		get_template_part( $template_part );

	endwhile;

else:

	the_content();

endif;