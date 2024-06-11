<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

// Add custom content before the Thank You page
if(!function_exists('nb_google_pust_datalayer_thank_you_page')):
function nb_google_pust_datalayer_thank_you_page($orderId) {
    $layer_pust_enabled = true;
    $order = new WC_Order($orderId);

    if($order) {
        $actionField = "'id': '" . $order->get_order_number() . "'," . "\n";
        $actionField .= "'revenue': '" . $order->get_total() . "'," . "\n";
        $actionField .= "'tax': '" . $order->get_total_tax() . "'," . "\n";
        $actionField .= "'shipping': '" . $order->get_shipping_total() . "'" . "\n";

        // Order lines computed
        $orderLines = '';
        if($order->get_items()) {
            foreach ( $order->get_items() as $item_id => $item ) {
                $productId = $item->get_product_id();
                $getVariant = get_post_meta( $productId, 'product_material', true ) . ' - ' . get_post_meta( $productId, 'product_color', true );
                $orderLines .= "{"."\n";
                    $orderLines .= "'name': '" . $item->get_name() . "'," . "\n";
                    $orderLines .= "'id': '" . $productId . "'," . "\n";
                    $orderLines .= "'price': '" . $item->get_total() . "'," . "\n";
                    $orderLines .= "'variant': '".$getVariant."'," . "\n";
                    $orderLines .= "'quantity': " . $item->get_quantity() . "," . "\n";
                $orderLines .= "}," . "\n";
            }
        }

        if($layer_pust_enabled) {
        ?>
<script>
if(window?.dataLayer) {
    window.dataLayer.push({
        'event': 'purchase',
        'ecommerce': {
        'purchase': {
        'currency': '<?php echo get_option('woocommerce_currency'); ?>',
        'actionField': {
            <?php echo $actionField; ?>
        },
            'products': [<?php echo $orderLines; ?>]
        }
    }
    });
}
</script>
        <?php
        }
    }
}
add_action('woocommerce_thankyou', 'nb_google_pust_datalayer_thank_you_page');
endif;

/*
window.dataLayer = window.dataLayer || [];
window.dataLayer.push({
  event: 'select_promotion',
  ecommerce: {
    items: [{
      promotion_id: 'sc2021',
      promotion_name: 'summer_campaign_2021',
      creative_name: 'family_in_bathing_suits_1',
      creative_slot: 'featured_items',
      location_id: 'ChIJ4Us9pPryjUYRn1MzXbSQuPA'
    }]
  }
});
*/

// Data layer for view item
/*

item_id	id	ID / SKU of the product.
item_name	name	Name of the product.
item_list_name	list	Product list name.
item_list_id	N/A	Product list identifier.
index	position	Product position in the list.
item_brand	brand	Product brand.
item_category	category	Product category top-level.
item_category2	category	Product category 2nd level (or alternative).
item_category3	category	Product category 3rd level (or alternative).
item_category4	category	Product category 4th level (or alternative).
item_category5	category	Product category 5th level (or alternative).
item_variant	variant	Item variant name or description.
affiliation	N/A	The store affiliation for this event.
discount	N/A	Any discount associated with this product.
coupon	coupon	Coupon associated with this product.
price	price	Price of this product.
currency	N/A	Currency of the price that is collected.
quantity	quantity	Quantity of the item. Must be an integer.


dataLayer.push({
  'item_id': 'red',
  'item_name': 50,
  'item_list_name': 'customize',
  'index': 'customize',
  'item_brand': 'customize',
  'item_category': 'customize',
  'item_variant': 'customize',
  'affiliation': 'customize',
  'discount': 'customize',
  'coupon': 'customize',
  'price': 'customize',
  'quantity': 'customize',
});

*/

// Data layer for purchase

/*
transaction_id	id	Unique ID for the transaction. Required for purchase and refund events.
affiliation	affiliation	The store or affiliation where the purchase occurred.
value	revenue	The value associated with the event.
currency	currencyCode	Local currency of the collected price. Required for purchase events.
tax	tax	How much tax is included in the total revenue of the purchase.
shipping	shipping	Shipping costs included in the total revenue of the purchase.
items	products/impressions/promotions	Products associated with the event.
shipping_tier	option	The shipping tier used with add_shipping_info.
payment_type	option	The payment method sent with add_payment_info.
coupon	coupon	Coupon associated with the event.
promotion_id	N/A	ID of a promotion associated with the event.
promotion_name	N/A	Name of a promotion associated with the event.
creative_name	N/A	Name of a promotion creative associated with the event.
creative_slot	N/A	Name of the creative slot associated with the event.
location_id	N/A	The physical location associated with the item. It’s recommended to use the Google Place ID that corresponds to the location.
item_list_name	N/A	Name of the list associated with the event.
item_list_id	N/A	ID of the list associated with the event.
*/

// Add to cart event
/*

onclick="dataLayer.push({ 'ecommerce': null });dataLayer.push({
'event': 'add_to_cart',
'ecommerce': {
		'items': [{
		'item_id': '{{ product.id }}',
		'item_name': '{{ product.title | remove: "'" | remove: '"' }}',
		'item_brand': '{{ product.vendor | remove: "'" | remove: '"' }}',
		'item_category': '{{ product.collections[0].title | remove: "'" | remove: '"' }}',
		'item_variant': '{{ product.selected_variant.sku }}',
		'currency': '{{ shop.currency }}',
		'price': '{{ product.price  | times: 0.01}}'
		}]
	}
});"

*/

/*
// 1. Impressions
dataLayer.push({
    'event': 'eec.impressions',
    'ecommerce': {
        'currencyCode': 'INR',                       // Local currency is optional.
        'impressions': [
            {
                'name': 'Triblend Android T-Shirt',       // Name or ID is required.
                'id': '12345',
                'price': '15.25',
                'brand': 'Google',
                'category': 'Apparel',
                'variant': 'Gray',
                'list': 'Search Results',
                'position': 1
            },
            {
                'name': 'Donut Friday Scented T-Shirt',
                'id': '67890',
                'price': '33.75',
                'brand': 'Google',
                'category': 'Apparel',
                'variant': 'Black',
                'list': 'Search Results',
                'position': 2
            }
        ]
    }
});

// 2. Product Click
dataLayer.push({
    'event': 'eec.product_click',
    'ecommerce': {
        'click': {
            'actionField': { 'list': 'Search Results' },      // Optional list property.
            'products': [{
                'name': productObj.name,                      // Name or ID is required.
                'id': productObj.id,
                'price': productObj.price,
                'brand': productObj.brand,
                'category': productObj.cat,
                'variant': productObj.variant,
                'position': productObj.position
            }]
        }
    }
});

// 3. Product Details
dataLayer.push({
    'event': 'eec.product_detail',
    'ecommerce': {
        'detail': {
            'actionField': { 'list': 'Apparel Gallery' },    // 'detail' actions have an optional list property.
            'products': [{
                'name': 'Triblend Android T-Shirt',         // Name or ID is required.
                'id': '12345',
                'price': '15.25',
                'brand': 'Google',
                'category': 'Apparel',
                'variant': 'Gray'
            }]
        }
    }
});

// 4. Add To Cart
dataLayer.push({
    'event': 'eec.addToCart',
    'ecommerce': {
        'currencyCode': 'INR',
        'add': {                                // 'add' actionFieldObject measures.
            'products': [{                        //  adding a product to a shopping cart.
                'name': productObj.name,
                'id': sku,
                'price': String(this.addZeroes(price)),
                'brand': 'Nivia Sports',
                'category': `${productObj.parent_category_url}/${productObj.category_url}`,
                'variant': productVariant,
                'quantity': Number(quantity)
            }]
        }
    }
});


// 5. Remove from cart
dataLayer.push({
    'event': 'eec.removeFromCart',
    'ecommerce': {
        'remove': {                               // 'remove' actionFieldObject measures.
            'products': [{                          //  removing a product to a shopping cart.
                'name': productObj.product_name,
                'id': sku,
                'price': String(this.addZeroes(price)),
                'brand': 'Nivia Sports',
                'category': `${productObj.category_parent_name}/${productObj.category_name}`,
                'variant': productVariant,
                'quantity': Number(quantity)
            }]
        }
    }
});

// 6. Checkout
dataLayer.push({
    'event': 'eec.checkout',
    'ecommerce': {
        'checkout': {
            'actionField': { 'step': 1, 'option': 'Checkout' },
            'products': [{                          //  removing a product to a shopping cart.
                'name': productObj.product_name,
                'id': sku,
                'price': String(this.addZeroes(price)),
                'brand': 'Nivia Sports',
                'category': `${productObj.category_parent_name}/${productObj.category_name}`,
                'variant': productVariant,
                'quantity': Number(quantity)
            }]
        }
    }
});


// 7. Purchase
dataLayer.push({
    'event': 'eec.purchase',
    'ecommerce': {
        'purchase': {
            'actionField': {
                'id': 'T12345',                         // Transaction ID. Required for purchases and refunds.
                'affiliation': 'Online Store',
                'revenue': '35.43',                     // Total transaction value (incl. tax and shipping)
                'tax': '4.90',
                'shipping': '5.99',
                'coupon': 'SUMMER_SALE'
            },
            'products': [{                            // List of productFieldObjects.
                'name': 'Triblend Android T-Shirt',     // Name or ID is required.
                'id': '12345',
                'price': '15.25',
                'brand': 'Google',
                'category': 'Apparel',
                'variant': 'Gray',
                'quantity': 1,
                'coupon': ''                            // Optional fields may be omitted or set to empty string.
            },
            {
                'name': 'Donut Friday Scented T-Shirt',
                'id': '67890',
                'price': '33.75',
                'brand': 'Google',
                'category': 'Apparel',
                'variant': 'Black',
                'quantity': 1
            }]
        }
    }
});
*/