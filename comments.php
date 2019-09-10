<?php
/**
 * The template for displaying comments.
 * 
 * User Profile: https://profiles.wordpress.org/fahimmurshed
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Golpo
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php esc_html_e('Comments', 'golpo'); ?>
		</h2><!-- .comments-title -->

		<?php
        the_comments_navigation(array(
            'prev_text' => '<i class="material-icons">navigate_before</i><span class="hidden-sm">' . esc_html__('Older comments', 'golpo') . '</span>',
            'next_text' => '<span class="hidden-sm">' . esc_html__('Newer comments', 'golpo') . '</span><i class="material-icons">navigate_next</i>',
        )); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
                    'avatar_size' => 32,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php 
        the_comments_navigation(array(
            'prev_text' =>'<i class="material-icons">navigate_before</i><span class="hidden-sm hidden-md">' . __('Older comments', 'golpo') . '</span>',
            'next_text' => '<span class="hidden-sm hidden-md">' . __('Newer comments', 'golpo') . '</span><i class="material-icons">navigate_next</i>',
        ));

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'golpo' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().

	comment_form();
	?>

</div><!-- #comments -->