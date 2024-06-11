<?php

$jumbotron_title = get_sub_field('jumbotron_title');
$jumbotron_text = get_sub_field('jumbotron_text');

?>
<div class="jumbotron">
	<div class="container">
		<?php if($jumbotron_title): ?>
			<h1 class="Jumbotron-Title"><?php echo $jumbotron_title; ?></h1>
		<?php endif; ?>
		
		<?php if($jumbotron_text): ?>
		<div class="Jumbotron-Text">
			<?php echo $jumbotron_text; ?>
		</div>
		<?php endif; ?>
	</div>
	<!--<h1 class="display-4">Hello, world!</h1>
	<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
		<hr class="my-4">
	<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
	<p class="lead">
		<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
	</p>
	-->
</div>