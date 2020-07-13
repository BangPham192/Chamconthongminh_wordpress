<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Default_Mag
 */

?>

    <?php do_action('default_mag_action_ticker_news_post'); ?>


	</div><!-- #content -->
	<?php 
	$default_mag_footer_widgets_number = default_mag_get_option('number_of_footer_widget');
	if ($default_mag_footer_widgets_number != 0) {?>
	    <?php
	    if (1 == $default_mag_footer_widgets_number) {
	        $col = 'col-12 twp-col-gap';
	    } elseif (2 == $default_mag_footer_widgets_number) {
	        $col = 'col-12 col-sm-6 twp-col-gap';
	    } elseif (3 == $default_mag_footer_widgets_number) {
	        $col = 'col-12 col-sm-6 col-xl-4 twp-col-gap';
	    } elseif (4 == $default_mag_footer_widgets_number) {
	        $col = 'col-12 col-sm-6 col-xl-3 twp-col-gap';
	    } else {
	        $col = 'col-12 col-sm-6 col-xl-3 twp-col-gap';
	    }
	    if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
	        <div class="twp-footer-widget">
	            <div class="container">
	                <div class="twp-row">
	                    <?php if (is_active_sidebar('footer-col-one') && $default_mag_footer_widgets_number > 0) : ?>
	                        <div class="<?php echo esc_attr($col); ?>">
	                            <?php dynamic_sidebar('footer-col-one'); ?>
	                        </div>
	                    <?php endif; ?>
	                    <?php if (is_active_sidebar('footer-col-two') && $default_mag_footer_widgets_number > 1) : ?>
	                        <div class="<?php echo esc_attr($col); ?>">
	                            <?php dynamic_sidebar('footer-col-two'); ?>
	                        </div>
	                    <?php endif; ?>
	                    <?php if (is_active_sidebar('footer-col-three') && $default_mag_footer_widgets_number > 2) : ?>
	                        <div class="<?php echo esc_attr($col); ?>">
	                            <?php dynamic_sidebar('footer-col-three'); ?>
	                        </div>
	                    <?php endif; ?>
	                    <?php if (is_active_sidebar('footer-col-four') && $default_mag_footer_widgets_number > 3) : ?>
	                        <div class="<?php echo esc_attr($col); ?>">
	                            <?php dynamic_sidebar('footer-col-four'); ?>
	                        </div>
	                    <?php endif; ?>
	                </div>
	            </div>
	        </div>
	    <?php } ?>
	<?php } ?>
	<footer id="colophon" class="site-footer twp-footer footer-active">
		<div class="container">
			<div class="twp-row">
			    <div class="col-lg-6  twp-col-gap">
			    	<div class="site-info">
						Copyright © 2020 Chamconthongminh. All right reserved.
				    </div><!-- .site-info -->
			        <div class="site-copyright">

			        </div>
			    </div>
			    <?php if (has_nav_menu('footer-nav')) { ?>
				    <div class="col-lg-6 twp-col-gap">
				        <div class="footer-menu-wrapper">
			            	<?php wp_nav_menu(array(
			            		'theme_location' => 'footer-nav',
			            		'menu_id' => 'footer-nav-menu',
			            		'container' => 'div',
			            		'container_class' => 'twp-footer-menu',
			            		'depth' => 1,
			                    'menu_class' => false,
			            	)); ?>
				        </div>
				    </div>
			    <?php } ?>
			</div>
		</div>
	</footer><!-- #colophon -->
	</div><!-- #page -->
	<?php if ( is_active_sidebar( 'off-canvas-sidebar' ) ) { ?>
		<div class="twp-offcanvas-sidebar-wrapper" id="sidr">
			<div class="twp-offcanvas-close-icon">
				<a class="sidr-class-sidr-button-close" href="#sidr-nav">
					<span class="twp-close-icon twp-close-icon-sm">
						<span></span>
						<span></span>
					</span>
				</a>
			</div>
			<?php dynamic_sidebar('off-canvas-sidebar'); ?>
		</div>
	<?php } else { ?>
		<div class="twp-offcanvas-sidebar-wrapper" id="sidr">
			<div class="twp-offcanvas-close-icon">
				<a class="sidr-class-sidr-button-close" href="#sidr-nav">
					<span class="twp-close-icon twp-close-icon-sm">
						<span></span>
						<span></span>
					</span>
				</a>
			<?php esc_html__( "please add Widgets in Off Canvas Sidebar", 'default-mag' ) ?>
			</div>
		</div>
	<?php } ?>
	<div class="twp-ticker-open close" id="twp-ticker-open-section">
		<span class="twp-plus-icon" id="twp-ticker-open">
			<span></span>
			<span></span>
		</span>
	</div>
	<div class="twp-up-arrow" id="scroll-top">
		<span><i class="fa fa-chevron-up"></i></span>
	</div>
	<?php wp_footer(); ?>

	

</body>
</html>

