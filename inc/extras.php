<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Golpo
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function golpo_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'golpo_body_classes' );

	// Title Remover

	/**
	 * Filter the title and return empty string if necessary.
	 *
	 * @param $title string The old title
	 * @param int $post_id The post ID
	 *
	 * @return string Old title or empty string.
 	 */
function golpo_suppress_title( $title, $post_id = 0 ) {
	if ( ! $post_id ) {
		return $title;
	}

	$hide_title = get_post_meta( $post_id, 'golpo_hide_title', true );
	if ( ! is_admin() && is_singular() && intval( $hide_title ) && in_the_loop() ) {
		return '';
	}

	return $title;
}

add_filter( 'the_title', 'golpo_suppress_title', 10, 2 );

/*--------------------------------------------------
	MetaBox
----------------------------------------------------*/

add_action( 'load-post.php', 'golpo_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'golpo_post_meta_boxes_setup' );

function golpo_post_meta_boxes_setup() {
	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'golpo_add_post_meta_boxes' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'golpo_save_meta', 10, 2 );
}

function golpo_add_post_meta_boxes() {
	add_meta_box(
		'golpo-hide-title',
		esc_html__( 'Hide Title?', 'golpo' ),
		'golpo_render_metabox',
		null,
		'side',
		'core'
	);
}

function golpo_render_metabox( $post ) {
	$curr_value = get_post_meta( $post->ID, 'golpo_hide_title', true );
	wp_nonce_field( basename( __FILE__ ), 'golpo_meta_nonce' );
	?>
	<input type="hidden" name="golpo-hide-title-checkbox" value="0"/>
	<input type="checkbox" name="golpo-hide-title-checkbox" id="golpo-hide-title-checkbox"
	       value="1" <?php checked( $curr_value, '1' ); ?> />
	<label for="golpo-hide-title-checkbox"><?php esc_html_e( 'Clicke here to hide the title', 'golpo' ); ?></label>
	<?php
}

function golpo_save_meta( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( ! isset( $_POST['golpo_meta_nonce'] ) || ! wp_verify_nonce( $_POST['golpo_meta_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return;
	}

	/* Get the posted data and sanitize it for use as an HTML class. */
	$form_data = ( isset( $_POST['golpo-hide-title-checkbox'] ) ? $_POST['golpo-hide-title-checkbox'] : '0' );
	update_post_meta( $post_id, 'golpo_hide_title', $form_data );
}
