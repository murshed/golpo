<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Golpo
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses golpo_header_style()
 */
function golpo_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'golpo_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'golpo_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'golpo_custom_header_setup' );

if ( ! function_exists( 'golpo_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see golpo_custom_header_setup().
 */
function golpo_header_style() {
	$header_text_color = get_theme_mod('header_textcolor', '#ffffff');


	$header_bg_color = get_theme_mod( 'header_bg_color', '#030120' );
	$header_image = get_custom_header();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: <?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	.site-header{
		background-color: <?php echo esc_attr($header_bg_color); ?>;
		<?php if(isset($header_image->url) && !empty($header_image->url)): ?>
			background-image: url("<?php echo esc_url($header_image->url); ?>");
		<?php endif; ?>
	}
	</style>
	<?php
}
endif; // This is Golpo_header_style