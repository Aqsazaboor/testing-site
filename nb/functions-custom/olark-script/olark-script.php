<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}
$olarkActive = false;
if(!function_exists('olark_messages_script') && $olarkActive):
function olark_messages_script() {
	if(function_exists('get_site_language')) {
		$siteLanguage = get_site_language();
		if($siteLanguage == "sv") {
		?>
<!-- begin olark code -->
<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('6076-737-10-4497');</script>
<!-- end olark code -->
		<?php
		}
	}
}
add_action('wp_footer', 'olark_messages_script'); 
endif;