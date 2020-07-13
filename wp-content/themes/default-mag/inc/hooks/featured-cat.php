<?php
if (!function_exists('default_mag_footer_category_post')) :
    /**
     * Featued Category Section
     *
     * @since default-mag 1.0.0
     *
     */
    function default_mag_footer_category_post()
    {
        if (1 != default_mag_get_option('show_featured_category_section')) {
            return null;
        }
        ?>
        <div class="twp-featured-category-post-list">
            <div class="container">
                <div class="twp-row">
                    <?php
                    global $post;
                    for ($i=1; $i <= 3 ; $i++) { 
                    $category_id = absint(default_mag_get_option('select_category_for_featured_category_'. $i)) ;
                    $number_of_category_posts = absint(default_mag_get_option('number_of_post_featured_category')) ;
                        $default_mag_category_post_args = array(
                            'category__in' => $category_id,
                            'posts_per_page' => $number_of_category_posts, // Number of category posts to display.
                            'ignore_sticky_posts' => 1
                        ); ?>
                        <div class="col-lg-4 col-md-6 twp-col-gap">
                           
                            <?php if (!empty($category_id)) { ?>
                                <h2 class="twp-title twp-section-title"><a href="<?php echo esc_url(get_category_link( $category_id ))?>"><?php echo esc_html(get_cat_name($category_id))?></a></h2>
                            <?php } ?>
                            <ul class="twp-recent-post-list twp-box-shadow">
                                <?php 
                                $default_mag_featured_category_query = new WP_Query($default_mag_category_post_args);
                                $counter = 0;
                                if ($default_mag_featured_category_query->have_posts()) :
                                    while ($default_mag_featured_category_query->have_posts()) : $default_mag_featured_category_query->the_post();
                                        if(has_post_thumbnail()){
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
                                            $url = $thumb['0'];
                                        }
                                        else{
                                            $url = '';
                                        }
                                        ?>
                                        <?php
                                        if ($counter == 0) { ?>
                                            <?php 
                                            if(has_post_thumbnail()){
                                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
                                                $url = $thumb['0'];
                                            }
                                            else{
                                                $url = '';
                                            }?>
                                            <li class="twp-feature-post">
                                                <div class="twp-image-section data-bg-lg">
                                                    <a href="<?php the_permalink(); ?>" class="data-bg data-bg-lg d-block" data-background="<?php echo esc_url($url); ?>"></a>
                                                    <?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>
                                                </div>
                                                <div class="twp-categories twp-primary-categories">
                                                    <?php default_mag_post_categories(); ?>
                                                </div>
                                                <h3 class="twp-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                <div class="twp-author-desc">
                                                    <?php default_mag_post_author(); ?>
                                                    <?php default_mag_post_date(); ?>
                                                    <?php default_mag_get_comments_count(get_the_ID()); ?>
                                                </div>
                                                <?php 
                                                if (has_excerpt()) { ?>
                                                    <div class="twp-caption">
                                                        <?php the_excerpt(); ?>
                                                    </div>
                                                <?php } ?>
                                            </li>
                                        <?php $counter++; } else { ?>
                                                <li class="twp-recent-post twp-image-left">
                                                    <div class="twp-image-section data-bg-sm">
                                                        <a href="<?php the_permalink(); ?>" class="data-bg data-bg-sm d-block" data-background="<?php echo esc_url($url); ?>"></a>
                                                        <?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>
                                                    </div>
                                                    <div class="twp-desc">
                                                        <h3 class="twp-post-title twp-post-title-sm"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                        <div class="twp-author-desc twp-primary-color">
                                                            <?php default_mag_post_date(); ?>
                                                        </div>
                                                    </div>
                                                </li>
                                        <?php
                                        $counter++;
                                    }
                                        endwhile;
                                endif; 
                                wp_reset_postdata(); 
                                ?>
                            </ul>
                            
                        </div><!--col-->
                    <?php } ?>
                </div><!--/row-->
            </div><!--/container-->
        </div><!--/twp-news-main-section-->
        <?php
}  
endif;
add_action('default_mag_action_category_list_post', 'default_mag_footer_category_post', 10);
