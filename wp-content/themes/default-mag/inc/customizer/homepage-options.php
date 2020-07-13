<?php
/**
 * carousel section
 *
 * @package Default Mag
 */

$default = default_mag_get_default_theme_options();

// Top bar Main Section.
$wp_customize->add_section( 'top_bar_section_settings',
	array(
		'title'      => __( 'Top Bar Section', 'default-mag' ),
		'priority'   => 90,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_top_bar_section.
$wp_customize->add_setting( 'show_top_bar_section',
	array(
		'default'           => $default['show_top_bar_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_bar_section',
	array(
		'label'    => __( 'Enable Top Bar', 'default-mag' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - show_top_tag_section.
$wp_customize->add_setting( 'show_top_tag_section',
	array(
		'default'           => $default['show_top_tag_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_tag_section',
	array(
		'label'    => __( 'Enable Most Tags on Top Bar', 'default-mag' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
		'active_callback' => 'default_mag_top_bar_calback',
	)
);

$wp_customize->add_setting( 'most_tag_bar_title',
	array(
		'default'           => $default['most_tag_bar_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'most_tag_bar_title',
	array(
		'label'    => __( 'Tag Section Title', 'default-mag' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'text',
		'priority' => 100,
		'active_callback' => 'default_mag_top_bar_calback',
	)
);


// Setting - show_top_social_section.
$wp_customize->add_setting( 'show_top_social_section',
	array(
		'default'           => $default['show_top_social_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_social_section',
	array(
		'label'    => __( 'Enable Social Menu on Top Bar', 'default-mag' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
		'active_callback' => 'default_mag_top_bar_calback',
	)
);

// Setting - show_top_date_section.
$wp_customize->add_setting( 'show_top_date_section',
	array(
		'default'           => $default['show_top_date_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_date_section',
	array(
		'label'    => __( 'Enable Date on Top Bar', 'default-mag' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
		'active_callback' => 'default_mag_top_bar_calback',
	)
);


// Main Header Section.
$wp_customize->add_section( 'main_header_section_settings',
	array(
		'title'      => __( 'Header Section', 'default-mag' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_addvertisement_section.
$wp_customize->add_setting( 'show_addvertisement_section',
	array(
		'default'           => $default['show_addvertisement_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_addvertisement_section',
	array(
		'label'    => __( 'Enable Header Advertisement', 'default-mag' ),
		'section'  => 'main_header_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting top_section_advertisement.
$wp_customize->add_setting('top_section_advertisement',
	array(
		'default'           => $default['top_section_advertisement'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control($wp_customize, 'top_section_advertisement',
		array(
			'label'       => esc_html__('Top Section Advertisement', 'default-mag'),
			'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'default-mag'), 728, 90),
			'section'     => 'main_header_section_settings',
			'priority'    => 120,
			'active_callback' => 'default_mag_addvertisement_section_callback',
		)
	)
);

/*top_section_advertisement_url*/
$wp_customize->add_setting('top_section_advertisement_url',
	array(
		'default'           => $default['top_section_advertisement_url'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control('top_section_advertisement_url',
	array(
		'label'    => esc_html__('URL Link', 'default-mag'),
		'section'  => 'main_header_section_settings',
		'type'     => 'text',
		'priority' => 130,
		'active_callback' => 'default_mag_addvertisement_section_callback',
	)
);

// Setting - show_offcanvas_collaps.
$wp_customize->add_setting('show_offcanvas_collaps',
	array(
		'default'           => $default['show_offcanvas_collaps'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control('show_offcanvas_collaps',
	array(
		'label'       => esc_html__('Enable Off Canvas collapse', 'default-mag'),
		'section'     => 'main_header_section_settings',
		'type'        => 'checkbox',
		'priority'    => 140,
	)
);

// Setting - show_trending_on_nav.
$wp_customize->add_setting('show_trending_on_nav',
	array(
		'default'           => $default['show_trending_on_nav'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control('show_trending_on_nav',
	array(
		'label'       => esc_html__('Enable Trending Now On Menu', 'default-mag'),
		'section'     => 'main_header_section_settings',
		'type'        => 'checkbox',
		'priority'    => 140,
	)
);

$wp_customize->add_setting( 'trending_section_title',
	array(
		'default'           => $default['trending_section_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'trending_section_title',
	array(
		'label'    => __( 'Trending Section Title', 'default-mag' ),
		'section'  => 'main_header_section_settings',
		'type'     => 'text',
		'priority' => 150,
	)
);


// Setting - drop down category for carousel.
$wp_customize->add_setting( 'select_category_for_trending_section',
	array(
		'default'           => $default['select_category_for_trending_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Default_Mag_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_trending_section',
	array(
        'label'           => __( 'Category for Trending Section', 'default-mag' ),
        'description'     => __( 'Select category to be shown on trending section on click', 'default-mag' ),
        'section'         => 'main_header_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 150,

    ) ) );

// Setting - show_search_icon_on_nav.
$wp_customize->add_setting('show_search_icon_on_nav',
	array(
		'default'           => $default['show_search_icon_on_nav'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control('show_search_icon_on_nav',
	array(
		'label'       => esc_html__('Enable Search Icon On Menu', 'default-mag'),
		'section'     => 'main_header_section_settings',
		'type'        => 'checkbox',
		'priority'    => 150,
	)
);

// Carousel Main Section.
$wp_customize->add_section( 'carousel_section_settings',
	array(
		'title'      => __( 'Blog/News Carousel Section', 'default-mag' ),
		'priority'   => 110,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_carousel_section.
$wp_customize->add_setting( 'show_carousel_section',
	array(
		'default'           => $default['show_carousel_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_carousel_section',
	array(
		'label'    => __( 'Enable Carousel', 'default-mag' ),
		'section'  => 'carousel_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting( 'heading_text_on_carousel',
	array(
		'default'           => $default['heading_text_on_carousel'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'heading_text_on_carousel',
	array(
		'label'    => __( 'Section Title Text', 'default-mag' ),
		'section'  => 'carousel_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);

/*No of Carousel*/
$wp_customize->add_setting( 'number_of_home_carousel',
	array(
		'default'           => $default['number_of_home_carousel'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_home_carousel',
	array(
		'label'    => __( 'Select no of carousel', 'default-mag' ),
		'section'  => 'carousel_section_settings',
		'input_attrs'     => array( 'min' => 1, 'max' => 12, 'style' => 'width: 150px;' ),

		'type'     => 'number',
		'priority' => 105,
	)
);


// Setting - drop down category for carousel.
$wp_customize->add_setting( 'select_category_for_carousel',
	array(
		'default'           => $default['select_category_for_carousel'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Default_Mag_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_carousel',
	array(
        'label'           => __( 'Category for carousel', 'default-mag' ),
        'description'     => __( 'Select category to be shown on Carousel bellow slider ', 'default-mag' ),
        'section'         => 'carousel_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,

    ) ) );



// Featured Blog Main Section.
$wp_customize->add_section( 'featured_category_section_settings',
	array(
		'title'      => __( 'Blog/News Featured Category Section', 'default-mag' ),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_featured_category_section.
$wp_customize->add_setting( 'show_featured_category_section',
	array(
		'default'           => $default['show_featured_category_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_featured_category_section',
	array(
		'label'    => __( 'Enable Featured Category', 'default-mag' ),
		'section'  => 'featured_category_section_settings',
		'type'     => 'checkbox',
		'priority' => 110,
	)
);


// Setting - drop down category for featured_blog.
for ( $i=1; $i <=  3 ; $i++ ) {
	$wp_customize->add_setting( 'select_category_for_featured_category_'. $i,
		array(
			'default'           => $default['select_category_for_featured_category'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control( new Default_Mag_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_featured_category_'. $i,
		array(
	        'label'           => __( 'Category for Featured Category -', 'default-mag' ). $i,
	        'section'         => 'featured_category_section_settings',
	        'type'            => 'dropdown-taxonomies',
	        'taxonomy'        => 'category',
			'priority'    	  => 130,

	    ) ) );
}


$wp_customize->add_setting( 'number_of_post_featured_category',
	array(
		'default'           => $default['number_of_post_featured_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_post_featured_category',
	array(
		'label'    => __( 'Number of Post on Single Category column', 'default-mag' ),
		'section'  => 'featured_category_section_settings',
		'input_attrs'     => array( 'min' => 1, 'max' => 12, 'style' => 'width: 150px;' ),

		'type'     => 'number',
		'priority' => 130,
	)
);


// News featured fix post Section.
$wp_customize->add_section('breaking_pined_post_section_settings',
    array(
        'title' => esc_html__('Fixed Scrolling Post Section Options', 'default-mag'),
        'priority' => 130,
        'capability' => 'edit_theme_options',
        'panel' => 'homepage_option_panel',
    )
);
// Setting - show_ticker_pinned_post_section.
$wp_customize->add_setting('show_ticker_pinned_post_section',
    array(
        'default' => $default['show_ticker_pinned_post_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'default_mag_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_ticker_pinned_post_section',
    array(
        'label' => esc_html__('Enable Ticker Pin Post Section', 'default-mag'),
        'section' => 'breaking_pined_post_section_settings',
        'type' => 'checkbox',
        'priority' => 100,
    )
);


/*No of Slider*/
$wp_customize->add_setting('ticker_pinned_post_title',
	array(
		'default'           => $default['ticker_pinned_post_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('ticker_pinned_post_title',
	array(
		'label'       => esc_html__('Ticker Pin Post Section Title', 'default-mag'),
		'section'     => 'breaking_pined_post_section_settings',
		'type'        => 'text',
		'priority'    => 110,
	)
);

$wp_customize->add_setting('select_category_for_ticker_pinned_section',
	array(
		'default'           => $default['select_category_for_ticker_pinned_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(new Default_Mag_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_ticker_pinned_section',
		array(
			'label'           => esc_html__('Category for Ticekr Pin Post (Leave empty for recent post)', 'default-mag'),
        	'description'     => esc_html__( 'Set this to empty if you want recent post on this section', 'default-mag' ),
			'section'         => 'breaking_pined_post_section_settings',
			'type'            => 'dropdown-taxonomies',
			'taxonomy'        => 'category',
			'priority'        => 130,

		)));

$wp_customize->add_setting( 'number_of_ticker_post',
	array(
		'default'           => $default['number_of_ticker_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_ticker_post',
	array(
		'label'    => __( 'Select Number of Post to display', 'default-mag' ),
		'section'  => 'breaking_pined_post_section_settings',
		'type'     => 'number',
		'input_attrs'     => array( 'min' => 1, 'max' => 10, 'style' => 'width: 150px;' ),
		'priority' => 130,
	)
);