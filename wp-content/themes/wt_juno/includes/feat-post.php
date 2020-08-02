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
<div id="feat-post-section" class="section">
	<div class="inner-box">
		<div class="post-list col col-230">
			<?php							
				$feat_list_title = wt_get_option('wt_feat_list_title');
				$cat1_id = wt_get_option('wt_feat_section_list_cat');
				
				$args1 = array(
					'cat' => $cat1_id,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => 3
				);	
			?>
			
			<?php if (!empty($feat_list_title)){ ?>
				<h3 class="cat-title"><?php echo $feat_list_title; ?></h3>
			<?php } ?>
			
			<?php $query = new WP_Query( $args1 ); ?>
				<?php if ( $query -> have_posts() ) : ?>
					<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
						<article class="item-post">
							
							<?php if ( has_post_thumbnail() ) {	?>
								<div class="thumbnail overlay">
									<a href="<?php the_permalink(); ?>" >
										<?php the_post_thumbnail( 'wt-thumb-300_130' ); ?>
									</a>
								</div>
							<?php } ?>
							
							<div class="cat-bullet"><?php wt_get_bullet_cats(); ?></div>
							<h4>								
								<a href="<?php the_permalink() ?>">
									<?php 
										// display only first 55 characters in the title.	
										$short_title = mb_substr(the_title('','',FALSE),0, 55);
										echo $short_title; 
										if (strlen($short_title) > 54){ 
											echo '...'; 
										} 
									?>	
								</a>
							</h4>	
									
							<div class="entry-meta">
								<?php 
									$is_review = get_overall_score(); 
									if ($is_review == false){ ?>
										<span class="author"><?php _e('Posted by ', 'wellthemes'); ?><?php the_author_posts_link(); ?></span>
										<span class="sep">-</span>
								<?php
									}	?>
								<span class="date"><?php echo get_the_date(); ?></span>							
							</div>
								
						</article>
					<?php endwhile; ?>
				<?php endif; ?>					
			<?php wp_reset_query();		//reset the query ?>
		</div><!--  /box-340 -->
		
		<div class="col col-620 col-last feat-post">
			<?php	
				$feat_post_title = wt_get_option('wt_feat_post_title');	
				$cat2_id = wt_get_option('wt_feat_section_post_cat');
				
				$args = array(
					'cat' => $cat2_id,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => 1
				);	
			?>
			
			<?php if (!empty($feat_post_title)){ ?>
				<h3 class="cat-title"><?php echo $feat_post_title; ?></h3>
			<?php } ?>			
									
			<?php $query = new WP_Query( $args ); ?>
				<?php if ( $query -> have_posts() ) : ?>
					<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
						<article class="single-col-post">
							
							<?php if ( has_post_thumbnail() ) {	?>
								<div class="thumbnail overlay">
									<a href="<?php the_permalink(); ?>" >
										<?php the_post_thumbnail( 'wt-post' ); ?>
									</a>
								</div>							
							<?php } ?>
							
							<header class="entry-header">							
								<div class="entry-meta">
									<span class="entry-cats"><?php wt_get_cats_bg(); ?></span>									
									<span class="author"><?php _e('Posted by ', 'wellthemes'); ?><?php the_author_posts_link(); ?></span>
									<span class="sep">-</span>
									<span class="date"><?php echo get_the_date(); ?></span>
									<?php get_overall_score(); ?>
								</div>					
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>							
							</header>
					
							<div class="entry-excerpt">							
								<?php the_excerpt(); ?>							
							</div>
							
							<footer class="entry-footer">
								<div class="read-more main-color-bg"><h5><a href="<?php the_permalink(); ?>"><?php _e('Read More', 'wellthemes'); ?></a></h5></div>
								<?php the_tags('<div class="tags"><span><span>Tags</span></span>',' ','</div>'); ?>	
								<?php if ( comments_open() ) : ?>
									<div class="comments">
										<?php if (get_comments_number() > 0) { ?>
											<span class="comment-count main-color-bg">
												<?php comments_popup_link( __('', 'wellthemes'), __( '1', 'wellthemes'), __('%', 'wellthemes')); ?>
											</span>
										<?php } ?>
										<span class="comment"><h5><a href="<?php comments_link(); ?>"><?php _e('Leave Comment', 'wellthemes'); ?></a></h5></span>
									</div>		
								<?php endif; ?>
							</footer>
								
						</article>
					<?php endwhile; ?>
				<?php endif; ?>					
			<?php wp_reset_query();		//reset the query ?>
		</div>
	</div>		
</div>