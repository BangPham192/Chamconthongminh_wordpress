<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package  WellThemes
 * @file     404.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */

?>
<?php get_header(); ?>

<div id="content" class="full-content error-page">
	
	<div class="error-page-wrap">
		<div class="col col-290">
			<h1>404</h1>
			<h2><?php _e('Page not found', 'wellthemes');?></h2>
		</div>
		
		<div class="col col-620 col-last">
			<h4><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'wellthemes' ); ?></h4>
			<?php get_search_form(); ?>
			<?php the_widget('WP_Widget_Recent_Posts', array('number' => 3, 'title' => ' '), array('before_title' => '', 'after_title' => '')); ?>
		</div>
	</div>
</div><!-- /content -->

<?php get_footer(); ?>