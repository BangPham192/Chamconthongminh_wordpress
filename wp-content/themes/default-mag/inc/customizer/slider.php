<?php
/**
 * slider section
 *
 * @package Default Mag
 */

$default = default_mag_get_default_theme_options();
// Slider Main Section.
$wp_customize->add_section( 'main_banner_section_settings',
	array(
		'title'      => __( 'Main Banner Section', 'default-mag' ),
		'priority'   => 110,
		'capability' => 'edit_theme_options',
		'panel'      => 'homepage_option_panel',
	)
);

// Setting - show_main_banner_section.
$wp_customize->add_setting( 'show_main_banner_section',
	array(
		'default'           => $default['show_main_banner_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_main_banner_section',
	array(
		'label'    => __( 'Enable Main Banner', 'default-mag' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting( 'default_mag_banner_exclusive_section',
	array(
		'default'           => $default['default_mag_banner_exclusive_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'default_mag_banner_exclusive_section',
	array(
		'label'    => __( 'Exclusive Section Title Text', 'default-mag' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting - drop down category for exclusive section.
$wp_customize->add_setting( 'select_category_for_exclusive_section',
	array(
		'default'           => $default['select_category_for_exclusive_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Default_Mag_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_exclusive_section',
	array(
        'label'           => __( 'Category for Exclusive Section', 'default-mag' ),
        'description'     => __( 'Select category to be shown on exclusive section on your banner ', 'default-mag' ),
        'section'         => 'main_banner_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 100,
    ) ) );

$wp_customize->add_setting( 'number_of_home_exclusive_section',
	array(
		'default'           => $default['number_of_home_exclusive_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_home_exclusive_section',
	array(
		'label'    => __( 'Select Post Number on Exclusive', 'default-mag' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'number',
		'priority' => 100,
		'input_attrs'     => array( 'min' => 1, 'max' => 10, 'style' => 'width: 150px;' ),

	)
);

$wp_customize->add_setting( 'default_mag_banner_slider_section',
	array(
		'default'           => $default['default_mag_banner_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'default_mag_banner_slider_section',
	array(
		'label'    => __( 'Slider Section Title Text', 'default-mag' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting - drop down category for exclusive section.
$wp_customize->add_setting( 'select_category_for_slider_section',
	array(
		'default'           => $default['select_category_for_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Default_Mag_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_slider_section',
	array(
        'label'           => __( 'Category for Slider Section', 'default-mag' ),
        'description'     => __( 'Select category to be shown on slider section on your banner ', 'default-mag' ),
        'section'         => 'main_banner_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 100,
    ) ) );


/*No of Slider*/
$wp_customize->add_setting( 'number_of_home_slider',
	array(
		'default'           => $default['number_of_home_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_home_slider',
	array(
		'label'    => __( 'Select Number of Post on Slider', 'default-mag' ),
        'description'     => __( 'Only 4 Post will be shown on slider and remaining will be listed below', 'default-mag' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'number',
		'input_attrs'     => array( 'min' => 1, 'max' => 12, 'style' => 'width: 150px;' ),
		'priority' => 100,
	)
);

/*content excerpt in Slider*/
$wp_customize->add_setting( 'number_of_content_home_slider',
	array(
		'default'           => $default['number_of_content_home_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_content_home_slider',
	array(
		'label'    => __( 'Select no words on Slider Section', 'default-mag' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'number',
		'priority' => 100,
		'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);
$wp_customize->add_setting( 'default_mag_recent_post_section',
	array(
		'default'           => $default['default_mag_recent_post_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'default_mag_recent_post_section',
	array(
		'label'    => __( 'Recent Post Section Title Text', 'default-mag' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_recent_post',
	array(
		'default'           => $default['select_category_for_recent_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Default_Mag_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_recent_post',
	array(
        'label'           => __( 'Category for Recent Post', 'default-mag' ),
        'description'     => __( 'Select category to be shown on recent post left of main slider ', 'default-mag' ),
        'section'         => 'main_banner_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 100,

    ) ) );


/*No of Slider*/
$wp_customize->add_setting( 'number_of_home_recent_post',
	array(
		'default'           => $default['number_of_home_recent_post'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'default_mag_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_home_recent_post',
	array(
		'label'    => __( 'Select Number of Post on Recent Post', 'default-mag' ),
        'description'     => __( 'Post will be shown on left of slider along with one featured post', 'default-mag' ),
		'section'  => 'main_banner_section_settings',
		'type'     => 'number',
		'input_attrs'     => array( 'min' => 1, 'max' => 10, 'style' => 'width: 150px;' ),
		'priority' => 100,
	)
);