<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

/*
https://developers.google.com/fonts/docs/webfont_loader?csw=1
https://github.com/typekit/webfontloader
*/
if( function_exists('editor_fonts') ) {
	function preload_fonts() {
		$fonts = editor_fonts();
?>

		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
		<script>
			WebFontConfig = {
				loading: function() {
					// alert('Fonts loaded!');
				},
				custom: {
					<?php
					$fontsString = '';
					foreach ( $fonts as $key=>$font ) {
						$fontsString .= "'".$font['slug']."',";
					}
					$fontsString = rtrim($fontsString,',');
					echo "families: [".$fontsString."],\n";
					?>
					families: ['My Font', 'My Other Font:n4,i4,n7'],
					urls: ['<?php echo get_stylesheet_directory_uri() . "/assets/dist/css/fonts.css"; ?>']
				}
			};
		</script>
		<!-- <script>
			WebFontConfig = {
				loading: function() {
					alert('Fonts loaded!');
				},
				active: function() {},
				inactive: function() {},
				fontloading: function(familyName, fvd) {},
				fontactive: function(familyName, fvd) {},
				fontinactive: function(familyName, fvd) {}
			};
			WebFont.load({
				classes: true,
				custom: {
					families: 
		<?php
		$fontsString = '';
		foreach ( $fonts as $key=>$font ) {
			$fontsString .= "'".$font['slug']."',";
		}
		$fontsString = rtrim($fontsString,',');
		echo "[".$fontsString."],\n";
		?>
					urls: ['<?php echo get_stylesheet_directory_uri() . "/assets/editorv4/css/fonts.css"; ?>'],
				}
			});
		</script> -->
<?php
	}
	add_action( 'wp_head', 'preload_fonts', 100 );
	//add_action( 'wp_footer', 'preload_fonts', 100 );
}