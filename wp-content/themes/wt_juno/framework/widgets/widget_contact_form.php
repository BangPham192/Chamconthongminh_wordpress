<?php
/**
 * Plugin Name: Well Themes: Contact Form
 * Plugin URI: http://wellthemes.com/
 * Description: This widget allows you to display the contact form in the sidebar or the footer areas of well themes.
 * Version: 1.0
 * Author: Well Themes Team
 * Author URI: http://wellthemes.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'wellthemes_contact_form_widgets' );

function wellthemes_contact_form_widgets() {
	register_widget( 'wellthemes_contact_form_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class wellthemes_contact_form_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function wellthemes_contact_form_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_contact_form', 'description' => __('Displays contact form in the sidebar or footer.', 'wellthemes') );

		/* Create the widget. */
		$this->WP_Widget( 'wellthemes_contact_form_widget', __('Well Themes: Contact Form', 'wellthemes'), $widget_ops);
	}
	
	/**
	 * update widget settings
	 */	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['email']= strip_tags($new_instance['email']); 
			
			return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance) {
		$admin_email = get_option('admin_email');
		$defaults = array('title' => 'Contact', 'email' => $admin_email);
		$instance = wp_parse_args((array) $instance, $defaults);
		
		
	?>
					
		<div class="field"> 
			<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title', 'wellthemes'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</div>
		
		<div class="field"> 
			<label for="<?php echo $this->get_field_id('email'); ?>"> <?php _e('Email', 'wellthemes'); ?> </label>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $instance['email']; ?>" />
		</div>   

		
<?php
	}
	
	/**
	 * display the widget on the screen.
	 */
	function widget($args, $instance) {
		extract($args);
	
		$title = esc_attr($instance['title']); 
		$email_to = $instance['email'];
	
		echo $before_widget;		
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		$name_error = '';
		$email_error = '';
		$message_error = '';
						
		$wt_recaptcha_public_key = wt_get_option('wt_recaptcha_public_key');
		$wt_recaptcha_private_key = wt_get_option('wt_recaptcha_private_key');
		
		require_once( trailingslashit( get_stylesheet_directory() ) . 'framework/lib/recaptcha/recaptchalib.php' );
		
		if(isset($_POST['submitted'])){
			
			//validate sender name
			if(trim($_POST['sender_name']) === '') {
				$name_error = 'Please enter your name.';
				$has_error = true;
			} else {
				$name = trim($_POST['sender_name']);
			}
			
			//validate sender email
			if(trim($_POST['sender_email']) === '')  {
				$email_error = 'Please enter your email address.';
				$has_error = true;
			} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['sender_email']))) {
				$email_error = 'Please enter a valid email address.';
				$has_error = true;
			} else {
				$email = trim($_POST['sender_email']);
			}
			
			//validate message
			if(trim($_POST['message_text']) === '') {
				$message_error = 'Please enter a message.';
				$has_error = true;
			} else {
				if(function_exists('stripslashes')) {
					$message = stripslashes(trim($_POST['message_text']));
				} else {
					$message = trim($_POST['message_text']);
				}
			}
			
			//if no error, send email.
			if(!isset($has_error)) {
			
				if (!isset($email_to) || ($email_to == '') ){
					$email_to = get_option('admin_email');				
				}			
				
				$subject = 'Contact Message From '.$name;
				$body = "Name: $name \n\nEmail: $email \n\nMessage:\n $message";
				$headers = 'From: '.$name.' <'.$email_to.'>' . "\r\n" . 'Reply-To: ' . $email;
				
				mail($email_to, $subject, $body, $headers);
				$email_sent = true;
			
			}		
			
	   }
?>			
			<?php if(isset($email_sent) && $email_sent == true) { ?>
			
				<div class="success">
					<p><?php _e('Thank you. Your message was sent successfully.', 'wellthemes') ?></p>
				</div>
		
			<?php } else { ?> 
			
				<?php if(isset($has_error)) { ?>
					<p class="error"><?php _e('Please correct the following errors and try again.', 'wellthemes') ?></p>
				<?php } ?>			
				
				<script type="text/javascript">
					<!--//--><![CDATA[//><!--
					jQuery(document).ready(function() {
						jQuery('form#widget_contact_form').submit(function() {
							jQuery('form#widget_contact_form .error').remove();
							var hasError = false;
							
							jQuery('.wrequiredField').each(function() {
								if(jQuery.trim(jQuery(this).val()) == '') {
								
									if(jQuery(this).hasClass('wname_field')) {
										jQuery(this).parent().append('<span class="error"><?php _e('Please enter your name.', 'wellthemes'); ?></span>');
									}
									
									if(jQuery(this).hasClass('email')) {
										jQuery(this).parent().append('<span class="error"><?php _e('Please enter your email.', 'wellthemes'); ?></span>');
									}
									
									if(jQuery(this).hasClass('message_field')) {
										jQuery(this).parent().append('<span class="error"><?php _e('Please enter your message.', 'wellthemes'); ?></span>');
									}
									
									if(jQuery(this).hasClass("captcha_field")) {
										jQuery(this).parent().append('<span class="error"><?php _e('Please enter the security code.', 'wellthemes'); ?></span>');
									}
					
									jQuery(this).addClass('inputError');
									hasError = true;
								} else if(jQuery(this).hasClass('email')) {
									var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
									if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
										var labelText = jQuery(this).prev().text();
										labelText = labelText.toLowerCase();
										jQuery(this).parent().append('<span class="error"><?php _e('You entered an invalid', 'wellthemes'); ?> '+labelText+'.</span>');
										jQuery(this).addClass('inputError');
										hasError = true;
									}
								}
							});
						
							if(!hasError) {
								var formInput = jQuery(this).serialize();
								jQuery.post(jQuery(this).attr('action'),formInput, function(data){
									jQuery('form#widget_contact_form').slideUp("200", function() {				   
										jQuery(this).before('<div class="success"><?php _e('Thank you. Your message was sent successfully.', 'wellthemes');  ?></div>');
									});
								});
							}
														
							return false;
		
						});
					});
					//-->!]]>
				</script>
				<script type="text/javascript">
					var RecaptchaOptions = {
					theme : 'custom',
					custom_theme_widget: 'recaptcha_widget'
					};
				</script>
				<form action="<?php $_SERVER['PHP_SELF']; ?>" id="widget_contact_form" method="post">
          
					<div class="field">
						<label for="sender_name"><?php _e('Name', 'wellthemes') ?></label>
						
						<input type="text" class="text wname_field wrequiredField" name="sender_name" id="sender_name" value="<?php if(isset($_POST['sender_name'])) echo $_POST['sender_name'];?>" />
							<?php if($name_error != '') { ?>
								<span class="error"><?php echo $name_error; ?></span>  
							<?php } ?>
					</div>
              
					<div class="field">
						<label for="sender_email"><?php _e('Email', 'wellthemes') ?></label>
						<input type="text" class="text wrequiredField email" name="sender_email" id="sender_email" value="<?php if(isset($_POST['sender_email']))  echo $_POST['sender_email'];?>" />
							<?php if($email_error != '') { ?>
								<span class="error"><?php echo $email_error; ?></span> 
							<?php } ?>	
					</div>
             
					<div class="field">		
						<label for="message_text"><?php _e('Message', 'wellthemes') ?></label>
						<textarea class="message_field wrequiredField" name="message_text" id="message_text"><?php if(isset($_POST['message_text'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message_text']); } else { echo $_POST['message_text']; } } ?></textarea>
						<?php if($message_error != '') { ?>
							<span class="error"><?php echo $message_error; ?></span> 
						<?php } ?>				
					</div>
					
					
					<div id="recaptcha_widget" style="display:none">							
						
						<div class="field">
							<div id="recaptcha_image"></div>								
						</div>
						
						<div class="field">								   
						   <div class="recaptcha_only_if_incorrect_sol" style="color:red"><?php _e('Incorrect please try again', 'wellthemes'); ?></div>
						   <span class="recaptcha_only_if_image"><?php _e('Enter the words above:', 'wellthemes'); ?></span>
						   <span class="recaptcha_only_if_audio"><?php _e('Enter the numbers you hear:', 'wellthemes'); ?></span>
						   <input type="text" id="recaptcha_response_field" class="text wrequiredField captcha_field" name="recaptcha_response_field" />							 
						</div>
						
						<div class="recaptcha-help-wrap">
							<div class="recaptcha_refresh"><a href="javascript:Recaptcha.reload()"><?php _e('Refresh', 'wellthemes'); ?></a></div>
							<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')"><?php _e('Audio ', 'wellthemes'); ?></a></div>
							<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')"><?php _e('Image', 'wellthemes'); ?></a></div>
							<div class="recaptcha_help"><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', 'wellthemes'); ?></a></div>
						</div>
						

						<script type="text/javascript"
							src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $wt_recaptcha_public_key; ?>">
						</script>
						<noscript>
						   <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $wt_recaptcha_public_key; ?>"
								height="300" width="500" frameborder="0"></iframe><br>
							<textarea name="recaptcha_challenge_field" rows="3" cols="40">
						   </textarea>
						   <input type="hidden" name="recaptcha_response_field"
								value="manual_challenge">
						</noscript>
					</div>
					
					
					<div class="field">
						<input type="hidden" name="submitted" id="submitted" value="true" />
						<input type="submit" name="wt_wsubmit" value="Send" class="main-color-bg button" />
					</div>
					
				</form>
			
			<?php 
			} 			
			
			echo $after_widget; 		
		}
}

?>