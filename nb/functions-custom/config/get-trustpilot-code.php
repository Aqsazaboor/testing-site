<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

$trustpilotActive = true;

if($trustpilotActive):
	function nb_add_trustpilot_to_head() {
		// This should be high up the head
		?>
<!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
<!-- End TrustBox script -->
	<?php
	}
	add_action('wp_head', 'nb_add_trustpilot_to_head', 1);

	function nb_get_trustpilot_widget() {
		// Sweden
	?>

<section>
	<div class="container trustpilot-widget-container">
		<div class="columns">
			<div class="column">
				<!-- TrustBox widget - Micro Review Count -->
				<div class="trustpilot-widget" data-locale="sv-SE" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="5c8608d330a6670001f404d9" data-style-height="24px" data-style-width="100%" data-theme="light">
					<a href="https://se.trustpilot.com/review/skyltdax.se" target="_blank" rel="noopener">Trustpilot</a>
				</div>
				<!-- End TrustBox widget -->
			</div>
		</div>
	</div>
</section>

	<?php
	}

	if(!function_exists('nb_add_trustpilot_shortcode')):
		add_shortcode( 'trustpilot', 'nb_add_trustpilot_shortcode' );
		function nb_add_trustpilot_shortcode( $atts ) {
			$output = '';
			$output .= '<!-- TrustBox widget - Micro Review Count -->
				<div class="trustpilot-widget" data-locale="sv-SE" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="5c8608d330a6670001f404d9" data-style-height="24px" data-style-width="100%" data-theme="light">
					<a href="https://se.trustpilot.com/review/skyltdax.se" target="_blank" rel="noopener">Trustpilot</a>
				</div>
				<!-- End TrustBox widget -->';
			// "foo = {$atts['foo']}"
			return $output;
		}
	endif;

endif;