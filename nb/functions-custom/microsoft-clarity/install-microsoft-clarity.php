<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

if(!function_exists('install_microsoft_clarity')):
function install_microsoft_clarity() {
	if( function_exists('get_field') && get_field('microsoft_clarity_id', 'option')):
		$site_msc_id = get_field('microsoft_clarity_id', 'option');
?>
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", <?php echo '"'.$site_msc_id.'"'; ?>);
</script>
<?php
	endif;
}
endif;

// Finland
/*
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "j8c6h1wu51");
</script>
*/