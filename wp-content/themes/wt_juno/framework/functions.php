<?php

/**
 * Tell WordPress to run wellthemes_theme_setup() when the 'after_setup_theme' hook is run.
 */
 
add_action( 'after_setup_theme', 'wellthemes_theme_setup' );

if ( ! function_exists( 'wellthemes_theme_setup' ) ):

function wellthemes_theme_setup() {

	/**
	 * Load up our required theme files.
	 */
	require( get_template_directory() . '/framework/settings/theme-options.php' );
	require( get_template_directory() . '/framework/settings/option-functions.php' );
	require( get_template_directory() . '/framework/shortcodes/wellthemes-shortcodes.php' );
	require( get_template_directory() . '/framework/shortcodes/shortcodes.php' );
	
	require( get_template_directory() . '/framework/meta/meta_post.php' );
	require( get_template_directory() . '/framework/meta/meta_category.php' );
	require( get_template_directory() . '/framework/meta/meta_functions.php' );
	/**
	 * Load our theme widgets
	 */
	require( get_template_directory() . '/framework/widgets/widget_adsblock.php' );
	require( get_template_directory() . '/framework/widgets/widget_adsingle.php' );
	require( get_template_directory() . '/framework/widgets/widget_contact_form.php' );
	require( get_template_directory() . '/framework/widgets/widget_flickr.php' );
	require( get_template_directory() . '/framework/widgets/widget_tabs.php' );
	require( get_template_directory() . '/framework/widgets/widget_popular_posts.php' );
	require( get_template_directory() . '/framework/widgets/widget_video.php' );
	require( get_template_directory() . '/framework/widgets/widget_facebook.php' );
	require( get_template_directory() . '/framework/widgets/widget_carousel.php' );
	require( get_template_directory() . '/framework/widgets/widget_aboutus.php' );
	require( get_template_directory() . '/framework/widgets/widget_pinterest.php' );
	require( get_template_directory() . '/framework/widgets/widget_recent_comments.php' );
	require( get_template_directory() . '/framework/widgets/widget_google.php' );
	require( get_template_directory() . '/framework/widgets/widget_subscribe.php' );
	require( get_template_directory() . '/framework/widgets/widget_popular_categories.php' );
	require( get_template_directory() . '/framework/widgets/widget_top_reviews.php' );
	
	/* Add translation support.
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'wellthemes', get_template_directory() . '/languages' );
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) )
		$content_width = 600;
		
	/** 
	 * Add default posts and comments RSS feed links to <head>.
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * This theme styles the visual editor with editor-style.css to match the theme style.
	 */
	add_editor_style();
	
	/**
	 * Register menus
	 *
	 */
	register_nav_menus( array(
		'top-menu' => __( 'Top Menu', 'wellthemes' ),
		'primary-menu' => __( 'Primary Menu', 'wellthemes' )					
	) );
	
	/**
	 * Add support for the featured images (also known as post thumbnails).
	 */
	if ( function_exists( 'add_theme_support' ) ) { 
		add_theme_support( 'post-thumbnails' );
	}
	
	/**
	 * Add custom image sizes
	 */
	add_image_size( 'wt-slider', 880, 320, true );			//main slider
	add_image_size( 'wt-post', 620, 340, true );			//content slider
	add_image_size( 'wt-img-425_225', 425, 225, true );		//feat category thumbnails
	add_image_size( 'wt-thumb-300_130', 300, 130, true );	//feat post thumbnails
	add_image_size( 'wt-thumb-160_90', 160, 90, true );	//feat post thumbnails
	add_image_size( 'wt-thumb-70_70', 70, 70, true );	//feat post thumbnails
	
		
	
}
endif; // wellthemes_theme_setup

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */

if (!is_admin()){
    add_action('wp_enqueue_scripts', 'wellthemes_js');
}

if (!function_exists('wellthemes_js')) {

    function wellthemes_js() {
		wp_enqueue_script('wt_hoverIntent', get_template_directory_uri().'/js/hoverIntent.js',array('jquery'),'', true);
		wp_enqueue_script('wt_superfish', get_template_directory_uri().'/js/superfish.js',array('hoverIntent'),'', true);
		wp_enqueue_script('wt_slider', get_template_directory_uri() . '/js/flexslider-min.js', array('jquery'),'', true); 
		wp_enqueue_script('wt_lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'),'', true); 		
		wp_enqueue_script('wt_jflickrfeed', get_template_directory_uri() . '/js/jflickrfeed.min.js', array('jquery'),'', true); 
		wp_enqueue_script('wt_mobilemenu', get_template_directory_uri() . '/js/jquery.mobilemenu.js', array('jquery'),'', true); 
		wp_enqueue_script('wt_touchSwipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'),'', true); 
		wp_enqueue_script('wt_carousel', get_template_directory_uri() . '/js/jquery.carousel.js', array('jquery'), '', true); 
		wp_enqueue_script('wt_mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'),'', true); 		
		wp_enqueue_script('wt_custom', get_template_directory_uri() . '/js/custom.js', array('jquery'),'', true);		
    }
	
}

/**
 * Enqueues styles for front-end.
 *
 */ 
if (!function_exists('wellthemes_css')) {
	function wellthemes_css() {
		wp_enqueue_style( 'wt-style', get_stylesheet_uri() );		
	}
}
add_action( 'wp_enqueue_scripts', 'wellthemes_css' );


/**
 * Register our sidebars and widgetized areas.
 *
 */
 
if ( function_exists('register_sidebar') ) {
	
	register_sidebar( array(
		'name' => __( 'Sidebar', 'wellthemes' ),
		'id' => 'sidebar-1',
		'description' => __( 'Main sidebar area', 'wellthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
		
	register_sidebar( array(
		'name' => __( 'Footer Widget 1', 'wellthemes' ),
		'id' => 'footer-1',
		'description' => __( 'Widget 1 area in the footer', 'wellthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget 2', 'wellthemes' ),
		'id' => 'footer-2',
		'description' => __( 'Widget 2 area in the footer', 'wellthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget 3', 'wellthemes' ),
		'id' => 'footer-3',
		'description' => __( 'Widget 3 area in the footer', 'wellthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget 4', 'wellthemes' ),
		'id' => 'footer-4',
		'description' => __( 'Widget 4 area in the footer', 'wellthemes' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wellthemes_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
if ( ! function_exists( 'wellthemes_comment' ) ) :
function wellthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;
	
	switch ( $comment->comment_type ) :
		case '' :
		
		if($comment->user_id == $post->post_author) {
			$author_text = '<span class="author-comment main-color-bg">Author</span>';
		} else {
			$author_text = '';
		}
		
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
		
			<div class="author-avatar">
				<a href="<?php comment_author_url()?>"><?php echo get_avatar( $comment, 60 ); ?></a>
			</div>			
		
			<div class="comment-right">
				
				<div class="comment-header">
						<h5><?php printf( __( '%s', 'wellthemes' ), sprintf( '<cite class="fn cufon">%s</cite>', get_comment_author_link() ) ); ?></h5>
						<?php echo $author_text; ?>
				</div>
					
				<div class="comment-meta">					
					
					<span class="comment-time">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 'wellthemes' ), get_comment_date(),  get_comment_time() ); ?></a>
					</span>
					<span class="sep">-</span>
					<span class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wellthemes' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span>
				
					
					
					<?php edit_comment_link( __( '[ Edit ]', 'wellthemes' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- /comment-meta -->
			
				<div class="comment-text">
					<?php comment_text(); ?>
				</div>
		
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'wellthemes' ); ?></p>
				<?php endif; ?>

				<!-- /reply -->
		
			</div><!-- /comment-right -->
		
		</article><!-- /comment  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wellthemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '[ Edit ]', 'wellthemes' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php	
			break;
	endswitch;
}
endif;	//ends check for wellthemes_comment()


/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
 * @return Prints the HTML for the pagination if a template is $paged
 */
if ( ! function_exists( 'wt_pagination' ) ) :
function wt_pagination() {
	global $wp_query;
 
	$big = 999999999; // This needs to be an unlikely integer
 
	// For more options and info view the docs for paginate_links()
	// http://codex.wordpress.org/Function_Reference/paginate_links
	$paginate_links = paginate_links( array(
		'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'mid_size' => 5
	) );
 
	// Display the pagination if more than one page is found
	if ( $paginate_links ) {
		echo '<div class="pagination">';
		echo $paginate_links;
		echo '</div><!--// end .pagination -->';
	}
}
endif; // ends check for wt_pagination()


if ( ! function_exists( 'wellthemes_main_menu_fallback' ) ) :
	
	function wellthemes_main_menu_fallback() { ?>
		<ul class="menu">
			<?php
				wp_list_categories(array(
					'number' => 5,
					'exclude' => '1',		//exclude uncategorized posts
					'title_li' => '',
					'orderby' => 'count',
					'order' => 'DESC'  
				));
			?>  
		</ul>
    <?php
	}

endif; // ends check for wellthemes_main_menu_fallback()


if ( ! function_exists( 'wellthemes_top_menu_fallback' ) ) :
	
	function wellthemes_top_menu_fallback() { ?>
		
    <?php
	}

endif; // ends check for wellthemes_top_menu_fallback()

if ( ! function_exists( 'wellthemes_first_post_tag_link' ) ) :
	
	function wellthemes_first_post_tag_link() {
		if ( $posttags = get_the_tags() ){
			$tag = current( $posttags );
			printf(
				'<span class="tag-title"><a href="%1$s">%2$s</a></span>',
				get_tag_link( $tag->term_id ),
				esc_html( $tag->name )
			);
		}
	}
	
endif; // ends check for wellthemes_first_post_tag_link()

function wt_get_cats_bg(){
	$category = get_the_category();
	if ($category){		
	
		if (isset($category[0]->term_id)){
							
			$cat1_id = $category[0]->term_id;
			echo '<span class="main-color-bg cat'.$cat1_id.'"><h5><a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a></h5></span>';
		}
		
		if (isset($category[1]->term_id)){					
			$cat2_id = $category[1]->term_id;														
			echo '<span class="main-color-bg cat'.$cat2_id.'"><h5><a href="' . get_category_link( $category[1]->term_id ) . '">' . $category[1]->name.'</a></h5></span>';
		}
	}
}

function wt_get_first_cat_bg(){
	$category = get_the_category();
	if ($category){		
	
		if (isset($category[0]->term_id)){
			
			$cat1_color = "";		
			$options = get_option('wt_options');		
			$cat1_color = $options['wt_primary_color'];
				
			$cat1_id = $category[0]->term_id;
						
			echo '<span class="main-color-bg cat'.$cat1_id.'"><h5><a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a></h5></span>';
		}
		
	}
}

function wt_get_first_cat(){
	$category = get_the_category();
	if ($category){	
		if (isset($category[0]->term_id)){
						
			$cat1_id = $category[0]->term_id;				
			echo '<span class="cat"><span class="main-color-bg cat'.$cat1_id.'"></span><h6><a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a></h6></span>';		
			
		}
	
	}
}

function wt_get_bullet_cats(){
	$category = get_the_category();
	if ($category){	
		if (isset($category[0]->term_id)){
					
			$cat1_id = $category[0]->term_id;
			echo '<span class="cat"><span class="main-color-bg cat'.$cat1_id.'"></span><h6><a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a></h6></span>';		
			
		}
		
		if (isset($category[1]->term_id)){
					
			$cat2_id = $category[1]->term_id;																	
			echo '<span class="cat cat-two"><span class="main-color-bg cat'.$cat2_id.'"></span><h6><a href="' . get_category_link( $category[1]->term_id ) . '">' . $category[1]->name.'</a></h6></span>';	
		}
	
	}
}

function wt_content_class(){
	$options = get_option('wt_options');
	$sidebar_position = $options['wt_sidebar_position'];
	
	if ($sidebar_position =="left"){
		$content_class = "content-right";
	} elseif ($sidebar_position =="none"){
		$content_class = "content-full";
	} else {
		$content_class = "content-left";
	}
	
	return $content_class;
}

function wt_show_review(){
	global $post ;
		$review_title = get_post_meta($post->ID, 'wt_meta_post_review_title', true);
		?>
		<div class="review-header"><h4><?php echo $review_title; ?></h4></div>
		<div class="review-items">
			<?php
			
			$item1_title = get_post_meta($post->ID,'wt_meta_post_review_item1_title', true);
			$item1_score = get_post_meta($post->ID,'wt_meta_post_review_item1_score', true);
				
			if( $item1_title && $item1_score && is_numeric( $item1_score )){
				
				if ( $item1_score > 50 ){
					$item1_score = 50;
				}
					
				if ( $item1_score < 0 ){
					$item1_score = 0;
				}
				
				$rating1_percent = $item1_score * 2 . '%';			
				?>
				
				<div class="review-item">
					<div class="item-title"><?php echo $item1_title; ?></div>
					<div class="review-stars"><div style="width:<?php echo $rating1_percent; ?>"></div></div>
				</div>
				<?php			
			}
			
			$item2_title = get_post_meta($post->ID,'wt_meta_post_review_item2_title', true);
			$item2_score = get_post_meta($post->ID,'wt_meta_post_review_item2_score', true);
			
			if( $item2_title && $item2_score && is_numeric( $item2_score )){
				
				if ( $item2_score > 50 ){
					$item2_score = 50;
				}
					
				if ( $item2_score < 0 ){
					$item2_score = 0;
				}
				
				$rating2_percent = $item2_score * 2 . '%';			
				?>
				
				<div class="review-item">
					<div class="item-title"><?php echo $item2_title; ?></div>
					<div class="review-stars"><div style="width:<?php echo $rating2_percent; ?>"></div></div>
				</div>
				<?php			
			}
			
			$item3_title = get_post_meta($post->ID,'wt_meta_post_review_item3_title', true);
			$item3_score = get_post_meta($post->ID,'wt_meta_post_review_item3_score', true);
			
			if( $item3_title && $item3_score && is_numeric( $item3_score )){
				
				if ( $item3_score > 50 ){
					$item3_score = 50;
				}
					
				if ( $item3_score < 0 ){
					$item3_score = 0;
				}
				
				$rating3_percent = $item3_score * 2 . '%';			
				?>
				
				<div class="review-item">
					<div class="item-title"><?php echo $item3_title; ?></div>
					<div class="review-stars"><div style="width:<?php echo $rating3_percent; ?>"></div></div>
				</div>
				<?php			
			}
			
			$item4_title = get_post_meta($post->ID,'wt_meta_post_review_item4_title', true);
			$item4_score = get_post_meta($post->ID,'wt_meta_post_review_item4_score', true);
			
			if( $item4_title && $item4_score && is_numeric( $item4_score )){
				
				if ( $item4_score > 50 ){
					$item4_score = 50;
				}
					
				if ( $item4_score < 0 ){
					$item4_score = 0;
				}
				
				$rating4_percent = $item4_score * 2 . '%';			
				?>
				
				<div class="review-item">
					<div class="item-title"><?php echo $item4_title; ?></div>
					<div class="review-stars"><div style="width:<?php echo $rating4_percent; ?>"></div></div>
				</div>
				<?php			
			}
			
			$item5_title = get_post_meta($post->ID,'wt_meta_post_review_item5_title', true);
			$item5_score = get_post_meta($post->ID,'wt_meta_post_review_item5_score', true);
			
			if( $item5_title && $item5_score && is_numeric( $item5_score )){
				
				if ( $item5_score > 50 ){
					$item5_score = 50;
				}
					
				if ( $item5_score < 0 ){
					$item5_score = 0;
				}
				
				$rating5_percent = $item5_score * 2 . '%';			
				?>
				
				<div class="review-item">
					<div class="item-title"><?php echo $item5_title; ?></div>
					<div class="review-stars"><div style="width:<?php echo $rating5_percent; ?>"></div></div>
				</div>
				<?php			
			}
			
			?>	
		</div>
	<?php
	
	$item6_title = get_post_meta($post->ID,'wt_meta_post_review_item6_title', true);
	$item6_score = get_post_meta($post->ID,'wt_meta_post_review_item6_score', true);	
	
	if( $item6_title && $item6_score && is_numeric( $item6_score )){
		
		if ( $item6_score > 50 ){
			$item6_score = 50;
		}
			
		if ( $item6_score < 0 ){
			$item6_score = 0;
		}
		
		$rating6_percent = $item6_score * 2 . '%';			
		$rating6 =  $item6_score/10; 	
		$review_summary = get_post_meta($post->ID,'wt_meta_review_summary', true);
		$rating_text = get_post_meta($post->ID,'wt_meta_post_review_item6_rating_text', true);
		?>
		<div class="review-item-final">
			
			<div class="left">
				<div class="final-title"><h6><?php echo $item6_title; ?></h6></div>
				<?php if ( !empty ($review_summary ) ){ ?>			
					<div class="final-summary">
						<?php echo $review_summary; ?>
					</div>		
				<?php				
				} ?>
			</div>
			
			<div class="right">
				<div class="final-score"><h3><?php echo $rating6; ?></h3></div>
				<div class="final-text"><?php echo $rating_text; ?></div>
				<div class="review-stars"><div style="width:<?php echo $rating6_percent; ?>"></div></div>
			</div>
			
			
		</div>
				
		<?php			
	}			
}

function get_overall_score(){
	global $post ;
	$enable_review = get_post_meta($post->ID,'wt_meta_post_show_review', true);	
	
	if (empty($enable_review)){
		return false;
	}
	
	$overall_score = get_post_meta($post->ID,'wt_meta_post_review_item6_score', true);	
			
	if ($overall_score && is_numeric( $overall_score ) ){
		
		if ( $overall_score > 50 ){
				$overall_score = 50;
		}
			
		if ( $overall_score < 0 ){
			$overall_score = 0;
		}
		
		$overall_rating_percent = $overall_score * 2 . '%';			
		$overall_rating =  $overall_score/10; 	?>	
			<div class="review-stars"><div style="width:<?php echo $overall_rating_percent; ?>"></div></div>
		<?php
		return true;
	} else {
		return false;
	}	
}

function set_category_styles(){
	$categories = get_categories();
		$cat_css = "";
		foreach($categories as $category) {
			
			$cat_id = $category->term_id;
			$wt_category_meta = get_option( "wt_category_meta_color_$cat_id" );
			
			if (isset($wt_category_meta['wt_cat_meta_color'])){
				$cat_color = $wt_category_meta['wt_cat_meta_color'];					
				$cat_css .=".cat".$cat_id."{background:".$cat_color."} ";
			}		
				
		}
				
		wp_add_inline_style('wt-style', $cat_css);	
	
}
add_action( 'wp_enqueue_scripts', 'set_category_styles',11 );