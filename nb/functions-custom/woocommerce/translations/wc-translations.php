<?php

/**
* @snippet Translate WooCommerce Strings Terms without Plugin
* @source https://www.wptechnic.com/?p=7475
* @compatible WC 7.3.0
*/

if ( function_exists( 'pll__' ) ) {

  $translation_array = array(
    "rename_wc_subtotal" => "Subtotal",
    "rename_wc_related_products" => pll__( 'Related products', 'woocommerce' ),
    "rename_wc_you_may_also_like" => "You may also like…",
    "rename_wc_you_may_also_like" => "Shipping",
    "rename_wc_proceed_to_checkout" => "Proceed to checkout",
    "rename_wc_proceed_to_checkout" => "Apply coupon",
  );


  if(!function_exists('wc_custom_cart_totals_order_total_html')):
  function wc_custom_cart_totals_order_total_html( $value )   {
      $value = '<strong>' . WC()->cart->get_total() . '</strong> ';

    // If prices are tax inclusive, show taxes here.
    if ( wc_tax_enabled() && WC()->cart->display_prices_including_tax() ) {
      $tax_string_array = array();
      $cart_tax_totals  = WC()->cart->get_tax_totals();
      if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) {
        foreach ( $cart_tax_totals as $code => $tax ) {
          $tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
        }
      } elseif ( ! empty( $cart_tax_totals ) ) {
        $tax_string_array[] = sprintf( '%s %s', wc_price( WC()->cart->get_taxes_total( true, true ) ), WC()->countries->tax_or_vat() );
      }

          if ( ! empty( $tax_string_array ) ) {
              $taxable_address = WC()->customer->get_taxable_address();
              $estimated_text  = '';
              $value .= '<small class="includes_tax">' . sprintf( pll__( '%s', 'woocommerce' ), implode( ', ', $tax_string_array ) . $estimated_text ) . '</small>';
          }
      }
      return $value;
  }
  add_filter( 'woocommerce_cart_totals_order_total_html', 'wc_custom_cart_totals_order_total_html', 20, 1 );
  endif;

  if(!function_exists('wc_new_shipping_title')):
  add_filter( 'woocommerce_shipping_package_name', 'wc_new_shipping_title' );
  function wc_new_shipping_title() {
    return pll__('Shipping');
  }
  endif;

  if(!function_exists('rename_wc_you_may_also_like')):
  add_filter( 'woocommerce_product_upsells_products_heading', 'rename_wc_you_may_also_like' );
  function rename_wc_you_may_also_like() {
    return pll__( 'You may also like...', 'woocommerce' );
  }
  endif;

  // Home in Breadcrumbs
  if(!function_exists('wcc_change_breadcrumb_home_text')):
  add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
  function wcc_change_breadcrumb_home_text( $defaults ) {
      // Change the breadcrumb home text from 'Home' to 'Apartment'
    $defaults['home'] = pll__( 'Hem' );
    return $defaults;
  }
  endif;

  // Subtotal
  if(!function_exists('rename_wc_subtotal')):
  add_filter( 'gettext', 'rename_wc_subtotal', 10, 3 );
  function rename_wc_subtotal( $translated_text, $text, $domain ) {
    if ( $text === 'Subtotal' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Delsumma', $domain );
    }
    return $translated_text;
  }
  endif;

  // Related products
  if(!function_exists('rename_wc_related_products')):
  add_filter( 'gettext', 'rename_wc_related_products', 10, 3 );
  function rename_wc_related_products( $translated_text, $text, $domain ) {
    if ( $text === 'Related products' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Related products', $domain );
    }
    return $translated_text;
  }
  endif;

  // Shipping
  if(!function_exists('rename_wc_shipping')):
  add_filter( 'gettext', 'rename_wc_shipping', 10, 3 );
  function rename_wc_shipping( $translated_text, $text, $domain ) {
    if ( $text === 'Shipping' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Shipping', $domain );
    }
    return $translated_text;
  }
  endif;

  // Shipping to
  if(!function_exists('rename_wc_shipping_to')):
  add_filter( 'gettext', 'rename_wc_shipping_to', 10, 3 );
  function rename_wc_shipping_to( $translated_text, $text, $domain ) {
    if ( $text === 'Shipping to' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Shipping to', $domain );
    }
    return $translated_text;
  }
  endif;

  // Proceed to checkout
  if(!function_exists('rename_wc_proceed_to_checkout')):
  add_filter( 'gettext', 'rename_wc_proceed_to_checkout', 10, 3 );
  function rename_wc_proceed_to_checkout( $translated_text, $text, $domain ) {
    if ( $text === 'Proceed to checkout' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Proceed to checkout', $domain );
    }
    return $translated_text;
  }
  endif;

  // Apply coupon
  if(!function_exists('rename_wc_apply_coupon')):
  add_filter( 'gettext', 'rename_wc_apply_coupon', 10, 3 );
  function rename_wc_apply_coupon( $translated_text, $text, $domain ) {
    if ( $text === 'Apply coupon' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Apply coupon', $domain );
    }
    return $translated_text;
  }
  endif;

  // Update cart
  if(!function_exists('rename_wc_update_cart')):
  add_filter( 'gettext', 'rename_wc_update_cart', 10, 3 );
  function rename_wc_update_cart( $translated_text, $text, $domain ) {
    if ( $text === 'Update cart' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Update cart', $domain );
    }
    return $translated_text;
  }
  endif;

  // Coupon code
  if(!function_exists('rename_wc_coupon_code')):
  add_filter( 'gettext', 'rename_wc_coupon_code', 10, 3 );
  function rename_wc_coupon_code( $translated_text, $text, $domain ) {
    if ( $text === 'Coupon code' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Coupon code', $domain );
    }
    return $translated_text;
  }
  endif;

  // Total
  if(!function_exists('rename_wc_total')):
  add_filter( 'gettext', 'rename_wc_total', 10, 3 );
  function rename_wc_total( $translated_text, $text, $domain ) {
    if ( $text === 'Total' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Total', $domain );
    }
    return $translated_text;
  }
  endif;

  // View cart
  if(!function_exists('rename_wc_view_cart')):
  add_filter( 'gettext', 'rename_wc_view_cart', 10, 3 );
  function rename_wc_view_cart( $translated_text, $text, $domain ) {
    if ( $text === 'View cart' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'View cart', $domain );
    }
    return $translated_text;
  }
  endif;

  // Checkout
  if(!function_exists('rename_wc_checkout')):
  add_filter( 'gettext', 'rename_wc_checkout', 10, 3 );
  function rename_wc_checkout( $translated_text, $text, $domain ) {
    if ( $text === 'Checkout' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Checkout', $domain );
    }
    return $translated_text;
  }
  endif;

  // Shipping to
  if(!function_exists('rename_wc_shipping_to')):
  add_filter( 'gettext', 'rename_wc_shipping_to', 10, 3 );
  function rename_wc_shipping_to( $translated_text, $text, $domain ) {
    if ( $text === 'Shipping to' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Shipping to', $domain );
    }
    return $translated_text;
  }
  endif;

  // Product
  if(!function_exists('rename_wc_product')):
  add_filter( 'gettext', 'rename_wc_product', 10, 3 );
  function rename_wc_product( $translated_text, $text, $domain ) {
    if ( $text === 'Product' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Product', $domain );
    }
    return $translated_text;
  }
  endif;

  // Price
  if(!function_exists('rename_wc_price')):
  add_filter( 'gettext', 'rename_wc_price', 10, 3 );
  function rename_wc_price( $translated_text, $text, $domain ) {
    if ( $text === 'Price' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Price', $domain );
    }
    return $translated_text;
  }
  endif;

  // Quantity
  if(!function_exists('rename_wc_quantity')):
  add_filter( 'gettext', 'rename_wc_quantity', 10, 3 );
  function rename_wc_quantity( $translated_text, $text, $domain ) {
    if ( $text === 'Quantity' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Quantity', $domain );
    }
    return $translated_text;
  }
  endif;

  // Have a coupon?
  if(!function_exists('rename_wc_have_a_coupon')):
  add_filter( 'gettext', 'rename_wc_have_a_coupon', 10, 3 );
  function rename_wc_have_a_coupon( $translated_text, $text, $domain ) {
    if ( $text === 'Have a coupon?' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Have a coupon?', $domain );
    }
    return $translated_text;
  }
  endif;


  // Click here to enter your code
  if(!function_exists('rename_wc_enter_your_code')):
  add_filter( 'gettext', 'rename_wc_enter_your_code', 10, 3 );
  function rename_wc_enter_your_code( $translated_text, $text, $domain ) {
    if ( $text === 'Click here to enter your code' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Click here to enter your code', $domain );
    }
    return $translated_text;
  }
  endif;

  // Place order
  if(!function_exists('rename_wc_place_order')):
  add_filter( 'gettext', 'rename_wc_place_order', 10, 3 );
  function rename_wc_place_order( $translated_text, $text, $domain ) {
    if ( $text === 'Place order' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Place order', $domain );
    }
    return $translated_text;
  }
  endif;

  // Add to cart
  if(!function_exists('rename_wc_add_to_cart')):
  add_filter( 'gettext', 'rename_wc_add_to_cart', 10, 3 );
  function rename_wc_add_to_cart( $translated_text, $text, $domain ) {
    if ( $text === 'Add to cart' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Lägg i varukorgen', $domain );
    }
    return $translated_text;
  }
  endif;

  // Order details page:

  if(!function_exists('rename_wc_order_details')):
  add_filter( 'gettext', 'rename_wc_order_details', 10, 3 );
  function rename_wc_order_details( $translated_text, $text, $domain ) {
    if ( $text === 'Order details' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Order details', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_billing_address')):
  add_filter( 'gettext', 'rename_wc_billing_address', 10, 3 );
  function rename_wc_billing_address( $translated_text, $text, $domain ) {
    if ( $text === 'Billing address' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Billing address', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_shipping_address')):
  add_filter( 'gettext', 'rename_wc_shipping_address', 10, 3 );
  function rename_wc_shipping_address( $translated_text, $text, $domain ) {
    if ( $text === 'Shipping address' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Shipping address', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_order_details')):
  add_filter( 'gettext', 'rename_wc_order_details', 10, 3 );
  function rename_wc_order_details( $translated_text, $text, $domain ) {
    if ( $text === 'Order details' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Order details', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_payment_method')):
  add_filter( 'gettext', 'rename_wc_payment_method', 10, 3 );
  function rename_wc_payment_method( $translated_text, $text, $domain ) {
    if ( $text === 'Payment method:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Payment method:', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_order_number')):
  add_filter( 'gettext', 'rename_wc_order_number', 10, 3 );
  function rename_wc_order_number( $translated_text, $text, $domain ) {
    if ( $text === 'Order number:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Order number:', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_total_colon')):
  add_filter( 'gettext', 'rename_wc_total_colon', 10, 3 );
  function rename_wc_total_colon( $translated_text, $text, $domain ) {
    if ( $text === 'Total:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Total:', $domain );
    }
    return $translated_text;
  }
  endif;


  if(!function_exists('rename_wc_date')):
  add_filter( 'gettext', 'rename_wc_date', 10, 3 );
  function rename_wc_date( $translated_text, $text, $domain ) {
    if ( $text === 'Date:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Date:', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_shipping_color')):
  add_filter( 'gettext', 'rename_wc_shipping_color', 10, 3 );
  function rename_wc_shipping_color( $translated_text, $text, $domain ) {
    if ( $text === 'Shipping:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Shipping:', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_subtotal_colon')):
  add_filter( 'gettext', 'rename_wc_subtotal_colon', 10, 3 );
  function rename_wc_subtotal_colon( $translated_text, $text, $domain ) {
    if ( $text === 'Subtotal:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Subtotal:', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_email_colon')):
  add_filter( 'gettext', 'rename_wc_email_colon', 10, 3 );
  function rename_wc_email_colon( $translated_text, $text, $domain ) {
    if ( $text === 'Email:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Email:', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_thank_you_order')):
  add_filter( 'gettext', 'rename_wc_thank_you_order', 10, 3 );
  function rename_wc_thank_you_order( $translated_text, $text, $domain ) {
    if ( $text === 'Thank you. Your order has been received.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Thank you. Your order has been received.', $domain );
    }
    return $translated_text;
  }
  endif;


  // Filtering
  // Default sorting
  // Showing all 9 results
  // Sort by popularity
  // Sort by latest
  // Sort by price: low to high
  // Sort by price: high to low

  if(!function_exists('rename_wc_default_sorting')):
  add_filter( 'gettext', 'rename_wc_default_sorting', 10, 3 );
  function rename_wc_default_sorting( $translated_text, $text, $domain ) {
    if ( $text === 'Default sorting' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Default sorting', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_sort_popularity')):
  add_filter( 'gettext', 'rename_wc_sort_popularity', 10, 3 );
  function rename_wc_sort_popularity( $translated_text, $text, $domain ) {
    if ( $text === 'Sort by popularity' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Sort by popularity', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_sort_latest')):
  add_filter( 'gettext', 'rename_wc_sort_latest', 10, 3 );
  function rename_wc_sort_latest( $translated_text, $text, $domain ) {
    if ( $text === 'Sort by latest' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Sort by latest', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_sort_low_high')):
  add_filter( 'gettext', 'rename_wc_sort_low_high', 10, 3 );
  function rename_wc_sort_low_high( $translated_text, $text, $domain ) {
    if ( $text === 'Sort by price: low to high' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Sort by price: low to high', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_sort_high_low')):
  add_filter( 'gettext', 'rename_wc_sort_high_low', 10, 3 );
  function rename_wc_sort_high_low( $translated_text, $text, $domain ) {
    if ( $text === 'Sort by price: high to low' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Sort by price: high to low', $domain );
    }
    return $translated_text;
  }
  endif;

  // My account

  // No order has been made yet.
  // Browse products
  // Dashboard
  // Orders
  // Addresses
  // Account details
  // Log out
  // The following addresses will be used on the checkout page by default.
  // Billing address
  // Shipping address
  // Hello <name> (not <name>? Log out)
  // From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.
  // First name
  // Last name
  // Email address
  // Password change
  // Current password (leave blank to leave unchanged)
  // New password (leave blank to leave unchanged)
  // Confirm new password
  // Save changes

  if(!function_exists('rename_wc_dashboard')):
  add_filter( 'gettext', 'rename_wc_dashboard', 10, 3 );
  function rename_wc_dashboard( $translated_text, $text, $domain ) {
    if ( $text === 'Dashboard' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Dashboard', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_orders')):
  add_filter( 'gettext', 'rename_wc_orders', 10, 3 );
  function rename_wc_orders( $translated_text, $text, $domain ) {
    if ( $text === 'Orders' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Orders', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_addresses')):
  add_filter( 'gettext', 'rename_wc_addresses', 10, 3 );
  function rename_wc_addresses( $translated_text, $text, $domain ) {
    if ( $text === 'Addresses' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Addresses', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_account_details')):
  add_filter( 'gettext', 'rename_wc_account_details', 10, 3 );
  function rename_wc_account_details( $translated_text, $text, $domain ) {
    if ( $text === 'Account details' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Account details', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_first_name')):
  add_filter( 'gettext', 'rename_wc_first_name', 10, 3 );
  function rename_wc_first_name( $translated_text, $text, $domain ) {
    if ( $text === 'First name' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'First name', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_last_name')):
  add_filter( 'gettext', 'rename_wc_last_name', 10, 3 );
  function rename_wc_last_name( $translated_text, $text, $domain ) {
    if ( $text === 'Last name' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Last name', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_password_change')):
  add_filter( 'gettext', 'rename_wc_password_change', 10, 3 );
  function rename_wc_password_change( $translated_text, $text, $domain ) {
    if ( $text === 'Password change' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Password change', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_email_address')):
  add_filter( 'gettext', 'rename_wc_email_address', 10, 3 );
  function rename_wc_email_address( $translated_text, $text, $domain ) {
    if ( $text === 'Email address' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Email address', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_save_changes')):
  add_filter( 'gettext', 'rename_wc_save_changes', 10, 3 );
  function rename_wc_save_changes( $translated_text, $text, $domain ) {
    if ( $text === 'Save changes' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Save changes', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_log_out')):
  add_filter( 'gettext', 'rename_wc_log_out', 10, 3 );
  function rename_wc_log_out( $translated_text, $text, $domain ) {
    if ( $text === 'Log out' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Log out', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_empty_cart')):
  add_filter( 'gettext', 'rename_wc_empty_cart', 10, 3 );
  function rename_wc_empty_cart( $translated_text, $text, $domain ) {
    if ( $text === 'Your cart is currently empty.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Your cart is currently empty.', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_return_to_shop')):
  add_filter( 'gettext', 'rename_wc_return_to_shop', 10, 3 );
  function rename_wc_return_to_shop( $translated_text, $text, $domain ) {
    if ( $text === 'Return to shop' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Return to shop', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_coupon')):
  add_filter( 'gettext', 'rename_wc_coupon', 10, 3 );
  function rename_wc_coupon( $translated_text, $text, $domain ) {
    if ( $text === 'Coupon' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Coupon', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_coupon_colon')):
  add_filter( 'gettext', 'rename_wc_coupon_colon', 10, 3 );
  function rename_wc_coupon_colon( $translated_text, $text, $domain ) {
    if ( $text === 'Coupon:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Coupon:', $domain );
    }
    return $translated_text;
  }
  endif;


  if(!function_exists('rename_wc_remove')):
  add_filter( 'gettext', 'rename_wc_remove', 10, 3 );
  function rename_wc_remove( $translated_text, $text, $domain ) {
    if ( $text === 'Remove' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Remove', $domain );
    }
    return $translated_text;
  }
  endif;


  if(!function_exists('rename_wc_remove_extra')):
  add_filter( 'gettext', 'rename_wc_remove_extra', 10, 3 );
  function rename_wc_remove_extra( $translated_text, $text, $domain ) {
    if ( $text === '[Remove]' && $domain === 'woocommerce' ) {
      $translated_text = pll__( '[Remove]', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_removed')):
  add_filter( 'gettext', 'rename_wc_removed', 10, 3 );
  function rename_wc_removed( $translated_text, $text, $domain ) {
    if ( $text === 'removed.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'removed.', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_coupon_applied')):
  add_filter( 'gettext', 'rename_wc_coupon_applied', 10, 3 );
  function rename_wc_coupon_applied( $translated_text, $text, $domain ) {
    if ( $text === 'Coupon code applied successfully.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Coupon code applied successfully.', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_cart_updated')):
  add_filter( 'gettext', 'rename_wc_cart_updated', 10, 3 );
  function rename_wc_cart_updated( $translated_text, $text, $domain ) {
    if ( $text === 'Cart updated.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Cart updated.', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_undo')):
  add_filter( 'gettext', 'rename_wc_undo', 10, 3 );
  function rename_wc_undo( $translated_text, $text, $domain ) {
    if ( $text === 'Undo?' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Undo?', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_order_notes')):
  add_filter( 'gettext', 'rename_wc_order_notes', 10, 3 );
  function rename_wc_order_notes( $translated_text, $text, $domain ) {
    if ( $text === 'Order notes' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Order notes ', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_optional')):
  add_filter( 'gettext', 'rename_wc_optional', 10, 3 );
  function rename_wc_optional( $translated_text, $text, $domain ) {
    if ( $text === 'optional' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'optional', $domain );
    }
    return $translated_text;
  }
  endif;


  if(!function_exists('rename_wc_order_notes_paragraph')):
  add_filter( 'gettext', 'rename_wc_order_notes_paragraph', 10, 3 );
  function rename_wc_order_notes_paragraph( $translated_text, $text, $domain ) {
    if ( $text === 'Notes about your order, e.g. special notes for delivery.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Notes about your order, e.g. special notes for delivery.', $domain );
    }
    return $translated_text;
  }
  endif;

  // Mitt konto

  // Remove
  // Shipping
  // Coupon code applied successfully.
  // Coupon has been removed.
  // Cart updated.
  // Undo?
  // <product> removed. Undo?
  // Order notes (optional)
  // Notes about your order, e.g. special notes for delivery.
  // DONE ^

  // Shipping costs are calculated during checkout.
  if(!function_exists('rename_wc_shipping_costs_calculated')):
    add_filter( 'gettext', 'rename_wc_shipping_costs_calculated', 10, 3 );
    function rename_wc_shipping_costs_calculated( $translated_text, $text, $domain ) {
      if ( $text === 'Shipping costs are calculated during checkout.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Shipping costs are calculated during checkout.', $domain );
    }
    return $translated_text;
  }
  endif;

  // Street address *
  // Town / City *
  // Phone *
  // Postcode / ZIP *
  // Country / Region *
  // House number and street name

  // Not done
  // Company name (optional)
  // Apartment, suite, unit, etc. (optional)


  if(!function_exists('rename_wc_street_address')):
  add_filter( 'gettext', 'rename_wc_street_address', 10, 3 );
  function rename_wc_street_address( $translated_text, $text, $domain ) {
    if ( $text === 'Street address' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Street address', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_postcode_zip')):
  add_filter( 'gettext', 'rename_wc_postcode_zip', 10, 3 );
  function rename_wc_postcode_zip( $translated_text, $text, $domain ) {
    if ( $text === 'Postcode / ZIP' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Postcode / ZIP', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_town_city')):
  add_filter( 'gettext', 'rename_wc_town_city', 10, 3 );
  function rename_wc_town_city( $translated_text, $text, $domain ) {
    if ( $text === 'Town / City' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Town / City', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_phone')):
  add_filter( 'gettext', 'rename_wc_phone', 10, 3 );
  function rename_wc_phone( $translated_text, $text, $domain ) {
    if ( $text === 'Phone' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Phone', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_company_name')):
  add_filter( 'gettext', 'rename_wc_company_name', 10, 3 );
  function rename_wc_company_name( $translated_text, $text, $domain ) {
    if ( $text === 'Company name' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Company name', $domain );
    }
    return $translated_text;
  }
  endif;


  if(!function_exists('rename_wc_house_number_street_name')):
  add_filter( 'gettext', 'rename_wc_house_number_street_name', 10, 3 );
  function rename_wc_house_number_street_name( $translated_text, $text, $domain ) {
    if ( $text === 'House number and street name' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'House number and street name', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_country_region')):
  add_filter( 'gettext', 'rename_wc_country_region', 10, 3 );
  function rename_wc_country_region( $translated_text, $text, $domain ) {
    if ( $text === 'Country / Region' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Country / Region', $domain );
    }
    return $translated_text;
  }
  endif;



  if(!function_exists('rename_wc_current_password')):
  add_filter( 'gettext', 'rename_wc_current_password', 10, 3 );
  function rename_wc_current_password( $translated_text, $text, $domain ) {
    if ( $text === 'Current password (leave blank to leave unchanged)' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Current password (leave blank to leave unchanged)', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_wc_new_password_leave_blank')):
  add_filter( 'gettext', 'rename_wc_new_password_leave_blank', 10, 3 );
  function rename_wc_new_password_leave_blank( $translated_text, $text, $domain ) {
    if ( $text === 'New password (leave blank to leave unchanged)' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'New password (leave blank to leave unchanged)', $domain );
    }
    return $translated_text;
  }
  endif;


  // Save address
  if(!function_exists('rename_wc_save_address')):
  add_filter( 'gettext', 'rename_wc_save_address', 10, 3 );
  function rename_wc_save_address( $translated_text, $text, $domain ) {
    if ( $text === 'Save address' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Save address', $domain );
    }
    return $translated_text;
  }
  endif;

  // No order has been made yet.
  if(!function_exists('rename_wc_no_order_made')):
  add_filter( 'gettext', 'rename_wc_no_order_made', 10, 3 );
  function rename_wc_no_order_made( $translated_text, $text, $domain ) {
    if ( $text === 'No order has been made yet.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'No order has been made yet.', $domain );
    }
    return $translated_text;
  }
  endif;

  // Browse products
  if(!function_exists('rename_wc_browse_products')):
  add_filter( 'gettext', 'rename_wc_browse_products', 10, 3 );
  function rename_wc_browse_products( $translated_text, $text, $domain ) {
    if ( $text === 'Browse products' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Browse products', $domain );
    }
    return $translated_text;
  }
  endif;

  // The following addresses will be used on the checkout page by default.
  if(!function_exists('rename_wc_following_addresses')):
  add_filter( 'gettext', 'rename_wc_following_addresses', 10, 3 );
  function rename_wc_following_addresses( $translated_text, $text, $domain ) {
    if ( $text === 'The following addresses will be used on the checkout page by default.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'The following addresses will be used on the checkout page by default.', $domain );
    }
    return $translated_text;
  }
  endif;

  // You have not set up this type of address yet.
  // Current password (leave blank to leave unchanged)
  // New password (leave blank to leave unchanged)

  // Confirm new password
  if(!function_exists('rename_wc_confirm_new_password')):
  add_filter( 'gettext', 'rename_wc_confirm_new_password', 10, 3 );
  function rename_wc_confirm_new_password( $translated_text, $text, $domain ) {
    if ( $text === 'Confirm new password' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Confirm new password', $domain );
    }
    return $translated_text;
  }
  endif;

  // Remember me
  if(!function_exists('rename_wc_confirm_new_password')):
  add_filter( 'gettext', 'rename_wc_confirm_new_password', 10, 3 );
  function rename_wc_confirm_new_password( $translated_text, $text, $domain ) {
    if ( $text === 'Confirm new password' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Confirm new password', $domain );
    }
    return $translated_text;
  }
  endif;

  // Lost your password?
  if(!function_exists('rename_wc_lost_your_password')):
  add_filter( 'gettext', 'rename_wc_lost_your_password', 10, 3 );
  function rename_wc_lost_your_password( $translated_text, $text, $domain ) {
    if ( $text === 'Lost your password?' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Lost your password?', $domain );
    }
    return $translated_text;
  }
  endif;

  // Username or email address *
  if(!function_exists('rename_wc_username_email_address')):
  add_filter( 'gettext', 'rename_wc_username_email_address', 10, 3 );
  function rename_wc_username_email_address( $translated_text, $text, $domain ) {
    if ( $text === 'Username or email address' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Username or email address', $domain );
    }
    return $translated_text;
  }
  endif;

  // Password *
  if(!function_exists('rename_wc_password')):
  add_filter( 'gettext', 'rename_wc_password', 10, 3 );
  function rename_wc_password( $translated_text, $text, $domain ) {
    if ( $text === 'Password' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Password', $domain );
    }
    return $translated_text;
  }
  endif;

  // Login
  if(!function_exists('rename_wc_login_button')):
  add_filter( 'gettext', 'rename_wc_login_button', 10, 3 );
  function rename_wc_login_button( $translated_text, $text, $domain ) {
    if ( $text === 'Login' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Login', $domain );
    }
    return $translated_text;
  }
  endif;

  // 404 title
  if(!function_exists('translate_error_title')):
  add_filter( 'gettext', 'translate_error_title', 10, 3 );
  function translate_error_title( $translated_text, $text, $domain ) {
    if ( $text === 'Page could not be found.' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Page could not be found.', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_category_colon')):
  add_filter( 'gettext', 'rename_category_colon', 10, 3 );
  function rename_category_colon( $translated_text, $text, $domain ) {
    if ( $text === 'Category:' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Category:', $domain );
    }
    return $translated_text;
  }
  endif;

  if(!function_exists('rename_tags_colon')):
  add_filter( 'gettext', 'rename_tags_colon', 10, 3 );
  function rename_tags_colon( $translated_text, $text, $domain ) {
    if ( $text === 'Tags: ' && $domain === 'woocommerce' ) {
      $translated_text = pll__( 'Taggar', $domain );
    }
    return $translated_text;
  }
  endif;



  // Showing all 67 results
  // Does not work...
  // if(!function_exists('translate_filter_results')):
  // add_filter( 'gettext', 'translate_filter_results', 10, 3 );
  // function translate_filter_results( $translated_text, $text, $domain ) {
  //   if ( $text === ' Showing all %s results' && $domain === 'woocommerce' ) {
  //     $translated_text = pll__( 'Page could not be found.', $domain );
  //   }
  //   return $translated_text;
  // }
  // endif;

  if(!function_exists('wc_change_sale_text')):
  // add_filter('woocommerce_sale_flash', 'wc_change_sale_text');
  // function wc_change_sale_text($html, $post, $product) {
  //   var_dump($product);
  //   return '<span class="onsale">'.pll__('Rabatt!').'</span>';
  // }
  add_filter('woocommerce_sale_flash', 'wc_change_sale_text');
  function wc_change_sale_text($text) {
      global $product;
      $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
      return '<span class="onsale">-'.$percentage.'%</span>';  
  }     
  endif;
    
}