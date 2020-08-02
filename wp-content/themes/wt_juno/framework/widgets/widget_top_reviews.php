<?php
/**
 * Plugin Name: Well Themes: Top Reviews
 * Plugin URI: http://wellthemes.com/
 * Description: This widhet displays the top reviews in the sidebar.
 * Version: 1.0
 * Author: Well Themes Team
 * Author URI: http://wellthemes.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'wellthemes_top_reviews_widgets' );

function wellthemes_top_reviews_widgets() {
	register_widget( 'wellthemes_top_reviews_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class wellthemes_top_reviews_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function wellthemes_top_reviews_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_reviews', 'description' => __('Displays the top reviews in the sidebar.', 'wellthemes') );

		/* Create the widget. */
		$this->WP_Widget( 'wellthemes_top_reviews_widget', __('Well Themes: Top Reviews', 'wellthemes'), $widget_ops);
	}

	/**
	 * display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		
		extract( $args );
	    $title = apply_filters('widget_title', $instance['title'] );
		$display_category = $instance['display_category'];
		$entries_display = $instance['entries_display'];
		
		if(empty($entries_display)){ 
			$entries_display = '5'; 
		}
		
		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;	

        $args = array(
			'cat' => $display_category,
			'post_type' => 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $entries_display,
			'meta_key' => 'wt_meta_post_review_item6_score',
			'orderby' => 'meta_value_num',
		);
		
		$popular_posts = new WP_Query( $args );?>
		<ul class="list post-list">
			<?php while($popular_posts->have_posts()): $popular_posts->the_post();  ?>			
				<li>
					<article class="item-post">
							
						<?php if ( has_post_thumbnail() ) {	?>
							<div class="thumbnail overlay">
								<a href="<?php the_permalink(); ?>" >
									<?php the_post_thumbnail( 'wt-thumb-300_130' ); ?>
								</a>
							</div>
						<?php } ?>
						
						<div class="cat-bullet"><?php wt_get_bullet_cats(); ?></div>
						<h4>								
							<a href="<?php the_permalink() ?>">
								<?php 
									// display only first 75 characters in the title.	
									$short_title = mb_substr(the_title('','',FALSE),0, 75);
									echo $short_title; 
									if (strlen($short_title) > 75){ 
										echo '...'; 
									} 
								?>	
							</a>
						</h4>	
								
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
							
					</article>
				</li><!-- /item-post -->
		   <?php endwhile; ?>
	   </ul>
	   <?php		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array('title' => 'Top Reviews', 'entries_display' => 5, 'display_category' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wellthemes'); ?></label>
        <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'entries_display' ); ?>"><?php _e('How many entries to display?', 'wellthemes'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('entries_display'); ?>" name="<?php echo $this->get_field_name('entries_display'); ?>" value="<?php echo $instance['entries_display']; ?>" style="width:100%;" /></p>
 
		<p><label for="<?php echo $this->get_field_id( 'display_category' ); ?>"><?php _e('Display specific categories? Enter category ids separated with a comma (e.g. - 1, 3, 8)', 'wellthemes'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id('display_category'); ?>" name="<?php echo $this->get_field_name('display_category'); ?>" value="<?php echo $instance['display_category']; ?>" style="width:100%;" /></p>
	<?php
	}
}
?>