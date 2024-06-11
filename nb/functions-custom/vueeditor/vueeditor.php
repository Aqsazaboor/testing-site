<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

require_once 'vueditor-icons.php';
require_once 'vueditor-class.php';

require_once 'partials/editor-sidebar.php';
require_once 'partials/editor-canvas.php';

// ---------------------------------------------------
// The VUE designer app Canvas
// ---------------------------------------------------

if(!function_exists('vueeditor')):
function vueeditor() {

global $product;
$product_id = $product->get_id();
?>

<div id="app"></div>

<?php
}
endif;