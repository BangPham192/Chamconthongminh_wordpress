<?php
if (!function_exists('default_mag_carousel_args')) :
    /**
     * Banner carousel Details
     *
     * @since Default Mag 1.0.0
     *
     * @return array $qargs carousel details.
     */
    function default_mag_carousel_args()
    {
        $default_mag_carousel_number = absint(default_mag_get_option('number_of_home_carousel'));
        $default_mag_carousel_category = esc_attr(default_mag_get_option('select_category_for_carousel'));
        $qargs = array(
            'posts_per_page' => esc_attr($default_mag_carousel_number),
            'post_type' => 'post',
            'cat' => $default_mag_carousel_category,
        );
        return $qargs;
        ?>
        <?php
    }
endif;


if (!function_exists('default_mag_carousel')) :
    /**
     * Banner carousel
     *
     * @since Default Mag 1.0.0
     *
     */
    function default_mag_carousel()
    {
        $default_mag_carousel_title_text = esc_html(default_mag_get_option('heading_text_on_carousel'));

        if (1 != default_mag_get_option('show_carousel_section')) {
            return null;
        }
        $default_mag_carousel_args = default_mag_carousel_args();
        $default_mag_carousel_query = new WP_Query($default_mag_carousel_args); ?>
        <?php $rtl_class_c = 'false';
        if(is_rtl()){ 
            $rtl_class_c = 'true';
        }?>
        <div class="twp-related-articles-slider-section twp-default-bg twp-slider-icon">
            <div class="container">
                <?php if (!empty($default_mag_carousel_title_text)) { ?>
                    <div class="section-heading">
                        <h2 class="twp-title">
                            <?php echo esc_html($default_mag_carousel_title_text); ?>
                        </h2>
                    </div>
                <?php } ?>
                <div class="twp-related-articles-slider" data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
                    <?php
                    if ($default_mag_carousel_query->have_posts()) :
                        while ($default_mag_carousel_query->have_posts()) : $default_mag_carousel_query->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'insights-main-banner');
                                $url = $thumb['0'];
                            }
                            ?>
                                <div class="twp-related-articles">
                                    <div class="twp-image-section">
                                        <?php if (has_post_thumbnail()) { ?>
                                        <a href="<?php the_permalink(); ?>" class="data-bg data-bg-md" data-background="<?php echo esc_url($url); ?>"></a>
                                        <?php  } else { ?>
                                            <div class="data-bg-md"></div>
                                        <?php } ?>
                                    </div>
                                    <div class="twp-description">
                                        <h3 class="twp-post-title twp-post-title-sm">
                                            <a  href="<?php the_permalink(); ?>" class="twp-default-anchor-text">
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
            </div>
        </div>
        <?php
    }
endif;
add_action('default_mag_action_carousel_post', 'default_mag_carousel', 10);