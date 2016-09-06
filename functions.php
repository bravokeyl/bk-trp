<?php
include_once( get_template_directory() . '/lib/init.php' );

define('CHILD_THEME_NAME','TechReviewPro');
define('CHILD_THEME_VERSION','1.0.0');

add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Menu' ) );
add_theme_support( 'genesis-footer-widgets', 3 );
add_theme_support( 'genesis-connect-woocommerce' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

add_image_size('home-top','300','200', true);
add_image_size('home-main','630','9999');

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

	wp_enqueue_style( 'trp-font', "//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700", array(), null );

	//wp_enqueue_style( 'trp-fa', get_stylesheet_directory_uri().'/lib/fa/css/font-awesome.min.css', array(), null );
	wp_enqueue_style( 'trp-app', get_stylesheet_directory_uri().'/css/bk.css', array(), null );

	wp_dequeue_style('techreviewpro');
}

remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_action( 'genesis_after_header', 'genesis_do_nav' );

add_action('genesis_header','genesis_do_nav');

genesis_register_sidebar( array(
	'id'          => 'home-left',
	'name'        => __( 'Home Left','trp' ),
	'description' => __( 'This is the home page left section.','trp' ),
) );

genesis_register_sidebar( array(
	'id'          => 'home-right',
	'name'        => __( 'Home Right','trp' ),
	'description' => __( 'This is the home page right section.','trp' ),
) );

genesis_register_sidebar( array(
	'id'          => 'home-newsletter',
	'name'        => __( 'Home Newsletter','trp' ),
	'description' => __( 'Below home top section.','trp' ),
) );

genesis_register_sidebar( array(
	'id'          => 'home-main',
	'name'        => __( 'Home Main','trp' ),
	'description' => __( 'Home Main section.','trp' ),
) );

remove_action('genesis_footer','genesis_do_footer');
add_action('genesis_footer','trp_footer');
function trp_footer() {
	$output  = '<p>';
	$output  = '<p>Copyright &copy; '.date( 'Y' ).' &middot;';
	$output .= ' <a href="'.esc_url(home_url()).'">'.get_bloginfo('name').'</a>';
	$output .= ' &middot; All Rights Reserved';
	$output .= '</p>';
	echo $output;
}
