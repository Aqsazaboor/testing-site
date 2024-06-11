<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once 'wm-get-all-countries-from-blog1-footer.php';
require_once 'wm-remove-dashboard-widgets.php';
require_once 'wm-remove-wp-notices-for-shop-manager.php';

// This needs to be translated before using it:
// require_once 'wm-generate-slug-on-save.php';

// Test to sync products to other blogs
require_once 'multisite-sync/create-product-on-update.php';