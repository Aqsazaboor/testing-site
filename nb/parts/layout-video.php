<?php
$headline = trim(get_sub_field("headline"));
$caption = trim(get_sub_field("caption"));

$youtube_code = get_sub_field("youtube_code");;
$vimeo_code = get_sub_field("vimeo_code");;

#echo get_sub_field("youtube_code");
#echo get_sub_field("vimeo_code");


?>

<div class="module-wrapper module-wrapper--video">
	<div class="Video" aria-labelledby="video-headline" aria-describedby="video-info">
	<?php
		
	if($headline) {
		echo '<h3><span>'.$headline.'</span></h3>';
	}
	
	
	if($vimeo_code) {
		$vimeo_URL = 'https://player.vimeo.com/video/'.$vimeo_code;
	?>
		<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="<?php echo $vimeo_URL; ?>" width="705" height="400" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
		</div>
	<?php
	} elseif($youtube_code) {
		$youtube_URL = 'https://www.youtube.com/embed/'.$youtube_code;
	?>
		<div class="embed-responsive embed-responsive-16by9">
			<iframeclass="embed-responsive-item" width="705" height="400" src="<?php echo $youtube_URL; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>
	<?php
	} else {
		echo 'Ingen video-kod inlagd i komponenten!';
	}
	?>		
	</div>
</div>
