// Setup
const debug = false;

// ------------------------------------------
// Rita upp CM på skyltbilder
// ------------------------------------------
/*
jQuery( document ).ready(function($) {

	// Add fastclick
	FastClick.attach(document.body);
	
	function buildCart() {
				
		// --------------------------------------------------
		// Fix images with canvas image on top
		// --------------------------------------------------
		$('.shop_table .woocommerce-cart-form__cart-item.cart_item').each(function() {
			console.log( $(this) );
			
			console.log( $(this).find('.product-thumbnail img').attr('src') );
			
			// --------------------------------------------
			// Put image underneath canvas generated image
			// --------------------------------------------
			
			var product_image = $(this).find('.product-thumbnail img').attr('src');
			
			$(this).find('#oi').append('<img class="cart-image-real" src="'+product_image+'"/>');
			
		});
		
	}

	if( $('body.woocommerce-cart.woocommerce-js') ) {
		console.log('build cart!');
		buildCart();
	}


	jQuery( document.body ).on( 'updated_cart_totals', function(){
		//re-do your jquery
		console.log('Updated cart!');
		
		buildCart();
	});
	
	// --------------------------------------------------
	
	if( debug ) {

		// put put centimeters on sign
		container = $('.generated__sign-container');
		times = height / 10;
		container.append('<div id="divide" style="position:absolute;top:0;left:0;height:100%;width:100%;border:1px solid blue;"></div>');
		onecm = container.find('img').attr('height') / times;
		
		var sum = 0;
		for (var i = 1; i <= times; i++) {
		   //console.log( onecm, Math.floor(times) );
		   container.find('#divide').append('<div style="border:1px solid black; height:'+onecm+'px">10 mm</div>');
		}
		
	}
	
	$('#toggle-search-bar').on('click', function() {
		$('#site-search').toggleClass('active');
	});
});
*/
