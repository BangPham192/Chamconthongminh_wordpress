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
<div id="feat-single-cats" class="section">
	<div class="left-post col col-425">
			<?php							
				$cat1_id = wt_get_option('wt_feat_singlecat1');
				$cat1_name = get_cat_name($cat1_id);	
				$cat1_url = get_category_link($cat1_id );	
				
				$args1 = array(
					'cat' => $cat1_id,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => 3
				);				
				
			?>
						
			<h3 class="strong cat-title">
				<?php if ($cat1_id == 0){ 
					_e('Latest Posts', 'wellthemes');
				} else { ?>
					<a href="<?php echo esc_url( $cat1_url ); ?>" ><?php echo $cat1_name; ?></a>			
				<?php }	?>
			</h3>									
			
			<?php $query = new WP_Query( $args1 ); ?>
				<?php if ( $query -> have_posts() ) : ?>
					<?php $last_post  = $query -> post_count -1; ?>
					<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
						<?php if ( $query->current_post == 0 ) { ?>	
							<div class="main-post">								
								<?php get_template_part( 'content', 'excerpt' ); ?>									
							</div><!-- /main-post -->
					<?php } ?>
					<?php if ( $query->current_post == 1 ) { ?>	
						<div class="post-list">
					<?php } ?>
					
					<?php if ( $query->current_post >= 1 ) { ?>	
							<div class="item-post">
								<?php if ( has_post_thumbnail() ) {	?>								
									<div class="thumbnail overlay">
										<a href="<?php the_permalink(); ?>" >
											<?php the_post_thumbnail( 'wt-thumb-160_90' ); ?>
										</a>
									</div>
								<?php } ?>
								
								<div class="post-right col-250">
									<h5>
										<a href="<?php the_permalink() ?>">
											<?php 
												// display only first 55 characters in the title.	
												$short_title = mb_substr(the_title('','',FALSE),0, 55);
												echo $short_title; 
												if (strlen($short_title) > 55){ 
													echo '...'; 
												} 
											?>	
										</a>									
									</h5>
									<div class="entry-meta">
										<span class="author"><?php _e('Posted by ', 'wellthemes'); ?><?php the_author_posts_link(); ?></span>
										<span class="sep">-</span>
										<span class="date"><?php echo get_the_date(); ?></span>
									</div>
									<div class="entry-excerpt">
									<p>
										<?php 
											//display only first 60 characters in the excerpt.								
											$excerpt = get_the_excerpt();														
											echo mb_substr($excerpt,0, 60);									
											if (strlen($excerpt) > 60){ 
												echo '...'; 
											} 
										?>
									</p>
								</div>
								
								
								</div>
							</div>	
						<?php } ?>
					<?php if (( $query->post_count  > 1) AND ($query->current_post == $last_post )) { ?>					
					</div><!-- /post-list -->
				<?php } ?>	
						
					<?php endwhile; ?>
				<?php endif; ?>					
			<?php wp_reset_query();		//reset the query ?>
		</div><!--  /box-340 -->
		
		<div class="right-post col col-425 col-last">
			<?php	
				$cat2_id = wt_get_option('wt_feat_singlecat2');
				$cat2_name = get_cat_name($cat2_id);	
				$cat2_url = get_category_link($cat2_id );	
				
				$args = array(
					'cat' => $cat2_id,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'posts_per_page' => 3
				);	
			?>
			
			<h3 class="strong cat-title">
				<?php if ($cat2_id == 0){ 
					_e('Latest Posts', 'wellthemes');
				} else { ?>
					<a href="<?php echo esc_url( $cat2_url ); ?>" ><?php echo $cat2_name; ?></a>			
				<?php }	?>
			</h3>
				
									
			<?php $query = new WP_Query( $args ); ?>
				<?php if ( $query -> have_posts() ) : ?>
					<?php $last_post  = $query -> post_count -1; ?>
					<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
						<?php if ( $query->current_post == 0 ) { ?>	
							<div class="main-post">								
								<?php get_template_part( 'content', 'excerpt' ); ?>	
							</div><!-- /main-post -->
					<?php } ?>
					<?php if ( $query->current_post == 1 ) { ?>	
						<div class="post-list">
					<?php } ?>
					
					<?php if ( $query->current_post >= 1 ) { ?>	
							<div class="item-post">
								<?php if ( has_post_thumbnail() ) {	?>								
									<div class="thumbnail overlay">
										<a href="<?php the_permalink(); ?>" >
											<?php the_post_thumbnail( 'wt-thumb-160_90' ); ?>
										</a>
									</div>
								<?php } ?>
								
								<div class="post-right col-250">
									<h5>
										<a href="<?php the_permalink() ?>">
											<?php 
												// display only first 55 characters in the title.	
												$short_title = mb_substr(the_title('','',FALSE),0, 55);
												echo $short_title; 
												if (strlen($short_title) > 55){ 
													echo '...'; 
												} 
											?>	
										</a>									
									</h5>
									<div class="entry-meta">
										<span class="author"><?php _e('Posted by ', 'wellthemes'); ?><?php the_author_posts_link(); ?></span>
										<span class="sep">-</span>
										<span class="date"><?php echo get_the_date(); ?></span>
									</div>
									<div class="entry-excerpt">
									<p>
										<?php 
											//display only first 60 characters in the excerpt.								
											$excerpt = get_the_excerpt();														
											echo mb_substr($excerpt,0, 60);									
											if (strlen($excerpt) > 60){ 
												echo '...'; 
											} 
										?>
									</p>
								</div>
								
								
								</div>
							</div>	
						<?php } ?>
					<?php if (( $query->post_count  > 1) AND ($query->current_post == $last_post )) { ?>					
					</div><!-- /post-list -->
				<?php } ?>
					<?php endwhile; ?>
				<?php endif; ?>					
			<?php wp_reset_query();		//reset the query ?>
		</div>
</div>