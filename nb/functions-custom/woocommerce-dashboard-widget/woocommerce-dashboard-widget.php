<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

$woocommerce_custom_order_widget_enabled = false;

if( $woocommerce_custom_order_widget_enabled ) {

	if(!function_exists('woocommerce_dashboard_widget')):
	add_action('wp_dashboard_setup', 'woocommerce_dashboard_widget');
	function woocommerce_dashboard_widget() {
		global $wp_meta_boxes;
		wp_add_dashboard_widget('woocommerce_dashboard_widget', 'Skyltdax orderhantering', 'woocommerce_custom_dashboard_widget');
	}
	endif;

	if(!function_exists('woocommerce_custom_dashboard_widget')):
	function woocommerce_custom_dashboard_widget() {
	?>
		<div class="custom-dashboard-widget">
			<h2>Ohanterade ordrar</h2>
			<p>Dessa ordrar har flaggan <strong>Processing</strong>. Klick öppnar ordrar i Woocommerce orderhantering. Ett tag kommer vi behöva hämta information från vårt gamla system, <a href="https://www.skyltdax.konjin.com/" target="_blank">det hittar du här</a>.</p>
			
			<div id="dashboard-widget" v-cloak>
				<div>
					<div class="custom-dashboard-widget__table-row">
						<div class="custom-dashboard-widget__table-header">
							<div class="id-row">#</div>
							<div>Namn</div>
							<div>Datum</div>
							<div class="productcolor-row">Produkter</div>
						</div>
					</div>
					<div v-if="!loading && allOrders" class="custom-dashboard-widget__table">
						<div v-for="(orderItem, index) in allOrders" class="custom-dashboard-widget__table-row" :key="index" :class="orderItem.order_status === 'prio-order' ? 'prio' : ''">
							<a v-if="orderItem.order_url" :href="getRealOrderUrl(orderItem)">
								<div class="id-row">{{index+1}}</div>
								<div>
									<div v-if="orderItem.country_code" class="flag" :class="['flag-'+orderItem.country_code]"></div>
									<span v-if="orderItem.firstname">{{ orderItem.firstname }}</span> 
									<span v-if="orderItem.lastname">{{ orderItem.lastname }}</span> 
									(<span v-if="orderItem.order_id">{{ orderItem.order_id }}</span>)
								</div>	
								<div><span v-if="orderItem.order_date_created">{{ orderItem.order_date_created }}</span></div>
								<div class="productcolor-row">
									<div v-if="orderItem.order_items">
										<div v-for="(orderItemColor, index) in orderItem.order_items" :key="index">
											<div v-if="orderItemColor.product_color">
												<div class="product-color-badge" v-if="orderItemColor.product_color[0]" :data-product-color="getProductColor(orderItemColor.product_color[0])">
													<span><span v-if="orderItemColor.product_variant[0]">{{ getMaterialLetter(orderItemColor.product_variant) }}</span></span>
												</div>	
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="loading" v-else></div>
				</div>
			</div>
		</div>
	<?php
	}
	endif;
}