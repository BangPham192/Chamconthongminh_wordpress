<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Default_Mag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("twp-single-page-post-section twp-secondary-font"); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php 
	$post_options = get_post_meta( $post->ID, 'default-mag-meta-checkbox', true );
	if (!empty( $post_options ) ) {
	   default_mag_post_thumbnail();
	} ?>
	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'default-mag' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
