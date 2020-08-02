<?php
/**
 * Template Name: Blog
 * Description: A Page Template to display bloag archives with the sidebar.
 *
 * @package  WellThemes
 * @file     page-blog.php
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
<div id="content" class="archive post-archive<?php echo $content_class; ?>">
	<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts("paged=$paged");
	?>	
		<header class="archive-header">
			<h3 class="archive-title"><?php the_title(); ?></h3>			
		</header><!-- /archive-header -->
			
			<?php if ( have_posts() ) : ?>
				<div class="archive-postlist">
					<?php $i = 0; ?>				
					<?php while ( have_posts() ) : the_post(); ?>
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
				</div>
				<?php wt_pagination(); ?>
				<?php wp_reset_query();?>
				<?php else : ?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php _e( 'Nothing Found', 'wellthemes' ); ?></h1>
							</header><!-- /entry-header -->

							<div class="entry-content">
								<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'wellthemes' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- /entry-content -->
						</article><!-- /post-0 -->

					<?php endif; ?>
	</div><!-- /content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>