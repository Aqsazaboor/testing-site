<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists("wc_add_header_before_cart_table")) {
    function wc_add_header_before_cart_table() {
        $output = '<div class="checkout__section--header"><h2>'.pll__('Din beställning').'</h2></div>';
        echo $output;
    }
    add_action( 'woocommerce_before_cart_table', 'wc_add_header_before_cart_table', 10 );
}

if(!function_exists("wc_add_header_before_cart_totals")) {
    function wc_add_header_before_cart_totals() {
        $output = '<div class="checkout__section--header"><h2>'.pll__('Summering').'</h2></div>';
        echo $output;
    }
    add_action( 'woocommerce_before_cart_totals', 'wc_add_header_before_cart_totals', 10 );
}

// it's showing the wrong prices, disable until fixed
$checkout_header_enabled = false; 
if(!function_exists("wc_add_header_before_cart") && $checkout_header_enabled) {
    function wc_add_header_before_cart() {
        $cart_sum_before_shipping = WC()->cart->get_cart_total();
        $checkout_url = WC()->cart->get_checkout_url();

        $output = '<div class="checkout__header">';

        $output .= '<div class="checkout__header--shortcut">';
            $output .= '<div><span>'.pll__('Delsumma').'</span>'.$cart_sum_before_shipping.'</div>';
            $output .= '<div><a class="button button-primary" href="'.$checkout_url.'">'.pll__('Gå till kassan').'</a></div>';
        $output .= '</div>';

        $output .= '<h1>'.pll__('Varukorg').'</h1>';
        $output .= '</div>';
        
        echo $output;
    }    
    add_action( 'woocommerce_before_cart', 'wc_add_header_before_cart', 10 );
}

if(!function_exists("wc_add_faq_after_cart")) {
    function wc_add_faq_after_cart() {
        $output = '';
        $args = array(
            'post_type' => 'checkout_faq',
            'posts_per_page' => 999
        );
        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) :
            $output = '<div id="checkout__faq--container" class="checkout__faq">';
            $output .= '<div><h2>'.pll__('Det är enkelt att handla hos Skyltdax.se!').'</h2></div>';
            $output .= '<div class="faq__wrapper">';

            while ( $the_query->have_posts() ) : $the_query->the_post();
                $postId = get_the_ID();
                $postThumbnail = get_the_post_thumbnail_url($postId, 'full');
                $output .= '<div class="faq__question--wrapper post-id-'.$postId.'">';
                    $output .= '<div id="answer-id-'.$postId.'" class="faq__question">';
                    $output .= '<button aria-controls="question-id-'.$postId.'" role="button" class="faq__question--trigger" data-content="question-id-'.$postId.'">';
                    if($postThumbnail) {
                        $output .= '<span><img src="'.$postThumbnail.'" /></span>';
                    }
                    $output .= '<span>'.get_the_title().'</span>';
                    $output .= '</button></div>';
                    $output .= '<div id="question-id-'.$postId.'" class="faq__answer"><div>'.get_the_content().'</div></div>';
                $output .= '</div>';
            endwhile;

            $output .= '</div>';
            $output .= '</div>';

            wp_reset_postdata();
        endif;

        echo $output;
    }    
    add_action( 'woocommerce_after_cart_contents', 'wc_add_faq_after_cart', 10 );
    // Event handler does not work for this now...
    # add_action( 'woocommerce_after_cart', 'wc_add_faq_after_cart', 10 );
}

if(!function_exists("button_go_back")) {
    function button_go_back() {
        $output =  '<a class="button__go-back" id="menu-item-back-button" href="'.get_bloginfo('url').'">'.pll__('Tillbaka').'</a>';
        echo $output;
    }
    # add_action( 'woocommerce_before_cart', 'wc_add_back_button_after_cart', 10 );
}

// Last item before footer
if(!function_exists("wc_add_back_button_after_cart") && function_exists("button_go_back")) {
    function wc_add_back_button_after_cart () {
        echo '<div class="checkout__button--go-back">';
        button_go_back();
        echo '</div>';
    }
    add_action( 'woocommerce_after_cart', 'wc_add_back_button_after_cart', 10 );
    add_action( 'woocommerce_after_checkout_form', 'wc_add_back_button_after_cart', 12 );   
}

// These are actions you can unhook/remove!
 
# add_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );
# add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
# add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
# add_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );