<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

// Post to ajax, this will generate a shipping label, add to app!
// Using plugin for this.
/*
action: sslabels_api
orders[]: 1473
api_action: generate_labels
_ajax_nonce: bb85f82371
pll_ajax_backend: 1
*/

function nb_admin_menu() {
	add_menu_page(
		__( 'Skyltdax Admin', 'skyltdax-admin' ),
		__( 'Skyltdax Admin', 'skyltdax-admin' ),
		'manage_woocommerce',
		'skyltdax-admin',
		'nb_admin_page_contents',
		'dashicons-schedule',
		3
	);
}
add_action( 'admin_menu', 'nb_admin_menu' );

function nb_admin_page_contents() {

	function convert_date($inputDate) {
	    $date = new DateTime($inputDate);
	    return $date->format('Y-m-d H:i');
	}
?>
    <div id="sdx-app" class="sdx-app" v-cloak>

        <div class="wrap sdx-app-wrapper">
            <section v-if="!orderSingleActive" class="order-table">
                <div class="sdx-app-card">
                    
                    <div class="order-table-header">
                        <h1 class="wp-heading-inline"><?php esc_html_e( 'Orderöversikt', 'skyltdax-admin' ); ?></h1>
                    </div>

                    <div class="order-table-filters">
                        <div class="filter-buttons">
                            <button class="button" :class="filtered === 'all' ? 'active' : ''" @click.prevent="filtered = 'all'"><?php _e('Alla', 'nb'); ?></button>
                            <button class="button" :class="filtered === 'prio-order' ? 'active' : ''" @click.prevent="filtered = 'prio-order'"><?php _e('Prioritet', 'nb'); ?><span class="status-badge" v-if="prioOrdersCount > 0">{{prioOrdersCount}}</span></button>
                            <button class="button" :class="filtered === 'processing' ? 'active' : ''" @click.prevent="filtered = 'processing'"><?php _e('Processar', 'nb'); ?></button>
                            <button class="button" :class="filtered === 'on-hold' ? 'active' : ''" @click.prevent="filtered = 'on-hold'"><?php _e('Pausat', 'nb'); ?></button>
                            <button class="button" :class="filtered === 'in-production' ? 'active' : ''" @click.prevent="filtered = 'in-production'"><?php _e('Under arbete', 'nb'); ?></button>
                        </div>
                    </div>

                    <div v-if="allOrders.length < 1">Åh, just nu finns det inga ohanterade ordrar.</div>
                    
                    <table  v-if="allOrders.length > 0" class="wp-list-table widefat fixed striped table-view-list posts">
                        <thead>
                            <tr>
                                <td style="width: 20px;"></td>
                                <td style="width: 70px;">Order ID</td>
                                <td style="width: 160px;">Datum</td>
                                <td>Beställare</td>
                                <td style="width: 90px;">Betalt</td>
                                <td style="width: 100px;">Status</td>
                                <td style="width: 140px;">Betalningsmetod</td>
                                <td style="width: 140px;">Leveransmetod</td>
                                <td style="width: 110px;">Orderinnehåll</td>
                            </tr>
                        </thead>
                        
                         <tbody v-if="allOrders" id="the-list">
                            <tr v-for="(orderItem, index) in allOrders" :key="index" v-if="orderItem.order_status === filtered || filtered === 'all'">
                                <!-- <td><input type="checkbox" :value="orderItem.order_id" v-model="checkedOrders" /></td> -->
                                <td><a :href="'/wp-admin/admin.php?page=skyltdax-admin&order='+orderItem.order_id" target="_blank" title="Öppna i nytt fönster"><div class="button-open-new-window"></div></a></td>
                                <td class="order_num"><span v-if="orderItem">{{ orderItem.order_id }}</span></td>
                                <td data-colname="Datum"><span v-if="orderItem">{{ orderItem.order_date_created }}</span></td>
                                <td data-colname="Namn">
                                    <div v-if="orderItem" class="order-active-trigger" @click.prevent="toggleSingleOrder(orderItem)">
                                        <div>
                                            <span class="order-lang" :class="'lang-'+orderItem.country_code"></span>
                                            <span v-if="orderItem.firstname">{{ orderItem.firstname }}</span> 
                                            <span v-if="orderItem.lastname">{{ orderItem.lastname }}</span>
                                        </div>
                                        <div>
                                            <div class="note" v-if="orderItem.customer_notes">Kund</div>
                                            <!-- <span class="note" v-for="(note, index) in orderItem.order_notes" v-if="note.note_added_by !== 'system'" :key="index">{{note.note_added_by}}</span> -->
                                        </div>
                                    </div>
                                </td>
                                <td data-colname="Totalt">
                                    <div v-if="orderItem" class="order-active-trigger" @click.prevent="toggleSingleOrder(orderItem)">
                                        <div v-if="orderItem.order_total">{{ orderItem.order_total }}</div> <div>{{ orderItem.order_currency}}</div>
                                    </div>
                                </td>
                                <td><span v-if="orderItem" :class="orderItem.order_status"><mark class="order-status-custom" :class="orderItem.order_status"><span>{{ orderItem.order_status }}</span></mark></span></td>
                                <td><span v-if="orderItem.order_payment_method">{{ getPaymentMethod(orderItem.order_payment_method) }}</span></td>
                                <td><span v-if="orderItem.order_shipping_method">{{ translateShipping(orderItem.order_shipping_method) }}</span></td>
                                <td>
                                    <template v-if="orderItem && orderItem.order_items" v-for="(orderProduct, index) in orderItem.order_items">
                                        <div v-if="orderProduct.product_color !== null && orderProduct.product_color[0] !== null" class="product-color-badge" :data-product-color="orderProduct.product_color[0].toLowerCase()">
                                            <span v-if="orderProduct.product_variant && orderProduct.product_variant[0] !== null && orderProduct.product_variant[0][0] !== null">{{getMaterialLetter(orderProduct.product_variant)}}</span>
                                        </div>
                                    </template>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="sdx-app-card hidden">
                    Under arbete
                </div>
                <div style="padding: 24px; background: white; border: 1px solid #DDD;" v-if="checkedOrders.length > 0">
                    <h2>Checked orders:</h2>
                    <div style="display: flex; gap: 5px; margin-bottom: 16px;">
                        <span style="border: 1px solid #DDD; background: white; padding: 5px 10px;" v-for="orderItem in checkedOrders">{{orderItem}}</span>
                    </div>
                    <button class="button">Do something</button>
                </div>
            </section>

            <section v-if="orderSingleActive && orderSingleData" class="order-single-view">
                <div class="sdx-app-card">

                <div class="toolbar hide-print">
                        <div>
                            <button class="button button-back hide-print" @click.prevent="closeSingleOrder">Tillbaka</button>
                        </div>
                        <div>
                            <button class="button button-print" @click.prevent="triggerPrint">Skriv ut</button>
                            <a class="button" :href="orderSingleData.order_url">Öppna i Woocommerce</a>
                            <button class="button button-print" :class="[loading ? 'loading': '']" @click.prevent="createOrderLabel(orderSingleData.order_id)">Label</button>
                        </div>
                    </div>
                    <div class="order-single-view-header">
                        <div>
                            <h1>Order: #{{orderSingleData.order_id}}</h1>
                        </div>
                        <div>
                            <div class="close-single-view hide-print" @click.prevent="closeSingleOrder"><button class="button"><span>Stäng</span></button></div>
                        </div>
                    </div>
                    <div class="order-wrapper">
                        <div class="row order-details border-bottom">

                            <div class="col">
                                <h2>Orderinformation <span v-if="orderSingleData.country_code"><span class="order-lang" :class="'lang-'+orderSingleData.country_code"></span></span></h2>
                                <div>
                                    <span :class="orderSingleData.order_status"><mark class="order-status-custom" :class="orderSingleData.order_status"><span>{{ orderSingleData.order_status }}</span></mark></span>
                                </div>
                                <div class="flex-table">
                                    <div>
                                        <div>Skapad</div>
                                        <div><span v-if="orderSingleData.order_date_created">{{orderSingleData.order_date_created}}</span></div>
                                    </div>
                                    <div>
                                        <div>Betalningsmetod</div>
                                        <div><span v-if="orderSingleData.order_payment_method_title">{{orderSingleData.order_payment_method_title}}</span></div>
                                    </div>
                                    <div v-if="orderSingleData.order_shipping_total">
                                        <div>Fraktkostnad</div>
                                        <div><span v-if="orderSingleData.order_shipping_total">{{ orderSingleData.order_shipping_total }} {{orderSingleData.order_currency}}</span></div>
                                    </div>
                                    <div v-if="orderSingleData.order_discount_total !== '0'">
                                        <div>Rabatt</div>
                                        <div>{{orderSingleData.order_discount_total}} {{orderSingleData.order_currency}}</div>
                                    </div>
                                    <div>
                                        <div>Ordervärde</div>
                                        <div><span v-if="orderSingleData.order_total">{{ orderSingleData.order_total }} {{orderSingleData.order_currency}}</span></div>
                                    </div>
                                    <div>
                                        <div>Moms 25%</div>
                                        <div><span v-if="orderSingleData.order_total_tax">{{ orderSingleData.order_total_tax }} {{orderSingleData.order_currency}}</span></div>
                                    </div>
                                </div>

                                <div class="order-status-handler hide-print">
                                    <div><strong>Ändra status:</strong></div>
                                    <select id="order_status" name="order_status" class="wc-enhanced-select select2-hidden-accessible enhanced" tabindex="-1" aria-hidden="true" @change="toggleOrderStatus($event)">
                                        <option v-for="(statusItem, index) in orderStatusesData" :key="index" :value="statusItem.key" :selected="checkOrderStatus(statusItem.key, orderSingleData.order_status)">{{statusItem.name}}</option>
                                    </select>

                                    <button :disabled="checkOrderStatus(toggleStatus, orderSingleData.order_status) || loading" @click="updateOrderStatus(orderSingleData.order_id, orderSingleData.blog_id)" class="button">Ändra status</button>
                                </div>

                            </div>

                            <div class="col" v-if="orderSingleData.order_shipping_company || orderSingleData.order_shipping_phone || orderSingleData.order_shipping_first_name || orderSingleData.order_shipping_last_name || orderSingleData.order_shipping_address_1 || orderSingleData.order_shipping_postcode || orderSingleData.order_shipping_city || orderSingleData.order_shipping_country">
                                <h2>Leveransuppgifter</h2>
                                <ul>
                                    <li v-if="orderSingleData.order_shipping_company"><strong>{{orderSingleData.order_shipping_company}}</strong></li>
                                    <li v-if="orderSingleData.order_shipping_phone">{{orderSingleData.order_shipping_phone}}</li>
                                    <li v-if="orderSingleData.order_shipping_first_name || orderSingleData.order_shipping_last_name">{{orderSingleData.order_shipping_first_name}} {{orderSingleData.order_shipping_last_name}}</li>
                                    <li v-if="orderSingleData.order_shipping_address_1">{{orderSingleData.order_shipping_address_1}}</li>
                                    <li v-if="orderSingleData.order_shipping_address_2">{{orderSingleData.order_shipping_address_2}}</li>
                                    <li v-if="orderSingleData.order_shipping_postcode">{{orderSingleData.order_shipping_postcode}}</li>
                                    <li v-if="orderSingleData.order_shipping_city">{{orderSingleData.order_shipping_city}}</li>
                                    <li v-if="orderSingleData.order_shipping_country">{{convertToCountryString(orderSingleData.order_shipping_country)}}</li>
                                </ul>
                            </div>
                    

                            <div class="col">
                                <h2>Fakturauppgifter</h2>
                                <ul>
                                    <li v-if="orderSingleData.order_customer_id">Customer ID {{orderSingleData.order_customer_id}}</li>
                                    <li v-if="orderSingleData.order_billing_company"><strong>{{orderSingleData.order_billing_company}}</strong></li>
                                    <li>{{orderSingleData.order_billing_first_name}} {{orderSingleData.order_billing_last_name}}</li>
                                    <li v-if="orderSingleData.order_billing_address_1">{{orderSingleData.order_billing_address_1}}</li>
                                    <li v-if="orderSingleData.order_billing_address_2">{{orderSingleData.order_billing_address_2}}</li>
                                    <li>{{orderSingleData.order_billing_postcode}}</li>
                                    <li v-if="orderSingleData.order_billing_city">{{orderSingleData.order_billing_city}}</li>
                                    <li v-if="orderSingleData.order_shipping_country">{{convertToCountryString(orderSingleData.order_billing_country)}}</li>
                                </ul>
                                <ul>
                                    <li v-if="orderSingleData.order_billing_email">
                                        <a :href="'mailto:'+orderSingleData.order_billing_email">{{orderSingleData.order_billing_email}}</a>
                                    </li>
                                    <li v-if="orderSingleData.order_billing_phone">
                                        <a :href="'tel:'+orderSingleData.order_billing_phone">{{orderSingleData.order_billing_phone}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col order-products">
                                <h2>Beställda produkter ({{countTotalOrderItems()}})</h2>
                                <div v-if="orderSingleData.order_shipping_method" class="order-shipping-method">
                                    <h2>
                                        <div class="order-shipping-method__group">
                                            <div>Leverans: </div>
                                            <div v-if="orderSingleData.order_shipping_method">{{ orderSingleData.order_shipping_method }} </div>
                                            <div v-if="orderSingleData.order_shipping_method" class="method" :class="getShippingMethod(orderSingleData.order_shipping_method)"></div>
                                        </div>
                                    </h2>
                                </div>
                                <div v-if="orderSingleData.order_items.length < 1" class="order-items">
                                    <div class="order-item">
                                        <div class="order-skeleton">
                                            <h3>Denna order har inga produkter.</h3>
                                            <div class="image"></div>
                                            <div class="text">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div v-else class="order-items">
                                    <div v-for="(orderItem, index) in orderSingleData.order_items" :key="index" class="order-item">
                                        <div v-if="orderItem.order_image" class="order-item-image-wrapper">
                                            <div>
                                                <img class="order-item-image" :src="orderItem.order_image" />
                                            </div>
                                        </div>
                                        <div class="order-item-image-wrapper" v-else>
                                            <div v-if="orderItem.product_image">
                                                <div>
                                                    <img class="order-item-image" :src="orderItem.product_image" />
                                                </div>
                                            </div>
                                            <div v-else>Hittade ingen bild till ordern.</div>
                                        </div>
                                        <div>
                                            <div class="order-item-header">
                                                <h3>
                                                    <template v-if="orderItem.product_name_alt_name">{{orderItem.product_name_alt_name}} <s>{{orderItem.product_name}}</s></template>
                                                    <template v-else>{{orderItem.product_name}}</template> 
                                                    <span v-if="orderItem.product_width[0]">{{orderItem.product_width[0]}}</span><span v-if="orderItem.product_height[0]">x{{orderItem.product_height[0]}}</span> 
                                                    <span v-if="orderItem.product_width && orderItem.product_height">mm</span>
                                                </h3>
                                                <template v-if="orderItem.product_description && checkIfClientArea(orderSingleData.blog_url)">
                                                    <div class="order-item__description">
                                                        <span v-html="orderItem.product_description"></span>
                                                    </div>
                                                </template>
                                                <div v-if="orderItem.product_description && showDescription" class="order-item__description">
                                                    <span v-html="orderItem.product_description"></span>
                                                </div>
                                                <button v-if="orderItem.product_description" @click.prevent="showDescription = !showDescription">Visa beskrivning</button>
                                            </div>
                                            <ul>
                                                <li v-if="orderItem.quantity && checkIfUndefined(orderItem.quantity)"><strong>Antal:</strong> {{orderItem.quantity}} st</li>
                                                <li v-if="orderItem.font_1 && checkIfUndefined(orderItem.font_1)"><strong>Typsnitt:</strong> {{orderItem.font_1}}</li>
                                                <li v-if="orderItem.font_2 && checkIfUndefined(orderItem.font_2)"><strong>Typsnitt:</strong> {{orderItem.font_2}}</li>
                                                <li v-if="orderItem.text_italic && checkIfUndefined(orderItem.text_italic)"><strong>Kursiv:</strong> {{orderItem.text_italic}}</li>
                                                <li v-if="orderItem.text_bold && checkIfUndefined(orderItem.text_bold)"><strong>Fet text:</strong> {{orderItem.text_bold}}</li>
                                                <li v-if="orderItem.text_alignment && checkIfUndefined(orderItem.text_alignment)"><strong>Textjustering:</strong> {{orderItem.text_alignment}}</li>
                                                <li v-if="orderItem.text_size && checkIfUndefined(orderItem.text_size)"><strong>Textstorlek:</strong> {{orderItem.text_size}}</li>
                                                <li v-if="orderItem.text_offset && checkIfUndefined(orderItem.text_offset)"><strong>Text offset:</strong> {{orderItem.text_offset}}</li>
                                                <li v-if="checkItemEngraving(orderItem)">Gravyr: {{ checkItemEngraving(orderItem) }}</li>
                                                <li v-if="orderItem.text_rows && checkIfUndefined(orderItem.text_rows)"><textarea rows="6" v-html="orderItem.text_rows"></textarea></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col order-comments">
                                <div v-if="orderSingleData.customer_notes">
                                    <h2>Kundkommentar</h2>
                                    <div class="customer-note">{{orderSingleData.customer_notes}}</div>
                                </div>
                                <div>
                                    <h2>Orderhistorik / kommentarer:</h2>
                                    <div class="order-add-admin-note hide-print">
                                        <div>
                                            <textarea v-model="noteText" rows="3"></textarea>
                                        </div>
                                        <div>
                                            <button class="button" @click.prevent="addOrderNote(orderSingleData.order_id, orderSingleData.blog_id)">Lägg till kommentar</button>
                                        </div>
                                    </div>
                                    <div class="order-notes" v-if="orderSingleData.order_notes">
                                        <div class="order-notes-filters hide-print">
                                            <div>
                                                <button @click="orderNotesFiltered = true" :class="orderNotesFiltered && 'button-active'">Filtrerad</button>
                                            </div>
                                            <div>
                                                <button @click="orderNotesFiltered = false" :class="!orderNotesFiltered && 'button-active'">Visa alla</button>
                                            </div>
                                        </div>
                                        <div class="order-note" v-for="(note, index) in orderSingleData.order_notes" :class="note.added_by === 'system' && orderNotesFiltered ? 'order-note-hidden' : ''">
                                            <div v-if="searchMediaFileURL(note.content)" v-html="searchMediaFileURL(note.content)"></div>
                                            <div v-if="!searchMediaFileURL(note.content) && note.content">{{note.content}} <span v-if="searchMediaFileURL(note.content)">{{ searchMediaFileURL(note.content) }}</span></div>
                                            <div class="order-note-author"><span v-if="note.added_by">{{note.added_by}}</span> <span v-if="note.date_created.date">{{note.date_created.date}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>
        
    </div>

<?php
    if (class_exists('GetWoocommerceOrders')) {
        $WoocommerceAllOrders = new GetWoocommerceOrders();
        $woocommerceOrders = $WoocommerceAllOrders->getAllOrders();
        if($woocommerceOrders) {
            echo '<script>'."\n";
            echo 'const orderLines = ' . $woocommerceOrders . ';'."\n";
            if(class_exists('dimap_SimpleShippingLabels')) {
                echo 'const sslabels_api = {"_ajax_nonce": "'. wp_create_nonce('generate_labels').'"};'."\n";
            }
            echo '</script>';
        }
    } else {
        throw new Exception('The class GetWoocommerceOrders does not exist.');
    }
}