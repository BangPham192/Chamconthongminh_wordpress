<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function default_mag_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'default-mag' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'default-mag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Off Canvas Sidebar', 'default-mag' ),
		'id'            => 'off-canvas-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'default-mag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Full Width HomePage Widget-bar', 'default-mag' ),
		'id'            => 'fullwidth-homepage-sidebar',
		'description'   => esc_html__( 'Add widgets here. which will display on your homepage above the footer widget area', 'default-mag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	$default_mag_footer_widgets_number = default_mag_get_option('number_of_footer_widget');
	if( $default_mag_footer_widgets_number > 0 ){
	    register_sidebar(array(
	        'name' => __('Footer Column One', 'default-mag'),
	        'id' => 'footer-col-one',
	        'description' => __('Displays items on footer section.','default-mag'),
	        'before_widget' => '<div id="%1$s" class="widget %2$s">',
	        'after_widget' => '</div>',
	        'before_title'  => '<h3 class="widget-title">',
	        'after_title'   => '</h3>',
	    ));
	    if( $default_mag_footer_widgets_number > 1 ){
	        register_sidebar(array(
	            'name' => __('Footer Column Two', 'default-mag'),
	            'id' => 'footer-col-two',
	            'description' => __('Displays items on footer section.','default-mag'),
	            'before_widget' => '<div id="%1$s" class="widget %2$s">',
	            'after_widget' => '</div>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	        ));
	    }
	    if( $default_mag_footer_widgets_number > 2 ){
	        register_sidebar(array(
	            'name' => __('Footer Column Three', 'default-mag'),
	            'id' => 'footer-col-three',
	            'description' => __('Displays items on footer section.','default-mag'),
	            'before_widget' => '<div id="%1$s" class="widget %2$s">',
	            'after_widget' => '</div>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	        ));
	    }
	    if( $default_mag_footer_widgets_number > 3 ){
	        register_sidebar(array(
	            'name' => __('Footer Column Four', 'default-mag'),
	            'id' => 'footer-col-four',
	            'description' => __('Displays items on footer section.','default-mag'),
	            'before_widget' => '<div id="%1$s" class="widget %2$s">',
	            'after_widget' => '</div>',
	            'before_title'  => '<h3 class="widget-title">',
	            'after_title'   => '</h3>',
	        ));
	    }
	}
}
add_action( 'widgets_init', 'default_mag_widgets_init' );

require get_template_directory() . '/inc/widgets/widget-base-class.php';
require get_template_directory() . '/inc/widgets/widgets.php';

