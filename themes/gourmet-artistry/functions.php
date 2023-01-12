<?php
/**
 * Gourmet Artistry functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gourmet_Artistry
 */

if ( ! function_exists( 'gourmet_artistry_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function gourmet_artistry_exerpt($length) {
	return 30;
}
add_filter('excerpt_length','gourmet_artistry_exerpt', 999);

function gourmet_artistry_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Gourmet Artistry, use a find and replace
	 * to change 'gourmet-artistry' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'gourmet-artistry', get_template_directory() . '/languages' );

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

	add_image_size( 'slider', 1200, 475, true );
	add_image_size( 'entry', 619, 462, true );
	add_image_size( 'single-image', 800, 300, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'gourmet-artistry' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'gourmet-artistry' ),
		'social-menu' => esc_html__( 'Social Menu', 'gourmet-artistry' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gourmet_artistry_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'gourmet_artistry_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gourmet_artistry_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gourmet_artistry_content_width', 640 );
}
add_action( 'after_setup_theme', 'gourmet_artistry_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gourmet_artistry_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gourmet-artistry' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'gourmet-artistry' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title text-center separator">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'gourmet_artistry_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gourmet_artistry_scripts() {
	wp_enqueue_style('foundation-styles', get_template_directory_uri() . '/css/app.css'  );

	wp_enqueue_style('foundation-icons', get_template_directory_uri() . '/css/foundation-icons.css'  );

  wp_enqueue_script('jquery');
	wp_enqueue_script( 'gourmet-artistry-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'gourmet-artistry-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('foundation-js', get_template_directory_uri() . '/js/foundation.js', array('jquery'), '20151215', true );
  wp_enqueue_script('what-input', get_template_directory_uri() . '/js/what-input.min.js', array(), '20151215', true );
  wp_enqueue_script('app-js', get_template_directory_uri() . '/js/app.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gourmet_artistry_scripts' );

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
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';
