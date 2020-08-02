<?php
/**
 * The template for displaying the single column featured categories.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  WellThemes
 * @file     feat-post.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>
<div id="feat-postlist" class="section">
	<?php if (is_home() && $paged < 2 ){ ?>
		<h3 class="strong archive-title">
			<?php _e('Latest Posts', 'wellthemes'); ?>		
		</h3>
	<?php } ?>
			
	<div class="archive-postlist">
		<?php							
			$cat_id = wt_get_option('wt_feat_postlist_cat');
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
			$args = array(
				'cat' => $cat_id,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				 'paged' => $paged
			);			
		?>
		<?php $i = 0; ?>
		<?php $wp_query = new WP_Query( $args ); ?>
			<?php if ( $wp_query -> have_posts() ) : ?>
				<?php while ( $wp_query -> have_posts() ) : $wp_query -> the_post(); ?>
					<?php								
						$post_class ="";
						if ( $i % 2 == 1 ){
							$post_class =" col-last";							
						}					
					?>								
					<div class="col col-425<?php echo $post_class; ?>">
						<?php get_template_part( 'content', 'excerpt' ); ?>
					</div>
					<?php $i++; ?>
				<?php endwhile; ?>
			<?php endif; ?>		
	</div>
	<?php wt_pagination(); ?>
	<?php wp_reset_query();?>	
</div>