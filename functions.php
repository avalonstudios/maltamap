<?php
/**
 * Malta Map Society functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Malta_Map_Society
 */

if ( ! function_exists( 'maltamap_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maltamap_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Malta Map Society, use a find and replace
		 * to change 'maltamap' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'maltamap', get_template_directory() . '/languages' );

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
		add_image_size( 'Blog_Images', 328, 205, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'maltamap' ),
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
		add_theme_support( 'custom-background', apply_filters( 'maltamap_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'maltamap_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maltamap_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'maltamap_content_width', 2000 );
}
add_action( 'after_setup_theme', 'maltamap_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function maltamap_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'maltamap' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'maltamap' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'maltamap_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function maltamap_scripts() {
	// Materialize CSS
	$link = "//cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css";
	//wp_enqueue_style( 'maltamap-materialize-css', $link, array(), '0.100.2' );

	// FontAwesome
	//$link = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css";
	$link = "//use.fontawesome.com/releases/v5.0.13/css/all.css";
	wp_enqueue_style( 'maltamap-fontawesome-css', $link, array(), '4.7.0' );	

	// Bootstrap CSS
	$link = "//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css";
	wp_enqueue_style( 'maltamap-bootstrap-css', $link, array(), '4.1.1' );

	$link = "//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css";
	wp_enqueue_style( 'maltamap-animate-css', $link, array(), '3.5.2' );

	// Main CSS
	wp_enqueue_style( 'maltamap-style', get_stylesheet_uri() );

	// Sidebar CSS
	//$showSidebar = get_field( 'show_sidebar' );
	//if ( SHOW_SIDEBAR || is_single() ) {
		wp_enqueue_style( 'maltamap-sidebar', get_template_directory_uri() . '/layouts/content-sidebar.css' );
	//}

	// Google Fonts
	$link = "//fonts.googleapis.com/css?family=Cinzel:400,700|Lora:400,400i,700,700i|Quattrocento:400,700";
	wp_enqueue_style( 'maltamap-googlefonts', $link );

	// JS
	$fldr = "/js/";
	$ext = ".js";
	$fldr = "/js/min/";
	$ext = ".min.js";


	// jQuery Migrate
	$link = "//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js";
	//wp_enqueue_script( 'maltamap-jqmigrate', $link, array(), '3.0.1', false );

	// jQuery
	$link = "//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js";
	wp_enqueue_script( 'maltamap-jquery', $link, array(), '3.3.1', false );

	// jQuery UI
	$link = "//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js";
	wp_enqueue_script( 'maltamap-jquery-ui', $link, array(), '1.12.1', true );

	// Custom JS
	wp_enqueue_script( 'maltamap-custom', get_template_directory_uri() . "{$fldr}custom{$ext}", array(), '0.0.1', true );
	
	// Puzzles JS
	wp_enqueue_script( 'maltamap-puzzles', get_template_directory_uri() . "{$fldr}puzzles{$ext}", array(), '0.0.1', true );

	wp_localize_script( 'maltamap-custom', 'ajaxObj', array(
		'ajaxURL'	=> admin_url( 'admin-ajax.php' ),
		'nonce'		=> wp_create_nonce( 'wp_rest' ),
		'siteURL'	=> get_site_url()
	));

	// Hide Menu
	//wp_enqueue_script( 'maltamap-hidemenu', get_template_directory_uri() . "{$fldr}hide-menu{$ext}", array(), '0.0.1', true );

	// Popper
	$link = "//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/popper.min.js";
	$link = "//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js";
	wp_enqueue_script( 'maltamap-popper', $link, array(), '1.14.3', true );


	// Bootstrap JS
	$link = "//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js";
	wp_enqueue_script( 'maltamap-bootstrap-js', $link, array( 'maltamap-jquery' ), '4.1.1', true );

	// Materialize JS
	$link = "//cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js";
//	wp_enqueue_script( 'maltamap-navigation', $link, array(), '0.100.2', true );

	//wp_enqueue_script( 'maltamap-navigation', get_template_directory_uri() . "{$fldr}navigation{$ext}", array(), '20151215', true );

	wp_enqueue_script( 'maltamap-skip-link-focus-fix', get_template_directory_uri() . "{$fldr}skip-link-focus-fix{$ext}", array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'maltamap_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page( array (
		'page_title'	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug'		=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Did You Know...',
		'menu_title'	=> 'Did You Know',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Map Puzzles',
		'menu_title'	=> 'Puzzles',
		'parent_slug'	=> 'theme-general-settings',
	));
}

require "inc/phpajaxcalls.php";

function add_allowed_origins( $origins ) {
	$origins[] = 'http://localhost:7889';
	$origins[] = 'http://localhost';
	return $origins;
}
add_filter( 'allowed_http_origins', 'add_allowed_origins' );