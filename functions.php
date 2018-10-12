<?php
/**
 * asdf functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package asdf
 */

if ( ! function_exists( 'asdf_setup' ) ) :

	function asdf_setup() {

		//Translation
		load_theme_textdomain( 'asdf', get_template_directory() . '/languages' );

		//Theme Supports
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));

		//Navigation
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'asdf' ),
		) );

		//image sizes
		add_image_size( 'asdf-logo', 250 );
		add_image_size( 'asdf-thumbnail', 920 ); // For archive
		add_image_size( 'asdf-full', 1500 ); // For single
    add_image_size( 'homepage-thumb', 220, 180, true );
}


endif;
add_action( 'after_setup_theme', 'asdf_setup' );



//Default content width
function asdf_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'asdf_content_width', 640 );
}
add_action( 'after_setup_theme', 'asdf_content_width', 0 );



//Widget areas
function asdf_widgets_init() {
	//sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'asdf' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'asdf' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	//footer
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'asdf' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Add widgets here.', 'asdf' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s col-sm col-xs-12">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

}
add_action( 'widgets_init', 'asdf_widgets_init' );



//Scripts and styles
function asdf_scripts() {
	wp_enqueue_style( 'asdf-style', get_stylesheet_uri() );

	wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js');

	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );

	wp_enqueue_style( 'source-sans-pro-font', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' );

	wp_enqueue_script( 'asdf-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'asdf-min-style', get_stylesheet_directory_uri() . '/sass/style.min.css' );
}
add_action( 'wp_enqueue_scripts', 'asdf_scripts' );




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
 * Theme settings
 */
require get_template_directory() . '/inc/theme-settings/settings.php';

/**
 * Customizer
 */
require get_template_directory() . '/inc/theme-customizer/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
