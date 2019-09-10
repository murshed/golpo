<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Golpo
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function golpo_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'golpo' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'golpo' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'golpo' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function golpo_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'golpo' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'golpo_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function golpo_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s </time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">'.__('Published on: ', 'golpo').' %2$s</time> '.__('Updated: ', 'golpo').'<time class="updated hidden" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	$categories = get_the_category_list( esc_html__( ', ', 'golpo' ) );

	if ( $categories ) {
		$categories = '<span class="posted-in"><i class="fa fa-folder-open"></i> ' . wp_kses($categories, array('a' => array('href' => array(), 'rel' => array()))) . '</span>';
	}

	echo '<span class="posted-on"><i class="fa fa-calendar"></i> ' . wp_kses_post($posted_on) . '</span> <span class="byline"><i class="fa fa-user"></i> ' . wp_kses_post($byline) . '</span> '.wp_kses_post($categories);

}
endif;

if ( ! function_exists( 'golpo_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function golpo_entry_footer() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		echo '<i class="fa fa-comments"></i> ';
		comments_popup_link( esc_html__( 'Leave a comment', 'golpo' ), esc_html__( '1 Comment', 'golpo' ), esc_html__( '% Comments', 'golpo' ) );
		echo '</span>';
	}

	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'golpo' ) );
		if ( $tags_list ) {
			/* translators: tags_list */
			printf( '<span class="tags-links">' . wp_kses( __( '<i class="fa fa-tags"></i> %1$s', 'golpo' ), array('i' => array( 'class' => array() ))) . '</span>', wp_kses_post($tags_list) ); // WPCS: XSS OK.
		}
	}

	

	edit_post_link( esc_html__( 'Edit', 'golpo' ), '<span class="edit-link"><i class="fa fa-pencil"></i> ', '</span>' );
}
endif;

if ( ! function_exists( 'golpo_category_transient_flusher' ) ) :
/**
 * Flush out the transients used in golpo_categorized_blog.
 */
function golpo_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'golpo_categories' );
}
add_action( 'edit_category', 'golpo_category_transient_flusher' );
add_action( 'save_post',     'golpo_category_transient_flusher' );
endif;
