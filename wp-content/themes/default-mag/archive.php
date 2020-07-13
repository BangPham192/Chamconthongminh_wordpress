<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Default_Mag
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php if (is_author()) { ?>
				<header class="page-header twp-archive-head">
		            <?php
		            $user_display_name = get_the_author_meta( 'display_name' );
		            $user_user_description = get_the_author_meta( 'user_description' );
		            $user_user_url = get_the_author_meta( 'user_url' );
		            $user_email = get_the_author_meta( 'user_email' ); ?>
					<div class="twp-single-author-info twp-secondary-font">
					    <div class="twp-row">
					        <div class="twp-author-avatar twp-col-gap">
					            <img src="<?php echo get_avatar_url($user_email,  'size = 200'); ?>">
					        </div>
					        <div class="twp-author-description twp-col-gap">
					            <div class="twp-author-namee">
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
				</header><!-- .page-header -->
			<?php } else { ?>
				<header class="page-header twp-archive-head">
					<?php
					the_archive_title( '<h1 class="page-title twp-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->
			<?php } ?>

			<div class="twp-archive-post-list">
				<div class="twp-row">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					do_action('default_mag_action_posts_navigation');


				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
