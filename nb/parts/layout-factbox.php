<?php
$title = trim(get_sub_field("title"));
$text = trim(get_sub_field("text"));
?>

<div class="module-wrapper module-wrapper--factbox list">
	
    <div class="text">
	    <?php if($title) {
		    echo '<h3 class="factbox-header">'.$title.'</h3>';
	    }?>
		<?php if ($text): ?>
			<div class="text__text wysiwyg">
				<?php echo $text; ?>
			</div>
		<?php endif; ?>
    </div>

</div>