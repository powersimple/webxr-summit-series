<?php
/**
 * BeOnePage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BeOnePage
 */

if ( ! function_exists( 'beonepage_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function beonepage_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BeOnePage, use a find and replace
	 * to change 'beonepage' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'beonepage', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Add style sheet for WordPress visual editor.
	add_editor_style( 'layouts/editor.style.css' );
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
	add_image_size( 'featured-thumb', 720, 480, true  );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Header Menu', 'beonepage' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'image'
	) );
}
endif; // beonepage_setup
add_action( 'after_setup_theme', 'beonepage_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beonepage_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'beonepage_content_width', 1140 );
}
add_action( 'after_setup_theme', 'beonepage_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beonepage_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'beonepage' ),
		'id'            => 'sidebar-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'beonepage_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function beonepage_scripts() {
	wp_enqueue_style( 'beonepage-bootstrap-style', get_template_directory_uri() . '/layouts/bootstrap.min.css', array(), '3.3.5' );

	wp_enqueue_style( 'beonepage-font-awesome-style', get_template_directory_uri() . '/layouts/font.awesome.min.css', array(), '4.4.0' );

	wp_enqueue_style( 'beonepage-magnific-popup-style', get_template_directory_uri() . '/layouts/magnific.popup.css', array(), '1.0.0' );

	wp_enqueue_style( 'beonepage-style', get_stylesheet_uri() );

	wp_enqueue_style( 'beonepage-responsive-style', get_template_directory_uri() . '/layouts/responsive.css', array(), beonepage_get_version() );

	wp_enqueue_script( 'beonepage-jRespond-script', get_template_directory_uri() . '/js/jrespond.min.js', array(), '0.10', true );

	wp_enqueue_script( 'beonepage-smoothscroll-script', get_template_directory_uri() . '/js/smooth.scroll.js', array(), '1.4.0', true );

	wp_enqueue_script( 'beonepage-transit-script', get_template_directory_uri() . '/js/jquery.transit.js', array(), '0.9.12', true );

	wp_enqueue_script( 'beonepage-easing-script', get_template_directory_uri() . '/js/jquery.easing.min.js', array(), '1.3.2', true );

	wp_enqueue_script( 'beonepage-imagesloaded-script', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), '3.1.8', true );

	wp_enqueue_script( 'beonepage-isotope-script', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '2.2.2', true );

	wp_enqueue_script( 'beonepage-nicescroll-script', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array(), '3.6.0', true );

	wp_enqueue_script( 'beonepage-smooth-scroll-script', get_template_directory_uri() . '/js/jquery.smooth.scroll.min.js', array(), '1.5.6', true );

	wp_enqueue_script( 'beonepage-magnific-popup-script', get_template_directory_uri() . '/js/jquery.magnific.popup.min.js', array(), '1.0.0', true );

	wp_enqueue_script( 'beonepage-validate-script', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), '1.14.0', true );

	wp_enqueue_script( 'beonepage-app-script', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), beonepage_get_version(), true );

	// Localize the script with new data.
	wp_localize_script( 'beonepage-app-script', 'app_vars', array(
		'ajax_url'         => admin_url( 'admin-ajax.php' ),
		'home_url'         => esc_url( home_url( '/' ) ),
		'current_page_url' => beonepage_get_current_url(),
		'accent_color'     => '#ffcc00'
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'beonepage_scripts' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgmpa/tgm-plugin-activation.php';

/**
 * Load Kirki Customizer Toolkit.
 */
require_once get_template_directory() . '/inc/kirki/kirki.php';

/**
 * Load Customizer configuration.
 */
require_once get_template_directory() . '/inc/kirki/config.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Comments Callback.
 */
require_once get_template_directory() . '/inc/comments-callback.php';

/**
 * Add breadcrumb.
 */
require_once get_template_directory() . '/inc/breadcrumb.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';




?>