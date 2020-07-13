<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Default_Mag
 */

get_header();
?>

	<section class="error-404 not-found twp-not-found twp-min-height">
		<div class="twp-wrapper">
			<header class="page-header">
				<div class="twp-error-title twp-secondary-color">404...</div>
				<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'default-mag' ); ?></h2>
			</header><!-- .page-header -->
			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'default-mag' ); ?></p>
	
				<?php get_search_form(); ?>
			</div>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->

<?php
get_footer();
