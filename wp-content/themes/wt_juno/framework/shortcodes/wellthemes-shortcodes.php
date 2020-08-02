<?php

function wt_shortcodes_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'wt_shortcodes_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'wt_shortcodes_register_mce_button' );
	}
}
add_action('admin_head', 'wt_shortcodes_add_mce_button');


function wt_shortcodes_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['wt_shortcodes_mce_button'] = get_template_directory_uri().'/framework/shortcodes/tinymce/plugin.js';
	return $plugin_array;
}


function wt_shortcodes_register_mce_button( $buttons ) {
	array_push( $buttons, 'wt_shortcodes_mce_button' );
	return $buttons;
}


function wt_shortcodes_mce_css() {
	wp_enqueue_style('wt_shortcodes_mce', get_template_directory_uri().'/framework/shortcodes/tinymce/css/editor.css' );
}
add_action( 'admin_enqueue_scripts', 'wt_shortcodes_mce_css' );

?>