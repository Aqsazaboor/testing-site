<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('gb_add_colors_to_gutenber_pallette')):
function gb_add_colors_to_gutenber_pallette() {
    // Try to get the current theme default color palette
    $oldColorPalette = current( (array) get_theme_support( 'editor-color-palette' ) );
    // Get default core color palette from wp-includes/theme.json
    if (false === $oldColorPalette && class_exists('WP_Theme_JSON_Resolver')) {
        $settings = WP_Theme_JSON_Resolver::get_core_data()->get_settings();
        if (isset($settings['color']['palette']['default'])) {
            $oldColorPalette = $settings['color']['palette']['default']; // there is no need to apply translations to color names - they are translated already
        }
    }
    // The new colors we are going to add
    $newColorPalette = [
        [
            'name' => esc_attr__('Khaki', 'storefront'),
            'slug' => 'khaki',
            'color' => '#F8E8DD',
        ],
        [
            'name' => esc_attr__('Icy blue', 'storefront'),
            'slug' => 'icyblue',
            'color' => '#E1ECEE',
        ],
        [
            'name' => esc_attr__('Chocolate Brown', 'storefront'),
            'slug' => 'chocolatebrown',
            'color' => '#351408',
        ],
        [
            'name' => esc_attr__('Secondary Blue', 'storefront'),
            'slug' => 'secondaryblue',
            'color' => '#1d7b98',
        ], 
    ];
    // Merge the old and new color palettes
    if (!empty($oldColorPalette)) {
        $newColorPalette = array_merge($oldColorPalette, $newColorPalette);
    }
    // Apply the color palette containing the original colors and 2 new colors:
    add_theme_support( 'editor-color-palette', $newColorPalette);
}
add_action( 'after_setup_theme', 'gb_add_colors_to_gutenber_pallette' );
endif;