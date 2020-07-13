<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Default_Mag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("twp-single-page-post-section twp-secondary-font"); ?>>
	<header class="entry-header">
		<div class="twp-categories twp-primary-categories">
			<?php default_mag_post_categories(); ?>
		</div>
		<h1 class="entry-title twp-secondary-title">
			<?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>
			<a href="<?php echo esc_url( get_permalink() );?>" rel="bookmark">
			<?php the_title(); ?>
			</a>
		</h1>
			<div class="twp-author-desc">
				<?php default_mag_post_author(); ?>
				<?php default_mag_post_date(); ?>
				<?php default_mag_get_comments_count(get_the_ID()); ?>
			</div>
			<?php if (1 == default_mag_get_option('enable_except_on_single_post')) {
				if (has_excerpt()){
					the_excerpt();
				}
			}
			?>
	</header><!-- .entry-header -->

	<?php 
	$post_options = get_post_meta( $post->ID, 'default-mag-meta-checkbox', true );
	if (!empty( $post_options ) ) {
	   default_mag_post_thumbnail();
	} ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'default-mag' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php default_mag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
