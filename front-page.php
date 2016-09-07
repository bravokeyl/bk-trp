<?php
remove_action('genesis_loop','genesis_do_loop');
add_action('genesis_loop','trp_do_loop');
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

function trp_do_loop() {
  genesis_widget_area( 'home-main', array(
		'before' => '<div id="home-main" class="home-main"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

add_action('genesis_after_loop','trp_after_loop');
function trp_after_loop() {
  genesis_widget_area( 'home-deals', array(
		'before' => '<div id="home-deals" class="home-deals"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}
genesis();
