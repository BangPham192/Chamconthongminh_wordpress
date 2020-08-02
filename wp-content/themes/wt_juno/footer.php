<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package  WellThemes
 * @file     footer.php
 * @author   Well Themes Team
 * @link 	 http://wellthemes.com
 */
?>
	</div><!-- /main -->
</div><!-- /container -->
	<footer id="footer">
		<div class="footer-widgets">
			<div class="inner-wrap">
			
				<div class="col col-290">			
					<?php 
						if ( ! dynamic_sidebar( 'footer-1' ) ) : 			
						endif;
					?>
				</div>
				
				<div class="col col-290">	
					<?php 
						if ( ! dynamic_sidebar( 'footer-2' ) ) : 			
						endif;
					?>
				</div>
				
				<div class="col col-290">	
					<?php 
						if ( ! dynamic_sidebar( 'footer-3' ) ) : 			
						endif;
					?>
				</div>
				
				<div class="col col-290 col-last">
					<?php 
						if ( ! dynamic_sidebar( 'footer-4' ) ) : 			
						endif;					
					?>
				</div>
			
			</div><!-- /inner-wrap -->			
			
		</div><!-- /footer-widgets -->
		
		<div class="footer-info">
			<div class="inner-wrap">
				<?php if (wt_get_option( 'wt_footer_text_left' )){ ?> 
					<div class="footer-left">
						<?php echo wt_get_option( 'wt_footer_text_left' ); ?>			
					</div>
				<?php } ?>
				<?php if ( wt_get_option( 'wt_show_header_social' ) == 1 ) { ?>
					<div class="social-links">
						<div class="title"><?php _e('Get connected:', 'wellthemes');?></div>
						<ul class="list">
							<?php if (wt_get_option( 'wt_twitter_url' )) { ?>
								<li><a class="twitter" href="<?php echo wt_get_option( 'wt_twitter_url' ); ?>">Twitter</a></li>
							<?php } ?>
							
							<?php if (wt_get_option( 'wt_fb_url' )) { ?>
								<li><a class="fb" href="<?php echo wt_get_option( 'wt_fb_url' ); ?>">Facebook</a></li>
							<?php } ?>
							
							<?php if (wt_get_option( 'wt_gplus_url' )) { ?>
								<li><a class="gplus" href="<?php echo wt_get_option( 'wt_gplus_url' ); ?>">Google+</a></li>
							<?php } ?>
							
							<?php if (wt_get_option( 'wt_pinterest_url' )) { ?>
								<li><a class="pinterest" href="<?php echo wt_get_option( 'wt_pinterest_url' ); ?>">Pinterest</a></li>
							<?php } ?>
							
							<?php if (wt_get_option( 'wt_dribbble_url' )) { ?>
								<li><a class="dribbble" href="<?php echo wt_get_option( 'wt_dribbble_url' ); ?>">Facebook</a></li>
							<?php } ?>	
							
						</ul>
					</div>
				<?php } ?>
				
			</div><!-- /inner-wrap -->			
		</div> <!--/footer-info -->
		
	</footer><!-- /footer -->

<?php wp_footer(); ?>

</body>
</html>