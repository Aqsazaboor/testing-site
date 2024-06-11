<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!function_exists('nb_shop_promises')) :
	function nb_shop_promises()
	{

		$store_support_telephone = '';
		if (function_exists('get_field')) {
			$store_support_telephone = get_field('support_telephone', 'option');
		}

		$store_support_email = '';
		if (function_exists('get_field')) {
			$store_support_email = get_field('support_email', 'option');
		}

?>

		<section id="shop-promises-container" class="shop-promises-container">
			<div class="shop-promises">
				<div class="container is-widescreen">
					<div class="columns">

						<?php if ($store_support_telephone) { ?>
							<div class="column">
								<div class="contact-bar">
									<div class="telephone">
										<?php if ($store_support_telephone) :
											$clear_white_space = str_replace(' ', '', $store_support_telephone);
										?>
											<a href="tel:<?php echo $clear_white_space; ?>"><?php echo $store_support_telephone; ?></a><br />
										<?php endif ?>
									</div>
									<div class="email">
										<?php if ($store_support_email) : ?>
											<a href="mailto:<?php echo $store_support_email; ?>"><?php echo $store_support_email; ?></a>
										<?php endif ?>
									</div>
									<div>
										<?php if (is_user_logged_in()) { ?>
											<a class="log-out" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Mitt konto', 'nb'); ?>">
												<span></span><?php pll_e('Mitt konto'); ?>
											</a>
										<?php } else { ?>
											<a class="log-in" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Mitt konto', 'nb'); ?>">
												<span></span><?php pll_e('Mitt konto'); ?>
											</a>
										<?php } ?>
									</div>
									<div>
										<span>
											<?php pll_e('Företag & Brf - Kontakta oss för offert eller för specifika lösningar - Fakturabetalning erbjuds'); ?>
										</span>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="column">
								<div class="brand-promises" role="list">
									<?php if (pll__('Trygg E-handel')) : ?><div role="listitem">
											<div class="trust-safe-ecommerce brand-promises-item"><?php pll_e('Trygg E-handel'); ?></div>
										</div><?php endif; ?>
									<?php if (pll__('Kvalitativ gravyr')) : ?><div role="listitem">
											<div class="trust-quality-engraving brand-promises-item"><?php pll_e('Kvalitativ gravyr'); ?></div>
										</div><?php endif; ?>
									<?php if (pll__('Skickas inom en vecka')) : ?><div role="listitem">
											<div class="delivery-specs brand-promises-item"><?php pll_e('Skickas inom en vecka'); ?></div>
										</div><?php endif; ?>
									<?php if (pll__('Produceras i Sverige')) : ?><div role="listitem">
											<div class="produced-in-sweden brand-promises-item"><?php pll_e('Produceras i Sverige'); ?></div>
										</div><?php endif; ?>
									<?php if (pll__('Frakt 39 kr (fast pris)')) : ?><div role="listitem">
											<div class="flat-rate-shipping brand-promises-item"><?php pll_e('Frakt 39 kr (fast pris)'); ?></div>
										</div><?php endif; ?>
									<div role="listitem">
										<div class="brand-promises-item">
											<?php if (is_user_logged_in()) { ?>
												<a class="log-out" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Mitt konto', 'nb'); ?>">
													<span></span><?php pll_e('Mitt konto'); ?>
												</a>
											<?php } else { ?>
												<a class="log-in" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Mitt konto', 'nb'); ?>">
													<span></span><?php pll_e('Mitt konto'); ?>
												</a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</section>

<?php
	}
endif;
