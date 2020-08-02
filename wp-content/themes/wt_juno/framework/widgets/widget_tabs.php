<?php
/**
 * Plugin Name: Well Themes: Tab Posts
 * Plugin URI: http://wellthemes.com/
 * Description: This widhet displays the most recent and popular posts with thumbnails in the tabs.
 * Version: 1.0
 * Author: Well Themes Team
 * Author URI: http://wellthemes.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'wellthemes_recent_popular_widgets' );

function wellthemes_recent_popular_widgets() {
	register_widget( 'wellthemes_recent_popular_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class wellthemes_recent_popular_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function wellthemes_recent_popular_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_tabs', 'description' => __('Displays the recent, popular posts and comments in tabs.', 'wellthemes') );

		/* Create the widget. */
		$this->WP_Widget( 'wellthemes_recent_popular_widget', __('Well Themes: Tab Posts', 'wellthemes'), $widget_ops);
	}

	/**
	 *display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$entries_display = $instance['entries_display'];
		
		echo $before_widget;
		
		/* if ( $title )
		echo $before_title . $title . $after_title; */
		
		if(empty($entries_display)){ $entries_display = '5'; }
		
		$latest_category = $instance['latest_category'];
		$popular_category = $instance['popular_category'];
		
				
		$args_latest = array(
			'cat' => $latest_category,
			'post_type' => 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $entries_display		
		);	
		
		?>
		
		<div class="widget-tabs-title-container">
			<ul class="widget-tab-titles" class="list">
				<li class="main-color-bg active"><h5><a href="#widget-tab1-content"><?php _e('Recent', 'wellthemes'); ?></a></h5></li>
				<li class="main-color-bg"><h5><a href="#widget-tab2-content"><?php _e('Popular', 'wellthemes'); ?></a></h5></li>
				<li class="main-color-bg"><h5><a href="#widget-tab3-content"><?php _e('Comments', 'wellthemes'); ?></a></h5></li>
			</ul>
		</div>
		<div class="tabs-content-container">
			
			<div id="widget-tab1-content" class="tab-content" style="display: block;">	
				<?php $latest_posts = new WP_Query( $args_latest ); ?>
				<?php if ( $latest_posts -> have_posts() ) : ?>
					<ul class="list post-list">
					<?php while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); ?>					
						<li>
							<?php if ( has_post_thumbnail()) { ?>
							<div class="thumbnail">
								<?php the_post_thumbnail( 'wt-thumb-70_70' ); ?>
							</div>
							<?php } ?>
							<div class="post-right">
								<h5>
									<a href="<?php the_permalink() ?>">
										<?php 
											//display only first 50 characters in the title.	
											$short_title = mb_substr(the_title('','',FALSE),0, 50);
											echo $short_title; 
											if (strlen($short_title) > 49){ 
												echo '...'; 
											} 
										?>	
									</a>
								</h5>
								<div class="entry-meta">
									<?php 
										$is_review = get_overall_score(); 
										if ($is_review == false){ ?>
											<span class="author"><?php _e('Posted by ', 'wellthemes'); ?><?php the_author_posts_link(); ?></span>
											<span class="sep">-</span>
									<?php
										}	?>
									<span class="date"><?php echo get_the_date(); ?></span>							
								</div>
							</div>
						</li>
					<?php endwhile; ?>
					</ul>
				<?php endif;?>
			</div>
			
			<div id="widget-tab2-content" class="tab-content">
				<?php
					$args_popular = array(
						'cat' => $popular_category,
						'post_type' => 'post',
						'ignore_sticky_posts' => 1,
						'posts_per_page' => $entries_display,
						'orderby' => 'comment_count'						
					);	
				?>
				<?php $latest_posts = new WP_Query( $args_popular ); ?>
				<?php if ( $latest_posts -> have_posts() ) : ?>
					<ul class="list post-list">
					<?php while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); ?>					
						<li>
							<?php if ( has_post_thumbnail()) { ?>
							<div class="thumbnail">
								<?php the_post_thumbnail( 'wt-thumb-70_70' ); ?>
							</div>
							<?php } ?>
							<div class="post-right">
								<h5>
									<a href="<?php the_permalink() ?>">
										<?php 
											//display only first 50 characters in the title.	
											$short_title = mb_substr(the_title('','',FALSE),0, 50);
											echo $short_title; 
											if (strlen($short_title) > 49){ 
												echo '...'; 
											} 
										?>	
									</a>
								</h5>
								<div class="entry-meta">
									<?php 
										$is_review = get_overall_score(); 
										if ($is_review == false){ ?>
											<span class="author"><?php _e('Posted by ', 'wellthemes'); ?><?php the_author_posts_link(); ?></span>
											<span class="sep">-</span>
									<?php
										}	?>
									<span class="date"><?php echo get_the_date(); ?></span>							
								</div>
							</div>
						</li>
					<?php endwhile; ?>
					</ul>
				<?php endif;?>
			</div>
			
			<div id="widget-tab3-content" class="tab-content">
				<ul class="list comment-list">
					<?php 
						//get recent comments
						$args = array(
							   'status' => 'approve',
								'number' => $entries_display
							);	
						
						$postcount=0;
						$comments = get_comments($args);
						
						foreach($comments as $comment) :
								$postcount++;								
								$commentcontent = strip_tags($comment->comment_content);			
								if (strlen($commentcontent)> 50) {
									$commentcontent = mb_substr($commentcontent, 0, 49) . "...";
								}
								$commentauthor = $comment->comment_author;
								if (strlen($commentauthor)> 30) {
									$commentauthor = mb_substr($commentauthor, 0, 29) . "...";			
								}
								$commentid = $comment->comment_ID;
								$commenturl = get_comment_link($commentid); ?>
							   <li>
									<div class="thumbnail">
										<?php echo get_avatar( $comment, '70' ); ?>
									</div>
									<div class="post-right">
										<div class="comment-author"><h5><?php echo $commentauthor; ?></h5></div>
										<div class="comment-text">
											<a<?php if($postcount==1) { ?> class="first"<?php } ?> href="<?php echo $commenturl; ?>"><?php echo $commentcontent; ?></a>
										</div>
										<div class="entry-meta">
											<span class="ni-date"><?php echo get_the_date(); ?></span>
										</div>
									</div>
								</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div id="widget-posts-tiles">
			
		</div><!-- /tiles -->
	   <?php
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['entries_display'] = strip_tags($new_instance['entries_display']);
        $instance['latest_category'] = strip_tags($new_instance['latest_category']);
        $instance['popular_category'] = strip_tags($new_instance['popular_category']);
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array('entries_display' => 5, 'latest_category' => '', 'popular_category' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
		
		<p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><?php _e('How many entries to display?', 'wellthemes'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>
 
		<p><label for="<?php echo $this->get_field_id( 'latest_category' ); ?>"><?php _e('If you want to display specific category latest posts, enter category ids separated with a comma (e.g. - 1, 3, 8)', 'wellthemes'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('latest_category'); ?>" name="<?php echo $this->get_field_name('latest_category'); ?>" value="<?php echo $instance['latest_category']; ?>" style="width:100%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'popular_category' ); ?>"><?php _e('If you want to display specific category popular posts, enter category ids separated with a comma (e.g. - 1, 3, 8)', 'wellthemes'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('popular_category'); ?>" name="<?php echo $this->get_field_name('popular_category'); ?>" value="<?php echo $instance['popular_category']; ?>" style="width:100%;" /></p>
	<?php
	}
}
?>