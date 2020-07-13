<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Default_Mag
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function default_mag_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.

    global $post;
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    $global_layout = default_mag_get_option( 'global_layout' );

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

    if ( $post && is_singular() ) {
        $post_options = get_post_meta( $post->ID, 'default-mag-meta-select-layout', true );

        if (empty( $post_options ) ) {
            $global_layout = esc_attr( default_mag_get_option('global_layout') );
        } else{
            $global_layout = esc_attr($post_options);
        }
    }

    if ($global_layout == 'left-sidebar') {
        $classes[]= 'left-sidebar';
    }
    elseif ($global_layout == 'no-sidebar') {
        $classes[]= 'no-sidebar';
    }
    else{
        $classes[]= 'right-sidebar';

    }
	return $classes;
}
add_filter( 'body_class', 'default_mag_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function default_mag_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'default_mag_pingback_header' );

if ( ! function_exists( 'default_mag_archive_title' ) ) :
    function default_mag_archive_title( $title ) {
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            $title = single_term_title( '', false );
        }

        return $title;
    }
endif;
add_filter( 'get_the_archive_title', 'default_mag_archive_title' );

/* Display Breadcrumbs */
if (!function_exists('default_mag_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function default_mag_get_breadcrumb()
    {
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }
        $breadcrumb_type = default_mag_get_option( 'breadcrumb_type' );
        if ( 'disabled' === $breadcrumb_type ) {
            return;
        }

        if (!function_exists('breadcrumb_trail')) {

            /**
             * Load libraries.
             */

            require_once get_template_directory() . '/assets/libraries/breadcrumb-trail/breadcrumb-trail.php';
        }

        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        ); ?>


        <div class="twp-breadcrumbs">
            <div class="container">
                <?php breadcrumb_trail($breadcrumb_args); ?>
            </div>
        </div>


    <?php }

endif;
add_action('default_mag_action_get_breadcrumb', 'default_mag_get_breadcrumb');


if( ! function_exists( 'default_mag_excerpt_length' ) ) :

    /**
     * Excerpt length
     *
     * @since  default-mag 1.0.0
     *
     * @param null
     * @return int
     */
    function default_mag_excerpt_length( $length ){
        if ( is_admin() ) {
                return $length;
        }
        $excerpt_length = default_mag_get_option('excerpt_length_global');
        if ( empty( $excerpt_length) ) {
            $excerpt_length = $length;
        }
        return absint( $excerpt_length );

    }

endif;
add_filter( 'excerpt_length', 'default_mag_excerpt_length', 999 );


if ( ! function_exists( 'default_mag_custom_posts_navigation' ) ) :
    /**
     * Posts navigation.
     *
     * @since 1.0.0
     */
    function default_mag_custom_posts_navigation() {

        $pagination_type = default_mag_get_option( 'pagination_type' );

        switch ( $pagination_type ) {

            case 'default':
                echo '<div class="twp-pagination twp-w-100 twp-pagination-text">';
                    the_posts_navigation();
                echo '</div>';
            break;

            case 'numeric':
                echo '<div class="twp-pagination twp-w-100 twp-pagination-numeric">';
                    the_posts_pagination(array(
                            'mid_size' => 4,
                            'prev_text' => __('Previous', 'default-mag'),
                            'next_text' => __('Next', 'default-mag'),
                        ));
                echo '</div>';
            break;

            default:
            break;
        }

    }
endif;

add_action( 'default_mag_action_posts_navigation', 'default_mag_custom_posts_navigation' );

/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package default mag
 */

if (!function_exists('default_mag_trigger_custom_css_action')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
function default_mag_trigger_custom_css_action()
{
    $default_mag_site_title_identity_color = default_mag_get_option('site_title_identity_color');
    $background_color = get_background_color();
    ?>
        <style type="text/css">
        <?php
        if (!empty($default_mag_site_title_identity_color) ){
            ?>
            .twp-logo a,.twp-logo p, .twp-logo a:visited{
                color: <?php echo esc_html($default_mag_site_title_identity_color); ?>;
            }
        <?php  } ?>
            body .boxed-layout {
                background: #<?php echo esc_html($background_color)?>;
            }
        </style>
<?php }
endif;

if( ! function_exists( 'default_mag_recommended_plugins' ) ) :

  /**
   * Recommended plugins
   *
   */
  function default_mag_recommended_plugins(){
      $default_mag_plugins = array(
        array(
            'name'     => __('Social Share With Floating Bar', 'default-mag'),
            'slug'     => 'social-share-with-floating-bar',
            'required' => false,
        ),
        array(
          'name'     => __('One Click Demo Import', 'default-mag'),
          'slug'     => 'one-click-demo-import',
          'required' => false,
        ),
      );
      $default_mag_plugins_config = array(
          'dismissable' => true,
      );
      
      tgmpa( $default_mag_plugins, $default_mag_plugins_config );
  }
endif;
add_action( 'tgmpa_register', 'default_mag_recommended_plugins' );


  /*Disable PT branding.*/
  add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
  function default_mag_check_other_plugin() {
            function ocdi_after_import_setup() {
              // Assign menus to their locations.
              $main_menu   = get_term_by('name', 'Primary Menu', 'nav_menu');
              $footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');
              $social_menu = get_term_by('name', 'Social Menu', 'nav_menu');

              set_theme_mod('nav_menu_locations', array(
                      'primary-nav' => $main_menu->term_id,
                      'footer-nav'  => $footer_menu->term_id,
                      'social-nav'  => $social_menu->term_id,
                  )
              );

          }
        add_action('pt-ocdi/after_import', 'ocdi_after_import_setup');
  }
  add_action('admin_init', 'default_mag_check_other_plugin');
