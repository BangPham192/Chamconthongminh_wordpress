<?php
/**
 * Plugin Name: Well Themes: Carousel Widget
 * Plugin URI: http://wellthemes.com
 * Description: This widget allows to display latest posts carousel with thumbnails and post title in the sidebar of well themes.
 * Version: 1.0
 * Author: Well Themes Team
 * Author URI: http://wellthemes.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'wellthemes_carousel_widgets');

function wellthemes_carousel_widgets(){
	register_widget('wellthemes_carousel_widget');
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */ 
class wellthemes_carousel_widget extends WP_Widget {
	
	/**
	 * Widget setup.
	 */
	function wellthemes_carousel_widget(){
		/* Widget settings. */	
		$widget_ops = array('classname' => 'widget_carousel', 'description' => 'Displays the carousel slider in the sidebar.');
		
		/* Create the widget. */
		$this->WP_Widget('wellthemes_carousel_widget', 'Well Themes: Carousel', $widget_ops);
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance){	
		extract($args);
		echo $before_widget;
		$widget_id = $args['widget_id'];
		$title = $instance['title'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		
		if (empty ($posts)){
			$posts = 5;
		}
	
		if($categories != 'all') {
			$categories_array = array($categories);
		}
				
		$args = array(
				'showposts' => $posts,
				'cat' => $categories,
				'post_type' => 'post',
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1
			);
	
			if($title) {
				echo $before_title;
				echo $title;
				echo $after_title;				
			}
			?>
			
			<script>
				jQuery(document).ready(function($) {
					$("#<?php echo $widget_id; ?>").show();
					$('#<?php echo $widget_id; ?>').carousel({
						nextPrevLinks: false,
					});
				});
			</script>
	
				<div id="<?php echo $widget_id; ?>" class="carousel">
					<ul>
						<?php $query = new WP_Query( $args );?>
							<?php if ( $query -> have_posts() ) : ?>
								<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
									<?php if ( has_post_thumbnail()) { ?>	
											<li>											
												<a href="<?php the_permalink() ?>">
													<?php the_post_thumbnail( 'wt-img-425_225' ); ?>
												</a>
												<h4>
													<a href="<?php the_permalink() ?>">
														<?php 
															//display only first 60 characters in the title.	
															$short_title = mb_substr(the_title('','',FALSE),0, 60);
															echo $short_title; 
															if (strlen($short_title) > 59){ 
																echo '...'; 
															} 
														?>	
													</a>
												</h4>											
											</li>
									<?php }	 ?>									
								<?php endwhile; ?>
							<?php endif; ?>	
							<?php wp_reset_query();		//reset the query ?>
					</ul>
				</div>
			<?php
		echo $after_widget;
	}
	
	/**
	 * update widget settings
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array('title' => 'Featured Posts', 'categories' => 'all', 'posts' => 5);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wellthemes'); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Filter by Category:', 'wellthemes'); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e('Number of posts:', 'wellthemes'); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
	<?php }
}
?>