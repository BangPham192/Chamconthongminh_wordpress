<?php
if (!function_exists('default_mag_single_related_post')) :
    /**
     * Main Banner Section
     *
     * @since default-mag 1.0.0
     *
     */
    function default_mag_single_related_post()
    {
        if (1 != default_mag_get_option('enable_related_post_on_single_page')) {
            return;
        }
        ?>
        <div class="twp-related-post">
            <div class="container twp-no-space">
                    <?php
                    global $post;
                    $categories = get_the_category(get_the_ID());
                    $related_section_title = esc_html(default_mag_get_option('single_related_post_title'));
                    $number_of_related_posts = absint(default_mag_get_option('number_of_single_related_post'));

                    if ($categories) {
                        $cat_ids = array();
                        foreach ($categories as $category) $cat_ids[] = $category->term_id;
                        $default_mag_related_post_args = array(
                            'posts_per_page' => absint($number_of_related_posts),
                            'category__in' => $cat_ids,
                            'post__not_in' => array(get_the_ID()),
                            'order' => 'ASC',
                            'orderby' => 'rand'
                        ); ?>
                        <div class="twp-single-page-related-article-section">
                            <h2 class="twp-title"><?php echo esc_html($related_section_title); ?></h2>
                            <ul class="twp-single-related-post-list">
                                <?php 
                                $default_mag_related_post_post_query = new WP_Query($default_mag_related_post_args);
                                if ($default_mag_related_post_post_query->have_posts()) :
                                    while ($default_mag_related_post_post_query->have_posts()) : $default_mag_related_post_post_query->the_post();
                                            if(has_post_thumbnail()){
                                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
                                                $url = $thumb['0'];
                                            }
                                            else{
                                                $url = '';
                                            }?>
                                            <li class="twp-single-related-post">
                                                <div class="twp-image-section data-bg-md">
                                                    <a href="<?php the_permalink(); ?>" class="data-bg data-bg-md d-block" data-background="<?php echo esc_url($url); ?>"></a>
                                                    <?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>
                                                </div>
                                                <div class="twp-wrapper">
                                                    <div class="twp-meta-style-1  twp-author-desc twp-primary-text">
                                                        <?php default_mag_post_date(); ?>
                                                    </div>
                                                   
                                                    <h3 class="twp-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                </div>
                                            </li>
                                        <?php endwhile;
                                endif; 
                                wp_reset_postdata(); 
                                ?>
                            </ul>
                        </div><!--col-->
                    <?php } ?> 
            </div><!--/container-->
        </div><!--/twp-news-main-section-->
        <?php
}  
endif;
add_action('default_mag_action_related_post', 'default_mag_single_related_post', 10);
