<?php
/**
 * Golpo functions and definitions.
 * 
 * User Profile: https://profiles.wordpress.org/fahimmurshed
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Golpo
 */

if ( ! function_exists( 'golpo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function golpo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Golpo, use a find and replace
		 * to change 'golpo' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'golpo', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'golpo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'image',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'golpo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 100,
		) );
		// No need to set featured image size. If you need just uncomment this line
		// add_image_size( 'golpo-post-thumb', 870, 600, true );
	}
endif; // golpo_setup.
add_action( 'after_setup_theme', 'golpo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function golpo_content_width() {
	if ( ! isset( $content_width ) ) $content_width = 1200;
	else {
	$GLOBALS['golpo_content_width'] = apply_filters( 'golpo_content_width', 800 );
}
}
add_action( 'after_setup_theme', 'golpo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function golpo_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'golpo' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'golpo_widgets_init' );
/* translators: %s: golpo scripts */
/**
 * Enqueue scripts and styles.
 */
function golpo_scripts() {
	// Golpo CSS
	wp_enqueue_style( 'golpo-google-font', golpo_fonts_url(), false );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	// RTL start
	if(is_rtl()) {
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/css/bootstrap-rtl.css' );
	}
	// RTL end
	wp_enqueue_style( 'golpo-style', get_stylesheet_uri(), array( 'bootstrap', 'font-awesome' ) );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.css' );
	wp_enqueue_style( 'golpo-main', get_template_directory_uri() . '/assets/css/golpo.css' );

	// Golpo JS
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '20190522', true );
	wp_enqueue_script( 'golpo-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130112', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'golpo_scripts' );

if ( ! function_exists( 'golpo_fonts_url' ) ) :
/**
 * Register Google fonts for Golpo.
 *
 * Create your own golpo_fonts_url() function to override in a child theme.
 *
 * @since Golpo 1.0.0
 *
 * @return string Google fonts URL for the theme.
 */
function golpo_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin-ext,vietnamese';


	$fonts[] = 'Nunito:400,400i,600,600i,700,700i,800,800i,900,900i';

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

function golpo_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'golpo_add_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer Options
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * WPBootstrapNavWalker
 */
require_once get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Gutenberg support ❤
 */
add_theme_support('align-wide');

add_theme_support('editor-styles');

add_theme_support( 'editor-color-palette', array(
	array(
		'name' => __( 'strong magenta', 'golpo' ),
		'slug' => 'strong-magenta',
		'color' => '#a156b4',
	),
	array(
		'name' => __( 'light grayish magenta', 'golpo' ),
		'slug' => 'light-grayish-magenta',
		'color' => '#d0a5db',
	),
	array(
		'name' => __( 'very light gray', 'golpo' ),
		'slug' => 'very-light-gray',
		'color' => '#eee',
	),
	array(
		'name' => __( 'very dark gray', 'golpo' ),
		'slug' => 'very-dark-gray',
		'color' => '#444',
	),
) );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function golpo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'golpo_pingback_header' );
