<?php
/**
 * Theme widgets.
 *
 * @package Default Mag
 */

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';

if (!function_exists('default_mag_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function default_mag_load_widgets()
    {
        // Recent Post widget.
        register_widget('TWP_sidebar_widget');

        // Author widget.
        register_widget('TWP_Author_Post_widget');

        // Social widget.
        register_widget('TWP_Social_widget');

        //tab widget.
        register_widget('TWP_Tabbed_Widget');

        // Fullwidth homepage Post widget without add section.
        register_widget('TWP_Homepage_widget_style_1');

        // Fullwidth homepage Post widget with add section.
        register_widget('TWP_Homepage_widget_style_2');

    }
endif;
add_action('widgets_init', 'default_mag_load_widgets');

/*Recent Post widget*/
if (!class_exists('TWP_sidebar_widget')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class TWP_sidebar_widget extends Default_Mag_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'default_mag_popular_post_widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'default-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'default-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'default-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'default-mag'),
                ),
                'enable_counter' => array(
                    'label' => __('Enable Counter:', 'default-mag'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'default-mag'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 6,
                ),
            );

            parent::__construct('default-mag-popular-sidebar-layout', __('DM :- Recent Post', 'default-mag'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            echo '<div class="container">';
                if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                }

                $qargs = array(
                    'posts_per_page' => esc_attr($params['post_number']),
                    'no_found_rows' => true,
                );
                if (absint($params['post_category']) > 0) {
                    $qargs['category'] = absint($params['post_category']);
                }
                $all_posts = get_posts($qargs);
                ?>
                <?php global $post; 
                $count = 1;
                ?>
                <?php if (!empty($all_posts)) : ?>
                
                    <div class="twp-recent-widget-section">                
                        <ul class="twp-recent-widget-list">
                        <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                                <li class="twp-recent-widget">
                                    <div class="twp-image-section">
                                        <?php if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'default-mag-900-600' );
                                            $url = $thumb['0'];
                                            } else {
                                                $url = '';
                                        }
                                        ?>
                                        <a  href="<?php the_permalink(); ?>" class="data-bg data-bg-sm  bg-image">
                                            <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                            <?php if (true === $params['enable_counter']) { ?>
                                                <span class="twp-unit twp-secondary-bg-opacity"> <?php echo $count; ?></span>
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="twp-description">
                                        <div class="twp-meta-style-1  twp-author-desc twp-primary-text">
                                            <?php default_mag_post_date(); ?>
                                        </div>
                                        <h3 class="twp-widget-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                </li>
                            <?php 
                                $count++;
                                endforeach;
                            ?>
                        </ul>
                    </div>
                <?php wp_reset_postdata(); ?>
            </div>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Author widget*/
if (!class_exists('TWP_Author_Post_widget')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class TWP_Author_Post_widget extends Default_Mag_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'default_mag_author_widget',
                'description' => __('Displays authors details in post.', 'default-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'default-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label' => __('Name:', 'default-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'default-mag'),
                    'type'  => 'textarea',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => __('Author Image:', 'default-mag'),
                    'type'  => 'image',
                ),
                'url-fb' => array(
                   'label' => __('Facebook URL:', 'default-mag'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => __('Twitter URL:', 'default-mag'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-lt' => array(
                   'label' => __('Linkedin URL:', 'default-mag'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-ig' => array(
                   'label' => __('Instagram URL:', 'default-mag'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );

            parent::__construct('default-mag-author-layout', __('DM :- Author Widget', 'default-mag'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            echo '<div class="container"><div class="twp-author-wrapper">';
            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>

                <div class="twp-author-info">
                   
                        <?php if ( ! empty( $params['image_url'] ) ) { ?>
                            <div class="twp-image-section  bg-image data-bg-md">
                                <img src="<?php echo esc_url( $params['image_url'] ); ?>">
                            </div>
                        <?php } ?>
                    <div class="twp-description">
                        <?php if ( ! empty( $params['author-name'] ) ) { ?>
                            <h3 class="twp-widget-title twp-widget-title-md twp-text-center"><?php echo esc_html($params['author-name'] );?></h3>
                        <?php } ?>
                        <?php if ( ! empty( $params['description'] ) ) { ?>
                            <div class="twp-author-bio"><p><?php echo wp_kses_post( $params['description']); ?></p></div>
                        <?php } ?>
                    </div>
                    <div class="twp-social">
                        <?php if ( ! empty( $params['url-fb'] ) ) { ?>
                            <span class="twp-social-icon-rounded twp-secondary-border"><a href="<?php echo esc_url($params['url-fb']); ?>"><i class="fa fa-facebook"></i></a></span></span>
                        <?php } ?>
                        <?php if ( ! empty( $params['url-tw'] ) ) { ?>
                            <span class="twp-social-icon-rounded twp-secondary-border"><a href="<?php echo esc_url($params['url-tw']); ?>"><i class=" fa fa-twitter"></i></a></span>
                        <?php } ?>
                        <?php if ( ! empty( $params['url-lt'] ) ) { ?>
                            <span class="twp-social-icon-rounded twp-secondary-border"><a href="<?php echo esc_url($params['url-lt']); ?>"><i class=" fa fa-linkedin"></i></a></span>
                        <?php } ?>
                        <?php if ( ! empty( $params['url-ig'] ) ) { ?>
                            <span class="twp-social-icon-rounded twp-secondary-border"><a href="<?php echo esc_url($params['url-ig']); ?>"><i class=" fa fa-instagram"></i></a></span>
                        <?php } ?>
                    </div>
                </div>
            </div></div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Social widget*/
if (!class_exists('TWP_Social_widget')) :

    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class TWP_Social_widget extends Default_Mag_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'default_mag_social_widget',
                'description' => __('Displays Social share.', 'default-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'default-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('default-mag-social-layout', __('DM :- Social Widget', 'default-mag'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            echo '<div class="container">';
            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            } ?>
            
                <div class="twp-social-widget">
                    <div class="social-widget-menu">
                    <?php
                        wp_nav_menu(
                            array('theme_location' => 'social-nav',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                                'menu_id' => 'social-menu',
                                'fallback_cb' => false,
                                'menu_class' => 'twp-social-icons twp-widget-social-icons-rounded twp-icon-primary'
                            )); ?>
                    </div>
                    <?php if ( ! has_nav_menu( 'social-nav' ) ) : ?>
                        <p>
                            <?php esc_html_e( 'Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'default-mag' ); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*tabed widget*/
if (!class_exists('TWP_Tabbed_Widget')):

    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class TWP_Tabbed_Widget extends Default_Mag_Widget_Base {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct() {

            $opts = array(
                'classname'   => 'default_mag_widget_tabbed',
                'description' => __('Tabbed widget.', 'default-mag'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label'          => __('Popular Tab', 'default-mag'),
                    'type'           => 'heading',
                ),
                'popular_number' => array(
                    'label'         => __('No. of Posts:', 'default-mag'),
                    'type'          => 'number',
                    'css'           => 'max-width:60px;',
                    'default'       => 5,
                    'min'           => 1,
                    'max'           => 6,
                ),
                'enable_discription' => array(
                    'label'             => __('Enable Description:', 'default-mag'),
                    'type'              => 'checkbox',
                    'default'           => false,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size Featured Post:', 'default-mag'),
                    'type' => 'select',
                    'default' => 'medium',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'default-mag' ),
                        'medium' => esc_html__( 'Medium', 'default-mag' ),
                        'large' => esc_html__( 'Large', 'default-mag' ),
                        'full' => esc_html__( 'Full', 'default-mag' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label'         => __('Excerpt Length:', 'default-mag'),
                    'description'   => __('Number of words', 'default-mag'),
                    'default'       => 10,
                    'css'           => 'max-width:60px;',
                    'min'           => 0,
                    'max'           => 200,
                ),
                'recent_heading' => array(
                    'label'         => __('Recent Tab', 'default-mag'),
                    'type'          => 'heading',
                ),
                'recent_number' => array(
                    'label'        => __('No. of Posts:', 'default-mag'),
                    'type'         => 'number',
                    'css'          => 'max-width:60px;',
                    'default'      => 5,
                    'min'          => 1,
                    'max'          => 6,
                ),
                'comments_heading' => array(
                    'label'           => __('More Commented', 'default-mag'),
                    'type'            => 'heading',
                ),
                'comments_number' => array(
                    'label'          => __('No. of Comments:', 'default-mag'),
                    'type'           => 'number',
                    'css'            => 'max-width:60px;',
                    'default'        => 5,
                    'min'            => 1,
                    'max'            => 6,
                ),
            );

            parent::__construct('default-mag-tabbed', __('DM :- Tab Widgets', 'default-mag'), $opts, array(), $fields);

        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance) {

            $params = $this->get_params($instance);
            $tab_id = 'tabbed-'.$this->number;

            echo $args['before_widget'];
            ?>
            <div class="container">
                <div class="twp-tabbed-section">
                    <div class="section-head">
                        <ul class="nav nav-tabs twp-tab" role="tablist">
                            <li role="presentation" class="tab tab-popular">
                                <a href="#<?php echo esc_attr($tab_id);?>-popular" class="active" 4aria-controls="<?php esc_html_e('Popular', 'default-mag');?>" role="tab" data-toggle="tab">
                                    <span class="fire-icon tab-icon"> 
                                        <i class="fa fa-fire"></i>
                                    </span>
                                    <?php esc_html_e('Popular', 'default-mag');?>
                                </a>
                            </li>
                            <li class="tab tab-recent">
                                <a href="#<?php echo esc_attr($tab_id);?>-recent" aria-controls="<?php esc_html_e('Recent', 'default-mag');?>" role="tab" data-toggle="tab">
                                    <span class="flash-icon tab-icon">
                                        <i class="fa fa-bolt"></i>
                                    </span>
                                    <?php esc_html_e('Recent', 'default-mag');?>
                                </a>
                            </li>
                            <li class="tab tab-comments">
                                <a href="#<?php echo esc_attr($tab_id);?>-comments" aria-controls="<?php esc_html_e('Comments', 'default-mag');?>" role="tab" data-toggle="tab">
                                    <span class="comment-icon tab-icon">
                                       <i class="fa fa-comments"></i>
                                    </span>
                                    <?php esc_html_e('Comments', 'default-mag');?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="twp-tab-content">
                        <div id="<?php echo esc_attr($tab_id);?>-popular" role="tabpanel" class="tab-pane active">
                            <?php $this->render_news('popular', $params);?>
                        </div>
                        <div id="<?php echo esc_attr($tab_id);?>-recent" role="tabpanel" class="tab-pane">
                            <?php $this->render_news('recent', $params);?>
                        </div>
                        <div id="<?php echo esc_attr($tab_id);?>-comments" role="tabpanel" class="tab-pane">
                            <?php $this->render_comments($params);?>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            echo $args['after_widget'];

        }

        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params) {

            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }

            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows'  => true,
                        'orderby'        => 'comment_count',
                    );
                    break;

                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows'  => true,
                    );
                    break;

                default:
                    break;
            }

            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)):?>
                <?php global $post;
                ?>
                <ul class="twp-recent-widget-list">
                    <?php foreach ($all_posts as $key => $post):?>
                        <?php setup_postdata($post);?>
                        <li class="twp-recent-widget">
                            <div class="twp-image-section">
                                <a href="<?php the_permalink();?>" class="data-bg data-bg-sm bg-image">
                                    <?php if (has_post_thumbnail($post->ID)){?>
                                        <?php
                                        $select_image_size = esc_attr($params['select_image_size']);
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $select_image_size);?>
                                        <?php if (!empty($image)):?>
                                            <img src="<?php echo esc_url($image[0]);?>"/>
                                        <?php endif;?>
                                    <?php  } ?>
                                </a>
                            </div>

                            <div class="twp-description">
                                <div class="twp-d-flex">
                                    <div class=" twp-author-desc twp-primary-color">
                                        <?php default_mag_post_date(); ?>
                                    </div>
                                </div>
                                <h3 class="twp-widget-title">
                                    <a href="<?php the_permalink();?>">
                                        <?php the_title();?>
                                    </a>
                                </h3>
                            </div>
                            <?php if (true === $params['enable_discription']) {?>
                                <?php if (absint($params['excerpt_length']) > 0):?>
                                    <div class="twp-post-description">
                                        <?php
                                        $excerpt = get_the_excerpt();
                                        echo wp_kses_post(wpautop($excerpt));
                                        ?>
                                    </div>
                                <?php endif;?>
                            <?php }?>
                        </li>
                    <?php endforeach;?>
                </ul><!-- .news-list -->

                <?php wp_reset_postdata();?>

            <?php endif;?>

            <?php

        }

        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params) {

            $comment_args = array(
                'number'      => $params['comments_number'],
                'status'      => 'approve',
                'post_status' => 'publish',
            );

            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)):?>
                <ul class="twp-recent-widget-list">
                    <?php foreach ($comments as $key => $comment):?>
                        <li class="twp-recent-widget">
                            <figure class="twp-image-section">
                                <?php $comment_author_url = get_comment_author_url($comment);?>
                                <?php if (!empty($comment_author_url)):?>
                                    <a class="data-bg data-bg-sm bg-image" href="<?php echo esc_url($comment_author_url);?>"><?php echo get_avatar($comment, 65);
                                        ?></a>
                                <?php  else :?>
                                    <?php echo get_avatar($comment, 65);?>
                                <?php endif;?>
                            </figure>
                            <div class="twp-description">
                                <?php echo get_comment_author_link($comment);?>
                                &nbsp;
                                <?php echo esc_html_x('on', 'Tabbed Widget', 'default-mag');
                                ?>&nbsp;
                                <div class="twp-articles-title">
                                    <h3 class="twp-widget-title">
                                        <a href="<?php echo esc_url(get_comment_link($comment));?>">
                                        <?php echo get_the_title($comment->comment_post_ID);?>
                                    </a>
                                    </h3>
                                </div>
                               
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul><!-- .comments-list -->
            <?php endif;?>
            <?php
        }

    }
endif;

/*Homepage widget style 1*/
if (!class_exists('TWP_Homepage_widget_style_1')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class TWP_Homepage_widget_style_1 extends Default_Mag_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'default_mag_fullwidth_post_widget_style_1',
                'description' => __('Build for homepage widget area, displays post form selected category with list and full single image.', 'default-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'default-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'default-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'default-mag'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'default-mag'),
                    'type' => 'number',
                    'default' => 6,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 9,
                ),
                'enable_post_meta' => array(
                    'label' => __('Enable Post Meta:', 'default-mag'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
            );

            parent::__construct('default-mag-fullwidth-widget-style-1', __('DM :- Full-Width Homepage Widget Style-1', 'default-mag'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            if (absint($params['post_category']) > 0) {
                $cat_link =esc_url(get_category_link( $params['post_category'] ));
            } else {
                $cat_link ='';
            }
            echo "<div class='container'>";
            if (!empty($params['title'])) {
                echo $args['before_title'] .'<a href="'.$cat_link.'">' .$params['title'] .'</a>' .$args['after_title'];
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php global $post; 
            $count = 1;
            ?>
            <?php if (!empty($all_posts)) : ?>
                <div class="twp-home-page-widget-style-1-section">
                    <div class="twp-d-flex">                
                        <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                            <?php if ($count == 1) { ?>
                                <?php if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'default-mag-900-600' );
                                    $url = $thumb['0'];
                                    } else {
                                        $url = '';
                                }
                                ?>
                                <div class=" twp-full-post data-bg" data-background="<?php echo esc_url($url); ?>">
                                    <a href="<?php the_permalink(); ?>"></a>
                                    <div class="twp-wrapper twp-overlay twp-overlay-bg-black twp-w-100">
                                        <div class="twp-description">
                                            <div class="twp-categories twp-categories-with-bg">
                                                <?php default_mag_post_categories(); ?>
                                            </div>
                                            <h3 class="twp-post-title"><a class="twp-white-anchor-text" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <div class="twp-author-desc">
                                                <?php default_mag_post_author(); ?>
                                                <?php default_mag_post_date(); ?>
                                                <?php default_mag_get_comments_count(get_the_ID()); ?>
                                            </div>
                                            <?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <?php if ($count <= 2) {
                                    echo '<div class="twp-widget-post-list-section"><ul class="twp-post-with-categories-list">';
                                } ?>

                                <li class="twp-post-with-categories">
                                    <div class="twp-image-section data-bg-sm">
                                        <?php if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'default-mag-900-600' );
                                            $url = $thumb['0'];
                                            } else {
                                                $url = '';
                                        }
                                        ?>
                                        <a  href="<?php the_permalink(); ?>" class="data-bg data-bg-sm  bg-image">
                                            <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                        </a>
                                        <?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>
                                    </div>
                                    <div class="twp-description">
                                        <?php if (true === $params['enable_post_meta']) { ?>
                                            <div class="twp-row">
                                                 <div class="twp-categories twp-secondary-categories twp-col-gap">
                                                    <?php default_mag_post_categories(); ?>
                                                </div>
                                                <div class=" twp-author-desc twp-primary-color twp-col-gap">
                                                    <?php default_mag_post_date(); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <h3 class="twp-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                </li>
                                <?php if( $key == ( count( $all_posts ) - 1 ) ){
                                    echo '</ul></div>';
                                }?>
                            <?php } ?>
                            <?php 
                                $count++;
                                endforeach;
                            ?>
                        </div>
                </div>

            <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Homepage widget style 2*/
if (!class_exists('TWP_Homepage_widget_style_2')) :

    /**
     * Style 2 widget Class.
     *
     * @since 1.0.0
     */
    class TWP_Homepage_widget_style_2 extends Default_Mag_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'default_mag_fullwidth_post_widget_style_2',
                'description' => __('Build for homepage widget area, displays post form selected category with list as well as add uploader', 'default-mag'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'default-mag'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'default-mag'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'default-mag'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'default-mag'),
                    'type' => 'number',
                    'default' => 6,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 9,
                ),
                'enable_post_meta' => array(
                    'label' => __('Enable Post Meta:', 'default-mag'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'image_url_add' => array(
                    'label' => __('Advertisement Image:', 'default-mag'),
                    'type'  => 'image',
                ),
                'add_url' => array(
                   'label' => __('Advertisement URL:', 'default-mag'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );

            parent::__construct('default-mag-fullwidth-widget-style-2', __('DM 2 :- Full-Width Homepage Widget Style 2', 'default-mag'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];


            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }            
            if (absint($params['post_category']) > 0) {
                $cat_link =esc_url(get_category_link( $params['post_category'] ));
            } else {
                $cat_link ='';
            }
            echo "<div class='container'>";
                if (!empty($params['title'])) {
                    echo $args['before_title'] .'<a href="'.$cat_link.'">' .$params['title'] .'</a>' .$args['after_title'];
                }
                $all_posts = get_posts($qargs);
                ?>
                <?php global $post; 
                $count = 1;
                ?>
                <?php if (!empty($all_posts)) : ?>
                <div class="twp-home-page-widget-style-1-section">
                    <div class="twp-row">                
                        <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                            <?php if ($count <= 2) { ?>
                                <?php if ($count == 1) {
                                    echo '<div class="twp-col-3"><div class="twp-feature-post-list">';
                                } ?>
                                <?php if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'default-mag-900-600' );
                                    $url = $thumb['0'];
                                    } else {
                                        $url = '';
                                }
                                ?>
                                <div class="twp-feature-post">
                                    <div class="twp-image-section data-bg-lg">
                                        <a href="<?php the_permalink(); ?>" class="data-bg data-bg-lg d-block" data-background="<?php echo esc_url($url); ?>"></a>
                                        <?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>
                                    </div>
                                    <div class="twp-categories twp-primary-categories">
                                        <?php default_mag_post_categories(); ?>
                                    </div>
                                    <h3 class="twp-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="twp-author-desc">
                                        <?php default_mag_post_date(); ?>
                                        <?php default_mag_get_comments_count(get_the_ID()); ?>
                                    </div>
                                </div>
                                <?php if ($count == 2) {
                                    echo '</div></div>';
                                } ?>
                            <?php } else { ?>
                                <?php if ($count <= 3) {
                                    echo '<div class="twp-col-5"><ul class="twp-post-with-categories-list">';
                                } ?>

                                <li class="twp-post-with-categories">
                                    <div class="twp-image-section data-bg-sm">
                                        <?php if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'default-mag-900-600' );
                                            $url = $thumb['0'];
                                            } else {
                                                $url = '';
                                        }
                                        ?>
                                        <a  href="<?php the_permalink(); ?>" class="data-bg data-bg-sm  bg-image">
                                            <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                        </a>
                                        <?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>

                                    </div>
                                    <div class="twp-description">
                                            <?php if (true === $params['enable_post_meta']) { ?>
                                            <div class="twp-d-flex">
                                                 <div class="twp-categories twp-secondary-categories">
                                                    <?php default_mag_post_categories(); ?>
                                                </div>
                                                <div class=" twp-author-desc twp-primary-color">
                                                    <?php default_mag_post_date(); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <h3 class="twp-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                </li>
                                <?php if( $key == ( count( $all_posts ) - 1 ) ){
                                    echo '</ul></div>';
                                }?>
                            <?php } ?>
                            <?php 
                                $count++;
                                endforeach;
                            ?>
                            <?php if ( ! empty( $params['image_url_add'] ) ) { ?>
                                <div class="twp-col-4 twp-ad-image-section">
                                    <a href="<?php echo esc_url($params['add_url']); ?>">
                                        <img src="<?php echo esc_url( $params['image_url_add'] ); ?>">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                </div>

                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

