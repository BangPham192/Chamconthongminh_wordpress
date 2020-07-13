<?php
if (!function_exists('default_mag_ticker_news_args')) :
    /**
     * ticker pin Details
     *
     * @since Default Mag 1.0.0
     *
     * @return array $qargs ticker section details.
     */
    function default_mag_ticker_news_args()
    {
        $default_mag_ticker_news_number = absint(default_mag_get_option('number_of_ticker_post'));
        $default_mag_ticker_news_category = absint(default_mag_get_option('select_category_for_ticker_pinned_section'));
        $qargs = array(
            'posts_per_page' => absint($default_mag_ticker_news_number),
            'post_type' => 'post',
            'cat' => $default_mag_ticker_news_category,
        );
        return $qargs;
        ?>
        <?php
    }
endif;


if (!function_exists('default_mag_ticker_pin_post')) :
    /**
     * Banner ticker section
     *
     * @since Default Mag 1.0.0
     *
     */
    function default_mag_ticker_pin_post()
    {
        $default_mag_ticker_news_title_text = esc_html(default_mag_get_option('ticker_pinned_post_title'));

        if (1 != default_mag_get_option('show_ticker_pinned_post_section')) {
            return null;
        }
        $default_mag_ticker_news_args = default_mag_ticker_news_args();
        $default_mag_ticker_news_query = new WP_Query($default_mag_ticker_news_args); ?>
        <div class="twp-ticker-pin-slider-section twp-ticker-active" id="twp-ticker-slider">
            <div class="container">
                <div class="twp-wrapper clearfix">
                    <div class="twp-ticker-close"  id="twp-ticker-close">
                        <span class="twp-close-icon">
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                    <?php if (!empty($default_mag_ticker_news_title_text)) { ?>
                        <h2 class="twp-section-title twp-section-title-sm twp-primary-bg">
                            <?php echo esc_html($default_mag_ticker_news_title_text); ?>
                        </h2>
                    <?php } ?>
                    <?php $rtl_class_c = 'false';
                    if(is_rtl()){ 
                        $rtl_class_c = 'true';
                    }?>
                    <!-- <marquee behavior="" direction=""> -->
                    <div class="twp-ticker-pin-slider" data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
                        <?php
                        if ($default_mag_ticker_news_query->have_posts()) :
                            while ($default_mag_ticker_news_query->have_posts()) : $default_mag_ticker_news_query->the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'insights-main-banner');
                                    $url = $thumb['0'];
                                }
                                ?>
                                <div class="twp-ticket-pin">
                                    <div class="twp-image-section">
                                        <?php if (has_post_thumbnail()) { ?>
                                        <a href="<?php the_permalink(); ?>" class="data-bg data-bg-sm" data-background="<?php echo esc_url($url); ?>"></a>
                                        <?php  } else { ?>
                                            <div class="data-bg-md"></div>
                                        <?php } ?>
                                    </div>
                                    <div class="twp-title-section">
                                        <h4 class="twp-post-title twp-post-title-sm">
                                            <a class="twp-default-anchor-text" href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        endif; ?>
                    </div>
                    <!-- </marquee> -->

                </div>
                
            </div>
        </div>
        <?php
    }
endif;
add_action('default_mag_action_ticker_news_post', 'default_mag_ticker_pin_post', 10);
