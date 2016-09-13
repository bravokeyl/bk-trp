<?php
include_once( get_template_directory() . '/lib/init.php' );

include_once( get_stylesheet_directory() . '/lib/bk-cpt.php' );

define('CHILD_THEME_NAME','TechReviewPro');
define('CHILD_THEME_VERSION','1.0.0');

add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Menu' ) );
add_theme_support( 'genesis-footer-widgets', 3 );
add_theme_support( 'genesis-connect-woocommerce' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

add_image_size('home-top','300','200', true);

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
	wp_enqueue_style( 'trp-app', get_stylesheet_directory_uri().'/css/bk.css', array('dashicons'), null );

	wp_dequeue_style('techreviewpro');
}

//remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_action( 'genesis_after_header', 'genesis_do_nav' );

add_action('genesis_header','genesis_do_nav');

genesis_register_sidebar( array(
	'id'          => 'below-header',
	'name'        => __( 'Ad: Below Header','trp' ),
	'description' => __( 'This is for the ad below hedaer.','trp' ),
) );

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

genesis_register_sidebar( array(
	'id'          => 'home-deals',
	'name'        => __( 'Home Deals','trp' ),
	'description' => __( 'Home Deals section.','trp' ),
) );

genesis_register_sidebar( array(
	'id'          => 'trp-btad',
	'name'        => __( 'Ad: Below Title','trp' ),
	'description' => __( 'Ad which is below title and before content.','trp' ),
) );

genesis_register_sidebar( array(
	'id'          => 'trp-pead',
	'name'        => __( 'Ad: Post End','trp' ),
	'description' => __( 'Ad which is at the end of the post.','trp' ),
) );

genesis_register_sidebar( array(
	'id'          => 'trp-ad-3',
	'name'        => __( 'Ad: Three','trp' ),
	'description' => __( 'Ad three using [trp-ad id="3" or After Second para Ad','trp' ),
) );

genesis_register_sidebar( array(
	'id'          => 'trp-ad-4',
	'name'        => __( 'Ad: Four','trp' ),
	'description' => __( 'Ad four [trp-ad id="4"].','trp' ),
) );

genesis_register_sidebar( array(
	'id'          => 'trp-ad-beau',
	'name'        => __( 'Ad: Below Author','trp' ),
	'description' => __( 'Ad below author box.','trp' ),
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

add_action('genesis_after_header','trp_ad_below_header');
function trp_ad_below_header() {
	if(is_active_sidebar('below-header')) {
		genesis_widget_area( 'below-header', array(
			'before' => '<div id="below-header" class="below-header"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	}
	else {?>
		<div id="below-header" class="below-header"></div>
	<?php }
}
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action('genesis_before_content','genesis_do_breadcrumbs');
add_action('genesis_before_content','trp_post_title');
function trp_post_title() {
	if(is_single()) {
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		echo '<h1>'.get_the_title().'</h1>';
	}
}

add_post_type_support( 'trp_deals', 'genesis-layouts' );
function trp_cpt_layout() {
    if( 'trp_deals' == get_post_type() ) {
        return 'full-width-content';
    }
}
add_filter( 'genesis_site_layout', 'trp_cpt_layout' );

add_filter('excerpt_more','trp_read_more');

function trp_read_more() {
	return '<div class="trp-read-more"><a href='.esc_url(get_permalink()).'>Click to Continue</a></div>';
}

add_action('genesis_entry_header','trp_below_title_ad',14);
function trp_below_title_ad() {
	if(!is_home() && !is_archive()) {
		genesis_widget_area( 'trp-btad', array(
			'before' => '<div id="trp-btad" class="trp-btad">',
			'after'  => '</div>',
		) );
	}
}

add_action('genesis_entry_footer','trp_post_end_ad',20);
function trp_post_end_ad() {
	if(is_single()) {
		genesis_widget_area( 'trp-pead', array(
			'before' => '<div id="trp-pead" class="trp-pead">',
			'after'  => '</div>',
		) );
	}
}


function trp_get_dynamic_sidebar($index = 1) {
	$sidebar_contents = "";
	ob_start();
	if ( is_active_sidebar( $index ) ){
		dynamic_sidebar($index);
	}
	$sidebar_contents = ob_get_clean();
	return $sidebar_contents;
}

add_shortcode('trp-ad','trp_ad');
function trp_ad($atts) {
	$id = 0;
	if(!empty($atts['id'])){
		$id = $atts['id'];
	}
	$index = 'trp-ad-'.$id;
	return trp_get_dynamic_sidebar($index);
}

add_filter( 'the_content', 'trp_insert_post_ads' );

function trp_insert_post_ads( $content ) {

	$ad3 = trp_get_dynamic_sidebar('trp-ad-3');
	$ad4 = trp_get_dynamic_sidebar('trp-ad-4');

	if ( is_single() && ! is_admin() ) {
		return trp_insert_after_paragraph( $ad3, $ad4, $content );
	}

	return $content;
}

function trp_insert_after_paragraph( $ad3, $ad4, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}
		if ( 2 == $index + 1 ) {
			$paragraphs[$index] .= $ad3;
		}
		if ( 6 == $index + 1 ) {
			$paragraphs[$index] .= $ad4;
		}
	}

	return implode( '', $paragraphs );
}

add_action( 'genesis_after_entry', 'trp_do_author_ad', 9 );
function trp_do_author_ad() {
	if ( ! is_single() || ! post_type_supports( get_post_type(), 'author' ) )
		return;

	genesis_widget_area( 'trp-ad-beau', array(
		'before' => '<div id="trp-ad-beau" class="trp-ad-beau">',
		'after'  => '</div>',
	) );
}

add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );

remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


add_action( 'genesis_entry_header', 'trp_post_image', 3 );

function trp_post_image() {
	echo '<div class="trp-entry-image">';
	if ( ! is_singular() && genesis_get_option( 'content_archive_thumbnail' ) ) {

		$img = genesis_get_image( array(
			'format'  => 'html',
			'size'    => genesis_get_option( 'image_size' ),
			'context' => 'archive',
			'attr'    => genesis_parse_attr( 'entry-image', array ( 'alt' => get_the_title() ) ),
		) );

		if ( ! empty( $img ) ) {

			genesis_markup( array(
 				'html5'   => '<a %s>',
 				'xhtml'   => '<a href="' . get_permalink() . '" class="entry-image-link" aria-hidden="true">',
 				'context' => 'entry-image-link'
 			));

  			echo $img . '</a>';

 		}

	}
	echo '</div>';
}

add_action('genesis_header','trp_search',30);
function trp_search() {
	echo get_search_form();
}
