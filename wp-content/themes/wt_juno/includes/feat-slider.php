<?php
/**
 * The template for displaying the featured slider on homepage.
 * Gets the category for the posts from the theme options. 
 * If no category is selected, displays the latest posts.
 *
 * @package  WellThemes
 * @file     feat-slider.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 * 
 **/
?>
<?php		
	$cat_id = wt_get_option('wt_slider_category');	//get category id

	$args = array(
		'cat' => $cat_id,
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => 5
	);
		
?>
<div id="wt-slider">	
	<ul class="slides">
		<?php $query = new WP_Query( $args ); ?>
			<?php if ( $query -> have_posts() ) : ?>
				<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
						<?php if ( has_post_thumbnail()) { ?>				
								<li>
									<a href="<?php the_permalink(); ?>" >
										<?php the_post_thumbnail( 'wt-slider' ); ?>
									</a>
										
									<div class="post-info">
										<div class="entry-meta">											
											<span class="entry-cats"><?php wt_get_first_cat_bg(); ?></span>
										</div>
										
										<div class="title">
											<h3>
												<a href="<?php the_permalink() ?>">
													<?php 
														//display only first 30 characters in the title.	
														$short_title = mb_substr(the_title('','',FALSE),0, 30);
														echo $short_title; 
														if (strlen($short_title) > 29){ 
															echo '...'; 
														} 
													?>	
												</a>
											</h3>
										</div>								
										
										<div class="post-excerpt">
											<?php 
												$excerpt = get_the_excerpt();
												echo mb_substr($excerpt,0, 150);
												if (strlen($excerpt) > 149){ 
													echo '...'; 
												}
											?>
										</div>
										
										<div class="more">
											<span class="sep main-color-bg">&nbsp;</span>
											<span class="link main-color-bg"><h5><a href="<?php the_permalink() ?>"><?php _e('Read more', 'wellthemes'); ?></a></h5></span>
										</div>
																	
									</div>	
										
								</li>							
						<?php } ?>
				<?php endwhile; ?>
			<?php endif;?>
		<?php wp_reset_query();?>				
	</ul>
	<div class="slider-nav"></div>
</div>