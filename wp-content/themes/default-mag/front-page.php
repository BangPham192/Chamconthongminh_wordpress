<?php
/**
 * The template for displaying home page.
 * @package Default Mag
 */

get_header();?>
<?php if ( is_paged()) { ?>

<?php } else {
    /**
     * default_mag_main_banner hook
     * @since default-mag 1.0.0
     *
     * @hooked default_mag_main_banner -  10
     * @sub_hooked default_mag_main_banner -  10
     */
    do_action('default_mag_action_main_banner');

    /**
     * default_mag_carousel hook
     * @since default-mag 1.0.0
     *
     * @hooked default_mag_carousel -  10
     * @sub_hooked default_mag_carousel -  10
     */
    do_action('default_mag_action_carousel_post');

    /**
     * default_mag_footer_category_post hook
     * @since default-mag 1.0.0
     *
     * @hooked default_mag_footer_category_post -  10
     * @sub_hooked default_mag_footer_category_post -  10
     */
    do_action('default_mag_action_category_list_post');
    ?>

    <?php if (is_active_sidebar('fullwidth-homepage-sidebar')) { ?>
        <div class="twp-home-widget-section">
            <?php dynamic_sidebar('fullwidth-homepage-sidebar'); ?>
        </div>
    <?php }?>
<?php } ?>

        <?php if ('posts' == get_option('show_on_front')) { ?>
            <?php if (1 == default_mag_get_option('show_latest_post_content_on_homepage')) { ?>
            <div class="twp-home-page-latest-post">
                <div class="container clearfix">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <div class="twp-archive-post-list twp-row">
                                <?php
                                if ( have_posts() ) :

                                    if ( is_home() && ! is_front_page() ) :
                                        ?>
                                        <header>
                                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                                        </header>
                                        <?php
                                    endif;

                                    /* Start the Loop */
                                    while ( have_posts() ) :
                                        the_post();

                                        /*
                                        * Include the Post-Type-specific template for the content.
                                        * If you want to override this in a child theme, then include a file
                                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                        */
                                        get_template_part( 'template-parts/content', get_post_type() );

                                    endwhile;
                                    
                                    do_action('default_mag_action_posts_navigation');

                                else :

                                    get_template_part( 'template-parts/content', 'none' );

                                endif;
                                ?>
                            </div>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                    <?php get_sidebar();?>
                </div>
            </div>
            <?php } ?>
        <?php } else { ?>
            <?php if (1 == default_mag_get_option('show_selected_page_content_on_homepage')) { ?>
                <div class="twp-home-static-page" id="content-container">
                    <div class="container clearfix">
                        <div id="primary" class="content-area">
                            <?php
                            while (have_posts()) : the_post();
                                get_template_part('template-parts/content', 'page');

                            endwhile; // End of the loop.
                            ?>
                        </div><!-- #primary -->
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php } ?>
                
    <?php } ?>

<?php get_footer();