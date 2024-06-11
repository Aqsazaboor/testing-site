<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('nb_change_price_by_variation')):
add_action( 'woocommerce_before_add_to_cart_quantity', 'nb_change_price_by_variation' );
function nb_change_price_by_variation() {
    global $product;

    if ( $product->is_type('variable') ) {
        $variations_data =[]; // Initializing

        // Loop through variations data
        foreach($product->get_available_variations() as $variation ) {
            $variation_array = array(
                "price" => $variation['display_price'],
                "image" => $variation['image']['thumb_src']
            );
            // Set for each variation ID the corresponding price in the data array (to be used in jQuery)
            $variations_data[$variation['variation_id']] = $variation_array;
        }

        ?>
        <script>
        jQuery(function($) {
            const jsonData = <?php echo json_encode($variations_data); ?>;
            const inputVID = 'input.variation_id';
            $('input').change( function() {
                if( '' != $(inputVID).val() ) {
                    if($("#variation_selection").hasClass("is-hidden")) {
                        $("#variation_selection").removeClass("is-hidden");
                    }
                    const vid = $(inputVID).val(); // VARIATION ID
                    const vprice = '';
                    $.each( jsonData, function( index, item ) {
                        if( index == $(inputVID).val() ) {
                            console.log(item.price);
                            console.log(item.image);
                            variation_image = item.image; // The right variation price
                            variation_price = item.price; // The right variation price
                        }
                    });
                    $("#variation_price").html('<div style="display: flex; align-items: center; gap: 16px;"><img style="max-width: 30px; height: auto; border: 1px solid #EEE;" src="'+variation_image+'" /><div class="price">'+variation_price+' </div></div>');
                }
            });
        });
        </script>
        <?php
    }
}
endif;