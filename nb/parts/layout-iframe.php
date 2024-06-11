<div class="module-wrapper module-wrapper--iframe">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				
				$header_text = trim(get_sub_field("title"));
				$url = get_sub_field("url");
				
				if($header_text) {
					echo '<h2>'.$header_text.'</h2>';
				}
				
				if( $url ) {
					echo '<iframe src="'.$url.'" height="1100" width="100%" frameborder="0"></iframe>';
				}
				
				?>
			</div>
		</div>
	</div>
</div>