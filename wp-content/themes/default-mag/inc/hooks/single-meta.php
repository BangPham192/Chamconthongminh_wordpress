<?php
/**
 * Implement theme metabox.
 *
 * @package Default Mag
 */

if ( ! function_exists( 'default_mag_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box
	 *
	 * @since 1.0.0
	 */
	function default_mag_add_theme_meta_box() {

		$apply_metabox_post_types = array( 'post', 'page' );

		foreach ( $apply_metabox_post_types as $key => $type ) {
			add_meta_box(
				'default-mag-theme-settings',
				esc_html__( 'Single Page/Post Settings', 'default-mag' ),
				'default_mag_render_theme_settings_metabox',
				$type
			);
		}

	}

endif;

add_action( 'add_meta_boxes', 'default_mag_add_theme_meta_box' );

if ( ! function_exists( 'default_mag_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 */
	function default_mag_render_theme_settings_metabox( $post, $metabox ) {

		$post_id = $post->ID;
		$default_mag_post_meta_value = get_post_meta($post_id);

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'default_mag_meta_box_nonce' );
		// Fetch Options list.
		$page_layout = get_post_meta($post_id,'default-mag-meta-select-layout',true);
	?>
	<div id="default-mag-settings-metabox-container" class="default-mag-settings-metabox-container">
		<div id="default-mag-settings-metabox-tab-layout">
			<h4><?php echo __( 'Layout Settings', 'default-mag' ); ?></h4>
			<div class="default-mag-row-content">
				 <!-- Checkbox Field-->
				     <p>
				     <div class="default-mag-row-content">
				         <label for="default-mag-meta-checkbox">
				             <input type="checkbox" name="default-mag-meta-checkbox" id="default-mag-meta-checkbox" value="yes" <?php if ( isset ( $default_mag_post_meta_value['default-mag-meta-checkbox'] ) ) checked( $default_mag_post_meta_value['default-mag-meta-checkbox'][0], 'yes' ); ?> />
				             <?php _e( 'Check To Enable Featured Image On Single Page', 'default-mag' )?>
				         </label>
				     </div>
				     </p>
			     <!-- Select Field-->
			        <p>
			            <label for="default-mag-meta-select-layout" class="default-mag-row-title">
			                <?php _e( 'Single Page/Post Layout', 'default-mag' )?>
			            </label>
			            <select name="default-mag-meta-select-layout" id="default-mag-meta-select-layout">
				            <option value="right-sidebar" <?php selected('right-sidebar',$page_layout);?>>
				            	<?php _e( 'Content - Primary Sidebar', 'default-mag' )?>
				            </option>
				            <option value="left-sidebar" <?php selected('left-sidebar',$page_layout);?>>
				            	<?php _e( 'Primary Sidebar - Content', 'default-mag' )?>
				            </option>
				            <option value="no-sidebar" <?php selected('no-sidebar',$page_layout);?>>
				            	<?php _e( 'No Sidebar', 'default-mag' )?>
				            </option>
			            </select>
			        </p>
			</div><!-- .default-mag-row-content -->
		</div><!-- #default-mag-settings-metabox-tab-layout -->
	</div><!-- #default-mag-settings-metabox-container -->

    <?php
	}

endif;



if ( ! function_exists( 'default_mag_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function default_mag_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if ( ! isset( $_POST['default_mag_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['default_mag_meta_box_nonce'], basename( __FILE__ ) ) ) {
			  return; }

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check permission.
		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return; }
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$default_mag_meta_checkbox =  isset( $_POST[ 'default-mag-meta-checkbox' ] ) ? esc_attr($_POST[ 'default-mag-meta-checkbox' ]) : '';
		update_post_meta($post_id, 'default-mag-meta-checkbox', sanitize_text_field($default_mag_meta_checkbox));

		$default_mag_meta_select_layout =  isset( $_POST[ 'default-mag-meta-select-layout' ] ) ? esc_attr($_POST[ 'default-mag-meta-select-layout' ]) : '';
		if(!empty($default_mag_meta_select_layout)){
			update_post_meta($post_id, 'default-mag-meta-select-layout', sanitize_text_field($default_mag_meta_select_layout));
		}
	}

endif;

add_action( 'save_post', 'default_mag_save_theme_settings_meta', 10, 3 );