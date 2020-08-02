<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package  WellThemes
 * @file     sidebar.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
 ?> 
<?php
	$sidebar_name ="";	
	
	if ( is_home() ){	
		$homepage_sidebar = wt_get_option( 'wt_home_sidebar' );
		$sidebar_name = sanitize_title( $homepage_sidebar );		
	} elseif ( is_single() ){
		$single_post_sidebar = get_post_meta($post->ID, 'wt_meta_post_sidebar_name', true);
		$sidebar_name = sanitize_title($single_post_sidebar);
		
		if (empty( $sidebar_name)){
			$single_post_sidebar = wt_get_option( 'wt_single_post_sidebar' );
			$sidebar_name = sanitize_title( $single_post_sidebar );	
		}	
		
	} elseif( is_page() ){
		
		$single_page_sidebar = get_post_meta($post->ID, 'wt_meta_post_sidebar_name', true);
		$sidebar_name = sanitize_title($single_page_sidebar);
		
		if (empty( $sidebar_name)){
			$single_page_sidebar = wt_get_option( 'wt_single_page_sidebar' );
			$sidebar_name = sanitize_title( $single_page_sidebar );	
		}
		
	} elseif ( is_category() ){
		$category_sidebar = wt_get_option( 'wt_category_sidebar' );
		$sidebar_name = sanitize_title( $category_sidebar );	
	} elseif ( is_archive() ){
		$archive_sidebar = wt_get_option( 'wt_archive_sidebar' );
		$sidebar_name = sanitize_title( $archive_sidebar );
	} else {
		$sidebar_name = 'sidebar-1';
	}
	
	if ( empty($sidebar_name) ){
		$sidebar_name = 'sidebar-1';
	}
	
	//sidebar position
	$sidebar_position = "";	
	$sidebar_position = wt_get_option( 'wt_sidebar_position');
	
	if ( (is_single() ) OR (is_page())){
		
		$sidebar_position = get_post_meta($post->ID, 'wt_meta_post_sidebar_position', true);
		if (($sidebar_position == "") OR ($sidebar_position == "default")){
			$sidebar_position = wt_get_option( 'wt_sidebar_position' );		
		}		
	}
	
	$sidebar_class = "";
	if ($sidebar_position == "left"){
		$sidebar_class = " class='sidebar-left'";
	} 
		
	if ($sidebar_position != "none"){?>
	
	<div id="sidebar"<?php echo $sidebar_class; ?>>
		<?php dynamic_sidebar( $sidebar_name );	 ?>
	</div><!-- /sidebar -->
<?php } ?>