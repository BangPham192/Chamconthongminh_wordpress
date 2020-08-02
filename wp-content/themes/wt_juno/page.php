<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package  WellThemes
 * @file     page.php
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
<div id="content" class="single-page <?php echo $content_class; ?>">
	
	<?php if (have_posts()) : ?>
		<?php while ( have_posts() ) : the_post(); ?>				
			<?php get_template_part( 'content', 'page' ); ?>
			<?php comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>
	<?php endif ?>	

</div><!-- /content -->

<?php get_sidebar(); ?>	
<?php get_footer(); ?>