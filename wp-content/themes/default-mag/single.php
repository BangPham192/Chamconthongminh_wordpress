<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Default_Mag
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			if (1 == default_mag_get_option('enable_authro_detail_single_page')) {
				if ( 'post' === get_post_type() ) : ?>
		            <?php
		            $user_display_name = get_the_author_meta( 'display_name' );
		            $user_user_description = get_the_author_meta( 'user_description' );
		            $user_user_url = get_the_author_meta( 'user_url' );
		            $user_email = get_the_author_meta( 'user_email' ); ?>
					<div class="twp-single-author-info twp-secondary-font">
					    <div class="twp-row">
					        <div class="twp-author-avatar twp-col-gap">
					            <img src="<?php echo get_avatar_url($user_email,  'size = 300'); ?>">
					        </div>
					        <div class="twp-author-description twp-col-gap">
					            <div class="twp-author-name">
					                <h2 class="twp-title twp-sm-title"><?php echo esc_html($user_display_name); ?></h2>
					            </div>
					            <div class="twp-author-email">
					            	<a href="<?php echo esc_url($user_user_url); ?>">
						                <?php echo esc_url($user_user_url); ?>
					            	</a>
					            </div>
					            <div class="twp-about-author">
					                <?php echo esc_html($user_user_description); ?>
					            </div>
					        </div>
					    </div>
					</div>
				<?php
				endif;
			}
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			$next_post = get_next_post();
			if (!empty( $next_post )): ?>
				<div class="twp-single-next-post twp-secondary-font">
					<h3 class="twp-title">
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
							<?php echo esc_html__('Next Post','default-mag'); ?><i class="fa fa-chevron-right"></i>
						</a>
					</h3>

					<?php
						$post_categories = get_the_category($next_post);
						if ($post_categories) {
							$output = '<div class="twp-categories twp-primary-categories"><ul>';
							foreach ($post_categories as $post_category) {
								$output .= '<li class="float-left">
										<a class="default-mag-categories twp-primary-anchor-text--" href="' . esc_url(get_category_link($post_category)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'default-mag'), $post_category->name)) . '"> 
											' . esc_html($post_category->name) . '
										</a>
									</li>';
							}
							$output .= '</ul></div>';
							echo $output;
		
						}
					?>
					
					<h2 class="twp-secondary-title"><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo esc_attr( $next_post->post_title ); ?></a></h2>

					<div class="twp-time twp-primary-text"><i class="fa fa-clock-o"></i><?php echo get_the_date('D M j , Y', $next_post->ID  ); ?></div>
						
					<div class="twp-caption"><?php echo esc_html( get_the_excerpt( $next_post->ID ) ); ?></div>
					<?php 
					if (!empty(get_the_post_thumbnail( $next_post->ID , 'large' ))) { ?>
						<div class="twp-image-section"><?php echo wp_kses_post(get_the_post_thumbnail( $next_post->ID , 'large' )); ?></div>
					<?php } ?>
				</div>
			<?php endif; ?>
			<?php do_action('default_mag_action_related_post'); ?>
			
		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
