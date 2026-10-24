<?php
/**
 * Mursi Digital theme functions.
 *
 * @package Mursi_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MURSI_VERSION', '1.0.0' );
define( 'MURSI_DIR', get_template_directory() );
define( 'MURSI_URI', get_template_directory_uri() );

require MURSI_DIR . '/inc/helpers.php';
require MURSI_DIR . '/inc/data.php';
require MURSI_DIR . '/inc/customizer.php';
require MURSI_DIR . '/inc/post-types.php';
require MURSI_DIR . '/inc/contact-form.php';
require MURSI_DIR . '/inc/schema.php';

/**
 * Theme setup.
 */
function mursi_setup() {
	load_theme_textdomain( 'mursi-digital', MURSI_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 88,
			'width'       => 280,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_image_size( 'mursi-project', 960, 600, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'mursi-digital' ),
			'footer'  => __( 'Footer Menu', 'mursi-digital' ),
		)
	);
}
add_action( 'after_setup_theme', 'mursi_setup' );

/**
 * Content width.
 */
function mursi_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'mursi_content_width', 0 );

/**
 * Enqueue styles and scripts.
 */
function mursi_enqueue_assets() {
	wp_enqueue_style( 'mursi-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );
	wp_enqueue_style( 'mursi-style', get_stylesheet_uri(), array( 'mursi-fonts' ), MURSI_VERSION );
	wp_enqueue_script( 'mursi-main', MURSI_URI . '/assets/js/main.js', array(), MURSI_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mursi_enqueue_assets' );

/**
 * Preconnect to Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function mursi_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'mursi_resource_hints', 10, 2 );

/**
 * Swap no-js class for js as early as possible.
 */
function mursi_js_class() {
	echo "<script>document.documentElement.classList.replace('no-js','js');</script>\n";
}
add_action( 'wp_head', 'mursi_js_class', 0 );

/**
 * Register page templates stored in /page-templates (WordPress finds them automatically),
 * and add a body class per template for styling hooks.
 *
 * @param array $classes Body classes.
 * @return array
 */
function mursi_body_classes( $classes ) {
	if ( is_page_template() ) {
		$classes[] = 'tpl-' . sanitize_html_class( basename( get_page_template_slug(), '.php' ) );
	}
	return $classes;
}
add_filter( 'body_class', 'mursi_body_classes' );

/**
 * Excerpt length.
 *
 * @return int
 */
function mursi_excerpt_length() {
	return 22;
}
add_filter( 'excerpt_length', 'mursi_excerpt_length' );
