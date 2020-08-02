<?php
/**
 * The Theme Option Functions page
 *
 * This page is implemented using the Settings API.
 * 
 * @package  WellThemes
 * @file     option-functions.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */


/**
 * Set custom RSS feed links.
 *
 */
$options = get_option('wt_options');
	
function wt_custom_feed( $output, $feed ) {

	$options = get_option('wt_options');
	$url = $options['wt_rss_url'];	
	
	if ( $url ) {
		$outputarray = array( 'rss' => $url, 'rss2' => $url, 'atom' => $url, 'rdf' => $url, 'comments_rss2' => '' );
		$outputarray[$feed] = $url;
		$output = $outputarray[$feed];
	}
	return $output;
}
add_filter( 'feed_link', 'wt_custom_feed', 1, 2 );

/**
 * Set custom Favicon.
 *
 */
function wt_custom_favicon() {
	$options = get_option('wt_options');
	$favicon_url = $options['wt_favicon'];	
	
    if (!empty($favicon_url)) {
		echo '<link rel="shortcut icon" href="'. $favicon_url. '" />	'. "\n";
	}
}
add_action('wp_head', 'wt_custom_favicon');


/**
 * Set apple touch icon.
 *
 */
function wt_apple_touch() {
	$options = get_option('wt_options');
	$apple_touch = $options['wt_apple_touch'];	
	
    if (!empty($apple_touch)) {
		echo '<link rel="apple-touch-icon" href="'. $apple_touch. '" />	'. "\n";
	}
}
add_action('wp_head', 'wt_apple_touch');


/**
 * Set SEO options.
 *
 */
function wt_seo_options() {
	global $post;
	$options = get_option('wt_options');
	$wt_meta_title = $options['wt_homepage_title'];
	$wt_meta_description = $options['wt_meta_description'];
	$wt_meta_keywords = $options['wt_meta_keywords'];
	$wt_show_single_meta = $options['wt_show_single_meta'];	
	$wt_google_verification = $options['wt_google_verification'];
	$wt_bing_verification = $options['wt_bing_verification'];	
	$wt_exclude_cat_crawl = $options['wt_exclude_cat_crawl'];
	$wt_exclude_tag_crawl = $options['wt_exclude_tag_crawl'];
	$wt_exclude_archive_crawl = $options['wt_exclude_archive_crawl'];
	$wt_show_og_meta = $options['wt_show_og_meta'];	
	
	if ((is_home()) AND (!empty($wt_meta_title))){
		echo '<meta name="title" content="'. $wt_meta_title .'"  />' . "\n";
	}
	
	if ((is_home()) AND (!empty($wt_meta_description))){
		echo '<meta name="description" content=" '. $wt_meta_description .'"  />' . "\n";
	}
	
	if ((is_home()) AND (!empty($wt_meta_keywords))){
		echo '<meta name="keywords" content=" '. $wt_meta_keywords .'"  />' . "\n";
	}
	
	if ((is_home()) AND (!empty($wt_google_verification))){
		echo '<meta name="google-site-verification" content="' . $wt_google_verification . '" />' . "\n";
	}
	
	if ((is_home()) AND (!empty($wt_bing_verification))){
        echo '<meta name="msvalidate.01" content="' . $wt_bing_verification . '" />' . "\n";
	}
	
	if ((is_category()) AND ($wt_exclude_cat_crawl == 1 )){
		echo "<meta name=\"robots\" content=\"noindex,follow\">";
	}
	
	if ((is_tag()) AND ($wt_exclude_tag_crawl == 1 )){
		echo "<meta name=\"robots\" content=\"noindex,follow\">";
	}
	
	if ((is_archive()) AND ($wt_exclude_archive_crawl == 1 )){
		echo "<meta name=\"robots\" content=\"noindex,follow\">";
	}
	
	if ((is_single()) AND ($wt_show_single_meta == 1)){
		setup_postdata($post);
		$full_excerpt = get_the_excerpt();													
			
		$excerpt = mb_substr($full_excerpt,0, 150);									
		if (strlen($full_excerpt) > 150){
			$excerpt = $excerpt.'...';	
		}
		
		echo '<meta name="title" content="'. get_the_title() .'"  />' . "\n";
		echo '<meta name="description" content=" '. $excerpt .'"  />' . "\n";
	}
	
	if ($wt_show_og_meta == 1){
		if (is_single()) { 
			setup_postdata($post);
			$full_excerpt = get_the_excerpt();														
			
			$excerpt = mb_substr($full_excerpt,0, 150);									
			if (strlen($full_excerpt) > 150){
				$excerpt = $excerpt.'...';	
			} 
			
										
		?>  
<meta property="og:url" content="<?php the_permalink() ?>"/>  
<meta property="og:title" content="<?php the_title(); ?>" />  
<meta property="og:description" content="<?php echo $excerpt; ?>" />  
<meta property="og:type" content="article" />  
<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); }?>" />  
	<?php } else { ?>  
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />  
<meta property="og:description" content="<?php bloginfo('description'); ?>" />  
	<?php }	
	}	
}

add_action('wp_head', 'wt_seo_options');

/**
 * Add code in the header.
 *
 */
function wt_header_code() {
    $options = get_option('wt_options');
	$wt_header_code = $options['wt_header_code'];
    if (!empty($wt_header_code)) {
        echo $wt_header_code;
	}
}
add_action('wp_head', 'wt_header_code');


/**
 * Add code in the footer.
 *
 */
function wt_footer_code() {
    $options = get_option('wt_options');
	$wt_footer_code = $options['wt_footer_code'];
    if (!empty($wt_footer_code)) {
        echo $wt_footer_code;
	}
}
add_action('wp_footer', 'wt_footer_code');

/**
 * Get Google Fonts
 *
 */ 
function wt_get_google_fonts() {
	include( get_template_directory() . '/framework/settings/google-fonts.php' );
	$google_font_array = json_decode ($google_api_output,true) ;
	$items = $google_font_array['items'];
	
	$fonts_list = array();

	$fontID = 0;
	foreach ($items as $item) {
		$fontID++;
		$variants='';
		$variantCount=0;
		foreach ($item['variants'] as $variant) {
			$variantCount++;
			if ($variantCount>1) { $variants .= '|'; }
			$variants .= $variant;
		}
		$variantText = ' (' . $variantCount . ' Varaints' . ')';
		if ($variantCount <= 1) $variantText = '';
		$fonts_list[ $item['family'] . ':' . $variants ] = $item['family']. $variantText;
	}
	return $fonts_list;
}

function wt_get_font($font_string) {
	if ($font_string) {
		$font_pieces = explode(":", $font_string);			
		$font_name = $font_pieces[0];
	
		return $font_name;
	}
}

function wt_get_rgb_color($color){
			
		if ( $color[0] == '#' ) {
                $color = substr( $color, 1 );
        }
        if ( strlen( $color ) == 6 ) {
                list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return false;
        }
		
		$r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        
		
		$rgb =$r.','.$g.','.$b;
		return $rgb;       
}

/**
 * Set custom CSS styles
 */ 
function wt_custom_styles(){
	$options = get_option('wt_options');
	
	$wt_custom_style = '';
		
	//text styles
	$text_fontsize = $options['wt_text_fontsize'];
	$text_lineheight = $options['wt_text_lineheight'];
	
	$raw_text_style = $options['wt_text_fontstyle'];
	$formatted_text_style = wt_set_font_style($raw_text_style);
	$wt_text_font_string = $options['wt_text_font_name'];
	$wt_text_color = $options['wt_text_color'];   
	
	if ((!empty ($text_fontsize)) or (!empty ($text_style)) or (!empty ($text_lineheight))  or (!empty ($wt_text_font_string))  or (!empty($wt_bg_style)) or (!empty($wt_text_color)) ){
		$wt_custom_style .= "body{\n" ;
		
		if ( !empty ($text_fontsize) ) {
			$wt_custom_style .= "	font-size: " .$text_fontsize. ";\n";
		}
			
		if ( !empty ($formatted_text_style) ) {
			$wt_custom_style .= $formatted_text_style."\n";
		}
			
		if ( !empty ($text_lineheight) ) {
			$wt_custom_style .= "	line-height: " .$text_lineheight. ";\n";
		}
			
		if (!empty($wt_text_font_string)){
			wt_enqueue_font( $wt_text_font_string ) ;
			$font_name = wt_get_font($wt_text_font_string);
			$wt_custom_style .= "	font-family: " .$font_name. ", sans-serif, serif;\n";
		}
		
		if (!empty($wt_text_color) ){
			$wt_custom_style .= "	color: " .$wt_text_color. ";\n";
		}
		
		if (!empty($wt_bg_style) ){
			$wt_custom_style .= "	background: " .$wt_bg_style. ";\n";
		}			
			
		$wt_custom_style .="}\n\n";
	}
	
	//heading styles
	for ($i = 1; $i < 7; $i++){ 
		$raw_font_style = $options['wt_h'.$i.'_fontstyle'];
		$formatted_font_style = wt_set_font_style($raw_font_style);
				
		$font_size = $options['wt_h'.$i.'_fontsize'];
		$font_style = $formatted_font_style;
		$font_lineheight = $options['wt_h'.$i.'_lineheight'];
		$font_marginbottom = $options['wt_h'.$i.'_marginbottom'];
		
		if ((!empty ($font_size)) or (!empty ($font_style)) or (!empty ($font_lineheight)) or (!empty ($font_marginbottom))){
			$wt_custom_style .= "h".$i."{\n" ;
			if ( !empty ($font_size) ) {
				$wt_custom_style .= "	font-size: " .$font_size. ";\n";
			}
			
			if ( !empty ($font_style) ) {
				$wt_custom_style .= $font_style."\n";
			}
				
			if ( !empty ($font_lineheight) ) {
				$wt_custom_style .= "	line-height: " .$font_lineheight. ";\n";
			}
			
			if ( !empty ($font_marginbottom) ) {
				$wt_custom_style .= "	margin-bottom: " .$font_marginbottom. ";\n";
			}				
				
			$wt_custom_style .="}\n\n";	
		}
	}	
		
	//headings font and color	
	$wt_headings_font_string = $options['wt_headings_font_name'];
			
	if (!empty($wt_headings_font_string)){
		$wt_custom_style .= "h1, h2, h3, h4, h5, h6 {\n";
		
		if (!empty($wt_headings_font_string)){
			wt_enqueue_font( $wt_headings_font_string ) ;
			$font_name = wt_get_font($wt_headings_font_string);
			$wt_custom_style .= "    font-family: ".$font_name.", sans-serif, serif;\n";	
		}
			
		$wt_custom_style .= "}\n\n";
	}
	
	//links color
	$wt_links_color = $options['wt_links_color'];	
	if (!empty($wt_links_color)){	
		$wt_custom_style .= "#slider-main .entry-header h2 a {\n    color: ".$wt_links_color.";\n}\n\n";	
		$wt_custom_style .= "a:link {\n    color: ".$wt_links_color.";\n}\n\n";	
		$wt_custom_style .= "a:visited {\n    color: ".$wt_links_color.";\n}\n\n";		
	}
	
	//links hover color
	$wt_links_hover_color = $options['wt_links_hover_color'];
	if (!empty($wt_links_hover_color)){
		$wt_custom_style .= "a:hover, \n .entry-meta a:hover {\n    color: ".$wt_links_hover_color.";\n}\n\n";	
	}
		
	//custom css field
	$wt_custom_css_field = $options['wt_custom_css'];
	if (!empty($wt_custom_css_field)){
		$wt_custom_style .= $wt_custom_css_field;	
	}
	
	//set menu colors
	$wt_menu_primary_color = '';
	$wt_menu_second_color = '';
		
	if (isset($options['wt_menu_primary_color'])){
		$wt_menu_primary_color = $options['wt_menu_primary_color'];
	}
	
	if (isset($options['wt_menu_second_color'])){
		$wt_menu_second_color = $options['wt_menu_second_color'];
	}	
	
	if (!empty($wt_menu_primary_color)){
		$wt_custom_style .= "#main-menu,\n  #main-menu ul li ul li a,\n #main-menu ul li:hover ul li a,\n #main-menu ul li.over ul li a,\n #main-menu ul li ul li:hover ul li a,\n #main-menu ul li ul li.over ul li a{ \n    background: ".$wt_menu_primary_color." \n}\n\n";	
	}
	
	if (!empty($wt_menu_second_color)){
		$wt_custom_style .= "#main-menu{ \n    border-bottom: 4px solid ".$wt_menu_second_color." \n}\n\n";	
		$wt_custom_style .= "#main-menu .current-menu-item,\n #main-menu .current_page_item,\n #main-menu ul li a:hover,\n #main-menu ul li ul li:hover a,\n #main-menu ul li ul li.over a,\n #main-menu ul li ul li ul li a:hover{ \n    background: ".$wt_menu_second_color." \n}\n\n";	
	}	
	
	//set primary color
	$wt_primary_color = $options['wt_primary_color'];
	
	if (!empty($wt_primary_color)){
		
		$wt_custom_style .= ".main-color,\n .entry-meta .author a,\n .entry-content a{ \n    color: ".$wt_primary_color." \n}\n\n";
		$wt_custom_style .= ".main-color-bg,\n .pagination a:hover,\n .pagination .current,\n .review-container .review-header,\n .review-stars div,\n #respond input[type=submit],\n .tagcloud a,\n .pagination-links li a,\n .entry-footer .tags a:hover{ \n    background-color: ".$wt_primary_color." \n}\n\n";
		$wt_custom_style .= ".widget_tabs .widget-tabs-title-container ul li:hover:after,\n .widget_tabs .widget-tabs-title-container ul li.active:after{ \n    border-color: ".$wt_primary_color." #FFFFFF\n}\n\n";
		$wt_custom_style .= ".post-nav,\n #comments h3.comments-title{ \n    border-bottom: 5px solid ".$wt_primary_color." \n}\n\n";
		$wt_custom_style .= "#footer{ \n    border-top: 10px solid ".$wt_primary_color." \n}\n\n";
	}
	
	wp_add_inline_style('wt-style', $wt_custom_style);
}
add_action( 'wp_enqueue_scripts', 'wt_custom_styles' );


/**
 * Set font styles
 */ 
function wt_set_font_style($fontstyle){
	$stack = '';
		
	switch ( $fontstyle ) {

		case "normal":
			$stack .= "";
		break;
		case "italic":
			$stack .= "    font-style: italic;";
		break;
		case 'bold':
			$stack .= "    font-weight: bold;";
		break;
		case 'bold-italic':
			$stack .= "    font-style: italic;\n    font-weight: bold;";
		break;
	}
	return $stack;
}

/**
 * Include Google fonts
 */ 
function wt_enqueue_font($wt_text_font_string){

	$font_pieces = explode(":", $wt_text_font_string);
	$font_name = $font_pieces[0];
	$font_name = str_replace (" ","+", $font_pieces[0] );
				
	$font_variants = $font_pieces[1];
	$font_variants = str_replace ("|",",", $font_pieces[1] );

	wp_enqueue_style( $font_name , 'http://fonts.googleapis.com/css?family='.$font_name . ':' . $font_variants );
}

/**
 * Include Google fonts
 */ 


add_action( 'widgets_init', 'wt_add_sidebar' );
function wt_add_sidebar() {
	$options = get_option('wt_options');
	
	$sidebars = "";
	if (isset($options['wt_custom_sidebars'])){
		$sidebars = $options['wt_custom_sidebars'];
	}
	
	if($sidebars){
		foreach ($sidebars as $sidebar) {
			register_sidebar( array(
				'name' => $sidebar,
				'id' => sanitize_title($sidebar),
				'description' => __( 'Wellthemes custom sidebar', 'wellthemes' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h4>',
				'after_title' => '</h4>'
			) );
		}
	}
}
?>