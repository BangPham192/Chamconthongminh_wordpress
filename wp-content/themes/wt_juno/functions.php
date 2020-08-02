<?php
require( get_template_directory() . '/framework/functions.php' );

/**
 * Set the format for the more in excerpt, return ... instead of [...]
 */ 
function wellthemes_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'wellthemes_excerpt_more');



?>