<?php
include_once( get_template_directory() . '/lib/init.php' );

define('CHILD_THEME_NAME','TechReviewPro');
define('CHILD_THEME_VERSION','1.0.0');

add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Menu' ) );
add_theme_support( 'genesis-footer-widgets', 4 );
add_theme_support( 'genesis-connect-woocommerce' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

unregister_sidebar( 'sidebar-alt' );
unregister_sidebar( 'header-right' );


genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'genesis_edit_post_link', '__return_false' );

add_action( 'wp_enqueue_scripts', 'trp_enqueue_scripts_styles' ,10);
function trp_enqueue_scripts_styles() {

	wp_enqueue_script( 'trp-custom', get_stylesheet_directory_uri().'/js/bk.js', array( 'jquery' ), null , true );

	wp_enqueue_style( 'trp-font', "//fonts.googleapis.com/css?family=Roboto:400,700", array(), null );

	//wp_enqueue_style( 'trp-fa', get_stylesheet_directory_uri().'/lib/fa/css/font-awesome.min.css', array(), null );
	wp_enqueue_style( 'trp-app', get_stylesheet_directory_uri().'/css/bk.css', array(), null );

	wp_dequeue_style('bk-trp');
}
