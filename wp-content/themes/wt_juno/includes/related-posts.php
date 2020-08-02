<?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$tag_ids = array();
	foreach($tags as $single_tag) $tag_ids[] = $single_tag->term_id;

	$args=array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
		'showposts'=> 4, //number of related posts
		'ignore_sticky_posts'=> 1
	);	
	
} else {

	$categories = get_the_category($post->ID);
	
	if ($categories) {
		$category_ids = array();
		foreach($categories as $single_category) $category_ids[] = $single_category->term_id;

		$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'showposts'=> 4,  //number of related posts
			'ignore_sticky_posts'=>1
		);
		
	}
}

if($args){

	$my_query = new wp_query($args);
	
	if( $my_query->have_posts() ) {	?>
		<div class="related-posts">
			<h3><?php _e('Related Posts', 'wellthemes'); ?></h3>
			<ul class="list">
				<?php		
					while ($my_query->have_posts()) {
						$my_query->the_post();	?>
						<li>
							<?php if ( has_post_thumbnail() ) {	?>
								<div class="thumbnail overlay">
									<a href="<?php the_permalink(); ?>" >
										<?php the_post_thumbnail( 'wt-thumb-300_130' ); ?>
									</a>
								</div>
							<?php } ?>
							<div class="cat-bullet"><?php wt_get_first_cat(); ?></div>
							
							<h5>								
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
							</h5>	
									
							<div class="entry-meta">
								<?php get_overall_score();  ?>
								<span class="date"><?php echo get_the_date(); ?></span>									
							</div>				
						</li>
					<?php
					}		
				?>
			</ul>		
		</div>		
		<?php		
	}
	wp_reset_query();	
}

?>