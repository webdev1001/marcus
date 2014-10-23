<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'marcus', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/lib/languages', 'marcus' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Marcus Theme', 'marcus' ) );
define( 'CHILD_THEME_URL', 'http://wpcanada.ca/our-themes/marcus' );
define( 'CHILD_THEME_VERSION', '2.0.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Javascript files
add_action( 'wp_enqueue_scripts', 'marcus_enqueue_scripts' );
function marcus_enqueue_scripts() {

	wp_enqueue_script( 'marcus-responsive-menu', get_stylesheet_directory_uri() . '/lib/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
}

//* Enqueue CSS files
add_action( 'wp_enqueue_scripts', 'marcus_enqueue_styles' );
function marcus_enqueue_styles() {

	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Dosis:400,700|Open+Sans:400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'marcus-dashicons-style', get_stylesheet_uri(), array('dashicons'), '1.0' );
	wp_enqueue_style( 'marcus-genericons-style', get_stylesheet_directory_uri() . '/lib/font/genericons.css' );
}

//* Add new image sizes
add_image_size( 'mini-square', 80, 80, TRUE );
add_image_size( 'featured-page', 367, 160, TRUE );
add_image_size( 'featured-post', 100, 100, TRUE );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Reposition the primary navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

//* Add before entry widget area to single post page
add_action( 'genesis_before_entry', 'marcus_before_entry' ); 
function marcus_before_entry() {

	if ( ! is_singular( 'post' ) )
		return;

	genesis_widget_area( 'before-entry', array(
		'before' => '<div class="before-entry widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

//* Add wrapper to breadcrumbs
add_filter( 'genesis_breadcrumb_args', 'marcus_breadcrumb_args' );
function marcus_breadcrumb_args( $args ) {
	$args['prefix'] = '<div class="breadcrumbwrapper"><div class="breadcrumb">';
	$args['suffix'] = '</div></div>';
	$args['sep'] = ' &raquo; ';
	return $args;
}

//* Add single post navigation
add_action( 'genesis_after_entry', 'genesis_prev_next_post_nav', 9 );

//* Customize the post info function
add_filter( 'genesis_post_info', 'marcus_post_info_filter' );
function marcus_post_info_filter( $post_info ) {

	if ( !is_page() ) {

	$post_info = '[post_date] [post_author_link] [post_comments] [post_edit]';
	return $post_info;

}}

//* Modify comment form
add_filter( 'comment_form_defaults', 'marcus_comment_form_defaults' );
function marcus_comment_form_defaults( $defaults ) {
 
	$defaults['title_reply'] = __( 'Join the Discussion!' );
	$defaults['comment_notes_before'] = '<p class="comment-box">' . __( 'Please submit your comment with a real name.' );
	$defaults['comment_notes_after'] = '<p class="comment-box">' . __( 'Thanks for your feedback!' );
	return $defaults;
 
}

//* Customize search form placeholder text
add_filter( 'genesis_search_text', 'marcus_search_text' );
function marcus_search_text( $text ) {
	return esc_attr( 'Search this website...' );
}

// Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

//* Include and hook tertiary navigation menu
require_once( CHILD_DIR . '/lib/includes/tertiary-navigation-menu.php' );
add_action( 'genesis_before_footer', 'genesis_do_subnavtwo' );

//* Register Genesis Menus
add_theme_support( 'genesis-menus', array( 'primary'   => __( 'Primary Navigation Menu', 'genesis' ), 'secondary' => __( 'Secondary Navigation Menu', 'genesis' ), 'tertiary' => __( 'Tertiary Navigation Menu', 'genesis' ), ) );

//* Register widget areas
genesis_register_sidebar( array(
	'id'		=> 'slider',
	'name'		=> __( 'Slider', 'marcus' ),
	'description'	=> __( 'This is the Slider section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-top-message',
	'name'		=> __( 'Home Top Message', 'marcus' ),
	'description'	=> __( 'This is the Home Top Message section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-action',
	'name'		=> __( 'Home Action', 'marcus' ),
	'description'	=> __( 'This is the Home Action section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-middle-1',
	'name'		=> __( 'Home Middle 1', 'marcus' ),
	'description'	=> __( 'This is the Home Middle 1 section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-middle-2',
	'name'		=> __( 'Home Middle 2', 'marcus' ),
	'description'	=> __( 'This is the Home Middle 2 section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-middle-3',
	'name'		=> __( 'Home Middle 3', 'marcus' ),
	'description'	=> __( 'This is the Home Middle 3 section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'home-signup',
	'name'		=> __( 'Home Signup', 'marcus' ),
	'description'	=> __( 'This is the Home Signup section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'pre-footer-1',
	'name'		=> __( 'Pre Footer 1', 'marcus' ),
	'description'	=> __( 'This is the Pre Footer 1 section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'pre-footer-2',
	'name'		=> __( 'Pre Footer 2', 'marcus' ),
	'description'	=> __( 'This is the Pre Footer 2 section of the homepage.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'before-entry',
	'name'		=> __( 'Before Entry', 'marcus' ),
	'description'	=> __( 'Widgets in this widget area will display before single entries.', 'marcus' ),
) );
genesis_register_sidebar( array(
	'id'		=> 'widget-page',
	'name'		=> __( 'Widget Page', 'marcus' ),
	'description'	=> __( 'This is the Widget Page template.', 'marcus' ),
) );