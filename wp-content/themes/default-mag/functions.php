<?php
/**
 * Default Mag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Default_Mag
 */

if ( ! function_exists( 'default_mag_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function default_mag_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Default Mag, use a find and replace
		 * to change 'default-mag' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'default-mag', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-nav' => esc_html__( 'Primary Menu', 'default-mag' ),
			'social-nav' => esc_html__( 'Social Menu', 'default-mag' ),
			'footer-nav' => esc_html__( 'Footer Menu', 'default-mag' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		 /*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
		    'image',
		    'video',
		    'quote',
		    'gallery',
		    'audio',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'default_mag_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'default_mag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function default_mag_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'default_mag_content_width', 640 );
}
add_action( 'after_setup_theme', 'default_mag_content_width', 0 );


/**
 * function for google fonts
 */
if (!function_exists('default_mag_fonts_url')) :

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function default_mag_fonts_url()
    {

        $fonts_url = '';
        $fonts     = array();
        $default_mag_logo_font   = 'EB+Garamond:700,700i,800,800i';
        $default_mag_primary_font   = 'Merriweather:100,300,400,400i,500,700';
        $default_mag_secondary_font   = 'Source Sans Pro:100,300,400,400i,500,700';


        $default_mag_fonts   = array();
        $default_mag_fonts[] = $default_mag_logo_font;
        $default_mag_fonts[] = $default_mag_primary_font;
        $default_mag_fonts[] = $default_mag_secondary_font;

        $default_mag_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

        $i = 0;
        for ($i = 0; $i < count($default_mag_fonts); $i++) {

            if ('off' !== sprintf(_x('on', '%s font: on or off', 'default-mag'), $default_mag_fonts[$i])) {
                $fonts[] = $default_mag_fonts[$i];
            }

        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 */
function default_mag_scripts() {
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/css/bootstrap-grid.min.css');

	$fonts_url = default_mag_fonts_url();
	if (!empty($fonts_url)) {
	    wp_enqueue_style('default-mag-google-fonts', $fonts_url, array(), null);
	}
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/libraries/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('slick', get_template_directory_uri().'/assets/libraries/slick/css/slick.css');
	wp_enqueue_style('sidr', get_template_directory_uri().'/assets/libraries/sidr/css/jquery.sidr.css');
	wp_enqueue_style('magnific', get_template_directory_uri().'/assets/libraries/magnific/css/magnific-popup.css');

	wp_enqueue_style( 'default-mag-style', get_stylesheet_uri() );
	wp_add_inline_style( 'default-mag-style', default_mag_trigger_custom_css_action() );
	
	wp_enqueue_script( 'default-mag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script('jquery-bootstrap', get_template_directory_uri() . '/assets/libraries/bootstrap/js/bootstrap.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/js/slick.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-magnific', get_template_directory_uri() . '/assets/libraries/magnific/js/jquery.magnific-popup.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-sidr', get_template_directory_uri() . '/assets/libraries/sidr/js/jquery.sidr.min.js', array('jquery'), '', true);
	wp_enqueue_script('color-switcher', get_template_directory_uri() . '/assets/libraries/color-switcher/color-switcher.js', array('jquery'), '', true);
	wp_enqueue_script( 'default-mag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/assets/libraries/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
	wp_enqueue_script( 'default-mag-script', get_template_directory_uri() . '/assets/twp/js/twp-script.js', array(), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'default_mag_scripts' );


/**
 * Enqueue admin scripts and styles.
 */
function default_mag_admin_scripts( $hook ) {
	if ( 'widgets.php' === $hook ) {
	    wp_enqueue_media();
		wp_enqueue_script( 'default-mag-custom-widgets', get_template_directory_uri() . '/assets/twp/js/widgets.js', array( 'jquery' ), '1.0.0', true );
	}
	wp_enqueue_style( 'default-mag-custom-admin-style', get_template_directory_uri() . '/assets/twp/css/wp-admin.css', array(), '1.0.0' );

}
add_action( 'admin_enqueue_scripts', 'default_mag_admin_scripts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * widget initilized.
 */
require get_template_directory() . '/inc/widgets/widgets.init.php';


/**
 * Tgmpa plugin activation.
 */
require get_template_directory().'/assets/libraries/TGM-Plugin/class-tgm-plugin-activation.php';

/**
 * widget initilized.
 */
require get_template_directory() . '/inc/hooks/main-banner.php';
require get_template_directory() . '/inc/hooks/banner-carousel.php';
require get_template_directory() . '/inc/hooks/related-post.php';
require get_template_directory() . '/inc/hooks/featured-cat.php';
require get_template_directory() . '/inc/hooks/fixed-ticker-news.php';
require get_template_directory() . '/inc/hooks/single-meta.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Returns word count of the sentences.
 *
 * @since default-mag 1.0.0
 */
if (!function_exists('default_mag_get_excerpt')):
    function default_mag_get_excerpt($length = 25, $default_mag_content = null, $post_id = 1) {
        $length          = absint($length);
        $source_content  = preg_replace('`\[[^\]]*\]`', '', $default_mag_content);
        $trimmed_content = wp_trim_words($source_content, $length, '...');
        return $trimmed_content;
    }
endif;