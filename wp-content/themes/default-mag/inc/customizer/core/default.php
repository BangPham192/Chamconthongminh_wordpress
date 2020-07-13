<?php
/**
 * Default theme options.
 *
 * @package Default Mag
 */

if ( ! function_exists( 'default_mag_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function default_mag_get_default_theme_options() {

		$defaults = array();

		//header top bar
		$defaults['site_title_identity_color']		= '#000';
		$defaults['show_selected_page_content_on_homepage']		= 1;
		$defaults['show_latest_post_content_on_homepage']		= 1;
		$defaults['show_top_bar_section']				        = 1;
		$defaults['show_top_tag_section']				        = 1;
		$defaults['most_tag_bar_title']				        	= esc_html__( 'Trending Tags', 'default-mag' );
		$defaults['show_top_social_section']				    = 1;
		$defaults['show_top_date_section']				    	= 1;
		
		//header top bar
		$defaults['show_addvertisement_section']				= 1;
		$defaults['top_section_advertisement']					= '';
		$defaults['top_section_advertisement_url']				= '#';
		$defaults['show_offcanvas_collaps']						= 1;
		$defaults['show_trending_on_nav']						= 1;
		$defaults['trending_section_title']				        = esc_html__( 'Trending Now', 'default-mag' );
		$defaults['select_category_for_trending_section']		= '';
		$defaults['show_search_icon_on_nav']					= 1;

		// carousel section options.
		$defaults['show_carousel_section']						= 1;
		$defaults['number_of_home_carousel']					= 12;
		$defaults['heading_text_on_carousel']					= esc_html__( 'Recent Post', 'default-mag' );
		$defaults['select_category_for_carousel']				= 0;

		// Slider options.
		$defaults['show_main_banner_section']				    = 1;
		$defaults['default_mag_banner_exclusive_section']		= esc_html__( 'Exclusive', 'default-mag' );
		$defaults['select_category_for_exclusive_section']		= '';
		$defaults['number_of_home_exclusive_section']			= 6;
		$defaults['default_mag_banner_slider_section']			= esc_html__( 'Main Stories', 'default-mag' );
		$defaults['select_category_for_slider_section']			= '';
		$defaults['number_of_home_slider']						= 8;
		$defaults['number_of_content_home_slider']				= 0;
		$defaults['default_mag_recent_post_section']			= esc_html__( 'Just In', 'default-mag' );
		$defaults['select_category_for_recent_post']			= '';
		$defaults['number_of_home_recent_post']					= 5;

		// footer you may have missed section
		$defaults['show_ticker_pinned_post_section']    		= 1;
        $defaults['ticker_pinned_post_title']                   = esc_html__('Breaking News', 'default-mag');
        $defaults['select_category_for_ticker_pinned_section']  = 0;
        $defaults['number_of_ticker_post']  					= 7;

		// Single post options.
		$defaults['enable_except_on_single_post'] 	= 1;
		$defaults['enable_authro_detail_single_page'] 	= 1;
		$defaults['enable_related_post_on_single_page'] 	= 1;
        $defaults['single_related_post_title']                   = esc_html__('You May Like', 'default-mag');
		$defaults['number_of_single_related_post'] = 6;


		// featured_blog section
		$defaults['show_featured_category_section']			= 1;
		$defaults['select_category_for_featured_category']	= 0;
		$defaults['number_of_post_featured_category']		= 5;


		//Layout options.
		$defaults['site_date_layout_option']		= 'in-time-span';
		$defaults['homepage_layout_option']			= 'full-width';
		$defaults['global_layout']					= 'right-sidebar';
		$defaults['excerpt_length_global']			= 50;
		$defaults['pagination_type']				= 'numeric';
		$defaults['enable_copyright_credit']     	= 1;
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'default-mag' );
		$defaults['number_of_footer_widget']		= 3;
		$defaults['breadcrumb_type']				= 'simple';
		$defaults['enable_preloader']				= 1;

		// Pass through filter.
		$defaults = apply_filters( 'default_mag_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
