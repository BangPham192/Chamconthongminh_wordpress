<?php
/**
 * The Template for displaying all single posts.
 *
 * @package  WellThemes
 * @file     single.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>
<?php get_header(); ?>

<?php
	$content_class = "";
	$sidebar_position = get_post_meta($post->ID, 'wt_meta_post_sidebar_position', true);	
	if (($sidebar_position == "") OR ($sidebar_position == "default")){
		$sidebar_position = wt_get_option( 'wt_sidebar_position' );		
	}
	
	if ( $sidebar_position == "left" ){
		$content_class =" content-right";
	}
		
	if ( $sidebar_position == "none" ){
		$content_class =" content-full";
	}
	
?>

<div id="content" class="single-post <?php echo $content_class; ?>">
	
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'single' ); ?>
		<?php comments_template( '', true ); ?>		
	<?php endwhile; // end of the loop. ?>
		
</div><!-- /content -->

<?php get_sidebar(); ?>	
<?php get_footer(); ?>