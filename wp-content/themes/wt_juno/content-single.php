<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package  WellThemes
 * @file     content-single.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">	
		<?php
			$hide_post_nav = get_post_meta($post->ID, 'wt_meta_post_hide_nav', true);			
			if ($hide_post_nav != 1) {		
				if ( wt_get_option( 'wt_hide_post_nav' ) == 1 ){
					$hide_post_nav = 1;
				}				
			} else{
				$hide_post_nav = 1;
			}			
			
			if ( $hide_post_nav  != 1 ){ ?>
				<div class="post-nav">
					<?php previous_post_link('<div class="prev-post"><span class="icon main-color-bg"></span><span class="link"><h5>%link</h5></span></div>', __('Previous Post', 'wellthemes')); ?>
					<?php next_post_link('<div class="next-post"><span class="link"><h5>%link</h5></span><span class="icon main-color-bg"></span></div>', __('Next Post', 'wellthemes')); ?>
				</div>
		<?php } ?>
			
		<?php
			$hide_post_img = get_post_meta($post->ID, 'wt_meta_post_hide_img', true);			
			if ($hide_post_img != 1) {		
				if ( wt_get_option( 'wt_hide_post_img' ) == 1 ){
					$hide_post_img = 1;
				}				
			} else{
				$hide_post_img = 1;
			}
		
			if ( $hide_post_img  != 1 ){ ?>
				<div class="thumbnail single-post-thumbnail"><?php the_post_thumbnail( 'wt-slider' ); ?></div>			
		<?php }	?>
		
		<?php
			$hide_post_meta = get_post_meta($post->ID, 'wt_meta_post_hide_meta', true);			
			if ($hide_post_meta != 1) {		
				if ( wt_get_option( 'wt_hide_post_meta' ) == 1 ){
					$hide_post_meta = 1;
				}				
			} else{
				$hide_post_meta = 1;
			}				
				
			if ( $hide_post_meta  != 1 ){ ?>
				<div class="entry-meta">
					<span class="entry-cats"><?php wt_get_cats_bg(); ?></span>									
					<span class="author"><?php _e('Posted by ', 'wellthemes'); ?><?php the_author_posts_link(); ?></span>
					<span class="sep">-</span>
					<span class="date"><?php echo get_the_date(); ?></span>
					<?php get_overall_score(); ?>
				</div>
		<?php } ?>		
		
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
	</header><!-- /entry-header -->
	
	<?php		
		$post_banner1 = get_post_meta($post->ID, 'wt_meta_post_banner1', true);			
		if ($post_banner1 == "") {		
			if ( wt_get_option( 'wt_post_banner1' ) != "" ){
				$post_banner1 = wt_get_option( 'wt_post_banner1' );
			}				
		}
		
		if ($post_banner1 != ""){ ?>
			<div class="entry-ad">
				<div class="inner-wrap">
					<?php echo $post_banner1; ?>
				</div>			
			</div><?php 
		}	
	?>
	<div class="entry-content-wrap">		
		
		<div class="entry-content">	
			<?php
				$show_review = get_post_meta($post->ID, 'wt_meta_post_show_review', true);	
				if ( $show_review  == 1 ){ ?>
					<div class="review-container">
						<?php wt_show_review();	?>
					</div>
			<?php } ?>
			
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'wellthemes' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- /entry-content -->
		
	</div><!-- /entry-content-wrap -->
	
	<div class="entry-footer">
		<?php the_tags('<div class="tags"><span><span>Tags</span></span>',' ','</div>'); ?>	
	</div>
	<?php		
		$post_banner2 = get_post_meta($post->ID, 'wt_meta_post_banner2', true);			
		if ($post_banner2 == "") {		
			if ( wt_get_option( 'wt_post_banner2' ) != "" ){
				$post_banner2 = wt_get_option( 'wt_post_banner2' );
			}	
		}
		
		if ($post_banner2 != ""){ ?>
			<div class="entry-ad">
				<div class="inner-wrap">
					<?php echo $post_banner2; ?>
				</div>
			</div><?php 
		}	
	?>
	
</article><!-- /post-<?php the_ID(); ?> -->

<?php
	$hide_author_info = get_post_meta($post->ID, 'wt_meta_post_hide_author', true);			
	if ($hide_author_info != 1) {		
		if ( wt_get_option( 'wt_hide_author_info' ) == 1 ){
			$hide_author_info = 1;
		}				
	} else{
		$hide_author_info = 1;
	}
	
	if ( $hide_author_info != 1 ) { ?>
		<div class="entry-author">	
			<div class="author-header main-color-bg">
				<h4 class="title"><?php printf( __( 'About %s', 'wellthemes' ), get_the_author() ); ?></h4>
			</div>
			<div class="author-wrap">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
				</div>			
				<div class="author-description">					
					<?php the_author_meta( 'description' ); ?>
					<div class="author-link">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'wellthemes' ), get_the_author() ); ?>
						</a>
					</div>
				</div>
			</div>
		</div><!-- /entry-author -->		
<?php } //endif; ?>
		
<?php 

	$hide_social_links = get_post_meta($post->ID, 'wt_meta_post_hide_social', true);	
	
	if ($hide_social_links != 1) {		
		if ( wt_get_option( 'wt_hide_post_social' ) == 1 ){
			$hide_social_links = 1;
		}				
	} else{
		$hide_social_links = 1;
	}	
	
	if ( $hide_social_links != 1 ) { ?>
	
	<div class="entry-social">	
		<?php
			$full_excerpt = get_the_excerpt();														
			
			$excerpt = mb_substr($full_excerpt,0, 150);									
			if (strlen($full_excerpt) > 150){
				$excerpt = $excerpt.'...';	
			} 
			
			$thumbnail = "";
			if (has_post_thumbnail() ){
				 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
				 $thumbnail = $image[0];
			}
		?>
		
		<div class="fb">
			<a href="http://facebook.com/share.php?u=<?php the_permalink() ?>&amp;t=<?php the_title(); ?>" target="_blank"><?php _e('Facebook', 'wellthemes'); ?></a>
		</div>
		
		<div class="twitter">
			<a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink();?>" target="_blank"><?php _e('Twitter', 'wellthemes'); ?></a>	
		</div>
		
		<div class="gplus">			
			<a href="https://plus.google.com/share?url=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" target="_blank"><?php _e('Google+', 'wellthemes'); ?></a>			
		</div>
		
		<div class="linkedin">
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title(); ?>&amp;summary=<?php echo $excerpt; ?>" target="_blank"><?php _e('Linkedin', 'wellthemes'); ?></a>
		</div>
				
		<div class="pinterest">
			<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $thumbnail; ?>&amp;description=<?php the_title() ?>" target="_blank"><?php _e('Pinterest', 'wellthemes'); ?></a>
		</div>
		
		<div class="delicious">
			<a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank"><?php _e('Delicious', 'wellthemes'); ?></a>
		</div>
	</div><!-- /entry-social -->
		
<?php } 

	$hide_related_posts = get_post_meta($post->ID, 'wt_meta_post_hide_related', true);	
	
	if ($hide_related_posts != 1) {		
		if ( wt_get_option( 'wt_hide_related_posts' ) == 1 ){
			$hide_related_posts = 1;
		}				
	} else{
		$hide_related_posts = 1;
	}		
			
	if ( $hide_related_posts != 1 ) { 
		get_template_part( 'includes/related-posts' );
	}
?>