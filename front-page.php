<?php
// add_action('genesis_before_loop','trp_before_loop');
function trp_before_loop() {
  echo '<div class="trp-loop">';
}

add_action('genesis_before_content','trp_before_content');
function trp_before_content() {
  echo '<div class="bk-home-top">';
  genesis_widget_area( 'home-left', array(
		'before' => '<div id="home-left" class="home-left"><div class="wrap">',
		'after'  => '</div></div>',
	) );
  genesis_widget_area( 'home-right', array(
		'before' => '<div id="home-right" class="home-right"><div class="wrap">',
		'after'  => '</div></div>',
	) );
  echo '</div>';

  genesis_widget_area( 'home-newsletter', array(
		'before' => '<div id="home-newsletter" class="home-newsletter"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}


add_action('genesis_after_loop','trp_after_loop');
function trp_after_loop() {
  // echo '</div>';
  genesis_widget_area( 'home-deals', array(
		'before' => '<div id="home-deals" class="home-deals"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
genesis();
