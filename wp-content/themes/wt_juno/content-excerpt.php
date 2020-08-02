<?php
/**
 * The template for displaying content in the archive and search results template
 *
 * @package  WellThemes
 * @file     content-excerpt.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	
	<?php if ( has_post_thumbnail() ) {	?>
		<div class="thumbnail overlay">
			<a href="<?php the_permalink(); ?>" >
				<?php the_post_thumbnail( 'wt-img-425_225' ); ?>
			</a>
			<div class="cat-bullet"><?php wt_get_bullet_cats(); ?></div>
		</div>		
		
	<?php } ?>
	
	<header class="entry-header">							
		<div class="entry-meta">
			<span class="author"><?php _e('Posted by ', 'wellthemes'); ?><?php the_author_posts_link(); ?></span>
			<span class="sep">-</span>
			<span class="date"><?php echo get_the_date(); ?></span>
			<?php get_overall_score(); ?>																
		</div>
		
		<h3>								
			<a href="<?php the_permalink() ?>">
				<?php 
					// display only first 65 characters in the title.	
					$short_title = mb_substr(the_title('','',FALSE),0, 65);
					echo $short_title; 
					if (strlen($short_title) > 65){ 
						echo '...'; 
					} 
				?>	
			</a>
		</h3>
	</header>
	
	<div class="entry-excerpt">
		<p>
			<?php 
				//display only first 230 characters in the excerpt.								
				$excerpt = get_the_excerpt();														
				echo mb_substr($excerpt,0, 230);									
				if (strlen($excerpt) > 230){ 
					echo '...'; 
				} 
			?>
		</p>
	</div>
	
	<footer class="entry-footer">
		<div class="read-more main-color-bg"><h5><a href="<?php the_permalink(); ?>"><?php _e('Read More', 'wellthemes'); ?></a></h5></div>
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
	
</article><!-- /post-<?php the_ID(); ?> -->
