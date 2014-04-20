<?php
/**
 * classic_blogging functions and definitions
 *
 * @package classic_blogging
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'classic_blogging_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function classic_blogging_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on classic_blogging, use a find and replace
	 * to change 'classic_blogging' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'classic_blogging', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'classic_blogging' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'classic_blogging_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // classic_blogging_setup
add_action( 'after_setup_theme', 'classic_blogging_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function classic_blogging_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'classic_blogging' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'classic_blogging_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function classic_blogging_scripts() {
	wp_enqueue_style( 'classic_blogging-style', get_stylesheet_uri() );

	wp_enqueue_script( 'classic_blogging-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'classic_blogging-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'classic_blogging_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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

// MODIFICATIONS

add_theme_support( 'post-thumbnails' );

// Add 140x140 image size 
add_image_size('excerpt-thumbnail', 140, 140, true);

// Remove the ... from excerpt and change the text
function change_excerpt_more()
{
  function new_excerpt_more($more)
	{
	// Use .read-more to style the link
	  return '<span class="continue-reading"> <a href="' . get_permalink() . '">Continue Reading  &rarr;</a></span>';
	}
  add_filter('excerpt_more', 'new_excerpt_more');
}
add_action('after_setup_theme', 'change_excerpt_more');
