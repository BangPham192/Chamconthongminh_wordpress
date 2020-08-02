<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package  WellThemes
 * @file     index.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>
<?php get_header(); ?>

<?php
	$sidebar_position = "";	
	$content_class = "";
	$sidebar_position = wt_get_option( 'wt_sidebar_position' );	
	if ( $sidebar_position == "left" ){
		$content_class ="content-right";
	}	
?>
<div id="content" class="<?php echo $content_class; ?>">
	<?php
		if (is_home() && $paged < 2 ){
		
			//include slider
			if ( wt_get_option( 'wt_show_slider' ) == 1 ) {
				get_template_part( 'includes/feat-slider' );
			}
			
			//include featured post
			if ( wt_get_option( 'wt_show_feat_section' ) == 1 ) {
				get_template_part( 'includes/feat-post' );
			}
			
			//include featured categories
			if ( wt_get_option( 'wt_show_feat_singlecats' ) == 1 ) {
				get_template_part( 'includes/feat-singlecats' );
			}
		
		}
		
		
		//include posts list
		if ( wt_get_option( 'wt_show_feat_postlist' ) == 1 ) {
			get_template_part( 'includes/feat-postlist' );
		}
	?>
		
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>