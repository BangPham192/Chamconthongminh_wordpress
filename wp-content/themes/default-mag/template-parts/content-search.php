<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Default_Mag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('twp-archive-post'); ?>>
	<div class="twp-wrapper">
		<div class="twp-image-section data-bg-lg">
			<?php default_mag_post_thumbnail(); ?>
			<?php echo esc_attr(default_mag_post_format(get_the_ID())); ?>
		</div>
	
		<header class="entry-header">
			<div class="twp-categories">
				<?php default_mag_post_categories(); ?>
			</div>
			<div class="twp-articles-title"><?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );?></div>
				<div class="twp-meta-style-1  twp-author-desc">
					<?php default_mag_post_author(); ?>
					<?php default_mag_post_date(); ?>
					<?php default_mag_get_comments_count(get_the_ID()); ?>
				</div>
		</header><!-- .entry-header -->


		<div class="entry-content">
			<?php the_excerpt();
			?>
		</div><!-- .entry-content -->
	</div><!--/twp-wrapper-->
</article><!-- #post-<?php the_ID(); ?> -->
