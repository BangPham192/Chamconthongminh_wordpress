<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Default_Mag
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
	<!-- <style>
		body{
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			-o-user-select: none;
			user-select: none;
		}
	</style> -->
	<!-- <script type="text/javascript">
		var message = "NoRightClicking";
		function defeatIE() {
			if (document.all) {
				(message);return false;
				}
			}
			function defeatNS(e) {
				if (document.layers||(document.getElementById&&!document.all)) {
					 if (e.which==2||e.which==3) {
						 (message);return false;
					}
				}
			}
			if (document.layers) {
				document.captureEvents(Event.MOUSEDOWN);document.onmousedown=defeatNS;
			} else{
				document.onmouseup=defeatNS;document.oncontextmenu=defeatIE;
			}
			document.oncontextmenu=new Function("return false") 
    </script> -->
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} ?>
<?php 
$default_mag_page_layout = '';
if (default_mag_get_option('homepage_layout_option') == 'full-width') {
    $default_mag_page_layout = 'full-screen-layout';
} elseif (default_mag_get_option('homepage_layout_option') == 'boxed') {
    $default_mag_page_layout = 'boxed-layout';
} ?>
<div id="page" class="site <?php echo esc_attr($default_mag_page_layout); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'default-mag' ); ?></a>

	<header id="masthead" class="site-header">
		<?php if (default_mag_get_option('show_top_bar_section') == 1) { ?>
			<div class="twp-top-bar">
				<div class="container twp-no-space clearfix">
					<!-- <div class="clearfix"> -->
					<?php if (default_mag_get_option('show_top_tag_section') == 1) { ?>
						<div class="twp-header-tags float-left">
							<?php $default_mag_top_tag_title = default_mag_get_option('most_tag_bar_title');?>
							<?php if (!empty($default_mag_top_tag_title)) { ?>
								<div class="twp-tag-caption twp-primary-bg">
									<?php echo esc_html($default_mag_top_tag_title);?>
								</div>
							<?php } ?>
							<ul class="twp-tags-items clearfix">
								<?php $i = 1;?>
								<?php 
								$args = array(
								    'orderby' => 'count',
								    'order' => 'DESC',
								    'hide_empty ' => true,

								);
								?>
								<?php
								$tag_list = get_tags($args); //taxonomy=post_tag
								if ( $tag_list ) :
									foreach ( $tag_list as $tag ) : ?>
										<?php if ($i <= 6) { ?>
										<li><a class="tag" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( $tag->name ); ?>"><?php echo __('#','default-mag'); ?> <?php echo esc_html( $tag->name ); ?></a></li>
										<?php } ?>
										<?php $i++; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
					<?php } ?>
						<div class="twp-social-icon-section float-right">
							<?php if (default_mag_get_option('show_top_social_section') == 1) { ?>
								<?php if (has_nav_menu('social-nav')) { ?>
									<div class="navigation-social-icon">
										<div class="twp-social-icons-wrapper">
											<div class="page-social">
												<ul>
													<li>
														<a title="Facebook" href="https://www.facebook.com/marry.baby.vn" target="_blank" rel="nofollow" id="fb_header">
															<i class="fa fa-facebook-square"></i>
														</a>
													</li>
													<li>
														<a title="Youtube" href="https://www.youtube.com/user/marrybabyvn" target="_blank" rel="nofollow" id="youtube_header">
															<i class="fa fa-youtube-square"></i>
														</a>
													</li>
													<li>
														<a title="Instagram" href="https://www.instagram.com/marrybaby.vn/" target="_blank" rel="nofollow" id="instagram_header">
															<i class="fa fa-instagram"></i>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
							<?php if (default_mag_get_option('show_top_date_section') == 1) { ?>
								<div class="twp-todays-date twp-primary-bg">
									<!-- <span> -->
										<?php $time = current_time('timestamp');
											echo date_i18n('l, M j, Y',$time); ?>
									<!-- </span> -->
								</div>
							<?php } ?>
							
						</div>
					<!-- </div> -->

				</div><!--/container-->
			</div><!--/twp-header-top-bar-->
		<?php } ?>
		<?php $default_main_header_image = get_header_image(); ?>
		<?php 
		$logo_center = '';
		if (default_mag_get_option('show_addvertisement_section') != 1) { 
			$logo_center = "twp-logo-center";
		}?>
		<div class="twp-site-branding data-bg background-image-size<?php echo esc_attr($logo_center); ?>" data-background="<?php echo esc_url($default_main_header_image); ?>">
			<div class="container twp-no-space">
				<div class="twp-wrapper">
					<div class="twp-logo">
						<span class="twp-image-wrapper"><?php the_custom_logo(); ?></span>
						<span class="site-title">
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<?php bloginfo('name'); ?>
							</a>
						</span>
						<?php $description = get_bloginfo('description', 'display');
						if ($description || is_customize_preview()) : ?>
						    <p class="site-description">
						        <?php echo esc_html($description); ?>
						    </p>
						<?php
						endif; ?>

					</div><!--/twp-logo-->
					<?php if (default_mag_get_option('show_addvertisement_section') == 1) { ?>
						<div class="twp-ad">
							<!-- <a href="<?php echo esc_url(default_mag_get_option('top_section_advertisement_url')); ?>">
								<div class="twp-ad-image data-bg" data-background="<?php echo esc_url(default_mag_get_option('top_section_advertisement')); ?>">
								</div>
							</a> -->
							<div class="twp-ad-image data-bg" data-background="<?php echo esc_url(default_mag_get_option('top_section_advertisement')); ?>">
							</div>
						</div><!--/twp-ad-->
					<?php } ?>

				</div><!--/twp-wrapper-->
			</div><!--/container-->
		</div><!-- .site-branding -->
			

		<nav id="site-navigation" class="main-navigation twp-navigation twp-default-bg">
			<div class="twp-nav-menu">
				<div class="container twp-custom-container twp-left-space">
					<div class="clearfix">
	
						<div class="twp-nav-left-content float-left twp-d-flex">
							<div class="twp-nav-sidebar-menu">
								<?php if ((default_mag_get_option('show_offcanvas_collaps') == 1) && (is_active_sidebar( 'off-canvas-sidebar' )) ) { ?>
									<div class="twp-nav-off-canvas">
										<div class="twp-menu-icon" id="twp-nav-off-canvas">
											<span></span>
										</div>
									</div>
								<?php } ?>
								<div class="twp-mobile-menu-icon">
									<div class="twp-menu-icon" id="twp-menu-icon">
										<span></span>
									</div>
								</div>
							</div>
		
							<div class="twp-menu-section">
								<?php
								if (has_nav_menu('primary-nav')) {
									wp_nav_menu(array(
										'theme_location' => 'primary-nav',
										'menu_id' => 'primary-nav-menu',
										'container' => 'div',
										'container_class' => 'menu',
										'depth' => 4,
									));
								} else {
									wp_nav_menu(array(
										'theme_location' => 'primary',
										'menu_id' => 'primary-nav-menu',
										'container' => 'div',
										'container_class' => 'menu',
										'depth' => 1,
									));
								} ?>
							</div><!--/twp-menu-section-->
						</div>
	
						<div class="twp-nav-right-content float-right twp-d-flex">
                        	<div class="theme-mode header-theme-mode"></div>
							<?php if (default_mag_get_option('show_trending_on_nav') == 1) { ?>
								<div class="twp-latest-news-button-section" id="nav-latest-news">
									<div class="twp-nav-button twp-primary-bg" id="trending-btn">
										<span><i class="fa fa-bolt"></i></span>
										<span><?php echo esc_html(default_mag_get_option('trending_section_title'));?><span>
									</div>
								</div><!--/latest-news-section-->
							<?php } ?>
							
							<?php if (default_mag_get_option('show_search_icon_on_nav') == 1) { ?>
								<div class="twp-search-section" id="search">
									<i class="fa  fa-search"></i>
								</div><!--/twp-search-section-->
							<?php } ?>
						</div>
	
					</div><!--/twp-navigation-->
				</div><!--/container-->
			</div>

			<div class="twp-search-field-section" id="search-field">
				<div class="container">
					<div class="twp-search-field-wrapper">
						<div class="twp-search-field">
							<?php get_search_form(); ?>
						</div>
						<div class="twp-close-icon-section">
							<span class="twp-close-icon" id="search-close">
								<span></span>
								<span></span>
							</span>
						</div>
					</div>

				</div>
			</div>
			<?php if (default_mag_get_option('show_trending_on_nav') == 1) { ?>
				<div class="twp-articles-list" id="nav-latest-news-field">
					<div class="container">
						<?php
        					$default_mag_trending_category = esc_attr(default_mag_get_option('select_category_for_trending_section'));
							$args = array(
								'posts_per_page' => 12,
								'order' => 'ASC',
                				'cat' => esc_attr($default_mag_trending_category),
							);
							$twp_recent_nav_posts = new WP_Query($args);
							if($twp_recent_nav_posts->have_posts()):?>
								<section id="related-articles" class="page-section">
									<header class="twp-article-header twp-default-bg clearfix">
										<h3 class="twp-section-title primary-font">
											<?php echo esc_html(default_mag_get_option('trending_section_title'));?>
										</h3>
										<div class="twp-close-icon-section">
											<span class="twp-close-icon" id="latest-news-close">
												<span></span>
												<span></span>
											</span>
										</div>
									
									</header>
									<div class="entry-content">
										<div class="row">
											<?php while ($twp_recent_nav_posts->have_posts()):$twp_recent_nav_posts->the_post();?>
												<div class="col-lg-4 col-sm-6 twp-articles-border">
													<div class="twp-articles">
														<?php if(has_post_thumbnail()){ ?>
															<div class="twp-image-section">
																<a href="<?php the_permalink(); ?>" class="bg-image-- data-bg-- data-bg-xs-- bg-opacity-- d-block">
																	<?php the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>
																</a>
															</div>
														<?php } ?>
														<div class="twp-description">
															<h4 class="primary-font">
																<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
															</h4>
															<div class="twp-meta-style-1  twp-author-desc twp-primary-color">
																<?php default_mag_post_date(); ?>
															</div>
														</div><!-- .related-article-title -->
													</div>
												</div>
											<?php endwhile;wp_reset_postdata();?>
										</div>
									</div><!-- .entry-content-->
								</section>
							<?php endif; ?>
					</div>
				</div><!--/latest-news-section-->
			<?php } ?>
			
		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->
	<div class="twp-mobile-menu">
		<div class="twp-mobile-close-icon">
			<span class="twp-close-icon twp-close-icon-sm" id="twp-mobile-close">
				<span></span>
				<span></span>
			</span>
		</div>
		
	</div>
	
	<?php if (default_mag_get_option('enable_preloader') == 1) { ?>
		<div class="twp-overlay" id="overlay"></div>
		<div id="preloader">
			<div id="status">&nbsp;</div>
		</div>
	<?php } ?>
	
	<?php do_action( 'default_mag_action_get_breadcrumb' ); ?>

	<div id="content" class="site-content clearfix">