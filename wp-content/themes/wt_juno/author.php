<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package  WellThemes
 * @file     author.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>
<?php get_header(); ?>
<?php
	$sidebar_position = "";	
	$content_class = "";
	$sidebar_position = wt_get_option( 'wt_sidebar_position' );	
	if ( $sidebar_position == "left" ){
		$content_class =" content-right";
	}	
?>
	<div id="content" class="post-archive author-archive<?php echo $content_class; ?>">
		<?php if ( have_posts() ) : ?>
			<?php
				/* Queue the first post, that way we know
			     * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>

			<header class="archive-header">
				<h3 class="archive-title"><?php printf( __( 'Author Archives: %s', 'wellthemes' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h3>
			</header>

			<?php
				/* Since we called the_post() above, we need to
			 	 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>

			<?php
				// If a user has filled out their description, show a bio on their entries.
				if (( wt_get_option( 'wt_hide_archive_author_info' ) != 1 ) AND ( get_the_author_meta( 'description' ))) {?>
					<div class="archive-desc">							
						<div class="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), 68 ); ?>
						</div>	
					
						<div class="author-description">								
							<h4><?php printf( __( 'About %s', 'wellthemes' ), get_the_author() ); ?></h4>
								<?php the_author_meta( 'description' ); ?>																		
						</div><!-- /author-description -->
					</div><!-- /author-info -->
			<?php } ?>
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
		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'wellthemes' ); ?></h1>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'wellthemes' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</article><!-- /post-0 -->

		<?php endif; ?>
	</div><!-- /content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>