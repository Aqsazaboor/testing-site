<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>
	</div><!-- #content -->

	<?php #do_action( 'storefront_before_footer' ); ?>
			
		</div><!-- col-md -->
		

		
		<?php
		/**
		 * Functions hooked in to storefront_footer action
		 *
		 * @hooked storefront_footer_widgets - 10
		 * @hooked storefront_credit         - 20
		 */
		#do_action( 'storefront_footer' );
		?>

		<section id="footer" class="footer has-background-white hidden-print">
			
			<div class="shop-benefits">
				<div class="container">
					<div class="columns">
						<div class="column">
							<div class="shop-promises-container">
								<?php if(pll__('Skickas inom en vecka')): ?><div class="brand-promises-item flat-rate-shipping"><?php echo pll_e('Skickas inom en vecka'); ?></div><?php endif; ?>
								<?php if(pll__('Kvalitativ gravyr')): ?><div class="brand-promises-item trust-quality-engraving"><?php echo pll_e('Kvalitativ gravyr'); ?></div><?php endif; ?>
								<?php if(pll__('Trygg E-handel')): ?><div class="brand-promises-item trust-safe-ecommerce"><?php echo pll_e('Trygg E-handel'); ?></div><?php endif; ?>
								<?php if(pll__('Produceras i Sverige')): ?><div class="brand-promises-item produced-in-sweden"><?php echo pll_e('Produceras i Sverige'); ?></div><?php endif; ?>
								<?php if(pll__('Frakt 39 kr (fast pris)')): ?><div class="brand-promises-item flat-rate-shipping"><?php pll_e('Frakt 39 kr (fast pris)'); ?></div><?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="container footer-content">
				<div class="columns is-multiline">

	<?php

	// The main address pieces:
	$store_address     = get_option( 'woocommerce_store_address' );
	$store_address_2   = get_option( 'woocommerce_store_address_2' );
	$store_city        = get_option( 'woocommerce_store_city' );
	$store_postcode    = get_option( 'woocommerce_store_postcode' );
	$store_orgnumber   = function_exists('get_field') ? get_field( 'footer_org_number', "option" ) : "";

	// The country/state
	$store_raw_country = get_option( 'woocommerce_default_country' );

	// Split the country/state
	$split_country = explode( ":", $store_raw_country );

	// Country and state separated:
	$store_country = $split_country[0];

	$store_support_telephone = '';
	if(function_exists('get_field')) {
		$store_support_telephone = get_field('support_telephone','option');
	}

	$store_support_email = '';
	if(function_exists('get_field')) {
		$store_support_email = get_field('support_email','option');
	}

	?>
					<div class="column is-full category-list__section">
						<div class="columns">

							<div class="column is-one-quarter">
								<aside class="menu" role="navigation" aria-label="<?php pll_e('Produkter'); ?>">
									<h3>
										<?php pll_e('Signs in other languages?'); ?>
									</h3>
									<?php
										wp_nav_menu( array(
											'theme_location' => 'countries',
											'fallback_cb'    => false,
											'container_class' => 'menu-list'
										) );
									?>
								</aside>
							</div>

							<div class="column is-three-quarters">
								<div class="columns is-one-third">
									<div class="column is-one-third">
										<h3><?php pll_e('Kategorier'); ?></h3>
										<nav>
											<?php
												wp_nav_menu( array(
													'theme_location' => 'footercategories',
													'fallback_cb'    => false,
													'container_class' => 'menu-list'
												) );
											?>
										</nav>
									</div>
									<div class="column is-two-thirds">
										<h3><?php pll_e('Taggar'); ?></h3>
										<nav>
										<?php

										$taxonomy  = 'product_tag';
										$tags_html = [];
										$tquery    = new WP_Term_Query( array(
										'taxonomy'     => $taxonomy,
										'orderby'      => 'name',
										'order'        => 'ASC',
										'hide_empty'   => false,
										) );

										// 1st Loop: Go through each term and format it
										foreach($tquery->get_terms() as $term){
											$link   = get_term_link( $term->term_id, $taxonomy );
											$letter = $term->slug[0];
											// Set alphabetically by letter each product tag formatted html (with the class, the link and the count (optionally)
											// &nbsp;('.$term->count.')'.
											$tags_html[$letter][] = '<a class="'.$term->slug.'" href="'.$link.'">'.$term->name.'</a>';
										}

										echo '<div class="menu-list product_tags">';
										// 2nd Loop: Display all formatted product tags grouped by letter alphabetically
										foreach( $tags_html as $letter => $values ){
											echo implode('', $values);
										}
										echo '</div>';

										?>
										</nav>
									</div>
								</div>
							</div>
							
						</div>

					</div>

					<div class="column is-full about-company__section">
						<div class="columns">
							
							<div class="column about-company">
								<div>
									<h3><?php pll_e('Om Skyltdax'); ?></h3>
									<?php echo function_exists('get_field') && get_field('about_company_short_footer','options') ? get_field('about_company_short_footer','options') : ''; ?>
									<br /><br />
									<?php
										if( function_exists('get_field') && get_field('footer_about_shop_short','options') ) {
											echo '<p>'.get_field('footer_about_shop_short','options').'</p>';
										}
									?>
									<p>&copy; 2004-<?php echo date('Y'); ?> <?php pll_e('Copyright'); ?> <?php echo function_exists('get_field') && get_field('company_name','options') ? get_field('company_name','options') : 'Skyltdax Group AB'; ?></p>
								</div>
							</div>

							<div class="column">
								<h3>
								<?php pll_e('Kontakt'); ?>
								</h3>
								<?php /* <h3><?php echo bloginfo('name'); ?></h3> */ ?>
								<div class="columns is-multiline">
									<div class="column is-half">
										<address>
											<p>
												<?php pll_e('Adress'); ?>:<br />
												<?php
												echo $store_address . "<br />";
												echo ( $store_address_2 ) ? $store_address_2 . "<br />" : '';
												echo  $store_postcode . ' ' . $store_city . ', ' . $store_country . "<br />";
												echo $store_orgnumber ? pll__('Orgnummer') . " " . $store_orgnumber : "";
												?>
											</p>
										</address>

										<?php
										if( function_exists('get_field') && get_field('footer_reseller_text','options') ) {
											echo '<div class="reseller__section">';
											echo get_field('footer_reseller_text','options');
											echo '</div>';
										}
										?>
									</div>


									<div class="column is-half">
										<div class="customer-service__button">
											<h3><?php pll_e('Kundtjänst'); ?></h3>
											<?php if($store_support_telephone):
												$clear_white_space = str_replace(' ', '', $store_support_telephone);
											?>
												<a href="tel:<?php echo $clear_white_space; ?>"><?php echo $store_support_telephone; ?></a><br />
											<?php endif ?>
											<?php if($store_support_email): ?>
												<a href="mailto:<?php echo $store_support_email; ?>"><?php echo $store_support_email; ?></a>
											<?php endif ?>
										</div>
										<aside class="menu" role="navigation" aria-label="<?php pll_e('Kontakt'); ?>">
											<?php
												wp_nav_menu( array(
													'theme_location' => 'footer',
													'fallback_cb'    => false,
													'container_class' => 'menu-list'
												) );
											?>
										</aside>
									</div>

								</div>
								
								
							</div>
							
						</div>
					</div>
				</div>
			</div>

			<div>
				<div class="container">
					<div class="columns">
						<div class="column is-full">
							<div class="service-logos">
								
								<?php
									$siteLanguage = '';
									if(function_exists('get_site_language')) {
										$siteLanguage = get_site_language();
									} else {
										$siteLanguage = 'sv';
									}
								?>
							
								<ul>
									<li><div class="service-logo klarna"><span class="is-sr-only">Klarna</span></div></li>
									<li><div class="service-logo mastercard"><span class="is-sr-only">Mastercard Logo</span></div></li>
									<li><div class="service-logo visa"><span class="is-sr-only">Visa Logo</span></div></li>
									<?php if( $siteLanguage == 'sv' ) { ?>
										<li><div class="service-logo swish"><span class="is-sr-only">Swish Logo</span></div></li>
										<li><div class="service-logo se-postnord"><span class="is-sr-only">Postnord</span></div></li>
									<?php } ?>

									<?php if( $siteLanguage == 'de' ) { ?>
										<li><div class="service-logo de-post"><span class="is-sr-only">Deutsche post</span></div></li>
									<?php } ?>
									<?php if( $siteLanguage == 'fi' ) { ?>
										<li><div class="service-logo fi-posti"><span class="is-sr-only">Posti</span></div></li>
									<?php } ?>
									<?php if( $siteLanguage == 'nl' ) { ?>
										<li><div class="service-logo nl-post"><span class="is-sr-only">Post Nl</span></div></li>
									<?php } ?>
									<?php if( $siteLanguage == 'dk' ) { ?>
										<li><div class="service-logo dk-post"><span class="is-sr-only">Post Danmark</span></div></li>
									<?php } ?>
									<?php if( $siteLanguage == 'en' ) { ?>
										<li><div class="service-logo uk-post"><span class="is-sr-only">Post Danmark</span></div></li>
									<?php } ?>
									<li><div class="service-logo ups"><span class="is-sr-only">UPS</span></div></li>
									<li><div class="service-logo dhl"><span class="is-sr-only">DHL</span></div></li>
								</ul>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php /*
			<footer id="colophon" class="hidden-print">
				<div class="container">
					<div class="columns">
						<div class="column">
							<div class="pull-right copyright">
								&copy; 2004-<?php echo date('Y'); ?> <?php pll_e('Copyright'); ?> <?php echo function_exists('get_field') && get_field('company_name','options') ? get_field('company_name','options') : 'Skyltdax Group AB'; ?>
							</div>
						</div>
					</div>
				</div>
			</footer>
			*/ ?>

		</section>

		<?php
		if(function_exists('menu_drawer')) {
			menu_drawer();
		}
		?>
		
		<section class="drawer" id="drawer-menu" data-drawer-target="">
			<div class="drawer__overlay" data-drawer-close="" tabindex="-1"></div>
			
			<div class="drawer__wrapper">
				<div class="drawer__header">
					<div class="drawer__title">
						<?php pll_e('Meny'); ?>
					</div>
					<button class="drawer__close" data-drawer-close="" aria-label="Close Drawer"></button>
				</div>
				<div class="drawer__content">
					
					<div class="panel-navigation">
		
						<aside class="panel-menu" id="panel-menu">
							<div id="off-canvas-cart">
								<?php
								if( function_exists('woocommerce_mini_cart') ) {
									woocommerce_mini_cart();
								}
								?>
							</div>
							
							<ul class="menu-list">
								<?php /*
								<li><a href="/<?php echo PageHandler::getLocalUri($app['db'], 'home'); ?>"><?php echo t('page_home'); ?></a></li>
								<li><a href="/<?php echo PageHandler::getLocalUri($app['db'], 'design'); ?>"><?php echo t('page_design'); ?></a></li>
								<li><a href="/<?php echo PageHandler::getLocalUri($app['db'], 'about'); ?>"><?php echo t('page_about'); ?></a></li>
								<li><a href="/<?php echo PageHandler::getLocalUri($app['db'], 'faq'); ?>"><?php echo t('page_faq'); ?></a></li>
								<?php if ($app['config']["lang_id"]==2): ?>
									<li><a href="/<?php echo PageHandler::getLocalUri($app['db'], 'companies'); ?>"><?php echo t('page_companies'); ?></a></li>
								<?php endif; ?>
								*/ ?>
							</ul>
						</aside>
						
					</div>
					
				</div>
			</div>
			
		</section>

		<div id="recent-orders" class="recent-orders">
			<div>
				<div id="recent-orders__content"></div>
				<div>
					<button id="recent-orders__close" class="recent-orders__close">
						<span class="is-sr-only">Stäng</span>
					</button>
				</div>
			</div>
		</div>

	</div><!-- /row -->

</div><!-- /page-wrapper -->
<?php wp_footer(); ?>

</body>
</html>
