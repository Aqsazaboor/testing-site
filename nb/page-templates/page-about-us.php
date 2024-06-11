<?php
/*
 * Template Name: About us
 */

get_header(); ?>

<div>
	
	<?php
		if(!function_exists('the_field')) {
			echo 'ACF Pro must be installed for this page to work!';
		}
	?>
	
    <section class="hero is-link is-halfheight">
        <div class="hero-body">
            <div class="has-text-centered">
	            <?php the_field('video_intro'); ?>
            </div>
        </div>
        <div class="module-hero-fullwidth-video">
            <div class="overlay"></div>
            <iframe
                src="https://player.vimeo.com/video/182062185?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1&amp;autopause=0&amp;background=1&amp;muted=1"
                allow="autoplay; fullscreen"
                width="640"
                height="360"
                frameborder="0"
                webkitallowfullscreen=""
                mozallowfullscreen=""
                allowfullscreen="allowfullscreen"
            ></iframe>
        </div>
    </section>
    
    <section class="content-section overflow-image">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column">
                    <div class="from-to">
                        <div class="year">
                            2004 – 2022
                        </div>
                    </div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/theme/aboutus/undraw_stars_re_6je7.svg" alt="2004" />
                </div>
                <div class="column">
	                <?php the_field('welcome'); ?>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content-section has-background-white">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column">
                    <div class="columns">
                        <div class="column">
                            <?php the_field('quality'); ?>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/theme/aboutus/reviews.svg" alt="Vi prioriterar kvalitet!" /></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div
                        data-locale="sv-SE"
                        data-template-id="5419b6a8b0d04a076446a9ad"
                        data-businessunit-id="5c8608d330a6670001f404d9"
                        data-style-height="24px"
                        data-style-width="100%"
                        data-theme="light"
                        class="trustpilot-widget"
                        style="position: relative;"
                    >
                        <iframe
                            title="Customer reviews powered by Trustpilot"
                            loading="auto"
                            src="https://widget.trustpilot.com/trustboxes/5419b6a8b0d04a076446a9ad/index.html?templateId=5419b6a8b0d04a076446a9ad&amp;businessunitId=5c8608d330a6670001f404d9#locale=sv-SE&amp;styleHeight=24px&amp;styleWidth=100%25&amp;theme=light"
                            style="position: relative; height: 24px; width: 100%; border-style: none; display: block; overflow: hidden;"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
    if( have_rows('steps') ):
?>
    <section class="content-section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column is-full has-text-centered">
                    <header class="text-center"><h2><?php the_field('steps_title'); ?></h2></header>
                </div>
                <div class="column is-full four-easy-steps">
                    <div class="columns">
<?php
    while ( have_rows('steps') ) : the_row();
        ?>
            <div class="column step">
                <?php if(get_sub_field('step_image')) { ?>
                    <img src="<?php the_sub_field('step_image'); ?>" alt="<?php the_sub_field('step'); ?>" />
                <?php } ?>
                <?php if(get_sub_field('step')) { ?>
                    <p><?php the_sub_field('step'); ?></p>
                <?php } ?>
            </div>
        <?php

    endwhile;
    ?>
    </div>
                    </div>
            </div>
        </div>
    </section>
<?php
endif;
?>
    
    <section class="content-section has-background-white">
        <div class="container">
            <div class="columns is-multiline">
                <!--
                <div class="column is-full has-text-centered">
                    <header>
                        <h2>Våra kunder</h2>
                        <p>Förutom skyltar till privatpersoner så erbjuder vi även skyltar till...</p>
                    </header>
                </div>
                -->
                <div class="column is-full">
                    <div class="columns">
						<div class="column">
							<?php the_field('our_customers'); ?>
						</div>
                        <div class="column">
                            <div class="image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/theme/aboutus/add-to-cart.svg" alt="Våra kunder" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content-section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column">
                    <div class="quote">
                        <div class="image is-48x48"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/theme/aboutus/eva.jpg" alt="Custom Service Agent" class="is-rounded" /></div>
                        <h2><?php pll_e( 'Tack för mycket snabb och bra tjänst! Skylten blev mycket elegant! / Patrick', 'woocommerce' ); ?></h2>
                        <a href="https://se.trustpilot.com/review/skyltdax.se"><?php pll_e( 'Se våra omdömmen på Trustpilot', 'woocommerce' ); ?> ›</a>
                    </div>
                    <div class="image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/theme/aboutus/delivery.svg" alt="" /></div>
                </div>
                <div class="column">
                    <div class="columns">
                        <div class="column">
                            <div class="content-text">
	                            <?php the_field('contact_information'); ?>
	                            
	                            <?php
								if(function_exists('nb_get_our_sites')) {
									echo nb_get_our_sites();						
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<?php
get_footer();
