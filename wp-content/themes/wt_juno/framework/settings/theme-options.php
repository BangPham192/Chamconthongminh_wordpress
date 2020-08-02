<?php
/**
 * The Theme Options page
 *
 * This page is implemented using the Settings API
 * http://codex.wordpress.org/Settings_API
 * 
 * @package  WellThemes
 * @file     theme-options.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */

 /**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 *
 */

add_action( 'admin_init', 'wt_register_admin_scripts' );

function wt_register_admin_scripts() {
	wp_enqueue_style( 'wt_theme_options_css', get_template_directory_uri() . '/framework/settings/css/theme-options.css');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script( 'wt_colorpicker', get_template_directory_uri() . '/framework/settings/js/colorpicker.js', array( 'jquery' ));
	wp_enqueue_script( 'wt_select_js', get_template_directory_uri() . '/framework/settings/js/jquery.customSelect.min.js', array( 'jquery' ));
		
	wp_enqueue_script('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('wt_upload', get_template_directory_uri() .'/framework/settings/js/upload.js', array('jquery','media-upload','thickbox'));
}

global $pagenow;

if( ( 'themes.php' == $pagenow ) && ( isset( $_GET['activated'] ) && ( $_GET['activated'] == 'true' ) ) ) :
	/**
	* Set default options on activation
	*/
	function wt_init_options() {
		$options = get_option( 'wt_options' );
		if ( false === $options ) {
			$options = wt_default_options();  
		}
		update_option( 'wt_options', $options );
	}
	add_action( 'after_setup_theme', 'wt_init_options', 9 );
endif;

/**
 * Register the theme options setting
 */
function wt_register_settings() {
	register_setting( 'wt_options', 'wt_options', 'wt_validate_options' );	
}
add_action( 'admin_init', 'wt_register_settings' );

/**
 * Register the options page
 */

function wt_theme_add_page() {
	$wt_options_page = add_theme_page( __( 'Theme Options', 'wellthemes' ), __( 'Theme Options', 'wellthemes' ), 'edit_theme_options', 'wt-options', 'wt_theme_options_page' );
	add_action( 'admin_print_styles-' . $wt_options_page, 'wt_theme_options_scripts' );
}
add_action( 'admin_menu', 'wt_theme_add_page');


/**
 * Include scripts to the options page only
 */
function wt_theme_options_scripts(){
	wp_enqueue_script( 'wt_theme_options', get_template_directory_uri() . '/framework/settings/js/theme-options.js', array( 'jquery' ));
}


/**
 * Output the options page
 */
function wt_theme_options_page() { 
?>
	<div id="wt-admin"> 		
			<div class="header">	
				<div class="main">
					<div class="left">
						<h2><?php echo _e('Theme Options', 'wellthemes'); ?></h2>
					</div>	
				
					<div class="theme-info">		
						<h3><?php _e('Juno Theme', 'wellthemes'); ?></h3>			
						<ul>
							<li class="support">
								<a href="<?php echo esc_url(__('http://themeforest.net/user/wellthemes', 'wellthemes')); ?>" title="<?php _e('Theme Support', 'wellthemes'); ?>" target="_blank"><?php printf(__('Theme Support', 'wellthemes')); ?></a>
							</li>										
						</ul>
					</div>
				</div>
				<!-- <div class="subheader">
					
				</div> -->
			
			</div><!-- /header -->			
			
		<div class="options-wrap">
			
			<div class="tabs">
				<ul>
					<li class="general first"><a href="#general"><?php echo _e('General', 'wellthemes'); ?></a></li>
					<li class="home"><a href="#home"><?php echo _e('Hompepage', 'wellthemes'); ?></a></li>
					<li class="posts"><a href="#posts"><?php echo _e('Posts and Archives', 'wellthemes'); ?></a></li>
					<li class="sidebars"><a href="#sidebars"><?php echo _e('Sidebars', 'wellthemes'); ?></a></li>
					<li class="styles"><a href="#styles"><?php echo _e('Styles', 'wellthemes'); ?></a></li>
					<li class="typography"><a href="#typography"><?php echo _e('Typography', 'wellthemes'); ?></a></li>
					<li class="seo"><a href="#seo"><?php echo _e('SEO', 'wellthemes'); ?></a></li>
					<li class="footer"><a href="#footer"><?php echo _e('Header and Footer', 'wellthemes'); ?></a></li>
					<li class="reset"><a href="#reset"><?php echo _e('Reset', 'wellthemes'); ?></a></li>
				</ul>                           
			</div><!-- /subheader -->
					
			<div class="options-form">			
									
					<?php if ( isset( $_GET['settings-updated'] ) ) : ?>
						<div class="updated fade"><p><?php _e('Theme settings updated successfully', 'wellthemes'); ?></p></div>
					<?php endif; ?>
				
					<form action="options.php" method="post">
						
						<?php settings_fields( 'wt_options' ); ?>
						<?php $options = get_option('wt_options'); ?>	
											
						<div class="tab_content">
							<div id="general" class="tab_block">
								<h2><?php _e('General Settings', 'wellthemes'); ?></h2>
								
								<div class="fields_wrap">
								
									<div class="field infobox">
										<p><strong><?php _e('Uploading Images', 'wellthemes'); ?></strong></p>
										<?php _e('You can specify the complete URLs for the logo and other images or you can upload the image. Please read the documentation for the image uploading instructions.', 'wellthemes'); ?>										
									</div>
									
									<h3><?php _e('Header Settings', 'wellthemes'); ?></h3>								
																											
									<div class="field field-upload">
										<label for="wt_logo_url"><?php _e('Upload logo', 'wellthemes'); ?></label>
										<input id="wt_options[wt_logo_url]" class="upload_image" type="text" name="wt_options[wt_logo_url]" value="<?php echo esc_attr($options['wt_logo_url']); ?>" />
                                        
										<input class="upload_image_button" id="wt_logo_upload_button" type="button" value="Upload" />
										<span class="description long updesc"><?php _e('Upload a logo image or specify path. Max width: 150px. Max height: 50px.', 'wellthemes'); ?>
										</span> 
									</div>	
									
									<div class="field">
										<label for="wt_favicon"><?php _e('Upload Favicon', 'wellthemes'); ?></label>
										<input id="wt_options[wt_favicon]" class="upload_image" type="text" name="wt_options[wt_favicon]" value="<?php echo esc_attr($options['wt_favicon']); ?>" />
                                        <input class="upload_image_button" id="wt_favicon_button" type="button" value="Upload" />
										<span class="description updesc"><?php _e('Upload your 16x16 px favicon or specify path.', 'wellthemes'); ?></span> 
									</div>	
									
									<div class="field">
										<label for="wt_apple_touch"><?php _e('Apple Touch Icon', 'wellthemes'); ?></label>
										<input id="wt_options[wt_apple_touch]" class="upload_image" type="text" name="wt_options[wt_apple_touch]" value="<?php echo esc_attr($options['wt_apple_touch']); ?>" />
                                        <input class="upload_image_button" id="wt_apple_touch_button" type="button" value="Upload" />
										<span class="description updesc"><?php _e('Upload your 114px by 114px icon.', 'wellthemes'); ?></span> 
									</div>	
									
									<div class="field">
										<label for="wt_options[wt_rss_url]"><?php _e('Custom RSS URL', 'wellthemes'); ?></label>
										<input id="wt_options[wt_rss_url]" name="wt_options[wt_rss_url]" type="text" value="<?php echo esc_attr($options['wt_rss_url']); ?>" />
										<span class="description long"><?php _e( 'Enter full URL of RSS Feeds link starting with <strong>http:// </strong>. Leave blank to use default RSS Feeds.', 'wellthemes' ); ?></span>
									</div>	
									<h3><?php _e('Social Links', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_show_header_social]"><?php _e('Enable Social Links', 'wellthemes'); ?></label>
										<input id="wt_options[wt_show_header_social]" name="wt_options[wt_show_header_social]" type="checkbox" value="1" <?php isset($options['wt_show_header_social']) ? checked( '1', $options['wt_show_header_social'] ) : checked('0', '1'); ?> />				
										<span class="description chkdesc"><?php _e( 'Check to display social links in header and footer', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_fb_url]"><?php _e('Facebook', 'wellthemes'); ?></label>
										<input id="wt_options[wt_fb_url]" name="wt_options[wt_fb_url]" type="text" value="<?php echo esc_attr($options['wt_fb_url']); ?>" />
										<span class="description"><?php _e( 'Enter the full URL of Facebook profile.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_twitter_url]"><?php _e('Twitter', 'wellthemes'); ?></label>
										<input id="wt_options[wt_twitter_url]" name="wt_options[wt_twitter_url]" type="text" value="<?php echo esc_attr($options['wt_twitter_url']); ?>" />
										<span class="description"><?php _e( 'Enter the full URL of Twitter profile.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_gplus_url]"><?php _e('Google+', 'wellthemes'); ?></label>
										<input id="wt_options[wt_gplus_url]" name="wt_options[wt_gplus_url]" type="text" value="<?php echo esc_attr($options['wt_gplus_url']); ?>" />
										<span class="description"><?php _e( 'Enter the full URL of Google+ profile.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_pinterest_url]"><?php _e('Pinterest', 'wellthemes'); ?></label>
										<input id="wt_options[wt_pinterest_url]" name="wt_options[wt_pinterest_url]" type="text" value="<?php echo esc_attr($options['wt_pinterest_url']); ?>" />
										<span class="description"><?php _e( 'Enter the full URL of Pinterest profile.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_dribbble_url]"><?php _e('Dribbble', 'wellthemes'); ?></label>
										<input id="wt_options[wt_dribbble_url]" name="wt_options[wt_dribbble_url]" type="text" value="<?php echo esc_attr($options['wt_dribbble_url']); ?>" />
										<span class="description"><?php _e( 'Enter the full URL of Dribbble profile.', 'wellthemes' ); ?></span>
									</div>							
									
									
									<h3><?php _e('Contact Details', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_contact_address]"><?php _e('Contact Address', 'wellthemes'); ?></label>
										<input id="wt_options[wt_contact_address]" name="wt_options[wt_contact_address]" type="text" value="<?php echo esc_attr($options['wt_contact_address']); ?>" />
										<span class="description"><?php _e( 'Enter the address for the map on contact page.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_contact_email]"><?php _e('Email Address', 'wellthemes'); ?></label>
										<input id="wt_options[wt_contact_email]" name="wt_options[wt_contact_email]" type="text" value="<?php echo esc_attr($options['wt_contact_email']); ?>" />
										<span class="description long"><?php _e( 'Enter the email address where you wish to receive the contact form messages.', 'wellthemes' ); ?></span>
									</div>	
									
									<div class="field">
										<label for="wt_options[wt_contact_subject]"><?php _e('Email Subject', 'wellthemes'); ?></label>
										<input id="wt_options[wt_contact_subject]" name="wt_options[wt_contact_subject]" type="text" value="<?php echo esc_attr($options['wt_contact_subject']); ?>" />
										<span class="description"><?php _e( 'Enter the subject of the email.', 'wellthemes' ); ?></span>
									</div>
									
									<h3><?php _e('reCaptcha Settings', 'wellthemes'); ?></h3>
									<div class="field">
										<label for="wt_options[wt_recaptcha_public_key]"><?php _e('Public Key', 'wellthemes'); ?></label>
										<input id="wt_options[wt_recaptcha_public_key]" name="wt_options[wt_recaptcha_public_key]" type="text" value="<?php echo esc_attr($options['wt_recaptcha_public_key']); ?>" />
										<span class="description long"><?php _e( 'Enter the reCaptcha public key for the contact form reCaptcha. See documentation for more information', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_recaptcha_private_key]"><?php _e('Private Key', 'wellthemes'); ?></label>
										<input id="wt_options[wt_recaptcha_private_key]" name="wt_options[wt_recaptcha_private_key]" type="text" value="<?php echo esc_attr($options['wt_recaptcha_private_key']); ?>" />
										<span class="description long"><?php _e( 'Enter the reCaptcha private key for the contact form reCaptcha. See documentation for more information', 'wellthemes' ); ?></span>
									</div>
																		
								</div> <!-- /fields-wrap -->								
								
							</div><!-- /tab_block -->
							
							<div id="home" class="tab_block">
								<h2><?php _e('Homepage Settings', 'wellthemes'); ?></h2>
																
								<div class="fields_wrap">
									
									<div class="field infobox">
										<p><strong><?php _e('Featured Images', 'wellthemes'); ?></strong></p>
										<?php _e('The slider and featured categories use Post Featured images. Please read the theme documentation to learn how to upload the post featured images.', 'wellthemes'); ?>
									</div>
									
									<h3><?php _e('Main Slider Settings', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_show_slider]"><?php _e('Enable Slider', 'wellthemes'); ?></label>
										<input id="wt_options[wt_show_slider]" name="wt_options[wt_show_slider]" type="checkbox" value="1" <?php isset($options['wt_show_slider']) ? checked( '1', $options['wt_show_slider'] ) : checked('0', '1'); ?> />				
										<span class="description chkdesc"><?php _e( 'Check to enable the slider on homepage.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">	
									
										<label for="wt_options[wt_slider_category]"><?php _e('Slider Category', 'wellthemes'); ?></label>
										<?php 
											$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
											
												<select id="wt_slider_category" name="wt_options[wt_slider_category]" class="styled">
													<option <?php selected( 0 == $options['wt_slider_category'] ); ?> value="0"><?php _e( '--none--', 'wellthemes' ); ?></option>
														<?php foreach( $categories as $category ) : ?>
															<option <?php selected( $category->term_id == $options['wt_slider_category'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
														<?php endforeach; ?>
												</select>
											
											<span class="description slcdesc long"><?php _e( 'Select the category for the slider. Select <strong>none</strong> to show latest posts.', 'wellthemes' ); ?></span>					
									</div>
									
									<h3><?php _e('Featured Post Section', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_show_feat_section]"><?php _e('Enable section', 'wellthemes'); ?></label>
										<input id="wt_options[wt_show_feat_section]" name="wt_options[wt_show_feat_section]" type="checkbox" value="1" <?php isset($options['wt_show_feat_section']) ? checked( '1', $options['wt_show_feat_section'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check to enable the single featured post section on homepage.', 'wellthemes' ); ?></span>	
									</div>
									
									<div class="field">														
										<label for="wt_options[wt_feat_section_post_cat]"><?php _e('Featured Post Category', 'wellthemes'); ?></label>
										<?php 
											$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
											<select id="wt_feat_section_post_cat" name="wt_options[wt_feat_section_post_cat]" class="styled">
												<option <?php selected( 0 == $options['wt_feat_section_post_cat'] ); ?> value="0"><?php _e( '--none--', 'wellthemes' ); ?></option>
													<?php foreach( $categories as $category ) : ?>
														<option <?php selected( $category->term_id == $options['wt_feat_section_post_cat'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
													<?php endforeach; ?>
											</select>																						
											<span class="description slcdesc long"><?php _e( 'Select the second category. Select <strong>none</strong> to show latest posts.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_feat_post_title]"><?php _e('Post section title', 'wellthemes'); ?></label>
										<input id="wt_options[wt_feat_post_title]" name="wt_options[wt_feat_post_title]" type="text" value="<?php echo esc_attr($options['wt_feat_post_title']); ?>" />
										<span class="description"><?php _e( 'Enter the title for the featured post section.', 'wellthemes' ); ?></span>
									</div>

									<div class="field">														
										<label for="wt_options[wt_feat_section_list_cat]"><?php _e('Post List Category', 'wellthemes'); ?></label>
										<?php 
											$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
											<select id="wt_feat_section_list_cat" name="wt_options[wt_feat_section_list_cat]" class="styled">
													<option <?php selected( 0 == $options['wt_feat_section_list_cat'] ); ?> value="0"><?php _e( '--none--', 'wellthemes' ); ?></option>
														<?php foreach( $categories as $category ) : ?>
															<option <?php selected( $category->term_id == $options['wt_feat_section_list_cat'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
														<?php endforeach; ?>
											</select>	
																						
											<span class="description slcdesc long"><?php _e( 'Select category for post list. Select <strong>none</strong> to show latest posts.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_feat_list_title]"><?php _e('Post list title', 'wellthemes'); ?></label>
										<input id="wt_options[wt_feat_list_title]" name="wt_options[wt_feat_list_title]" type="text" value="<?php echo esc_attr($options['wt_feat_list_title']); ?>" />
										<span class="description"><?php _e( 'Enter the title for the post list.', 'wellthemes' ); ?></span>
									</div>
									
									<h3><?php _e('Single Column Categories', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_show_feat_singlecats]"><?php _e('Enable Categories', 'wellthemes'); ?></label>
										<input id="wt_options[wt_show_feat_singlecats]" name="wt_options[wt_show_feat_singlecats]" type="checkbox" value="1" <?php isset($options['wt_show_feat_singlecats']) ? checked( '1', $options['wt_show_feat_singlecats'] ) : checked('0', '1'); ?> />							
										<span class="description chkdesc"><?php _e( 'Check to enable single column categories on homepage.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">														
										<label for="wt_options[wt_feat_singlecat1]"><?php _e('Category 1', 'wellthemes'); ?></label>
										<?php 
											$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
											<select id="wt_feat_singlecat1" name="wt_options[wt_feat_singlecat1]" class="styled">
												<option <?php selected( 0 == $options['wt_feat_singlecat1'] ); ?> value="0"><?php _e( '--none--', 'wellthemes' ); ?></option>
												<?php foreach( $categories as $category ) : ?>
													<option <?php selected( $category->term_id == $options['wt_feat_singlecat1'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
												<?php endforeach; ?>
											</select>											
											<span class="description slcdesc"><?php _e( 'Select the first category. Select <strong>none</strong> to hide.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">														
										<label for="wt_options[wt_feat_singlecat2]"><?php _e('Featured Category 2', 'wellthemes'); ?></label>
										<?php 
											$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
											<select id="wt_feat_singlecat2" name="wt_options[wt_feat_singlecat2]" class="styled">
												<option <?php selected( 0 == $options['wt_feat_singlecat2'] ); ?> value="0"><?php _e( '--none--', 'wellthemes' ); ?></option>
												<?php foreach( $categories as $category ) : ?>
													<option <?php selected( $category->term_id == $options['wt_feat_singlecat2'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
												<?php endforeach; ?>
											</select>																						
											<span class="description slcdesc"><?php _e( 'Select the second featured category. Select <strong>none</strong> to hide.', 'wellthemes' ); ?></span>
									</div>
									
									<h3><?php _e('Latest Posts List', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_show_feat_postlist]"><?php _e('Enable Post List', 'wellthemes'); ?></label>
										<input id="wt_options[wt_show_feat_postlist]" name="wt_options[wt_show_feat_postlist]" type="checkbox" value="1" <?php isset($options['wt_show_feat_postlist']) ? checked( '1', $options['wt_show_feat_postlist'] ) : checked('0', '1'); ?> />							
										<span class="description chkdesc"><?php _e( 'Check to enable latest posts list on homepage.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">														
										<label for="wt_options[wt_feat_postlist_cat]"><?php _e('Featured Category 2', 'wellthemes'); ?></label>
										<?php 
											$categories = get_categories( array( 'hide_empty' => 1, 'hierarchical' => 0 ) );  ?>
											<select id="wt_feat_postlist_cat" name="wt_options[wt_feat_postlist_cat]" class="styled">
												<option <?php selected( 0 == $options['wt_feat_postlist_cat'] ); ?> value="0"><?php _e( '--none--', 'wellthemes' ); ?></option>
												<?php foreach( $categories as $category ) : ?>
													<option <?php selected( $category->term_id == $options['wt_feat_postlist_cat'] ); ?> value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
												<?php endforeach; ?>
											</select>																						
											<span class="description slcdesc"><?php _e( 'Select the second featured category. Select <strong>none</strong> to hide.', 'wellthemes' ); ?></span>
									</div>
									
								</div> <!-- /fields-wrap -->								
								
							</div><!-- /tab_block -->
							
							<div id="posts" class="tab_block">		
								<h2><?php _e('Posts and Archive Settings', 'wellthemes'); ?></h2>	
								
								<div class="fields_wrap">
								
									<div class="field infobox">
										<p><strong><?php _e('Settings for single posts, pages, images and archives', 'wellthemes'); ?></strong></p>
										<?php _e('You can adjust single posts, pages images and archive settings.', 'wellthemes'); ?>
									</div>
									
									<h3><?php _e('Post Settings', 'wellthemes'); ?></h3>
																		
									<div class="field">
										<label for="wt_options[wt_hide_post_nav]"><?php _e('Hide Post Nav', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_post_nav]" name="wt_options[wt_hide_post_nav]" type="checkbox" value="1" <?php isset($options['wt_hide_post_nav']) ? checked( '1', $options['wt_hide_post_nav'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable post navigation links.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_post_img]"><?php _e('Hide Post Image', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_post_img]" name="wt_options[wt_hide_post_img]" type="checkbox" value="1" <?php isset($options['wt_hide_post_img']) ? checked( '1', $options['wt_hide_post_img'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable post navigation links.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_post_meta]"><?php _e('Hide Post Meta', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_post_meta]" name="wt_options[wt_hide_post_meta]" type="checkbox" value="1" <?php isset($options['wt_hide_post_meta']) ? checked( '1', $options['wt_hide_post_meta'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable post meta data on pages.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_author_info]"><?php _e('Hide Author Information', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_author_info]" name="wt_options[wt_hide_author_info]" type="checkbox" value="1" <?php isset($options['wt_hide_author_info']) ? checked( '1', $options['wt_hide_author_info'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable author information below single posts.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_related_posts]"><?php _e('Hide Related Posts', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_related_posts]" name="wt_options[wt_hide_related_posts]" type="checkbox" value="1" <?php isset($options['wt_hide_related_posts']) ? checked( '1', $options['wt_hide_related_posts'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable related posts below single posts.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_post_social]"><?php _e('Hide Social Media', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_post_social]" name="wt_options[wt_hide_post_social]" type="checkbox" value="1" <?php isset($options['wt_hide_post_social']) ? checked( '1', $options['wt_hide_post_social'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable social media below single posts.', 'wellthemes' ); ?></span>					
									</div>
									
									<h3><?php _e('Page Settings', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_hide_page_meta]"><?php _e('Hide Page Meta', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_page_meta]" name="wt_options[wt_hide_page_meta]" type="checkbox" value="1" <?php isset($options['wt_hide_page_meta']) ? checked( '1', $options['wt_hide_page_meta'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable page meta data on pages.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_page_author_info]"><?php _e('Hide Author Information', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_page_author_info]" name="wt_options[wt_hide_page_author_info]" type="checkbox" value="1" <?php isset($options['wt_hide_page_author_info']) ? checked( '1', $options['wt_hide_page_author_info'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to hide author information on pages.', 'wellthemes' ); ?></span>					
									</div>								
																		
									<div class="field">
										<label for="wt_options[wt_hide_page_social]"><?php _e('Hide Social Media', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_page_social]" name="wt_options[wt_hide_page_social]" type="checkbox" value="1" <?php isset($options['wt_hide_page_social']) ? checked( '1', $options['wt_hide_page_social'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable social media on pages.', 'wellthemes' ); ?></span>					
									</div>
									
									<h3><?php _e('Images Settings', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_hide_img_meta]"><?php _e('Hide Post Meta on Images', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_img_meta]" name="wt_options[wt_hide_img_meta]" type="checkbox" value="1" <?php isset($options['wt_hide_img_meta']) ? checked( '1', $options['wt_hide_img_meta'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable post meta data on image pages.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_img_comments]"><?php _e('Hide Comments on Images', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_img_comments]" name="wt_options[wt_hide_img_comments]" type="checkbox" value="1" <?php isset($options['wt_hide_img_comments']) ? checked( '1', $options['wt_hide_img_comments'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable comments on the image pages.', 'wellthemes' ); ?></span>					
									</div>	

									<div class="field">
										<label for="wt_options[wt_hide_img_social]"><?php _e('Hide Social Media on Images', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_img_social]" name="wt_options[wt_hide_img_social]" type="checkbox" value="1" <?php isset($options['wt_hide_img_social']) ? checked( '1', $options['wt_hide_img_social'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to disable social media on Images.', 'wellthemes' ); ?></span>					
									</div>									
									
									<h3><?php _e('Archive Settings', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_hide_archive_cat_info]"><?php _e('Hide Category Description', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_archive_cat_info]" name="wt_options[wt_hide_archive_cat_info]" type="checkbox" value="1" <?php isset($options['wt_hide_archive_cat_info']) ? checked( '1', $options['wt_hide_archive_cat_info'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to hide category description in archive.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_archive_tag_info]"><?php _e('Hide Tag Description', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_archive_tag_info]" name="wt_options[wt_hide_archive_tag_info]" type="checkbox" value="1" <?php isset($options['wt_hide_archive_tag_info']) ? checked( '1', $options['wt_hide_archive_tag_info'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to hide tag information in archive.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_hide_archive_author_info]"><?php _e('Hide Author Description', 'wellthemes'); ?></label>
										<input id="wt_options[wt_hide_archive_author_info]" name="wt_options[wt_hide_archive_author_info]" type="checkbox" value="1" <?php isset($options['wt_hide_archive_author_info']) ? checked( '1', $options['wt_hide_archive_author_info'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check if you want to hide author informationin archive.', 'wellthemes' ); ?></span>					
									</div>									
									
									<h3><?php _e('Post Ads Settings', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_post_banner1]"><?php _e('Header Ad', 'wellthemes'); ?></label>
										<textarea id="wt_options[wt_post_banner1]" class="textarea" name="wt_options[wt_post_banner1]"><?php echo esc_attr($options['wt_post_banner1']); ?></textarea>
										<span class="description"><?php _e( 'Enter the code for post top ad.', 'wellthemes' ); ?></span>		
									</div>

									<div class="field">
										<label for="wt_options[wt_post_banner2]"><?php _e('Footer Ad', 'wellthemes'); ?></label>
										<textarea id="wt_options[wt_post_banner2]" class="textarea" name="wt_options[wt_post_banner2]"><?php echo esc_attr($options['wt_post_banner2']); ?></textarea>
										<span class="description"><?php _e( 'Enter the code for post bottom ad.', 'wellthemes' ); ?></span>		
									</div>
									
								</div> <!-- /fields-wrap -->
																
							</div><!-- /tab_block -->
							
							<div id="sidebars" class="tab_block">
								<h2><?php _e('Sidebars', 'wellthemes'); ?></h2>
									<div class="fields_wrap">
										<div class="field infobox">
											<p><strong><?php _e('Unlimited Sidebars', 'wellthemes'); ?></strong></p>
											<?php _e('You can create as many sidebars you wish. Once you have created the sidebar, you can select the widgets for it from the widgets section on your WordPress dashboard.', 'wellthemes'); ?>
										</div>	
										
										<h3><?php _e('Sidebar Position', 'wellthemes'); ?></h3>
										
										<div class="field">
											<ul id="sidebar-position-options" class="sidebar-position">	
												
												<li>
													<input type="radio" name="wt_options[wt_sidebar_position]" value="right" <?php checked( $options['wt_sidebar_position'], 'right'); ?> /><a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/settings/css/images/sidebar-right.png" /></a>
												</li>
												
												<li>
													<input type="radio" name="wt_options[wt_sidebar_position]" value="left" <?php checked( $options['wt_sidebar_position'], 'left'); ?> /> <a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/settings/css/images/sidebar-left.png" /></a>
												</li>
												
											</ul>
										</div>
										
										
										<h3><?php _e('Create Sidebar', 'wellthemes'); ?></h3>
										
										<div class="field">
											<label><?php _e('Sidebar Name', 'wellthemes'); ?></label>
											<input id="wt_custom_sidebar_name" type="text" name="wt_custom_sidebar_name" class="add-sidebar" value="" />
											<input id="wt_custom_sidebar_add_button"  class="upload_image_button" type="button" value="Create" />
											
																						
										</div>
										<div class="field">
										<ul id="wt_options_sidebar_list">
												<?php														
													$sidebars = "";													
													if (isset($options['wt_custom_sidebars'])){
														$sidebars = $options['wt_custom_sidebars'] ;
													}
																										
													if($sidebars){
														foreach ($sidebars as $sidebar) { ?>
															<li>
																<div class="sidebar-block"><?php echo $sidebar ?>  
																	<input name="wt_options[wt_custom_sidebars][]" type="hidden" value="<?php echo $sidebar ?>" /><a class="sidebar-remove"></a></div>
															</li>
														<?php }
													}
													
												?>
											</ul>
										</div>
										
										<h3><?php _e('Custom Sidebars', 'wellthemes'); ?></h3>
										
										<div class="field">
											<label><?php _e('Homepage Sidebar', 'wellthemes'); ?></label>
											<select id="wt_home_sidebar" name="wt_options[wt_home_sidebar]" class="styled">
												<option <?php selected( "" == $options['wt_home_sidebar'] ); ?> value=""><?php _e('Default', 'wellthemes'); ?></option>	
												<?php
													if($sidebars){
														foreach ($sidebars as $sidebar){?>
															<option <?php selected( $sidebar == $options['wt_home_sidebar'] ); ?> value="<?php echo $sidebar; ?>"><?php echo $sidebar ?></option>	
															<?php 
														}														
													}
												?>
											</select>											
											<span class="description slcdesc"><?php _e( 'Select sidebar for homepage.', 'wellthemes' ); ?></span>
										</div><!-- /field -->
										
										<div class="field">
											<label><?php _e('Single Post Sidebar', 'wellthemes'); ?></label>
											<select id="wt_single_post_sidebar" name="wt_options[wt_single_post_sidebar]" class="styled">
												<option <?php selected( "" == $options['wt_single_post_sidebar'] ); ?> value=""><?php _e('Default', 'wellthemes'); ?></option>	
												<?php
													if($sidebars){
														foreach ($sidebars as $sidebar){?>
															<option <?php selected( $sidebar == $options['wt_single_post_sidebar'] ); ?> value="<?php echo $sidebar; ?>"><?php echo $sidebar ?></option>	
															<?php 
														}														
													}
												?>
											</select>											
											<span class="description slcdesc"><?php _e( 'Select sidebar for single post.', 'wellthemes' ); ?></span>
										</div><!-- /field -->
										
										<div class="field">
											<label><?php _e('Single Page Sidebar', 'wellthemes'); ?></label>
											<select id="wt_single_page_sidebar" name="wt_options[wt_single_page_sidebar]" class="styled">
												<option <?php selected( "" == $options['wt_single_page_sidebar'] ); ?> value=""><?php _e('Default', 'wellthemes'); ?></option>	
												<?php
													if($sidebars){
														foreach ($sidebars as $sidebar){?>
															<option <?php selected( $sidebar == $options['wt_single_page_sidebar'] ); ?> value="<?php echo $sidebar; ?>"><?php echo $sidebar ?></option>	
															<?php 
														}														
													}
												?>
											</select>											
											<span class="description slcdesc"><?php _e( 'Select sidebar for single page.', 'wellthemes' ); ?></span>
										</div><!-- /field -->
										
										<div class="field">
											<label><?php _e('Category Sidebar', 'wellthemes'); ?></label>
											<select id="wt_category_sidebar" name="wt_options[wt_category_sidebar]" class="styled">
												<option <?php selected( "" == $options['wt_category_sidebar'] ); ?> value=""><?php _e('Default', 'wellthemes'); ?></option>	
												<?php
													if($sidebars){
														foreach ($sidebars as $sidebar){?>
															<option <?php selected( $sidebar == $options['wt_category_sidebar'] ); ?> value="<?php echo $sidebar; ?>"><?php echo $sidebar ?></option>	
															<?php 
														}														
													}
												?>
											</select>											
											<span class="description slcdesc"><?php _e( 'Select sidebar for category archives page.', 'wellthemes' ); ?></span>
										</div><!-- /field -->
										
										
										<div class="field">
											<label><?php _e('Archive Sidebar', 'wellthemes'); ?></label>
											<select id="wt_archive_sidebar" name="wt_options[wt_archive_sidebar]" class="styled">
												<option <?php selected( "" == $options['wt_archive_sidebar'] ); ?> value=""><?php _e('Default', 'wellthemes'); ?></option>	
												<?php
													if($sidebars){
														foreach ($sidebars as $sidebar){?>
															<option <?php selected( $sidebar == $options['wt_archive_sidebar'] ); ?> value="<?php echo $sidebar; ?>"><?php echo $sidebar ?></option>	
															<?php 
														}														
													}
												?>
											</select>											
											<span class="description slcdesc"><?php _e( 'Select sidebar for archives page.', 'wellthemes' ); ?></span>
										</div><!-- /field -->

									</div>	<!-- /fields_wrap -->	
							</div>	<!-- /tab_block -->	
							
							<div id="styles" class="tab_block">
								<h2><?php _e('Styles', 'wellthemes'); ?></h2>
								
								<div class="fields_wrap">
								
									<div class="field infobox">
										<p><strong><?php _e('Custom Styles', 'wellthemes');?></strong></p>
										<?php _e('You can change the primary color for the theme. Also you can use the custom styles for the theme by entering the custom css code.', 'wellthemes'); ?>
									</div>																	
									
									<h3><?php _e('Theme Color Schemes', 'wellthemes'); ?></h3>																	
									<div class="field">
										<label><?php _e('Theme main color', 'wellthemes'); ?></label>
										<div id="wt_primary_color_selector" class="color-pic"><div style="background-color:<?php echo $options['wt_primary_color'] ; ?>"></div></div>
										<input style="width:80px; margin-right:5px;"  name="wt_options[wt_primary_color]" id="wt_primary_color" type="text" value="<?php echo $options['wt_primary_color'] ; ?>" />
										<span class="description chkdesc"><?php _e( 'Select primary color for the theme.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label><?php _e('Menu main color', 'wellthemes'); ?></label>
										<div id="wt_menu_primary_color_selector" class="color-pic"><div style="background-color:<?php echo $options['wt_menu_primary_color'] ; ?>"></div></div>
										<input style="width:80px; margin-right:5px;"  name="wt_options[wt_menu_primary_color]" id="wt_menu_primary_color" type="text" value="<?php echo $options['wt_menu_primary_color'] ; ?>" />
										<span class="description chkdesc"><?php _e( 'Select primary color for the main menu.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label><?php _e('Menu second color', 'wellthemes'); ?></label>
										<div id="wt_menu_second_color_selector" class="color-pic"><div style="background-color:<?php echo $options['wt_menu_second_color'] ; ?>"></div></div>
										<input style="width:80px; margin-right:5px;"  name="wt_options[wt_menu_second_color]" id="wt_menu_second_color" type="text" value="<?php echo $options['wt_menu_second_color'] ; ?>" />
										<span class="description chkdesc"><?php _e( 'Select primary color for the main menu.', 'wellthemes' ); ?></span>
									</div>
									
																		
									<h3><?php _e('Custom CSS Styles', 'wellthemes'); ?></h3>	
									<div class="field">
										<label for="wt_options[wt_custom_css]"><?php _e('CSS Code', 'wellthemes'); ?></label>
										<textarea id="wt_options[wt_custom_css]" class="textarea" cols="50" rows="30" name="wt_options[wt_custom_css]"><?php echo esc_attr($options['wt_custom_css']); ?></textarea>
										<span class="description long"><?php _e( 'You can enter custom CSS code. It will overwrite the default style.', 'wellthemes' ); ?></span>							
									</div>										
								</div>
															
							</div>	<!-- /tab_block -->		
							
							<div id="typography" class="tab_block">
								<h2><?php _e('Typography', 'wellthemes'); ?></h2>
									
									<div class="fields_wrap">									
									
										<div class="field infobox">
											<p><strong><?php _e('Adjust your font styles', 'wellthemes'); ?></strong></p>
											<?php _e('You can use your custom fonts styles. If you want to use the default theme fonts, leave the fields empty. <br />
											From left to right: Font size, Font style, Line height, Margin Bottom', 'wellthemes'); ?>
										</div>
									
										<h3><?php _e('Headings', 'wellthemes'); ?></h3>
										
										<div class="field">
											<label><?php _e('Heading 1', 'wellthemes'); ?></label>
											
												<select id="wt_h1_fontsize" name="wt_options[wt_h1_fontsize]" class="styled select80">
													<option value="" <?php selected( $options['wt_h1_fontsize'] == '');?>></option>	
													<?php for ($i = 10; $i < 41; $i++){ $font_size = $i.'px'; ?>
														<option value="<?php echo $font_size; ?>" <?php selected( $font_size == $options['wt_h1_fontsize'] ); ?>><?php echo $font_size; ?></option>'; 
													<?php	}	?>										
												</select>
												
												<select id="wt_h1_fontstyle" name="wt_options[wt_h1_fontstyle]" class="styled select120">
													<option value="" <?php selected( $options['wt_h1_fontstyle'] == '');?>></option>	
													<option value="normal" <?php selected( $options['wt_h1_fontstyle'] == 'normal');?>>Normal</option>	
													<option value="italic" <?php selected( $options['wt_h1_fontstyle'] == 'italic');?>>Italic</option>	
													<option value="bold" <?php selected( $options['wt_h1_fontstyle'] == 'bold');?>>Bold</option>
													<option value="bold-italic" <?php selected( $options['wt_h1_fontstyle'] == 'bold-italic');?>>Bold Italic</option>
												</select>	
												
												<select id="wt_h1_lineheight" name="wt_options[wt_h1_lineheight]" class="styled select80">	
													<option value="" <?php selected( $options['wt_h1_lineheight'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $line_height = $i.'px'; ?>
														<option value="<?php echo $line_height; ?>" <?php selected( $line_height == $options['wt_h1_lineheight'] ); ?>><?php echo $line_height; ?> </option>
													<?php } ?>
												</select>
											
												<select id="wt_h1_marginbottom" name="wt_options[wt_h1_marginbottom]" class="styled select80">
													<option value="" <?php selected( $options['wt_h1_marginbottom'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $margin_bottom = $i.'px'; ?>
														<option value="<?php echo $margin_bottom; ?>" <?php selected( $margin_bottom == $options['wt_h1_marginbottom'] ); ?>><?php echo $margin_bottom; ?> </option>
													<?php } ?>
												</select>												
																					
										</div><!-- /field-->
										
										<div class="field">
											<label><?php _e('Heading 2', 'wellthemes'); ?></label>											
											
												<select id="wt_h2_fontsize" name="wt_options[wt_h2_fontsize]" class="styled select80">
													<option value="" <?php selected( $options['wt_h2_fontsize'] == '');?>></option>	
													<?php for ($i = 10; $i < 41; $i++){ $font_size = $i.'px'; ?>
														<option value="<?php echo $font_size; ?>" <?php selected( $font_size == $options['wt_h2_fontsize'] ); ?>><?php echo $font_size; ?></option>'; 
													<?php	}	?>										
												</select>
											
												<select id="wt_h2_fontstyle" name="wt_options[wt_h2_fontstyle]" class="styled select120">
													<option value="" <?php selected( $options['wt_h2_fontstyle'] == '');?>></option>	
													<option value="normal" <?php selected( $options['wt_h2_fontstyle'] == 'normal');?>>Normal</option>	
													<option value="italic" <?php selected( $options['wt_h2_fontstyle'] == 'italic');?>>Italic</option>	
													<option value="bold" <?php selected( $options['wt_h2_fontstyle'] == 'bold');?>>Bold</option>
													<option value="bold-italic" <?php selected( $options['wt_h2_fontstyle'] == 'bold-italic');?>>Bold Italic</option>
												</select>
												
												<select id="wt_h2_lineheight" name="wt_options[wt_h2_lineheight]" class="styled select80">
													<option value="" <?php selected( $options['wt_h2_lineheight'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $line_height = $i.'px'; ?>
														<option value="<?php echo $line_height; ?>" <?php selected( $line_height == $options['wt_h2_lineheight'] ); ?>><?php echo $line_height; ?> </option>
													<?php } ?>
												</select>
												
												<select id="wt_h2_marginbottom" name="wt_options[wt_h2_marginbottom]" class="styled select80">
													<option value="" <?php selected( $options['wt_h2_marginbottom'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $margin_bottom = $i.'px'; ?>
														<option value="<?php echo $margin_bottom; ?>" <?php selected( $margin_bottom == $options['wt_h2_marginbottom'] ); ?>><?php echo $margin_bottom; ?> </option>
													<?php } ?>
												</select>
										</div><!-- /field -->
										
										<div class="field">
											<label><?php _e('Heading 3', 'wellthemes'); ?></label>
											
												<select id="wt_h3_fontsize" name="wt_options[wt_h3_fontsize]" class="styled select80">
													<option value="" <?php selected( $options['wt_h3_fontsize'] == '');?>></option>	
													<?php for ($i = 10; $i < 41; $i++){ $font_size = $i.'px'; ?>
														<option value="<?php echo $font_size; ?>" <?php selected( $font_size == $options['wt_h3_fontsize'] ); ?>><?php echo $font_size; ?></option>'; 
													<?php	}	?>										
												</select>
											
												<select id="wt_h3_fontstyle" name="wt_options[wt_h3_fontstyle]" class="styled select120">
													<option value="" <?php selected( $options['wt_h3_fontstyle'] == '');?>></option>	
													<option value="normal" <?php selected( $options['wt_h3_fontstyle'] == 'normal');?>>Normal</option>	
													<option value="italic" <?php selected( $options['wt_h3_fontstyle'] == 'italic');?>>Italic</option>	
													<option value="bold" <?php selected( $options['wt_h3_fontstyle'] == 'bold');?>>Bold</option>											
													<option value="bold-italic" <?php selected( $options['wt_h3_fontstyle'] == 'bold-italic');?>>Bold Italic</option>
												</select>			
																			
												<select id="wt_h3_lineheight" name="wt_options[wt_h3_lineheight]" class="styled select80">
													<option value="" <?php selected( $options['wt_h3_lineheight'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $line_height = $i.'px'; ?>
														<option value="<?php echo $line_height; ?>" <?php selected( $line_height == $options['wt_h3_lineheight'] ); ?>><?php echo $line_height; ?> </option>
													<?php } ?>
												</select>
											
												<select id="wt_h3_marginbottom" name="wt_options[wt_h3_marginbottom]" class="styled select80">
													<option value="" <?php selected( $options['wt_h3_marginbottom'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $margin_bottom = $i.'px'; ?>
														<option value="<?php echo $margin_bottom; ?>" <?php selected( $margin_bottom == $options['wt_h3_marginbottom'] ); ?>><?php echo $margin_bottom; ?> </option>
													<?php } ?>
												</select>											
										</div><!-- /feild -->
										
										<div class="field">
											<label><?php _e('Heading 4', 'wellthemes'); ?></label>
											
												<select id="wt_h4_fontsize" name="wt_options[wt_h4_fontsize]" class="styled select80">
													<option value="" <?php selected( $options['wt_h4_fontsize'] == '');?>></option>	
													<?php for ($i = 10; $i < 41; $i++){ $font_size = $i.'px'; ?>
														<option value="<?php echo $font_size; ?>" <?php selected( $font_size == $options['wt_h4_fontsize'] ); ?>><?php echo $font_size; ?></option>'; 
													<?php	}	?>										
												</select>
																						
												<select id="wt_h4_fontstyle" name="wt_options[wt_h4_fontstyle]" class="styled select120">
													<option value="" <?php selected( $options['wt_h4_fontstyle'] == '');?>></option>	
													<option value="normal" <?php selected( $options['wt_h4_fontstyle'] == 'normal');?>>Normal</option>	
													<option value="italic" <?php selected( $options['wt_h4_fontstyle'] == 'italic');?>>Italic</option>	
													<option value="bold" <?php selected( $options['wt_h4_fontstyle'] == 'bold');?>>Bold</option>
													<option value="bold-italic" <?php selected( $options['wt_h4_fontstyle'] == 'bold-italic');?>>Bold Italic</option>
												</select>						
																																	
												<select id="wt_h4_lineheight" name="wt_options[wt_h4_lineheight]" class="styled select80">
													<option value="" <?php selected( $options['wt_h4_lineheight'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $line_height = $i.'px'; ?>
														<option value="<?php echo $line_height; ?>" <?php selected( $line_height == $options['wt_h4_lineheight'] ); ?>><?php echo $line_height; ?> </option>
													<?php } ?>
												</select>
										
												<select id="wt_h4_marginbottom" name="wt_options[wt_h4_marginbottom]" class="styled select80">
													<option value="" <?php selected( $options['wt_h4_marginbottom'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $margin_bottom = $i.'px'; ?>
														<option value="<?php echo $margin_bottom; ?>" <?php selected( $margin_bottom == $options['wt_h4_marginbottom'] ); ?>><?php echo $margin_bottom; ?> </option>
													<?php } ?>
												</select>
											
										</div><!-- /field -->
										
										<div class="field">
											<label><?php _e('Heading 5', 'wellthemes'); ?></label>
																				
												<select id="wt_h5_fontsize" name="wt_options[wt_h5_fontsize]" class="styled select80">
													<option value="" <?php selected( $options['wt_h5_fontsize'] == '');?>></option>	
													<?php for ($i = 10; $i < 41; $i++){ $font_size = $i.'px'; ?>
														<option value="<?php echo $font_size; ?>" <?php selected( $font_size == $options['wt_h5_fontsize'] ); ?>><?php echo $font_size; ?></option>'; 
													<?php	}	?>										
												</select>
												
												<select id="wt_h5_fontstyle" name="wt_options[wt_h5_fontstyle]" class="styled select120">
													<option value="" <?php selected( $options['wt_h5_fontstyle'] == '');?>></option>	
													<option value="normal" <?php selected( $options['wt_h5_fontstyle'] == 'normal');?>>Normal</option>	
													<option value="italic" <?php selected( $options['wt_h5_fontstyle'] == 'italic');?>>Italic</option>	
													<option value="bold" <?php selected( $options['wt_h5_fontstyle'] == 'bold');?>>Bold</option>
													<option value="bold-italic" <?php selected( $options['wt_h5_fontstyle'] == 'bold-italic');?>>Bold Italic</option>
												</select>	
												
												<select id="wt_h5_lineheight" name="wt_options[wt_h5_lineheight]" class="styled select80">
													<option value="" <?php selected( $options['wt_h5_lineheight'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $line_height = $i.'px'; ?>
														<option value="<?php echo $line_height; ?>" <?php selected( $line_height == $options['wt_h5_lineheight'] ); ?>><?php echo $line_height; ?> </option>
													<?php } ?>
												</select>
											
												<select id="wt_h5_marginbottom" name="wt_options[wt_h5_marginbottom]" class="styled select80">
													<option value="" <?php selected( $options['wt_h5_marginbottom'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $margin_bottom = $i.'px'; ?>
														<option value="<?php echo $margin_bottom; ?>" <?php selected( $margin_bottom == $options['wt_h5_marginbottom'] ); ?>><?php echo $margin_bottom; ?> </option>
													<?php } ?>
												</select>				
																						
										</div><!-- /field -->
										
										<div class="field">
											<label><?php _e('Heading 6', 'wellthemes'); ?></label>
											
												<select id="wt_h6_fontsize" name="wt_options[wt_h6_fontsize]" class="styled select80">
													<option value="" <?php selected( $options['wt_h6_fontsize'] == '');?>></option>	
													<?php for ($i = 10; $i < 41; $i++){ $font_size = $i.'px'; ?>
														<option value="<?php echo $font_size; ?>" <?php selected( $font_size == $options['wt_h6_fontsize'] ); ?>><?php echo $font_size; ?></option>'; 
													<?php	}	?>										
												</select>
											
												<select id="wt_h6_fontstyle" name="wt_options[wt_h6_fontstyle]" class="styled select120">
													<option value="" <?php selected( $options['wt_h6_fontstyle'] == '');?>></option>	
													<option value="normal" <?php selected( $options['wt_h6_fontstyle'] == 'normal');?>>Normal</option>	
													<option value="italic" <?php selected( $options['wt_h6_fontstyle'] == 'italic');?>>Italic</option>	
													<option value="bold" <?php selected( $options['wt_h6_fontstyle'] == 'bold');?>>Bold</option>											
													<option value="bold-italic" <?php selected( $options['wt_h6_fontstyle'] == 'bold-italic');?>>Bold Italic</option>
												</select>
																						
												<select id="wt_h6_lineheight" name="wt_options[wt_h6_lineheight]" class="styled select80">
													<option value="" <?php selected( $options['wt_h6_lineheight'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $line_height = $i.'px'; ?>
														<option value="<?php echo $line_height; ?>" <?php selected( $line_height == $options['wt_h6_lineheight'] ); ?>><?php echo $line_height; ?> </option>
													<?php } ?>
												</select>
										
												<select id="wt_h6_marginbottom" name="wt_options[wt_h6_marginbottom]" class="styled select80">
													<option value="" <?php selected( $options['wt_h6_marginbottom'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $margin_bottom = $i.'px'; ?>
														<option value="<?php echo $margin_bottom; ?>" <?php selected( $margin_bottom == $options['wt_h6_marginbottom'] ); ?>><?php echo $margin_bottom; ?> </option>
													<?php } ?>
												</select>	
										
										</div><!-- /field -->
										
										<h3><?php _e('Text Font Styles', 'wellthemes'); ?></h3>
										
										<div class="field">
											<label><?php _e('Text', 'wellthemes'); ?></label>
											
												<select id="wt_text_fontsize" name="wt_options[wt_text_fontsize]" class="styled select80">
													<option value="" <?php selected( $options['wt_text_fontsize'] == '');?>></option>	
													<?php for ($i = 10; $i < 41; $i++){ $font_size = $i.'px'; ?>
														<option value="<?php echo $font_size; ?>" <?php selected( $font_size == $options['wt_text_fontsize'] ); ?>><?php echo $font_size; ?></option>'; 
													<?php	}	?>										
												</select>
																															
												<select id="wt_text_fontstyle" name="wt_options[wt_text_fontstyle]" class="styled select120">
													<option value="" <?php selected( $options['wt_text_fontstyle'] == '');?>></option>	
													<option value="normal" <?php selected( $options['wt_text_fontstyle'] == 'normal');?>>Normal</option>	
													<option value="italic" <?php selected( $options['wt_text_fontstyle'] == 'italic');?>>Italic</option>	
													<option value="bold" <?php selected( $options['wt_text_fontstyle'] == 'bold');?>>Bold</option>											
													<option value="bold-italic" <?php selected( $options['wt_text_fontstyle'] == 'bold-italic');?>>Bold Italic</option>
												</select>
																						
												<select id="wt_text_lineheight" name="wt_options[wt_text_lineheight]" class="styled select80">
													<option value="" <?php selected( $options['wt_text_lineheight'] == '');?>></option>
													<?php for ($i = 10; $i < 55; $i+=5){ $line_height = $i.'px'; ?>
														<option value="<?php echo $line_height; ?>" <?php selected( $line_height == $options['wt_text_lineheight'] ); ?>><?php echo $line_height; ?> </option>
													<?php } ?>
												</select>
											
											<span class="description txtfontdesc long"><?php _e( 'Select font style for text. From left to right: Font Size, Font Style, Line Height', 'wellthemes' ); ?></span>
											
										</div><!-- /field-->
										
										<h3><?php _e('Font', 'wellthemes'); ?></h3>
										<?php $fonts_list= wt_get_google_fonts(); ?>
										<div class="field">
											<label><?php _e('Headings Font', 'wellthemes'); ?></label>
												<select id="wt_headings_font_name" name="wt_options[wt_headings_font_name]" class="styled select-wide">
													<option <?php selected( "" == $options['wt_headings_font_name'] ); ?> value=""></option>
													<?php foreach( $fonts_list as $font => $font_name ){ ?>
														<option <?php selected( $font == $options['wt_headings_font_name'] ); ?> value="<?php echo $font; ?>"><?php echo $font_name ?></option>	
													<?php } ?>
												</select>
											
											<span class="description txtfontdesc"><?php _e( 'Select font for Headings.', 'wellthemes' ); ?></span>
										</div><!-- /field -->
										
										<div class="field">
											<label><?php _e('Text Font', 'wellthemes'); ?></label>
												<select id="wt_text_font_name" name="wt_options[wt_text_font_name]" class="styled select-wide">
													<option <?php selected( "" == $options['wt_text_font_name'] ); ?> value=""></option>
													<?php foreach( $fonts_list as $font => $font_name ){ ?>
													<option <?php selected( $font == $options['wt_text_font_name'] ); ?> value="<?php echo $font; ?>"><?php echo $font_name; ?></option>	
													<?php } ?>
												</select>
											
											<span class="description txtfontdesc"><?php _e( 'Select font for Text.', 'wellthemes' ); ?></span>
										</div><!-- /field -->
										
										<h3><?php _e('Color Schemes', 'wellthemes'); ?></h3>
																				
										<div class="field">
											<label><?php _e('Text Color', 'wellthemes'); ?></label>
											<div id="wt_text_color_selector" class="color-pic"><div style="background-color:<?php echo $options['wt_text_color'] ; ?>"></div></div>
											<input style="width:80px; margin-right:5px;"  name="wt_options[wt_text_color]" id="wt_text_color" type="text" value="<?php echo $options['wt_text_color'] ; ?>" />
											<span class="description chkdesc"><?php _e( 'Select the text color.', 'wellthemes' ); ?></span>
										</div>									
										
										<div class="field">
											<label><?php _e('Links Color', 'wellthemes'); ?></label>
											<div id="wt_links_color_selector" class="color-pic"><div style="background-color:<?php echo $options['wt_links_color'] ; ?>"></div></div>
											<input style="width:80px; margin-right:5px;"  name="wt_options[wt_links_color]" id="wt_links_color" type="text" value="<?php echo $options['wt_links_color'] ; ?>" />
											<span class="description chkdesc"><?php _e( 'Select the links color.', 'wellthemes' ); ?></span>
										</div>
										
										<div class="field">
											<label><?php _e('Links Hover Color', 'wellthemes'); ?></label>
											<div id="wt_links_hover_color_selector" class="color-pic"><div style="background-color:<?php echo $options['wt_links_hover_color'] ; ?>"></div></div>
											<input style="width:80px; margin-right:5px;"  name="wt_options[wt_links_hover_color]" id="wt_links_hover_color" type="text" value="<?php echo $options['wt_links_hover_color'] ; ?>" />
											<span class="description chkdesc"><?php _e( 'Select links hover color.', 'wellthemes' ); ?></span>
										</div>
										
									</div><!-- /fields_wrap -->	
																	
							</div><!-- /tab_block -->								
							
							<div id="seo" class="tab_block">
								<h2><?php _e('SEO Settings', 'wellthemes'); ?></h2>
									
									<div class="fields_wrap">
									
										<div class="field infobox">
											<p><strong><?php _e('Site Verification', 'wellthemes'); ?></strong></p>
											<?php _e('You can improve your search rankings by verifying your website with Bing and Google.
											Please read the theme documentation for step by step instructions on how to find Google and Bing site verification IDs.', 'wellthemes'); ?>
										</div>
										
									<h3><?php _e('Default Meta Settings', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_homepage_title]"><?php _e('Homepage title', 'wellthemes'); ?></label>
										<input id="wt_options[wt_homepage_title]" name="wt_options[wt_homepage_title]" type="text" value="<?php echo esc_attr($options['wt_homepage_title']); ?>" />
										<span class="description"><?php _e( 'Enter the Homepage title.', 'wellthemes' ); ?></span>
									</div>
																		
									<div class="field">
										<label for="wt_options[wt_meta_description]"><?php _e('Homepage Description', 'wellthemes'); ?></label>
										<textarea id="wt_options[wt_meta_description]" class="textarea" name="wt_options[wt_meta_description]"><?php echo esc_attr($options['wt_meta_description']); ?></textarea>
										<span class="description"><?php _e( 'Add homepage description.', 'wellthemes' ); ?></span>					
									</div>
									
									<div class="field">
										<label for="wt_options[wt_meta_keywords]"><?php _e('Meta Keywords', 'wellthemes'); ?></label>
										<textarea id="wt_options[wt_meta_keywords]" class="textarea"  name="wt_options[wt_meta_keywords]"><?php echo esc_attr($options['wt_meta_keywords']); ?></textarea>
										<span class="description"><?php _e( 'Add default meta keywords. Separate keywords with commas.', 'wellthemes' ); ?></span>					
									</div>	
									
									<div class="field">
										<label for="wt_options[wt_show_single_meta]"><?php _e('Post Meta', 'wellthemes'); ?></label>
										<input id="wt_options[wt_show_single_meta]" name="wt_options[wt_show_single_meta]" type="checkbox" value="1" <?php isset($options['wt_show_single_meta']) ? checked( '1', $options['wt_show_single_meta'] ) : checked('0', '1'); ?> />
										<span class="description chkdesc"><?php _e( 'Check to enable the meta description on single posts.', 'wellthemes' ); ?></span>
									</div>
									
									<h3><?php _e('Exclude pages from crawl', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_exclude_cat_crawl]"><?php _e('Category Pages', 'wellthemes'); ?></label>
										<input id="wt_options[wt_exclude_cat_crawl]" name="wt_options[wt_exclude_cat_crawl]" type="checkbox" value="1" <?php isset($options['wt_exclude_cat_crawl']) ? checked( '1', $options['wt_exclude_cat_crawl'] ) : checked('0', '1'); ?> />							
										<span class="description chkdesc long"><?php _e( 'Check to exclude category pages from being crawled. Useful to avoid duplicate content.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_exclude_tag_crawl]"><?php _e('Tag Pages', 'wellthemes'); ?></label>
										<input id="wt_options[wt_exclude_tag_crawl]" name="wt_options[wt_exclude_tag_crawl]" type="checkbox" value="1" <?php isset($options['wt_exclude_tag_crawl']) ? checked( '1', $options['wt_exclude_tag_crawl'] ) : checked('0', '1'); ?> />				
										<span class="description chkdesc long"><?php _e( 'Check to exclude tag pages from being crawled. Useful to avoid duplicate content.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_exclude_archive_crawl]"><?php _e('Archives', 'wellthemes'); ?></label>
										<input id="wt_options[wt_exclude_archive_crawl]" name="wt_options[wt_exclude_archive_crawl]" type="checkbox" value="1" <?php isset($options['wt_exclude_archive_crawl']) ? checked( '1', $options['wt_exclude_archive_crawl'] ) : checked('0', '1'); ?> />				
										<span class="description chkdesc long"><?php _e( 'Check to exclude category archives from being crawled. Useful to avoid duplicate content.', 'wellthemes' ); ?></span>
									</div>
									
									<h3><?php _e('Open Graph Meta Elements', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_show_og_meta]"><?php _e('Enable Open Graph Meta', 'wellthemes'); ?></label>
										<input id="wt_options[wt_show_og_meta]" name="wt_options[wt_show_og_meta]" type="checkbox" value="1" <?php isset($options['wt_show_og_meta']) ? checked( '1', $options['wt_show_og_meta'] ) : checked('0', '1'); ?> />				
										<span class="description chkdesc long"><?php _e( 'Check to enable Open Graph Meta Elements to the header of theme. Useful for sharing content on social sharing sites.', 'wellthemes' ); ?></span>
									</div>
									
									
									<h3><?php _e('Site Verification', 'wellthemes'); ?></h3>
									
									<div class="field">
										<label for="wt_options[wt_google_verification]"><?php _e('Google Site Verification', 'wellthemes'); ?></label>
										<input id="wt_options[wt_google_verification]" type="text" name="wt_options[wt_google_verification]" value="<?php echo esc_attr($options['wt_google_verification']); ?>" />
										<span class="description"><?php _e( 'Enter your ID only.', 'wellthemes' ); ?></span>
									</div>
									
									<div class="field">
										<label for="wt_options[wt_bing_verification]"><?php _e('Bing Site Verification', 'wellthemes'); ?></label>
										<input id="wt_options[wt_bing_verification]" type="text" name="wt_options[wt_bing_verification]" value="<?php echo esc_attr($options['wt_bing_verification']); ?>" />
										<span class="description"><?php _e( 'Enter the ID only. It will be verified by <strong>Yahoo</strong> as well.','wellthemes' ); ?></span>
									</div>
									
									</div> <!-- /fields-wrap -->
									
							</div>	<!-- /tab_block -->	
							
							<div id="footer" class="tab_block">
								<h2><?php _e('Header and Footer Settings', 'wellthemes'); ?></h2>
									<div class="fields_wrap">
									
									<div class="field infobox">
										<p><strong><?php _e('Using Site Analytics Codes', 'wellthemes'); ?></strong></p>
										<?php _e('You can use site analytics codes in the header of footer.', 'wellthemes'); ?>
									</div>
									
									<h3><?php _e('Header Settings', 'wellthemes'); ?></h3>
																	
									<div class="field">
										<label for="wt_options[wt_header_code]"><?php _e('Header Code.', 'wellthemes'); ?></label>
										<textarea id="wt_options[wt_header_code]" class="textarea" name="wt_options[wt_header_code]"><?php echo esc_attr($options['wt_header_code']); ?></textarea>
										<span class="description"><?php _e( 'You can add any code eg. Google Analytics. It will appear in <strong>head</strong> section.', 'wellthemes' ); ?></span>		
									</div>
									
									<h3><?php _e('Footer Settings', 'wellthemes'); ?></h3>									
									<div class="field">
										<label for="wt_options[wt_footer_text_left]"><?php _e('Footer Text.', 'wellthemes'); ?></label>
										<textarea id="wt_options[wt_footer_text_left]" class="textarea" name="wt_options[wt_footer_text_left]"><?php echo esc_attr($options['wt_footer_text_left']); ?></textarea>
										<span class="description"><?php _e( 'Enter the footer left side text.', 'wellthemes' ); ?></span>					
									</div>								
																	
									<div class="field">
										<label for="wt_options[wt_footer_code]"><?php _e('Footer Code', 'wellthemes'); ?></label>
										<textarea id="wt_options[wt_footer_code]" class="textarea" name="wt_options[wt_footer_code]"><?php echo esc_attr($options['wt_footer_code']); ?></textarea>
										<span class="description"><?php _e( 'You can add any code eg. Google Analytics. It will appear in <strong>footer</strong> section.', 'wellthemes' ); ?></span>
									</div>
									
									</div> <!-- /fields-wrap -->
									
							</div>	<!-- /tab_block -->	
							
							<div id="reset" class="tab_block">
								<h2><?php _e('Reset Theme Settings', 'wellthemes'); ?></h2>
									<div class="fields_wrap">
										<div class="field warningbox">
											<p><strong><?php _e('Please Note', 'wellthemes'); ?></strong></p>
											<?php _e('You will lose all your theme settings and custom sidebar. The theme will restore default settings.', 'wellthemes'); ?>
										</div>
													
										<div class="field">
											<p class="reset-info"><?php _e('If you want to reset the theme settings.', 'wellthemes');?> </p>
											<input type="submit" name="wt_options[reset]" class="button-primary" value="<?php _e( 'Reset Settings', 'wellthemes' ); ?>" />
										</div>
									</div>	<!-- /fields_wrap -->	
							</div>	<!-- /tab_block -->	
					
						</div> <!-- /option_blocks -->			
						
					
		
			</div> <!-- /options-form -->
		</div> <!-- /options-wrap -->
		<div class="options-footer">
			<input type="submit" name="wt_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'wellthemes' ); ?>" />
		</div>
		</form>
	</div> <!-- /wt-admin -->
	<?php
}

/**
 * Return default array of options
 */
function wt_default_options() {
	$options = array(
		'wt_logo_url' => get_template_directory_uri().'/images/logo.png',	
		'wt_favicon' => '',
		'wt_apple_touch' => '',
		'wt_rss_url' => '',
		'wt_fb_url' => '',
		'wt_twitter_url' => '',
		'wt_gplus_url' => '',
		'wt_pinterest_url' => '',
		'wt_dribbble_url' => '',
		'wt_contact_address' => '',
		'wt_contact_email' => '',	
		'wt_recaptcha_public_key' => '',
		'wt_recaptcha_private_key' => '',		
		'wt_contact_subject' => '',		
		'wt_feat_post_title' => '',	
		'wt_feat_list_title' => '',		
		'wt_custom_sidebars' => '',
		'wt_home_sidebar' => '',
		'wt_single_post_sidebar' => '',
		'wt_single_page_sidebar' => '',
		'wt_archive_sidebar' => '',	
		'wt_category_sidebar' => '',		
		'wt_sidebar_position'=> 'right',		
		'wt_show_slider' => 1,		
		'wt_show_header_social' => 0,		
		'wt_slider_category' => 0,
		'wt_show_feat_section' => 1,	
		'wt_feat_section_list_cat' => 0,
		'wt_feat_section_post_cat' => 0,
		'wt_show_feat_singlecats' => 1,		
		'wt_feat_singlecat1' => 0,
		'wt_feat_singlecat2' => 0,
		'wt_show_feat_postlist' => 1,
		'wt_feat_postlist_cat' => 0,		
		'wt_hide_author_info' => 0,
		'wt_hide_related_posts' => 0,		
		'wt_hide_post_nav' => 0,
		'wt_hide_post_img' => 0,
		'wt_hide_post_meta' => 0,		
		'wt_hide_post_social' => 0,			
		'wt_hide_page_author_info' => 0,		
		'wt_hide_page_meta' => 0,	
		'wt_hide_page_social' => 0,
		'wt_hide_img_meta' => 0,
		'wt_hide_img_comments' => 0,
		'wt_hide_img_social' => 0,
		'wt_hide_archive_cat_info' => 0,
		'wt_hide_archive_tag_info' => 0,
		'wt_hide_archive_author_info' => 0,
		'wt_primary_color' => '',
		'wt_menu_primary_color' => '',
		'wt_menu_second_color' => '',		
		'wt_h1_fontsize' => '',
		'wt_h2_fontsize' => '',
		'wt_h3_fontsize' => '',	
		'wt_h4_fontsize' => '',	
		'wt_h5_fontsize' => '',	
		'wt_h6_fontsize' => '',	
		'wt_text_fontsize' => '',	
		'wt_h1_fontstyle' => '',
		'wt_h2_fontstyle' => '',
		'wt_h3_fontstyle' => '',
		'wt_h4_fontstyle' => '',
		'wt_h5_fontstyle' => '',
		'wt_h6_fontstyle' => '',	
		'wt_text_fontstyle' => '',
		'wt_h1_lineheight' => '',
		'wt_h2_lineheight' => '',
		'wt_h3_lineheight' => '',
		'wt_h4_lineheight' => '',
		'wt_h5_lineheight' => '',
		'wt_h6_lineheight' => '',
		'wt_text_lineheight' => '',
		'wt_h1_marginbottom' => '',	
		'wt_h2_marginbottom' => '',	
		'wt_h3_marginbottom' => '',	
		'wt_h4_marginbottom' => '',	
		'wt_h5_marginbottom' => '',	
		'wt_h6_marginbottom' => '',	
		'wt_text_font_name' => '',
		'wt_headings_font_name' => '',
		'wt_text_color' => '',
		'wt_links_color' => '',
		'wt_links_hover_color' => '',		
		'wt_custom_css' => '',
		'wt_homepage_title' => get_bloginfo('name'),		
		'wt_meta_keywords' => '',
		'wt_meta_description' => '',
		'wt_show_single_meta' => 1,		
		'wt_exclude_cat_crawl' => 0,	
		'wt_exclude_tag_crawl' => 0,
		'wt_exclude_archive_crawl' => 0,
		'wt_show_og_meta' => 1,		
		'wt_google_verification' => '',
		'wt_bing_verification' => '',	
		'wt_header_code' => '',
		'wt_post_banner1' => '',
		'wt_post_banner2' => '',		
		'wt_footer_text_left' => '&copy;'. date('Y') . ' '. get_bloginfo('name').' Designed by <a href="http://wellthemes.com">WellThemes.com</a>',
		'wt_footer_code' => ''		
	);
	return $options;
}

/**
 * Sanitize and validate options
 */
function wt_validate_options( $input ) {
	$submit = ( ! empty( $input['submit'] ) ? true : false );
	$reset = ( ! empty( $input['reset'] ) ? true : false );
	if( $submit ) :	
		
		$input['wt_logo_url'] = esc_url_raw($input['wt_logo_url']);
		$input['wt_favicon'] = esc_url_raw($input['wt_favicon']);
		$input['wt_apple_touch'] = esc_url_raw($input['wt_apple_touch']);		
		$input['wt_rss_url'] = esc_url_raw($input['wt_rss_url']);
		$input['wt_fb_url'] = esc_url_raw($input['wt_fb_url']);
		$input['wt_twitter_url'] = esc_url_raw($input['wt_twitter_url']);
		$input['wt_gplus_url'] = esc_url_raw($input['wt_gplus_url']);
		$input['wt_pinterest_url'] = esc_url_raw($input['wt_pinterest_url']);
		$input['wt_dribbble_url'] = esc_url_raw($input['wt_dribbble_url']);		
		$input['wt_contact_address'] = wp_kses_stripslashes($input['wt_contact_address']);
		$input['wt_contact_email'] = wp_filter_nohtml_kses($input['wt_contact_email']);
		$input['wt_recaptcha_public_key'] = wp_filter_nohtml_kses($input['wt_recaptcha_public_key']);
		$input['wt_recaptcha_private_key'] = wp_filter_nohtml_kses($input['wt_recaptcha_private_key']);		
		$input['wt_contact_subject'] = wp_kses_stripslashes($input['wt_contact_subject']);		
		$input['wt_feat_post_title'] = wp_kses_stripslashes($input['wt_feat_post_title']);	
		$input['wt_feat_list_title'] = wp_kses_stripslashes($input['wt_feat_list_title']);		
		$input['wt_text_color'] = wp_filter_nohtml_kses($input['wt_text_color']);
		$input['wt_links_hover_color'] = wp_filter_nohtml_kses($input['wt_links_hover_color']);
		$input['wt_primary_color'] = wp_filter_nohtml_kses($input['wt_primary_color']);	
		$input['wt_menu_primary_color'] = wp_filter_nohtml_kses($input['wt_menu_primary_color']);
		$input['wt_menu_second_color'] = wp_filter_nohtml_kses($input['wt_menu_second_color']);		
		$input['wt_custom_css'] = wp_kses_stripslashes($input['wt_custom_css']);
		$input['wt_homepage_title'] = wp_filter_post_kses($input['wt_homepage_title']);		
		$input['wt_meta_keywords'] = wp_filter_post_kses($input['wt_meta_keywords']);
		$input['wt_meta_description'] = wp_filter_post_kses($input['wt_meta_description']);
		$input['wt_google_verification'] = wp_filter_post_kses($input['wt_google_verification']);
		$input['wt_bing_verification'] = wp_filter_post_kses($input['wt_bing_verification']);
		$input['wt_header_code'] = wp_kses_stripslashes($input['wt_header_code']);
		$input['wt_post_banner1'] = wp_kses_stripslashes($input['wt_post_banner1']);
		$input['wt_post_banner2'] = wp_kses_stripslashes($input['wt_post_banner2']);		
		$input['wt_footer_text_left'] = wp_kses_stripslashes($input['wt_footer_text_left']);
		$input['wt_footer_code'] = wp_kses_stripslashes($input['wt_footer_code']);		
					
		if ( ! isset( $input['wt_show_header_social'] ) )
			$input['wt_show_header_social'] = null;
		$input['wt_show_header_social'] = ( $input['wt_show_header_social'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['wt_show_slider'] ) )
			$input['wt_show_slider'] = null;
		$input['wt_show_slider'] = ( $input['wt_show_slider'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['wt_show_feat_section'] ) )
			$input['wt_show_feat_section'] = null;
		$input['wt_show_feat_section'] = ( $input['wt_show_feat_section'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['wt_show_feat_singlecats'] ) )
			$input['wt_show_feat_singlecats'] = null;
		$input['wt_show_feat_singlecats'] = ( $input['wt_show_feat_singlecats'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['wt_show_feat_postlist'] ) )
			$input['wt_show_feat_postlist'] = null;
		$input['wt_show_feat_postlist'] = ( $input['wt_show_feat_postlist'] == 1 ? 1 : 0 );
						
		if ( ! isset( $input['wt_hide_post_nav'] ) )
			$input['wt_hide_post_nav'] = null;
		$input['wt_hide_post_nav'] = ( $input['wt_hide_post_nav'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_post_img'] ) )
			$input['wt_hide_post_img'] = null;
		$input['wt_hide_post_img'] = ( $input['wt_hide_post_img'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_post_meta'] ) )
			$input['wt_hide_post_meta'] = null;
		$input['wt_hide_post_meta'] = ( $input['wt_hide_post_meta'] == 1 ? 1 : 0 );				
		
		if ( ! isset( $input['wt_hide_author_info'] ) )
			$input['wt_hide_author_info'] = null;
		$input['wt_hide_author_info'] = ( $input['wt_hide_author_info'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_post_social'] ) )
			$input['wt_hide_post_social'] = null;
		$input['wt_hide_post_social'] = ( $input['wt_hide_post_social'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_related_posts'] ) )
			$input['wt_hide_related_posts'] = null;
		$input['wt_hide_related_posts'] = ( $input['wt_hide_related_posts'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_page_author_info'] ) )
			$input['wt_hide_page_author_info'] = null;
		$input['wt_hide_page_author_info'] = ( $input['wt_hide_page_author_info'] == 1 ? 1 : 0 );	
				
		if ( ! isset( $input['wt_hide_page_meta'] ) )
			$input['wt_hide_page_meta'] = null;
		$input['wt_hide_page_meta'] = ( $input['wt_hide_page_meta'] == 1 ? 1 : 0 );	
				
		if ( ! isset( $input['wt_hide_page_social'] ) )
			$input['wt_hide_page_social'] = null;
		$input['wt_hide_page_social'] = ( $input['wt_hide_page_social'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_img_meta'] ) )
			$input['wt_hide_img_meta'] = null;
		$input['wt_hide_img_meta'] = ( $input['wt_hide_img_meta'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_img_comments'] ) )
			$input['wt_hide_img_comments'] = null;
		$input['wt_hide_img_comments'] = ( $input['wt_hide_img_comments'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_img_social'] ) )
			$input['wt_hide_img_social'] = null;
		$input['wt_hide_img_social'] = ( $input['wt_hide_img_social'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_archive_cat_info'] ) )
			$input['wt_hide_archive_cat_info'] = null;
		$input['wt_hide_archive_cat_info'] = ( $input['wt_hide_archive_cat_info'] == 1 ? 1 : 0 );	
		
		if ( ! isset( $input['wt_hide_archive_tag_info'] ) )
			$input['wt_hide_archive_tag_info'] = null;
		$input['wt_hide_archive_tag_info'] = ( $input['wt_hide_archive_tag_info'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['wt_hide_archive_author_info'] ) )
			$input['wt_hide_archive_author_info'] = null;
		$input['wt_hide_archive_author_info'] = ( $input['wt_hide_archive_author_info'] == 1 ? 1 : 0 );		
		
		if ( ! isset( $input['wt_show_single_meta'] ) )
			$input['wt_show_single_meta'] = null;
		$input['wt_show_single_meta'] = ( $input['wt_show_single_meta'] == 1 ? 1 : 0 );		
		
		if ( ! isset( $input['wt_exclude_cat_crawl'] ) )
			$input['wt_exclude_cat_crawl'] = null;
		$input['wt_exclude_cat_crawl'] = ( $input['wt_exclude_cat_crawl'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['wt_exclude_tag_crawl'] ) )
			$input['wt_exclude_tag_crawl'] = null;
		$input['wt_exclude_tag_crawl'] = ( $input['wt_exclude_tag_crawl'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['wt_exclude_archive_crawl'] ) )
			$input['wt_exclude_archive_crawl'] = null;
		$input['wt_exclude_archive_crawl'] = ( $input['wt_exclude_archive_crawl'] == 1 ? 1 : 0 );
		
		if ( ! isset( $input['wt_show_og_meta'] ) )
			$input['wt_show_og_meta'] = null;
		$input['wt_show_og_meta'] = ( $input['wt_show_og_meta'] == 1 ? 1 : 0 );		
				
		if ( !in_array($input['wt_sidebar_position'], array('left','right')) )
			$input['wt_sidebar_position'] = $options['wt_sidebar_position'];	
			
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 0 ) );
		$cat_ids = array();
		foreach( $categories as $category )
			$cat_ids[] = $category->term_id;
				
		if( !in_array( $input['wt_slider_category'], $cat_ids ) && ( $input['wt_slider_category'] != 0 ) )
			$input['wt_slider_category'] = $options['wt_slider_category'];
		
		if( !in_array( $input['wt_feat_section_list_cat'], $cat_ids ) && ( $input['wt_feat_section_list_cat'] != 0 ) )
			$input['wt_feat_section_list_cat'] = $options['wt_feat_section_list_cat'];
			
		if( !in_array( $input['wt_feat_section_post_cat'], $cat_ids ) && ( $input['wt_feat_section_post_cat'] != 0 ) )
			$input['wt_feat_section_post_cat'] = $options['wt_feat_section_post_cat'];
							
		if( !in_array( $input['wt_feat_singlecat1'], $cat_ids ) && ( $input['wt_feat_singlecat1'] != 0 ) )
			$input['wt_feat_singlecat1'] = $options['wt_feat_singlecat1'];
			
		if( !in_array( $input['wt_feat_singlecat2'], $cat_ids ) && ( $input['wt_feat_singlecat2'] != 0 ) )
			$input['wt_feat_singlecat2'] = $options['wt_feat_singlecat2'];
		
		if( !in_array( $input['wt_feat_postlist_cat'], $cat_ids ) && ( $input['wt_feat_postlist_cat'] != 0 ) )
			$input['wt_feat_postlist_cat'] = $options['wt_feat_postlist_cat'];			
							
		return $input;
		
	elseif( $reset ) :
		$input = wt_default_options();
		return $input;
		
	endif;
}

if ( ! function_exists( 'wt_get_option' ) ) :
/**
 * Used to output theme options is an elegant way
 * @uses get_option() To retrieve the options array
 */
function wt_get_option( $option ) {
	$options = get_option( 'wt_options', wt_default_options() );
	return isset($options[ $option ]) ?  $options[ $option ] : '';
}
endif;