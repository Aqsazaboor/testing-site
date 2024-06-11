<?php

$jumbotron_title = get_sub_field("title");
$jumbotron_text = get_sub_field("text");
$jumbotron_video_file = get_sub_field("video_file");

$container_classes = 'module-wrapper module-wrapper--jumbotron Jumbotron';

if($jumbotron_video_file) {
	$container_classes .= ' Jumbotron-Has-Video';
}

?>

<div class="<?php echo $container_classes; ?>">

	<div class="Jumbotron-Content">
		<div>
			<?php
			
			if($jumbotron_title) {
				echo '<h1 class="Jumbotron-Title">'.$jumbotron_title.'</h1>';
			}
				
			if($jumbotron_text) {
				echo '<div class="Jumbotron-Text">';
				echo $jumbotron_text;
				echo '</div>';
			}
			
			?>
		</div>
	</div>


	<?php
	
	if( $jumbotron_video_file ) {
		$video_URL = $jumbotron_video_file['url'];
	?>
	
	<div id="videoHolder" class="Jumbotron-Video-Holder">
		<video autoplay muted loop playsinline poster="videos/blandat/fallback.jpg" id="bgvid">
			<source src="<?php echo $video_URL; ?>" type="video/mp4">
			<source src="videos/blandat/blandat.ogv" type="video/ogv">
		</video>
	</div>
	
	<div class="videoFallback"></div>
	
	<script>
		var video = document.getElementById('bgvid');
		video.volume = 0;
		video.autoplay = 1;
	</script>
	
	
	<?php
		
	}
	
	?>

</div>