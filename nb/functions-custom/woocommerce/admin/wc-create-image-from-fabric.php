<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'admin_menu', function() {
    add_submenu_page(
        null,
        'Welcome',
        'Welcome',
        'manage_woocommerce',
        'download-image',
        'prefix_render'
    );
} );

function prefix_render() {
	?>
	<div id="design_viewer_app" class="wrap" v-cloak>
		<div v-if="appError" class="app-error">Fel uppstod!</div>
		<div class="image-generator" v-if="lineItemData">
			<div>
				<div class="generator-surface">
					<canvas
					ref="canvas"
					id="generator-canvas"
					class="generator-canvas"
					></canvas>
				</div>
			</div>
			<div>
				<h1>Skapa bild från order</h1>
				<ul>
					<li v-if="lineItemData.item_id">Order id: {{ lineItemData.order_id }}</li>
					<li v-if="lineItemData.item_id">Order produkt: {{ lineItemData.item_id }}</li>
					<li v-if="lineItemData.product_width">Produktbredd: {{ lineItemData.product_width }} mm</li>
					<li v-if="lineItemData.product_height">Produkthöjd: {{ lineItemData.product_height }} mm</li>
					<li v-if="lineItemData.text_alignment">Textjustering: {{ lineItemData.text_alignment }}</li>
					<li v-if="lineItemData.text_font">Typsnitt: {{ lineItemData.text_font }}</li>
					<li v-if="lineItemData.text_size">Textstorlek: {{ lineItemData.text_size }} mm</li>
					<li v-if="lineItemData.text_bold">Fet stil: {{ lineItemData.text_bold }}</li>
					<li v-if="lineItemData.text_italic">Kursiv stil: {{ lineItemData.text_italic }}</li>
					<li v-if="lineItemData.text_rows">
						<div>Textrader:</div>
						<div v-html="lineItemData.text_rows"></div>
					</li>
				</ul>
				
				<div class="download-option">
					<p></p>
					<button v-if="!linkCreated" class="button button-trigger" @click.prevent="downloadCanvasAsImage">
						Ladda ner PNG x5 storlek
					</button>
					<div id="download-trigger"></div>
				</div>

				<div class="download-option">
					<p>Tänk på att datorn du laddar ner måste ha typsnittet installerat för att det ska visas rätt.</p>
					<button @click.prevent="downloadCanvasAsSvg"  class="button button-trigger">
						Ladda ner SVG
					</button>
				</div>
			</div>
		</div>
	</div>

	<?php
	if( function_exists('editor_fonts') ) {
		$fonts = JSON_encode(editor_fonts());
	} else {
		$fonts = '';
	}
	$output = '<script>';
	$output .= 'const fontsObject = '.$fonts.';';
	$output .= '</script>';
	echo $output;
	?>

	<?php
}

// add_action( 'admin_head', function() {
//     remove_submenu_page( 'index.php', 'my-welcome' );
// } );