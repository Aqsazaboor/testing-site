<?php
$text = trim(get_sub_field("text"));
?>

<div class="module-wrapper module-wrapper--preamble">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			    <div class="text">
					<?php if ($text): ?>
						<?php
						$text_classes = 'text__text wysiwyg';
						?>
						<div class="<?php echo $text_classes; ?>">
							<span class="preamble"><?php echo $text; ?></span>
						</div>
					<?php endif; ?>
			    </div>
			</div>
		</div>
	</div>
</div>